<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hargas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipe_artikel_id')->nullable();
            $table->double('harga', 10, 2)->nullable();
            $table->integer('panjang')->nullable();
            $table->string('status', 100)->default('active');
            $table->timestamps();

            $table->foreign('tipe_artikel_id')->references('id')->on('tipe_artikels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hargas');
    }
}
