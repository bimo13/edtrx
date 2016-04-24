<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePinboard extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('pinboard', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('teacher_id');
			$table->string('name',255);
			$table->text('description');
			$table->text('file_path');
			$table->string('file_name',255);
			$table->string('file_type',255);
			$table->text('publicity');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('pinboard');
	}

}
