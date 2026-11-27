@extends('layout.app')
@section('title')
    Корзина
@endsection
@section('content')
    <h2 class="mb-3">Корзина</h2>

    <div>
        <div class="table-responsive d-none d-md-block">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th scope="col">Картинка</th>
                    <th scope="col">Название</th>
                    <th scope="col">Количество</th>
                    <th scope="col">Стоимость 1 шт.</th>
                    <th scope="col">Общая стоимость</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cartItems as $cartItem)
                    <tr>
                        <td><img width="80" src="{{ asset($cartItem->product->image) }}" alt="no-img" class="rounded"></td>
                        <td>{{ $cartItem->product->title }}</td>
                        <td>{{ $cartItem->count }}</td>
                        <td>{{ $cartItem->product->price }} руб.</td>
                        <td><b>{{ $cartItem->count * $cartItem->product->price }} руб.</b></td>
                        <td>
                            <div class="d-inline-flex gap-1">
                                <form method="post" action="{{ route('cart.increase', $cartItem->id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-secondary cart_act_btn" @disabled($cartItem->count >= $cartItem->product->count)>
                                        +
                                    </button>
                                </form>
                                <form method="post" action="{{ route('cart.decrease', $cartItem->id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-secondary cart_act_btn">
                                        -
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-md-none d-flex flex-column gap-3 mb-3">
            @foreach($cartItems as $cartItem)
                <div class="card shadow-sm">
                    <div class="card-body p-2">
                        <div class="d-flex gap-3 align-items-center">
                            <img width="70" src="{{ asset($cartItem->product->image) }}" alt="no-img" class="rounded">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $cartItem->product->title }}</h6>
                                <div class="text-muted small">Цена: {{ $cartItem->product->price }} руб. / шт.</div>
                                <div class="fw-bold mt-1">Сумма: {{ $cartItem->count * $cartItem->product->price }} руб.</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
                            <span class="small text-muted">Количество: <b>{{ $cartItem->count }}</b></span>
                            <div class="d-inline-flex gap-2">
                                <form method="post" action="{{ route('cart.decrease', $cartItem->id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-secondary px-3 cart_act_btn">-</button>
                                </form>
                                <form method="post" action="{{ route('cart.increase', $cartItem->id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-secondary px-3 cart_act_btn" @disabled($cartItem->count >= $cartItem->product->count)>+</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-info">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex flex-column flex-md-row justify-content-md-end align-items-md-center gap-3 mt-3">
            <p class="mb-0 fs-5 text-end text-nowrap">Итого: <b>{{ $sum }} руб.</b></p>
            <div class="d-grid d-md-block">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Оформить заказ
                </button>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="post" action="{{ route('order.create') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Подтвердите заказ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="password" class="form-label">Пароль</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Оформить заказ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
