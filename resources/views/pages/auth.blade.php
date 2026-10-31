@extends('layout.app')
@section('title')
    Авторизация
@endsection
@section('content')
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <form method="post" action="{{route('login')}}">
        @csrf
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" id="login" name="login" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
