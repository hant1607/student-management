<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name', 191);
			$table->bigInteger('user_id')->unsigned()->nullable()->index('students_user_id_foreign');
			$table->bigInteger('class_id')->unsigned()->nullable()->index('students_class_id_foreign');
			$table->date('birthday');
			$table->string('gender', 191);
			$table->char('phone', 11);
			$table->string('image')->nullable();
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
		Schema::drop('students');
	}

}
