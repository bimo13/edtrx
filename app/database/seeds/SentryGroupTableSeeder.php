<?php

class SentryGroupTableSeeder extends Seeder {

    public function run() {
        DB::table('groups')->truncate();
        DB::table('users_groups')->truncate();
        Sentry::getGroupProvider()->create(
            array(
                'name'        => 'Admin',
                'permissions' => array(
                    'admin' => 1,
                    'admin.users' => 1
                )
            )
        );
        Sentry::getGroupProvider()->create(
            array(
                'name'        => 'Teacher',
                'permissions' => array(
                    'admin.agenda' => 1,
                    'admin.attendance' => 1,
                    'admin.gallery' => 1,
                    'admin.grade' => 1,
                    'admin.student' => 1,
                    'admin.timeline' => 1,
                    'admin.pinboard' => 1
                )
            )
        );
    }

}
