<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
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
        $categories = Category::all();
        $orders = Order::all();
        return view('admin.index', ['categories' => $categories, 'orders' => $orders]);
    }
    public function about() {
        $products = Product::latest()->take(5)->get();
        return view('pages.about', ['products' => $products]);
    }
    public function where() {
        return view('pages.where');
    }
    public function catalog() {
        $products = Product::all();
        $inCart = CartItem::query()->where('user_id',Auth::id())->pluck('product_id')->flip()->all();
        return view('pages.catalog', ['products' => $products, 'inCart' => $inCart]);
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
