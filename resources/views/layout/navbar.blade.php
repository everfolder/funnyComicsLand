<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid container">
        <a class="navbar-brand d-flex align-items-center" href="{{route('welcome')}}">
            <div class="d-inline-flex align-items-center gap-2">
                <img width="40" height="40" src="https://cdn.worldvectorlogo.com/logos/grok-1.svg" alt="Логотип">
                <span class="mb-0 fw-semibold">Funny Comics Land</span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-lg-center">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('registration')}}">Регистрация</a>
                    </li>
                @endguest
                <li class="nav-item">
                    <a class="nav-link" href="{{route('about')}}">О нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('catalog')}}">Каталог</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('where')}}">Где нас найти?</a>
                </li>
            </ul>
            @auth
                <div class="d-flex align-items-center gap-3">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('logout')}}">Выйти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('cart')}}">Корзина</a>
                        </li>
                        @if(\Illuminate\Support\Facades\Auth::user()->is_admin == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.index')}}">Админка</a>
                            </li>
                        @endif
                    </ul>
                    <img class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;" src="https://www.vectorltd.ru/images/review_icon.png" alt="no-logo">
                </div>
            @endauth
        </div>
    </div>
</nav>
