<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('results', function(Blueprint $table)
		{
			$table->foreign('student_id')->references('id')->on('students')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('results', function(Blueprint $table)
		{
			$table->dropForeign('results_student_id_foreign');
			$table->dropForeign('results_subject_id_foreign');
		});
	}

}
