<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomFeatureMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_feature_mappings', function (Blueprint $table) {
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->foreignId('room_feature_id')->constrained('room_features')->onDelete('cascade');
            $table->unique(["room_id", "room_feature_id"], 'room_feature_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_feature_mappings', function (Blueprint $table) {
            $table->dropForeign(['room_id', 'room_feature_id']);
            $table->dropUnique('room_feature_unique');
        });
        Schema::dropIfExists('room_feature_mappings');
    }
}
