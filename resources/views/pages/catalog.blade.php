@extends('layout.app')
@section('title')
    Каталог
@endsection
@section('content')
    <h2>Все товары</h2>
    <div class="d-flex flex-column gap-2 mb-3">
        <div class="d-flex align-items-center gap-3">
            <p class="mb-0">Выбранная категория:</p>
            <form method="get">
                <select class="form-select form-select-sm" id="category_id" name="category_id" onchange="this.form.submit()">
                    <option value="0" @selected(request('category_id') == 0)>Все категории</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="d-flex align-items-center gap-3">
            <p class="mb-0">Упорядочить по:</p>
            <form method="get">
                <select class="form-select form-select-sm" id="sort" name="sort" onchange="this.form.submit()">
                    <option value="year_desc" @selected(request('sort', 'year_desc') === 'year_desc')>Сначала новые</option>
                    <option value="year_asc" @selected(request('sort') === 'year_asc')>Сначала старые</option>
                    <option value="title_asc" @selected(request('sort') === 'title_asc')>По названию (А-Я)</option>
                    <option value="title_desc" @selected(request('sort') === 'title_desc')>По названию (Я-А)</option>
                    <option value="price_asc" @selected(request('sort') === 'price_asc')>Сначала дешевле</option>
                    <option value="price_desc" @selected(request('sort') === 'price_desc')>Сначала дороже</option>
                </select>
            </form>
        </div>
    </div>
    <div class="row gap-1">
        @foreach($products as $product)
            @continue($product->count<=0)
            <div class="card" style="width: 18rem;">
                <img src="{{ asset($product->image) }}" class="card-img-top" alt="без картинки сегодня">
                <div class="card-body">
                    <h5 class="card-title">{{$product->title}}</h5>
                    <p class="card-text">{{$product->description}}</p>
                    @auth
                        <form method="post" action="{{route('cart.add', $product->id)}}">
                            @csrf
                            <button type="submit" class="btn {{isset($inCart[$product->id]) ? 'disabled' : 'btn-primary'}}">
                                {{isset($inCart[$product->id]) ? 'Уже в корзине' : 'Добавить в корзину'}}
                            </button>
                        </form>
                    @endauth
                    <a href="{{route('product.open', $product->id)}}">О товаре</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
