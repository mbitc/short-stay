<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDiscussionStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('discussion_status', function($table)
        {
            $table->integer('level');
            $table->string('color');
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
		Schema::table('discussion_status', function($table)
        {
            $table->dropColumn('level');
            $table->dropColumn('color');
        });
	}

}
