@extends('layout.app')
@section('title')
    Регистрация
@endsection
@section('content')
    <form method="post" action="{{route('register')}}">
        @csrfз
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" id="login" name="login" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Адрес электронной почты</label>
            <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Фамилия</label>
            <input type="text" class="form-control" id="surname" name="surname" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="patronymic" class="form-label">Отчество (если есть)</label>
            <input type="text" class="form-control" id="patronymic" name="patronymic" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Повторите пароль</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="rules" name="rules">
            <label class="form-check-label" for="rules">Согласие с правилами регистрации</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
