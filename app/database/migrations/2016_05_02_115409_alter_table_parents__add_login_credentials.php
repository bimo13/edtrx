<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableParentsAddLoginCredentials extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('parents', function($table) {
			$table->string('email',255)->after('photo');
			$table->string('password',255)->after('email');
			$table->boolean('session')->after('password');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('parents', function($table) {
			$table->dropColumn('email');
			$table->dropColumn('password');
			$table->dropColumn('session');
		});
	}

}
