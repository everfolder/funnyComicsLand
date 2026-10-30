<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {

            // то есть мы в функции create_order после того, как создается запись в order прописываем цикл
            // в котором принудительно создаем записи в этой таблице где получается из записей корзины мы получаем
            // id товара, его количество и стоимость 1 штуки походу.

            $table->id();
            $table->foreignIdFor(\App\Models\Product::class)->constrained()->cascadeOnDelete()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Order::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('count');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
