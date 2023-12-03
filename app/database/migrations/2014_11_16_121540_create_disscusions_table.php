<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisscusionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//		

		Schema::create('discussions', function(Blueprint $table){
			$table->increments('id');
			$table->integer('apartament_id');
			$table->timestamps();
		});
		Schema::table('messages', function($table)
		{
		    //$table->dropForeign('messages_apartament_id_foreign');
		    //$table->dropColumn('apartament_id');
		    $table->integer('user_id');
		    $table->integer('discussion_id');
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
		Schema::dropIfExists('discussions');
		Schema::table('messages', function($table){
			//$table->dropForeign('messages_discussion_id_foreign');
			$table->dropColumn('discussion_id');
			//$table->integer('apartament_id');
			//$table->integer('')
			$table->dropColumn('user_id');
		});
	}

}
