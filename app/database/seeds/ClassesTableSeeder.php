<?php

class ClassesTableSeeder extends Seeder {

    public function run() {
        DB::table('classes')->truncate();
        DB::table('classes')->insert(array(
            array(
                'class_name' => '1-1',
                'grade_level' => '1',
                'teacher_id' => '2'
            ),
            array(
                'class_name' => '1-2',
                'grade_level' => '1',
                'teacher_id' => '3'
            ),
            array(
                'class_name' => '1-3',
                'grade_level' => '1',
                'teacher_id' => '4'
            ),
            array(
                'class_name' => '2-1',
                'grade_level' => '2',
                'teacher_id' => '5'
            ),
            array(
                'class_name' => '2-2',
                'grade_level' => '2',
                'teacher_id' => '6'
            ),
            array(
                'class_name' => '2-3',
                'grade_level' => '2',
                'teacher_id' => '7'
            ),
            array(
                'class_name' => '3-1',
                'grade_level' => '3',
                'teacher_id' => '8'
            ),
            array(
                'class_name' => '3-2',
                'grade_level' => '3',
                'teacher_id' => '9'
            ),
            array(
                'class_name' => '3-3',
                'grade_level' => '3',
                'teacher_id' => '10'
            )
        ));
        $this->command->info('Classes table seeded.');
    }

}