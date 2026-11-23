<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
        $request->validate([
           'title' => 'required|unique:categories|max:255',
        ]);
        $category = new Category();
        $category->title = $request->title;
        $category->save();

        return redirect()->back(); //->with('category_success', 'категория успешно добавлена!');
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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
    public function filter(Request $request){
        $categories = Category::all();
        $inCart = CartItem::query()->where('user_id',Auth::id())->pluck('product_id')->flip()->all();
        if ($request->category_id == 0) {
            $products = Product::all();
        }
        if ($request->category_id) {
            $products = Product::where('category_id', $request->category_id)->get();
        }
        return view('pages.catalog',['products'=>$products, 'categories'=>$categories, 'inCart'=>$inCart]);
    }
}
