@extends('layout.app')
@section('title')
    Корзина
@endsection
@section('content')
    <h2>Корзина</h2>
    <div>
        @foreach($cartItems as $cartItem)
            <div class="mb-3">
                <h5>{{\App\Models\Product::query()->where('id', $cartItem->product_id)->first()->title}}</h5>
            </div>
        @endforeach
    </div>
@endsection
