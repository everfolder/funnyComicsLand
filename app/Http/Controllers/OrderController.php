<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $currentUserPassword = User::where('id', auth()->id())->first()->password;
        if (md5($request->password) != $currentUserPassword) {
            return redirect()->back()->with('error', 'Неверный пароль');
        }

        $order = new Order();
        $order->user_id = auth()->id();
        $order->save();

        $cartItems = CartItem::query()->where('user_id', auth()->id())->get();
        $currentOrderId = Order::query()->where('user_id', auth()->id())->latest()->first()->id;

        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $cartItem->product_id;
            $orderItem->count = $cartItem->count;
            $orderItem->price = $cartItem->product->price;
            $orderItem->order_id = $currentOrderId;
            $cartItem->product->count -= $cartItem->count;

            $cartItem->product->save();
            $orderItem->save();
        }

        CartItem::query()->where('user_id', auth()->id())->delete();
        return redirect()->back()->with('success', 'Заказ успешно оформлен, можете перейти во вкладку с заказами');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order, Request $request)
    {
        $request->validate([
            'status_id' => 'required|exists:statuses,id',
            'cansel'    => 'required_if:status_id,2|nullable|string|max:1000',
        ], [
            'cansel.required_if' => 'Укажите причину отмены заказа.',
        ]);
        if ($order->status_id == $request->status_id) {
            return redirect()->back()->with('error', 'Выбран текущий статус');
        }

        $order->cansel = $request->cansel;
        $order->status_id = $request->status_id;

        if ($request->status_id != 2) {
            $order->cansel = null;
        } else {
            foreach ($order->items as $item) {
                $currentProduct = Product::where('id', $item->product_id)->first();
                $currentProduct->count += $item->count;
                $currentProduct->save();
            }
        }
        $order->save();

        return redirect()->back()->with('success', 'Статус успешно изменен');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back();
    }
    public function filter(Request $request) {
        if(Auth::user()->is_admin != 1){
            return redirect()->back();
        }
        if ($request->filter_status && $request->filter_status != 0) {
            $orders = Order::where('status_id', $request->filter_status)->get();
        }
        $products = Product::all();
        $categories = Category::all();
        $statuses = Status::all();
        return view('admin.index', ['categories' => $categories, 'orders' => $orders, 'statuses' => $statuses, 'products' => $products]);
    }
}
