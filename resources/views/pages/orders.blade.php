@extends('layout.app')
@section('title')
    Заказы
@endsection

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">История заказов</h2>

        <div class="d-flex flex-column gap-4">
            @foreach($orders as $order)
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Заказ от {{ $order->created_at }}</h5>
                        <span class="badge bg-primary">{{ $order->status->title }}</span>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-3">
                            @foreach($order->items as $itemInfo)
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $itemInfo->product->title }}</h6>
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            Всего стоимость: {{ $itemInfo->price * $itemInfo->count }} руб.
                                        </h6>
                                        <p class="card-text mb-0">
                                            Количество: {{ $itemInfo->count }} шт.
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @if($order->status_id == 1)
                        <div class="card-footer d-flex justify-content-end">
                            <form method="post" action="{{ route('user.order.delete', $order->id) }}" onsubmit="return">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    Отменить заказ
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
