<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGudangDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gudang_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gudang_id')->foreign('gudang_id')->references('id')->on('gudang');
            $table->string('no_part', 10);
            $table->string('sap');
            $table->string('cat');
            $table->string('deskripsi');
            $table->integer('stok')->unsigned();
            $table->string('satuan');
            $table->string('lokasi');
            $table->string('keterangan');
            $table->string('barcode');
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
        Schema::dropIfExists('gudang_detail');
    }
}
