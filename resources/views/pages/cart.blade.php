@extends('layout.app')
@section('title')
    Корзина
@endsection
@section('content')
    <h2>Корзина</h2>
    <div>
        <table class="table">
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
                    <td><img width="80" src="{{asset($cartItem->product->image)}}" alt="no-img"></td>
                    <td>{{$cartItem->product->title}}</td>
                    <td>{{$cartItem->count}}</td>
                    <td>{{$cartItem->product->price}}</td>
                    <td>{{$cartItem->count * $cartItem->product->price}} руб.</td>
                    <td>
                        <div class="d-inline-flex">
                            <form method="post" action="{{route('cart.increase', $cartItem->id)}}">
                                @csrf
                                <button class="cart_act_btn">
                                    +
                                </button>
                            </form>
                            <form method="post" action="{{route('cart.decrease', $cartItem->id)}}">
                                @csrf
                                <button class="cart_act_btn">
                                    -
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-info">
                {{session('success')}}
            </div>
        @endif

        <div class="text-end">
            <p>Итого: <b>{{$sum}}</b></p>
            <form method="post" action="{{route('order.create')}}">
                @csrf
                <button class="btn btn-primary">
                    Оформить заказ
                </button>
            </form>
        </div>
    </div>
@endsection
