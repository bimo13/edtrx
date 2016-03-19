<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAttendanceRmSubject extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('attendance', function($table) {
			$table->dropColumn('subject_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('attendance', function($table) {
			$table->integer('subject_id')->after('student_id');
		});
	}

}
