@extends('layout.app')

@section('title')
    {{ $product->title }}
@endsection

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <div class="row g-4 align-items-start">

                    <div class="col-md-4 text-center">
                        <img src="{{ asset($product->image) }}"
                             alt="{{ $product->title }}"
                             class="img-fluid rounded border"
                             style="max-height: 450px; object-fit: cover;">
                    </div>

                    <div class="col-md-8">
                        <h2 class="fw-bold mb-3">{{ $product->title }}</h2>

                        <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                            <span class="fs-3 fw-bold text-primary">{{ $product->price }} руб.</span>
                            <span class="badge bg-light text-dark border fs-6">
                                Осталось: {{ $product->count }} шт.
                            </span>
                        </div>

                        <p class="text-secondary mb-4">{{ $product->description }}</p>

                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item px-0">
                                <span class="text-muted">Антагонист:</span>
                                <strong>{{ $product->antagonist }}</strong>
                            </li>
                            <li class="list-group-item px-0">
                                <span class="text-muted">Автор / Издатель:</span>
                                <strong>{{ $product->publisher }}</strong>
                            </li>
                            <li class="list-group-item px-0">
                                <span class="text-muted">Год публикации:</span>
                                <strong>{{ $product->year }} г.</strong>
                            </li>
                        </ul>

                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Назад</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
