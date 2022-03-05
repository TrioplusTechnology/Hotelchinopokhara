<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnDescriptionRecreationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recreations', function (Blueprint $table) {
            $table->text('description')->after('title');
            $table->unique('slug')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recreations', function ($table) {
            $table->dropColumn('description');
            $table->dropUnique(['slug']);
        });
    }
}
