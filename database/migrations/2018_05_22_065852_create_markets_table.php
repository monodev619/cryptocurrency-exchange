<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('market_type', config('enum.market_type'));
            $table->integer('key_currency');
            $table->integer('target_currency');
            $table->double('rate')->default(0);
            $table->double('change')->default(0);
            $table->double('last')->default(0);
            $table->double('bid')->default(0);
            $table->double('ask')->default(0);
            $table->double('volume')->default(0);
            $table->double('high_24h')->default(0);
            $table->double('low_24h')->default(0);
            $table->double('minimum')->default(0);
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
        Schema::dropIfExists('markets');
    }
}
