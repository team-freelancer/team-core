<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('module_id')->length(11);
            $table->char('icon', 20);
            $table->tinyInteger('element')->length(2);
            $table->string('field_title', 100);
            $table->char('field_name', 50);
            $table->boolean('is_filter')->default(0);
            $table->boolean('is_search')->default(0);
            $table->boolean('is_hidden')->default(0);
            $table->boolean('is_manager')->default(0);
            $table->boolean('is_required')->default(0);
            $table->boolean('is_unique')->default(0);
            $table->char('link', 100);
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
        //
    }
}
