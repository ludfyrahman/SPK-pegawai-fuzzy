<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeInPositionDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('position_detail', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
            $table->dropColumn('start_period');
            $table->dropColumn('end_period');
            $table->dropColumn('status');
            // detail criteria id
            $table->unsignedBigInteger('criteria_detail_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('position_detail', function (Blueprint $table) {
            //
        });
    }
}
