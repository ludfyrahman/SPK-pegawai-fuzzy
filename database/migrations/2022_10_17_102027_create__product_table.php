<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_product', function (Blueprint $table) {
            $table->increments('id');
            $table->String('part_no');
            $table->String('name');
            $table->String('qty');
            $table->longText('deskripsi');
            $table->date('tanggal');
            $table->String('image')->nullable();;
            $table->String('code');
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
        Schema::dropIfExists('_product');
    }
}
