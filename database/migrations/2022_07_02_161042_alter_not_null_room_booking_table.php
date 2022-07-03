<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterNotNullRoomBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->bigInteger('room_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('booking', function ($table) {
            $table->bigInteger('room_id')->nullable(false)->change();
        });
    }
}
