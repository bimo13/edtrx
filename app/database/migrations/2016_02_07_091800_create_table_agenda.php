<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAgenda extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('agenda', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('teacher_id');
			$table->date('date');
			$table->time('time_start');
			$table->time('time_end');
			$table->text('description');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('agenda');
	}

}
