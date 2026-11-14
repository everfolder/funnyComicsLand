<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

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
    public function create()
    {
        $order = new Order();
        $order->user_id = auth()->id();
        $order->save();

        $cartItems = CartItem::query()->where('user_id', auth()->id())->get();
        $currentOrderId = Order::query()->where('user_id', auth()->id())->latest()->first()->id;

//        dd($currentOrderId . $cartItems);

        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->product_id = $cartItem->product_id;
            $orderItem->count = $cartItem->count;
            $orderItem->price = $cartItem->product->price;
            $orderItem->order_id = $currentOrderId;
            $orderItem->save();
        }


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
    public function edit(Order $order)
    {
        //
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
        //
    }
}
