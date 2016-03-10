<?php

class SentryPermissionTableSeeder extends Seeder {

    public function run() {
        DB::table('permissions')->truncate();
        DB::table('permissions')->insert(array(
            array('name' => 'Manage ',
                'value' => 'admin.agenda',
                'description' => 'Permission on managing agenda.',
            ),
            array('name' => 'Manage ',
                'value' => 'admin.attendance',
                'description' => 'Permission on managing attendance.',
            ),
            array('name' => 'Manage ',
                'value' => 'admin.gallery',
                'description' => 'Permission on managing galleries.',
            ),
            array('name' => 'Manage ',
                'value' => 'admin.grade',
                'description' => 'Permission on managing grades.',
            ),
            array('name' => 'Manage ',
                'value' => 'admin.student',
                'description' => 'Permission on managing students.',
            ),
            array('name' => 'Manage ',
                'value' => 'admin.timeline',
                'description' => 'Permission on managing timelines.',
            ),
            array('name' => 'Manage ',
                'value' => 'admin.user',
                'description' => 'Permission on managing users.',
            ),
        ));
    }

}
