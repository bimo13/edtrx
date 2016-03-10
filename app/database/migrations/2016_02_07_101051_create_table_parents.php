<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableParents extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('parents', function(Blueprint $table) {
			$table->increments('id');
			$table->string('first_name',255);
			$table->string('last_name',255);
			$table->string('address',255);
			$table->string('phone_1',255);
			$table->string('phone_2',255)->nullable();
			$table->text('photo')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('parents');
	}

}
