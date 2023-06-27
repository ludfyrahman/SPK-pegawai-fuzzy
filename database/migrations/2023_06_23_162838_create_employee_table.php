<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->String('nip_baru');
            $table->String('nip_lama');
            $table->String('nama');
            $table->String('gelar_depan')->nullable();
            $table->String('gelar_belakang');
            $table->Date('tmt_cpns');
            $table->String('gol_akhir');
            $table->Date('tmt_golongan');
            $table->String('tingkat_pendidikan');
            $table->String('nama_pendidikan');
            $table->String('tahun_lulus');
            $table->String('lokasi_kerja_nama');
            $table->String('unit_kerja');
            $table->String('instansi');
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
        Schema::dropIfExists('employee');
    }
}
