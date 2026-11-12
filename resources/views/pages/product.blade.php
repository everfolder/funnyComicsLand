@extends('layout.app')
@section('title')
    {{$product->title}}
@endsection
@section('content')
    <h2>Товар {{$product->title}}</h2>
    <div style="display:inline-flex">
        <div>
            <img src="{{asset($product->image)}}" alt="no-image">
        </div>
        <div>
            <div>
                <p>{{$product->title}}</p>
                <div>
                    <p>{{$product->price}}</p>
                    <p>Осталось {{$product->count}}</p>
                </div>
            </div>
            <div>
                <p>{{$product->description}}</p>
                <p>Антагонист: {{$product->antagonist}}</p>
            </div>
            <p>Автор {{$product->publisher}}</p>
            <p>Опубликовано в {{$product->year}} году</p>
        </div>
    </div>
@endsection
