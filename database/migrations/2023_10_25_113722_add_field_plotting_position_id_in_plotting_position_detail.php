<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldPlottingPositionIdInPlottingPositionDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plotting_position_detail', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('plotting_position_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plotting_position_detail', function (Blueprint $table) {
            //
            $table->dropColumn('plotting_position_id');
        });
    }
}
