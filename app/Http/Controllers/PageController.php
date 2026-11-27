<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function welcome() {
        return view('pages.welcome');
    }
    public function registration() {
        return view('pages.registration');
    }
    public function auth() {
        return view('pages.auth');
    }
    public function admin_index() {
        if(Auth::user()->is_admin != 1){
            return redirect()->back();
        }

        $categories = Category::all();
        $orders = Order::all();
        $statuses = Status::all();
        return view('admin.index', ['categories' => $categories, 'orders' => $orders, 'statuses' => $statuses]);
    }
    public function about() {
        $products = Product::latest()->take(5)->get();
        return view('pages.about', ['products' => $products]);
    }
    public function where() {
        return view('pages.where');
    }
    public function catalog(Request $request) {
        $categories = Category::all();
        $inCart = CartItem::query()->where('user_id',Auth::id())->pluck('product_id')->flip()->all();
        $sortedProducts = Product::query();

        if ($request->category_id && $request->category_id != 0 ) {
            $sortedProducts = $sortedProducts->where('category_id', $request->category_id);
        }

        switch ($request->sort) {
            case 'year_desc':
                $sortedProducts->orderBy('year', 'desc');
                break;
            case 'year_asc':
                $sortedProducts->orderBy('year', 'asc');
                break;
            case 'price_desc':
                $sortedProducts->orderBy('price', 'desc');
                break;
            case 'price_asc':
                $sortedProducts->orderBy('price', 'asc');
                break;
            case 'title_asc':
                $sortedProducts->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $sortedProducts->orderBy('title', 'desc');
                break;

        }

        $sortedProducts = $sortedProducts->get();
        return view('pages.catalog', ['products' => $sortedProducts, 'categories' => $categories, 'inCart' => $inCart]);
    }
    public function cart() {
        $cartItems = CartItem::query()->where('user_id',Auth::id())->get();
        $sum = 0;
        foreach ($cartItems as $cartItem) {
            $sum += $cartItem->product->price * $cartItem->count;
        }
        return view('pages.cart', ['cartItems' => $cartItems, 'sum' => $sum]);
    }
    public function orders() {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('pages.orders', ['orders' => $orders]);
    }
}
