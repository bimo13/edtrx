<?php

class SentryUserTableSeeder extends Seeder {

    public function run() {
        DB::table('users')->truncate();

        // ADMIN
        // =====
        Sentry::getUserProvider()->create(array(
            'email'       => 'admin@edutrax.com',
            'password'    => 'Administrator321+',
            'first_name'  => 'Admin',
            'last_name'   => 'Admin',
            'activated'   => 1,
        ));

        // Assign user permissions
        $adminUser  = Sentry::getUserProvider()->findByLogin('admin@edutrax.com');
        $adminGroup = Sentry::getGroupProvider()->findByName('Admin');
        $adminUser->addGroup($adminGroup);

        // TEACHERS
        // ========
        Sentry::getUserProvider()->create(array(
            'email'       => 'ahmad.gustiawan@edutrax.com',
            'password'    => 'AhmadGustiawan321+',
            'first_name'  => 'AHMAD',
            'last_name'   => 'GUSTIAWAN',
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin('ahmad.gustiawan@edutrax.com');
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

        Sentry::getUserProvider()->create(array(
            'email'       => 'eggy.gouztam@edutrax.com',
            'password'    => 'EggyGouztam321+',
            'first_name'  => 'EGGY',
            'last_name'   => 'NUDZUL GOUZTAM',
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin('eggy.gouztam@edutrax.com');
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

        Sentry::getUserProvider()->create(array(
            'email'       => 'ozzie.ghazali@edutrax.com',
            'password'    => 'OzzieGhazali321+',
            'first_name'  => 'OZZIE',
            'last_name'   => 'MUHAMMAD GHAZALI',
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin('ozzie.ghazali@edutrax.com');
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

        Sentry::getUserProvider()->create(array(
            'email'       => 'dimas.permana@edutrax.com',
            'password'    => 'DimasPermana321+',
            'first_name'  => 'DIMAS',
            'last_name'   => 'PERMANA',
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin('dimas.permana@edutrax.com');
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

        Sentry::getUserProvider()->create(array(
            'email'       => 'andre.dharma@edutrax.com',
            'password'    => 'AndreDharma321+',
            'first_name'  => 'ANDRE',
            'last_name'   => 'HALLEY DHARMA',
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin('andre.dharma@edutrax.com');
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

        Sentry::getUserProvider()->create(array(
            'email'       => 'silvia.yuliani@edutrax.com',
            'password'    => 'SilviaYuliani321+',
            'first_name'  => 'SILVIA',
            'last_name'   => 'YULIANI',
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin('silvia.yuliani@edutrax.com');
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

        Sentry::getUserProvider()->create(array(
            'email'       => 'ellisa.maulidia@edutrax.com',
            'password'    => 'EllisaMaulidia321+',
            'first_name'  => 'ELLISA',
            'last_name'   => 'MAULIDIA PUTRI',
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin('ellisa.maulidia@edutrax.com');
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

        Sentry::getUserProvider()->create(array(
            'email'       => 'tri.rejeki@edutrax.com',
            'password'    => 'TriRejeki321+',
            'first_name'  => 'TRI',
            'last_name'   => 'REJEKI',
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin('tri.rejeki@edutrax.com');
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

        Sentry::getUserProvider()->create(array(
            'email'       => 'alifia.wardoyo@edutrax.com',
            'password'    => 'AlifiaWardoyo321+',
            'first_name'  => 'ALIFIA',
            'last_name'   => 'BINTI WARDOYO',
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin('alifia.wardoyo@edutrax.com');
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

        Sentry::getUserProvider()->create(array(
            'email'       => 'hendri.firmansyah@edutrax.com',
            'password'    => 'HendriFirmansyah321+',
            'first_name'  => 'HENDRI',
            'last_name'   => 'FIRMANSYAH',
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin('hendri.firmansyah@edutrax.com');
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

        Sentry::getUserProvider()->create(array(
            'email'       => 'pradnyadhevi@edutrax.com',
            'password'    => 'Pradnyadhevi321+',
            'first_name'  => 'PRADNYADHEVI',
            'last_name'   => 'GUNAWAN',
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin('pradnyadhevi@edutrax.com');
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

        Sentry::getUserProvider()->create(array(
            'email'       => 'maman.suryaman@edutrax.com',
            'password'    => 'MamanSuryaman321+',
            'first_name'  => 'MAMAN',
            'last_name'   => 'SURYAMAN',
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin('maman.suryaman@edutrax.com');
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

        Sentry::getUserProvider()->create(array(
            'email'       => 'rega.arief@edutrax.com',
            'password'    => 'RegaArief321+',
            'first_name'  => 'REGA',
            'last_name'   => 'ARIEF',
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin('rega.arief@edutrax.com');
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

        Sentry::getUserProvider()->create(array(
            'email'       => 'yune.syaiddah@edutrax.com',
            'password'    => 'YuneSyaiddah321+',
            'first_name'  => 'YUNE',
            'last_name'   => 'SYAIDDAH',
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin('yune.syaiddah@edutrax.com');
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

        Sentry::getUserProvider()->create(array(
            'email'       => 'muhammad.yusuf@edutrax.com',
            'password'    => 'MuhammadYusuf321+',
            'first_name'  => 'MUHAMMAD',
            'last_name'   => 'YUSUF',
            'activated'   => 1,
        ));
        // Assign user permissions
        $teacherUser  = Sentry::getUserProvider()->findByLogin('muhammad.yusuf@edutrax.com');
        $teacherGroup = Sentry::getGroupProvider()->findByName('Teacher');
        $teacherUser->addGroup($teacherGroup);

    }

}