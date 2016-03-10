<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStudents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('students', function(Blueprint $table) {
			$table->increments('id');
			$table->string('student_no',255);
			$table->string('first_name',255);
			$table->string('last_name',255);
			$table->string('address',255);
			$table->string('phone',255);
			$table->string('ice_number',255);
			$table->string('birth_place',255);
			$table->date('birth_date',255);
			$table->enum('gender', array('male','female'));
			$table->integer('parent_id');
			$table->integer('class_id');
			$table->text('photo');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('students');
	}

}
