<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('market_id');
            $table->enum('bidask', config('enum.bidask'));
            $table->enum('order_type', config('enum.order_type'));
            $table->double('quantity');
            $table->double('price');
            $table->enum('condition', config('enum.condition'));
            $table->double('target_price')->default(0);
            $table->double('fee');
            $table->double('total');
            $table->enum('timeinforce', config('enum.timeinforce'));
            $table->double('balance');
            $table->enum('status', config('enum.order_status'));
            $table->timestamps();
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
