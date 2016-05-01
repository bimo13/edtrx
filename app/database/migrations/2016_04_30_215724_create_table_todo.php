<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTodo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('todo', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('teacher_id');
			$table->date('date');
			$table->string('name',255);
			$table->text('description');
			$table->boolean('has_file');
			$table->text('file_path')->nullable();
			$table->string('file_name',255)->nullable();
			$table->string('file_type',255)->nullable();
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
		Schema::drop('todo');
	}

}
