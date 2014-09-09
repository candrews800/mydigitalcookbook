<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('recipes', function($table)
        {
            $table->increments('id');
            $table->string('name');
            $table->char('time', 20);
            $table->integer('calories');
            $table->string('image');
            $table->text('directions');
            $table->string('url');
            $table->text('comments');
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
        Schema::drop('recipes');
	}

}
