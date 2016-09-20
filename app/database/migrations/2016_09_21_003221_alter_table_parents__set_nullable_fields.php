<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableParentsSetNullableFields extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement('ALTER TABLE `parents` MODIFY `address` VARCHAR(255);');
        DB::statement('ALTER TABLE `parents` MODIFY `phone_1` VARCHAR(255);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement('ALTER TABLE `parents` MODIFY `address` VARCHAR(255) NOT NULL;');
        DB::statement('ALTER TABLE `parents` MODIFY `phone_1` VARCHAR(255) NOT NULL;');
    }

}
