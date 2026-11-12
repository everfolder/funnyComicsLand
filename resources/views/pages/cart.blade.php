@extends('layout.app')
@section('title')
    Корзина
@endsection
@php
//    echo $cartItems
@endphp
@section('content')
    <h2>Корзина</h2>
    <div>

        <div class="mb-3">
            <h5>-</h5>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Картинка</th>
                <th scope="col">Название</th>
                <th scope="col">Количество</th>
                <th scope="col">Стоимость</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>

            @foreach($cartItems as $cartItem)
                @php
                    echo $cartItem
                @endphp
                <tr>
                    <td><img width="80" src="{{asset($cartItem->product->image)}}" alt="no-img"></td>
                    <td>{{$cartItem->product->title}}</td>
                    <td>{{$cartItem->count}}</td>
                    <td>{{$cartItem->count * $cartItem->product->price}} руб.</td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
