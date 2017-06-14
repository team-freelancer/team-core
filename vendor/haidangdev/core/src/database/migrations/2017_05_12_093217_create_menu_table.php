<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type');
            $table->string('title', 100);
            $table->string('icon', 50);
            $table->text('style');
            $table->integer('sort');
            $table->string('link_to', 25);
            $table->tinyInteger('is_active');
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
