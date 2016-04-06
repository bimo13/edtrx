<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTimeline extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('timeline', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('category');
			$table->integer('post_id');
			$table->text('publicity');
			$table->nullableTimestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('timeline');
	}

}
