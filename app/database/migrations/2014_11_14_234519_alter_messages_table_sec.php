<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMessagesTableSec extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('messages', function($table)
		{
			//$table->renameColumn('id_apartament', 'apartament_id');
		    $table->renameColumn('id_message_type','message_type_id');
		    $table->renameColumn('id_message_action_type','message_action_type_id');
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
		Schema::table('messages', function($table)
		{
			//$table->renameColumn('apartament_id', 'id_apartament');
		    $table->renameColumn('message_type_id','id_message_type');
		    $table->renameColumn('message_action_type_id','id_message_action_type');
		});
	}

}
