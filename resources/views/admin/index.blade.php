@extends('layout.app')
@section('title')
    Админ-панель
@endsection
@section('content')
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Все заказы</h2>

            <form method="get" action="" class="d-flex align-items-center gap-2">
                <label for="filter_status" class="form-label mb-0 text-muted small">Фильтр:</label>
                <select class="form-select form-select-sm w-auto" id="filter_status" name="filter_status" onchange="this.form.submit()">
                    <option value="">Все статусы</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" @selected(request('filter_status') == $status->id)>
                            {{ $status->title }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="d-flex flex-wrap gap-3">
            @foreach($orders as $order)
                <div class="card shadow-sm" style="width: 19rem;">
                    <div class="card-body d-flex flex-column">

                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h5 class="card-title mb-0">Заказ #{{ $order->id }}</h5>
                            <span class="badge bg-secondary">{{ $order->status->title }}</span>
                        </div>

                        <div class="text-muted small mb-3">
                            {{ $order->created_at->format('d.m.Y H:i') }}
                        </div>

                        <div class="small mb-3">
                            <div class="mb-1">
                                <span class="text-muted">Клиент:</span>
                                <span class="fw-medium">{{$order->user->surname}} {{$order->user->name}} {{$order->user->patronymic}}</span>
                            </div>
                            <div class="mb-1">
                                <span class="text-muted">Логин:</span>
                                <span class="fw-medium">{{$order->user->login}}</span>
                            </div>
                            <div>
                                <span class="text-muted">Товаров:</span>
                                <span class="fw-medium">{{ $order->items->sum('count') }} шт.</span>
                            </div>
                        </div>

                        @if($order->cansel)
                            <div class="alert alert-danger py-1 px-2 small mb-3">
                                <strong>Причина:</strong> {{ $order->cansel }}
                            </div>
                        @endif

                        <div class="d-flex gap-2 mt-auto">
                            <button type="button" class="btn btn-primary btn-sm flex-grow-1" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                                Изменить
                            </button>

                            <form method="post" action="{{ route('admin.order.delete', $order->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    Удалить
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Модальное окно редактирования заказа --}}
                <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="{{ route('order.edit', $order->id) }}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Заказ #{{ $order->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="status_id_{{ $order->id }}" class="form-label">Статус заказа</label>
                                        <select class="form-select" id="status_id_{{ $order->id }}" name="status_id">
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->id }}" @selected($status->id == $order->status_id)>
                                                    {{ $status->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="cansel_{{ $order->id }}" class="form-label">
                                            Причина отмены <span class="text-muted small">(если отменён)</span>
                                        </label>
                                        <textarea class="form-control @error('cansel') is-invalid @enderror"
                                                  id="cansel_{{ $order->id }}"
                                                  name="cansel"
                                                  rows="3"
                                                  placeholder="Опишите причину отмены...">{{ old('cansel', $order->cansel) }}</textarea>
                                        @error('cansel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <hr class="my-5">

    <div class="mb-5">
        <h2 class="mb-3">Добавить продукт</h2>
        <form method="post" action="{{ route('product.create') }}" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="col-md-6">
                <label for="product_title" class="form-label">Название</label>
                <input type="text" class="form-control" id="product_title" name="title" placeholder="Введите название" required>
            </div>
            <div class="col-md-6">
                <label for="category_id" class="form-label">Категория</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option selected disabled>Укажите категорию...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
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
                <div class="input-group">
                    <span class="input-group-text">Год</span>
                    <input type="number" class="form-control" id="year" name="year" required>
                </div>
            </div>

            <div class="col-md-6">
                <label for="publisher" class="form-label">Издатель</label>
                <input type="text" class="form-control" id="publisher" name="publisher" required>
            </div>
            <div class="col-md-3">
                <label for="antagonist" class="form-label">Антагонист</label>
                <input type="text" class="form-control" id="antagonist" name="antagonist" required>
            </div>
            <div class="col-md-3">
                <label for="image" class="form-label">Обложка</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>

            <div class="col-12">
                <label for="description" class="form-label">Описание товара</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <div class="col-12">
                <button class="btn btn-primary" type="submit">Добавить</button>
            </div>
        </form>
    </div>

    <hr class="my-5">

    <div class="mb-5">
        <h2 class="mb-3">Добавить категорию</h2>
        <form method="post" action="{{ route('category.create') }}" class="row g-3 mb-4">
            @csrf
            <div class="col-md-6">
                <label for="category_title" class="form-label">Название</label>
                <div class="input-group">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="category_title" name="title" placeholder="Укажите название категории">
                    <button class="btn btn-primary" type="submit">Добавить</button>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </form>

        <h3 class="h5 mb-3">Список категорий</h3>
        <table class="table table-hover align-middle">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Создан</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->title }}</td>
                    <td class="text-muted small">{{ $category->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
