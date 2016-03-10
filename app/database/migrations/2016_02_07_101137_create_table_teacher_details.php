<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTeacherDetails extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('teacher_details', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('teacher_no',255);
			$table->string('address',255);
			$table->string('phone_1',255);
			$table->string('phone_2',255)->nullable();
			$table->string('birth_place',255);
			$table->date('birth_date');
			$table->enum('gender', array('male', 'female'));
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
		Schema::drop('teacher_details');
	}

}
