@extends('layout.app')
@section('title')
    Каталог
@endsection
@section('content')
    <h2>Все товары</h2>
    <div class="mb-3">
        <form method="post" action="{{route('category.filter')}}">
            @csrf
            <select id="category_id" name="category_id">
                <option selected disabled>Выберите категорию...</option>
                <option value="0">Все категории</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">
                Применить
            </button>
        </form>
    </div>
    <div class="mb-3">
        <p>Упорядочить по</p>

        <form method="post" action="{{route('category.sort')}}">
            @csrf
            <select id="category_id" name="sort">
                <option selected disabled>Выберите порядо отображения...</option>
                <option value="0">Все категории</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">
                Применить
            </button>
        </form>
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
