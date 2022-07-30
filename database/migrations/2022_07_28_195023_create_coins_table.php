<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coin_id')->unique();
            $table->string('symbol')->unique();
            $table->string('name')->unique();
            $table->string('image');
            $table->decimal('current_price',16,8);
            $table->bigInteger('market_cap');
            $table->bigInteger('total_volume');
            $table->decimal('price_change_percentage_24h');
            $table->decimal('price_change_percentage_1h_in_currency');
            $table->boolean('favorite')->default(false);
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
        Schema::dropIfExists('coins');
    }
};
