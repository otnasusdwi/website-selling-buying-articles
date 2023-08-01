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
            $table->unsignedBigInteger('pembeli_id')->nullable();
            $table->unsignedBigInteger('tipe_artikel_id')->nullable();
            $table->unsignedBigInteger('harga_id')->nullable();
            $table->string('judul', 100)->nullable();
            $table->datetime('tanggal_order')->nullable();
            $table->double('harga', 10, 2)->nullable();
            $table->string('status', 20)->default('pending');
            $table->timestamps();

            $table->foreign('pembeli_id')->references('id')->on('users');
            $table->foreign('tipe_artikel_id')->references('id')->on('tipe_artikels');
            $table->foreign('harga_id')->references('id')->on('hargas');
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
