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
            <form method="get" action="{{route('admin.order.filter')}}" class="d-flex align-items-center gap-2">
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
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    Удалить
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="{{ route('order.edit', $order->id) }}">
                                @csrf
                                @method('PUT')
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
                                        <textarea class="form-control @error('cansel') is-invalid @enderror" id="cansel_{{ $order->id }}" name="cansel" rows="3" placeholder="Опишите причину отмены...">{{ old('cansel', $order->cansel) }}</textarea>
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
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Все товары</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">
                + Добавить товар
            </button>
        </div>

        <div class="modal fade" id="createProductModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Добавить товар</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-3">
            @foreach($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <a href="{{ route('product.open', $product->id) }}">
                            <img src="{{ asset($product->image) }}" class="card-img-top object-fit-cover" style="height: 280px;" alt="без картинки сегодня">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                <h5 class="card-title mb-0">{{ $product->title }}</h5>
                                <span class="fw-bold text-nowrap">{{ $product->price }} ₽</span>
                            </div>
                            <p class="card-text text-muted small text-truncate mb-3">
                                {{ $product->description }}
                            </p>
                            <p class="card-text text-muted small text-truncate mb-3">
                                @if($product->count <= 0)
                                    Товар кончился.
                                @endif
                            </p>
                            <div class="d-flex gap-2 mt-auto">
                                <button type="button" class="btn btn-primary btn-sm flex-grow-1" data-bs-toggle="modal" data-bs-target="#productModal{{$product->id}}">
                                    Изменить
                                </button>
                                <form method="post" action="{{ route('admin.product.delete', $product->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        Удалить
                                    </button>
                                </form>
                                <a href="{{ route('product.open', $product->id) }}" class="btn btn-outline-secondary btn-sm">
                                    О товаре
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="post" action="{{ route('product.edit', $product->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Редактировать: {{ $product->title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="product_title_{{ $product->id }}" class="form-label">Название</label>
                                            <input type="text" class="form-control" id="product_title_{{ $product->id }}" name="title" value="{{ $product->title }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="category_id_{{ $product->id }}" class="form-label">Категория</label>
                                            <select class="form-select" id="category_id_{{ $product->id }}" name="category_id" required>
                                                <option value="" disabled>Укажите категорию...</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" @selected($category->id == $product->category_id)>
                                                        {{ $category->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="price_{{ $product->id }}" class="form-label">Стоимость</label>
                                            <input type="number" class="form-control" id="price_{{ $product->id }}" name="price" value="{{ $product->price }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="count_{{ $product->id }}" class="form-label">Количество</label>
                                            <input type="number" class="form-control" id="count_{{ $product->id }}" name="count" value="{{ $product->count }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="year_{{ $product->id }}" class="form-label">Год выпуска</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Год</span>
                                                <input type="number" class="form-control" id="year_{{ $product->id }}" name="year" value="{{ $product->year }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="publisher_{{ $product->id }}" class="form-label">Издатель</label>
                                            <input type="text" class="form-control" id="publisher_{{ $product->id }}" name="publisher" value="{{ $product->publisher }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="antagonist_{{ $product->id }}" class="form-label">Антагонист</label>
                                            <input type="text" class="form-control" id="antagonist_{{ $product->id }}" name="antagonist" value="{{ $product->antagonist }}" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="image_{{ $product->id }}" class="form-label">
                                                Обложка <span class="text-muted small">(можно не добавлять новую!)</span>
                                            </label>
                                            <input type="file" class="form-control" id="image_{{ $product->id }}" name="image">
                                        </div>
                                        <div class="col-12">
                                            <label for="description_{{ $product->id }}" class="form-label">Описание товара</label>
                                            <textarea class="form-control" id="description_{{ $product->id }}" name="description" rows="3">{{ $product->description }}</textarea>
                                        </div>
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
        <h2 class="mb-3">Добавить категорию</h2>
        <form method="post" action="{{ route('admin.category.create') }}" class="row g-3 mb-4">
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
                <th scope="col" class="text-end">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->title }}</td>
                    <td class="text-muted small">{{ $category->created_at }}</td>
                    <td class="text-end">
                        <div class="d-inline-flex gap-1">
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}" title="Редактировать">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                </svg>
                            </button>
                            <form method="post"
                                  action="{{ route('admin.category.delete', $category->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Удалить">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form method="post" action="{{ route('admin.category.update', $category->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Редактировать категорию #{{ $category->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="cat_title_{{ $category->id }}" class="form-label">Название</label>
                                        <input type="text" class="form-control" id="cat_title_{{ $category->id }}" name="title" value="{{ $category->title }}" required>
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
            </tbody>
        </table>
    </div>
@endsection
