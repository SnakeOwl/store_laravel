<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Не указано');
            $table->tinyInteger('basket_status')->default(0); // 0 - заказ в корзине, 1 - заказ в обработке,
            $table->boolean('payment_status')->default(0);  //статус оплаты
            $table->string('payment_method');   //метод оплаты
            $table->string('delivery_method');  //метод доставки
            $table->string('address');
            $table->string('post_index')->nullable();    //почтовый индекс
            $table->unsignedTinyInteger('discont')->nullable()->default(0);
            $table->string('phone');
            $table->decimal('price', 10, 2);    // сумма заказа
            $table->string('status')->default('Обрабатывается');
            $table->dateTime('date_created')->useCurrent();
            $table->dateTime('date_delivered')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('courier_id')->nullable();
            $table->foreignId('promocode_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
