<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_permission', function (Blueprint $table) {
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->foreignId('permission_id')->constrained('permissions')->onDelete('cascade');
            $table->unique(["module_id", "permission_id"], 'module_permission_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('module_permission', function (Blueprint $table) {
            $table->dropForeign(['module_id', 'permission_id']);
            $table->dropUnique('module_permission_unique');
        });
        Schema::dropIfExists('module_permission');
    }
}
