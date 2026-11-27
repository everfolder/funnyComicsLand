<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
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
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'count' => 'required|integer|min:0',
            'year' => 'required|integer',
            'publisher' => 'required|string|max:255',
            'antagonist' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);
        $product = new Product();
        $product->title = $request->title;
        $product->price = $request->price;
        $product->count = $request->count;
        $product->year = $request->year;
        $product->publisher = $request->publisher;
        $product->antagonist = $request->antagonist;
        $product->description = $request->description;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/media/images'), $filename);
            $product->image = 'storage/media/images/'.$filename;
        }

        $product->save();
        return redirect()->back()->with('success', 'Товар успешно добавлен!');
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
    public function show(Product $product)
    {
        return view('pages.product', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'count' => 'required|integer|min:0',
            'year' => 'required|integer',
            'publisher' => 'required|string|max:255',
            'antagonist' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        $product->title = $request->title;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->count = $request->count;
        $product->year = $request->year;
        $product->publisher = $request->publisher;
        $product->antagonist = $request->antagonist;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/media/images'), $filename);
            $product->image = 'storage/media/images/'.$filename;
        }

        $product->save();

        return back()->with('success', 'Товар успешно обновлён');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (\App\Models\OrderItem::where('product_id', $product->id)->exists()) {
            return back()->with('error', 'Нельзя удалить товар — он уже есть в оформленных заказах');
        }
        $product->delete();
        return redirect()->back();
    }
}
