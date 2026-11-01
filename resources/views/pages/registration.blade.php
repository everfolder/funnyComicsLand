@extends('layout.app')
@section('title')
    Регистрация
@endsection
@section('content')
    <form method="post" action="{{route('register')}}">
        @csrf
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control @error('login') is-invalid @enderror" id="login" name="login" aria-describedby="emailHelp">
            <div class="invalid-feedback" id="validationServerUsernameFeedback">
                @error('login') {{$message}} @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Адрес электронной почты</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" aria-describedby="emailHelp">
            <div class="invalid-feedback" id="validationServerUsernameFeedback">
                @error('email') {{$message}} @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" aria-describedby="emailHelp">
            <div class="invalid-feedback" id="validationServerUsernameFeedback">
                @error('name') {{$message}} @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Фамилия</label>
            <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" aria-describedby="emailHelp">
            <div class="invalid-feedback" id="validationServerUsernameFeedback">
                @error('surname') {{$message}} @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="patronymic" class="form-label">Отчество (если есть)</label>
            <input type="text" class="form-control @error('patronymic') is-invalid @enderror" id="patronymic" name="patronymic" aria-describedby="emailHelp">
            <div class="invalid-feedback" id="validationServerUsernameFeedback">
                @error('patronymic') {{$message}} @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            <div class="invalid-feedback" id="validationServerUsernameFeedback">
                @error('password') {{$message}} @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Повторите пароль</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
            <div class="invalid-feedback" id="validationServerUsernameFeedback">
                @error('password_confirmation') {{$message}} @enderror
            </div>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="rules" name="rules">
            <label class="form-check-label @error('rules') is-invalid @enderror" for="rules">Согласие с правилами регистрации</label>
            <div class="invalid-feedback" id="validationServerUsernameFeedback">
                @error('rules') {{$message}} @enderror
            </div>
        </div>
        <div class="mb-3">
            <a href="{{route('auth')}}">Уже зарегистрированы? Войти</a>
        </div>
        <button type="submit" class="btn btn-primary">Регистрация</button>
    </form>
@endsection
