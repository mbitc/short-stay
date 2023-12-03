<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDiscussionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('discussions', function($table)
		{
			 $table->text('text');	
			 $table->string('telephone');
			 $table->string('email');
			 $table->integer('discussion_status_id');
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
		Schema::table('discussions', function($table)
		{
			$table->dropColumn('text');
			$table->dropColumn('telephone');
			$table->dropColumn('email');
			$table->dropColumn('discussion_status_id');       
		});
	}

}
