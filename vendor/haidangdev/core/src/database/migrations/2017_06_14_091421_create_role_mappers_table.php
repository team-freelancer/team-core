<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleMappersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_role_mappers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('module_id')->length(11);
            $table->integer('role_id')->length(11);
            $table->boolean('is_view')->default(0);
            $table->boolean('is_create')->default(0);
            $table->boolean('is_update')->default(0);
            $table->boolean('is_delete')->default(0);
            $table->text('fields');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
