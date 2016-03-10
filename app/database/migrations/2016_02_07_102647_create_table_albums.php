<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAlbums extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('albums', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name',255);
			$table->text('description')->nullable();
			$table->string('venue',255)->nullable();
			$table->date('date_taken',255)->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('albums');
	}

}
