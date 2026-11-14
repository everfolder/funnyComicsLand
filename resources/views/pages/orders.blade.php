@extends('layout.app')
@section('title')
    Заказы
@endsection
@section('content')
    <h2>История заказов</h2>
    <div class="mb-3">
        @foreach($orders as $order)
            <p>{{$order->id}}</p>
        @endforeach
    </div>
{{--    <div>--}}
{{--        <h5>Завершенные</h5>--}}
{{--        <div>--}}

{{--        </div>--}}
{{--    </div>--}}
@endsection
