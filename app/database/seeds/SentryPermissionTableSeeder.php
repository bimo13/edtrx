<?php

class SentryPermissionTableSeeder extends Seeder {

    public function run() {
        DB::table('permissions')->truncate();
        DB::table('permissions')->insert(array(
            array('name' => 'Manage Agenda',
                'value' => 'admin.agenda',
                'description' => 'Permission on managing agenda.',
            ),
            array('name' => 'Manage Attendance',
                'value' => 'admin.attendance',
                'description' => 'Permission on managing attendance.',
            ),
            array('name' => 'Manage Gallery',
                'value' => 'admin.gallery',
                'description' => 'Permission on managing galleries.',
            ),
            array('name' => 'Manage Grade',
                'value' => 'admin.grade',
                'description' => 'Permission on managing grades.',
            ),
            array('name' => 'Manage Students',
                'value' => 'admin.student',
                'description' => 'Permission on managing students.',
            ),
            array('name' => 'Manage Timeline',
                'value' => 'admin.timeline',
                'description' => 'Permission on managing timelines.',
            ),
            array('name' => 'Manage User',
                'value' => 'admin.user',
                'description' => 'Permission on managing users.',
            ),
            array('name' => 'Manage Pinboard',
                'value' => 'admin.pinboard',
                'description' => 'Permission on managing pin boards.',
            ),
        ));
    }

}
