<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddRoomIdRoomTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking', function ($table) {
            $table->dropForeign('room_id');
            $table->dropColumn('status');
            $table->foreignId('room_type_id')->constrained('room_type');
            $table->foreignId('room_id')->constrained('rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking', function ($table) {
            $table->foreignId('room_id')->constrained('room_type')->onDelete('cascade');
            $table->boolean('status');
            $table->dropForeign(['room_type_id']);
            $table->dropForeign(['room_id']);
        });
    }
}
