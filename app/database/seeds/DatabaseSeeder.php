<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Eloquent::unguard();

		$this->call('SentryGroupTableSeeder');
		$this->command->info('Users groups table seeded.');

		$this->call('SentryPermissionTableSeeder');
		$this->command->info('Users permissions table seeded.');

		$this->call('SentryUserTableSeeder');
		$this->command->info('Users table seeded.');

		$this->call('TeacherTableSeeder');
		$this->command->info('Teacher details table seeded.');

		$this->call('StudentTableSeeder');
		$this->command->info('Student table seeded.');

		$this->call('ParentTableSeeder');
		$this->command->info('Parent table seeded.');
	}

}
