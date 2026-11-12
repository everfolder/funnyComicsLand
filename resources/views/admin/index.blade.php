@extends('layout.app')
@section('title')
    Админ-панель
@endsection
@section('content')
    @if(session()->has('success'))
        <div class="alert alert-info">
            {{session('success')}}
        </div>
    @endif
    <h2>Добавить продукт</h2>
    <form method="post" action="{{route('product.create')}}" class="row mb-5 g-3 needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        @method('post')

        <div style="width: 100%" class="mb-1 d-inline-flex justify-content-between">
            <div>
                <label for="title" class="form-label">Добавить название</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Введите название">
            </div>
            <div>
                <label for="category_id" class="form-label">Выберите категори (надо будет сделать селект)</label>
                <select class="form-select" id="category_id" name="category_id" aria-label="Default select example">
                    <option selected>Укажите категорию...</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="col-md-4">
            <label for="price" class="form-label">Стоимость</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="1500 (в руб.)" required>
        </div>
        <div class="col-md-4">
            <label for="count" class="form-label">Количество</label>
            <input type="number" class="form-control" id="count" name="count" placeholder="10 (шт.)" required>
        </div>
        <div class="col-md-4">
            <label for="year" class="form-label">Год выпуска</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">Год</span>
                <input type="number" class="form-control" id="year" name="year" aria-describedby="inputGroupPrepend" required>
            </div>
        </div>
        <div class="col-md-6">
            <label for="publisher" class="form-label">Издатель</label>
            <input type="text" class="form-control" id="publisher" name="publisher" required>
            <div class="invalid-feedback">
                Please provide a valid city.
            </div>
        </div>
        <div class="col-md-3">
            <label for="antagonist" class="form-label">Антагонист</label>
            <input type="text" class="form-control" id="antagonist" name="antagonist" required>
        </div>
        <div class="col-md-3">
            <label for="image" class="form-label">Добавить обложку</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <div class="mb-1">
            <label for="description" class="form-label">Добавить описание товара</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Добавить</button>
        </div>
    </form>

    <form method="post" action="{{route('category.create')}}" class="row g-3 needs-validation" novalidate>
        @csrf
        @method('post')
        <h2>Добавить категорию</h2>
        <div style="margin-top: 0" class="mb-3">
            <label for="title" class="form-label">Название</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Укажите название категории">
            @error('title')
                {{ $message }}
            @enderror
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Добавить</button>
        </div>
    </form>
    <div class="mb-3">
        <h3>Категории</h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Название</th>
                <th scope="col">Создан</th>
{{--                <th scope="col">Действия</th>--}}
            </tr>
            </thead>
            <tbody>

            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->title}}</td>
                    <td>{{$category->created_at}}</td>
    {{--                <td>--}}
    {{--                    *кнопка для модалки*--}}
    {{--                    <img src="https://images.icon-icons.com/3230/PNG/512/edit_modify_icon_196940.png" width="30" alt="">--}}
    {{--                </td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
