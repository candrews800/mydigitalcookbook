<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFieldsFromRecipes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('recipes', function(Blueprint $table)
		{
			$table->dropColumn(array('comments'));
            $table->text('additional_text');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('recipes', function(Blueprint $table)
		{
            $table->dropColumn('additional_text');
            $table->text('comments');
		});
	}

}
