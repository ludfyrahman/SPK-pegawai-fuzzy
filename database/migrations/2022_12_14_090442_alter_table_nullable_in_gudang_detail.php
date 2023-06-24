<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableNullableInGudangDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gudang_detail', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('gudang_id')->nullable()->change();
            $table->string('no_part', 10)->nullable()->change();
            $table->string('sap')->nullable()->change();
            $table->string('cat')->nullable()->change();
            $table->string('deskripsi')->nullable()->change();
            $table->integer('stok')->unsigned()->nullable()->change();
            $table->string('satuan')->nullable()->change();
            $table->string('lokasi')->nullable()->change();
            $table->string('keterangan')->nullable()->change();
            $table->string('barcode')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gudang_detail', function (Blueprint $table) {
            //
        });
    }
}
