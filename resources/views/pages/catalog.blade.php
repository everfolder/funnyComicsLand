@extends('layout.app')
@section('title')
    Каталог
@endsection
@section('content')
    <h2>Все товары</h2>
    <div>
        <h3>Фильтрация*</h3>
    </div>
    <div class="row gap-1">
        @foreach($products as $product)
            <div class="card" style="width: 18rem;">
                <img src="{{ asset($product->image) }}" class="card-img-top" alt="без картинки сегодня">
                <div class="card-body">
                    <h5 class="card-title">{{$product->title}}</h5>
                    <p class="card-text">{{$product->description}}</p>
                    <form method="post" action="{{route('cart.add', $product->id)}}">
                        @csrf
                        <button type="submit" class="btn {{isset($inCart[$product->id]) ? 'disabled' : 'btn-primary'}}">
                            {{isset($inCart[$product->id]) ? 'Уже в корзине' : 'Добавить в корзину'}}
                        </button>
                    </form>
                    <a href="{{route('product.open', $product->id)}}">О товаре</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
