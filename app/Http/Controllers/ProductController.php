<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
//        dd($request->all());
        $request->validate([
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
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
        //
    }
}
