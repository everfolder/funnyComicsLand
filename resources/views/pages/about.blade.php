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

            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="..." class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="..." class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="..." class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
    </section>
@endsection
