<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUsersForConfide extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->drop();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
	}

}
