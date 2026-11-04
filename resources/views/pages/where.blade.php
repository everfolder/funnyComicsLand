@extends('layout.app')
@section('title')
    Где нас найти
@endsection
@section('content')
    <section class="contacts-page container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Где нас найти?</h1>
            <p class="text-muted">Заглядывай в гости за свежими выпусками любимых комиксов!</p>
        </div>
        <div class="row g-4 align-items-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4 h-100">
                    <h3 class="h4 mb-4 text-primary">Контакты Funny Comics Land</h3>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-geo-alt-fill text-danger fs-5 me-3"></i>
                            <div>
                                <strong>Адрес:</strong><br>
                                <span class="text-muted">г. Нижний Новгород, ул. Большая Покровская, д. 15</span>
                            </div>
                        </li>
                        <li class="mb-3 d-flex align-items-start">
                            <i class="bi bi-telephone-fill text-success fs-5 me-3"></i>
                            <div>
                                <strong>Номер телефона:</strong><br>
                                <span class="text-muted">+7 (999) 123-45-67</span>
                            </div>
                        </li>
                        <li class="d-flex align-items-start">
                            <i class="bi bi-envelope-fill text-info fs-5 me-3"></i>
                            <div>
                                <strong>Email:</strong><br>
                                <span class="text-muted">support@funnycomics.local</span>
                            </div>
                        </li>
                    </ul>
                    <hr class="my-4">
                    <div class="work-hours">
                        <h5 class="h6 fw-bold">Режим работы:</h5>
                        <p class="text-muted mb-0">Пн–Вс: с 10:00 до 20:00 (без перерывов и выходных)</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm overflow-hidden h-100">
                    <img src="{{ asset('public/media/images/map.jpg') }}" class="card-img-top w-100" alt="Схема проезда" style="height: 300px; object-fit: cover;">
                    <div class="card-body text-center bg-light">
                        <p class="card-text text-muted small mb-0">Мы находимся в самом центре города, в двух минутах от главной пешеходной улицы.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
