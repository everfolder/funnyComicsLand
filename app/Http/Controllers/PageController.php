<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
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
        return view('admin.index', ['categories' => $categories]);
    }
    public function about() {
        return view('pages.about');
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
        $cartItems = CartItem::all();
        return view('pages.cart', ['cartItems' => $cartItems]);
    }
    public function open_product() {
        return view('pages.product');
    }
}
