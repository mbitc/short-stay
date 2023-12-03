<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterApartaments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('apartaments', function($table)
		{
		    $table->string('house_name',100);
			$table->string('street',100);
			$table->string('post_code',100);
			$table->string('city',100);
			$table->string('country',100);
		    
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
		Schema::table('apartaments', function($table)
		{			
		    $table->dropColumn('house_name');			
			$table->dropColumn('street');
			$table->dropColumn('post_code');
			$table->dropColumn('city');
			$table->dropColumn('country');

		});
	}

}
