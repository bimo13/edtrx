<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAlbumAddUserPublicity extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('albums', function($table) {
			$table->integer('teacher_id')->after('id');
			$table->string('publicity',255)->after('venue');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('albums', function($table) {
			$table->dropColumn('teacher_id');
			$table->dropColumn('publicity');
		});
	}

}
