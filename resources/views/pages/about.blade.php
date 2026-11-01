@extends('layout.app')
@section('title')
    О нас
@endsection
@section('content')
    <section class="about-us container py-5">
        <div class="text-center mb-5">
            <img width="40" height="40" src="{{asset('https://cdn.worldvectorlogo.com/logos/grok-1.svg')}}" alt="Логотип">
            <h1 class="h3 text-muted">«Мир графических историй ближе, чем кажется!»</h1>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-md-8 text-center">
                <p class="lead">
                    Добро пожаловать в <strong>Funny Comics Land</strong> — твоего надежного проводника в бесконечные вселенные комиксов! Мы собираем лучшие графические новеллы и помогаем фанатам находить любимые истории.
                </p>
                <p>
                    Мы постоянно развиваемся и расширяем наш каталог, чтобы каждый нашел выпуск по душе. Присоединяйся к нашему путешествию!
                </p>
            </div>
        </div>
        <div class="latest-products">
            <h2 class="text-center mb-4">Новинки компании</h2>
            <div class="row">
                <p>*тут будет слайдер*</p>
{{--                @foreach($latestProducts as $product)--}}
{{--                    <div class="col-md">--}}
{{--                        <div class="card h-100 text-center p-2">--}}
{{--                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: contain;">--}}
{{--                            <div class="card-body">--}}
{{--                                <h5 class="card-title fs-6">{{ $product->name }}</h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
            </div>
        </div>
    </section>
@endsection
