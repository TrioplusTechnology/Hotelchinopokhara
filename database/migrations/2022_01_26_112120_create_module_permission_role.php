<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulePermissionRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_permission_role', function (Blueprint $table) {
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->foreignId('permission_id')->constrained('permissions')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->unique(["module_id", "permission_id", "role_id"], 'module_permission_role_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('module_permission_role', function (Blueprint $table) {
            $table->dropForeign(["module_id", "permission_id", "role_id"]);
            $table->dropUnique('module_permission_role_unique');
        });
        Schema::dropIfExists('module_permission_role');
    }
}
