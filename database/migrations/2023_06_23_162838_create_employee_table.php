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
            $table->unsignedInteger('user_id');
            $table->String('nip_baru');
            $table->String('nip_lama');
            $table->String('nama');
            $table->String('gelar_depan')->nullable();
            $table->String('gelar_belakang');
            $table->Date('tmt_cpns');
            $table->String('gol_akhir_id');
            $table->String('gol_akhir_nama');
            $table->Date('tmt_golongan');
            $table->String('mk_tahun');
            $table->String('mk_bulan');
            $table->String('jenis_jabatan_nama');
            $table->String('jabatan_nama');
            $table->Date('tmt_jabatan');
            $table->String('tingkat_pendidikan');
            $table->String('pendidikan_nama');
            $table->String('tahun_lulus');
            $table->String('kpkn_nama')->nullable();
            $table->String('lokasi_kerja_nama');
            $table->String('unor_nama');
            $table->String('instasi_induk_nama');
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
