<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAttendance extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('attendance', function(Blueprint $table) {
			$table->increments('id');
			$table->date('date');
			$table->integer('student_id');
			$table->integer('subject_id');
			$table->boolean('attendance');
			$table->text('description')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('attendance');
	}

}
