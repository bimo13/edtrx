<?php

class ParentTableSeeder extends Seeder {

    public function run() {
        DB::table('parents')->truncate();
        DB::table('parents')->insert(array(
            array(
                'first_name' => 'AHMAD',
                'last_name' => 'WICAKSONO',
                'address' => 'JL. BABAKAN SURABAYA NO. 56 RT 07/08 BANDUNG',
                'phone_1' => '8132500722',
                'phone_2' => '',
                'photo' => 'assets/uploads/parents/0000000000-01.jpg',
                'email'=> 'ahmad.wicaksono@email.com',
                'password' => sha1('AhmadWicaksono321+'),
                'session' => 0
            ),
            array(
                'first_name' => 'JOHANES',
                'last_name' => 'SETIAWAN',
                'address' => 'KOMP. MITRA DAGO BLOK A NO. 11 RT 01/07 BANDUNG',
                'phone_1' => '87877885643',
                'phone_2' => '',
                'photo' => 'assets/uploads/parents/0000000000-01.jpg',
                'email'=> 'johanes.setiawan@email.com',
                'password' => sha1('JohanesSetiawan321+'),
                'session' => 0
            ),
            array(
                'first_name' => 'INTAN',
                'last_name' => 'ANGGRAINI',
                'address' => 'KOMP. MARGAHAYU PERMAI BLOK C1 NO. 1 RT 03/03 BANDUNG',
                'phone_1' => '85712129851',
                'phone_2' => '',
                'photo' => 'assets/uploads/parents/0000000000-01.jpg',
                'email'=> 'intan.anggraini@email.com',
                'password' => sha1('IntanAnggraini321+'),
                'session' => 0
            ),
            array(
                'first_name' => 'AAZ',
                'last_name' => 'AZAMUDIN',
                'address' => 'JL. SADAKELING NO. 205 BANDUNG',
                'phone_1' => '8998891234',
                'phone_2' => '',
                'photo' => 'assets/uploads/parents/0000000000-01.jpg',
                'email'=> 'aaz.azamudin@email.com',
                'password' => sha1('AazAzamudin321+'),
                'session' => 0
            ),
            array(
                'first_name' => 'GUNAWAN',
                'last_name' => 'SIMORANGKIR',
                'address' => 'JL. DAKOTA II Gg. RADIO NO. 17/72 BANDUNG',
                'phone_1' => '8121403265',
                'phone_2' => '',
                'photo' => 'assets/uploads/parents/0000000000-01.jpg',
                'email'=> 'gunawan.simorangkir@email.com',
                'password' => sha1('GunawanSimorangkir321+'),
                'session' => 0
            ),
            array(
                'first_name' => 'KARTINA',
                'last_name' => 'SETIANINGSIH',
                'address' => 'KOMP. BANDUNG INDAH RAYA JL. HIJAU DAUN NO. 4 BANDUNG',
                'phone_1' => '8137615987',
                'phone_2' => '',
                'photo' => 'assets/uploads/parents/0000000000-01.jpg',
                'email'=> 'kartina.setianingsih@email.com',
                'password' => sha1('KartinaSetianingsih321+'),
                'session' => 0
            ),
            array(
                'first_name' => 'ANDRE',
                'last_name' => 'IMANUDIN',
                'address' => 'JL. CILENGKRANG II NO. 176, UJUNG BERUNG BANDUNG',
                'phone_1' => '8119967189',
                'phone_2' => '89999131399',
                'photo' => 'assets/uploads/parents/0000000000-01.jpg',
                'email'=> 'andre.imanudin@email.com',
                'password' => sha1('AndreImanudin321+'),
                'session' => 0
            ),
            array(
                'first_name' => 'HUMAM',
                'last_name' => 'WAFIQ',
                'address' => 'KOMP. BAROS INDAH BLOK A10 NO. 7, CIMAHI',
                'phone_1' => '81532291000',
                'phone_2' => '',
                'photo' => 'assets/uploads/parents/0000000000-01.jpg',
                'email'=> 'humam.wafiq@email.com',
                'password' => sha1('HumamWafiq321+'),
                'session' => 0
            ),
        ));
        $this->command->info('Parent table seeded.');
    }

}