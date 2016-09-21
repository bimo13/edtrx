<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableParentsSetLastNameAsNullable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement('ALTER TABLE `parents` MODIFY `last_name` VARCHAR(255);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement('ALTER TABLE `parents` MODIFY `last_name` VARCHAR(255) NOT NULL;');
    }

}
