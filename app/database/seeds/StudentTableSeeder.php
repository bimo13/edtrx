<?php

class StudentTableSeeder extends Seeder {

    public function run() {
        DB::table('students')->truncate();
        DB::table('students')->insert(array(
            array(
                'student_no' => '20100101',
                'first_name' => 'ADAM',
                'last_name' => 'WICAKSONO',
                'address' => 'JL. BABAKAN SURABAYA NO. 56 RT 07/08 BANDUNG',
                'phone' => '8132500711',
                'ice_number' => '8132500700',
                'birth_place' => 'BANDUNG',
                'birth_date' => '2003/08/13',
                'gender' => 'MALE',
                'parent_id' => '1',
                'class_id' => '1',
                'photo' => 'assets/uploads/students/0000000000-01.jpg'
            ),
            array(
                'student_no' => '20100102',
                'first_name' => 'ADHI',
                'last_name' => 'NUGRAHA',
                'address' => 'KOMP. MITRA DAGO BLOK A NO. 11 RT 01/07 BANDUNG',
                'phone' => '8132011015',
                'ice_number' => '8132011010',
                'birth_place' => 'BANDUNG',
                'birth_date' => '2003/03/01',
                'gender' => 'MALE',
                'parent_id' => '2',
                'class_id' => '1',
                'photo' => 'assets/uploads/students/0000000000-01.jpg'
            ),
            array(
                'student_no' => '20100103',
                'first_name' => 'ANDINI',
                'last_name' => 'NURINTAN',
                'address' => 'KOMP. MARGAHAYU PERMAI BLOK C1 NO. 1 RT 03/03 BANDUNG',
                'phone' => '8567771313',
                'ice_number' => '8112206677',
                'birth_place' => 'BANDUNG',
                'birth_date' => '2003/11/20',
                'gender' => 'FEMALE',
                'parent_id' => '3',
                'class_id' => '1',
                'photo' => 'assets/uploads/students/0000000000-01.jpg'
            ),
            array(
                'student_no' => '20100104',
                'first_name' => 'ANITA',
                'last_name' => 'TRI RAHAYU',
                'address' => 'JL. SADAKELING NO. 205 BANDUNG',
                'phone' => '85780141567',
                'ice_number' => '8157734747',
                'birth_place' => 'BANDUNG',
                'birth_date' => '2003/09/05',
                'gender' => 'FEMALE',
                'parent_id' => '4',
                'class_id' => '1',
                'photo' => 'assets/uploads/students/0000000000-01.jpg'
            ),
            array(
                'student_no' => '20100105',
                'first_name' => 'BEATRICE',
                'last_name' => 'SIMORANGKIR',
                'address' => 'JL. DAKOTA II Gg. RADIO NO. 17/72 BANDUNG',
                'phone' => '8121789456',
                'ice_number' => '8112226789',
                'birth_place' => 'BANDUNG',
                'birth_date' => '2003/05/15',
                'gender' => 'FEMALE',
                'parent_id' => '5',
                'class_id' => '1',
                'photo' => 'assets/uploads/students/0000000000-01.jpg'
            ),
            array(
                'student_no' => '20100106',
                'first_name' => 'CHARLES',
                'last_name' => 'SIMORANGKIR',
                'address' => 'JL. DAKOTA II Gg. RADIO NO. 17/72 BANDUNG',
                'phone' => '8121789123',
                'ice_number' => '8112226789',
                'birth_place' => 'BANDUNG',
                'birth_date' => '2003/05/15',
                'gender' => 'MALE',
                'parent_id' => '5',
                'class_id' => '1',
                'photo' => 'assets/uploads/students/0000000000-01.jpg'
            ),
            array(
                'student_no' => '20100107',
                'first_name' => 'DINAR',
                'last_name' => 'SETIAWIDIANI',
                'address' => 'KOMP. BANDUNG INDAH RAYA JL. HIJAU DAUN NO. 4 BANDUNG',
                'phone' => '8131400255',
                'ice_number' => '8785578911',
                'birth_place' => 'BANDUNG',
                'birth_date' => '2003/09/01',
                'gender' => 'FEMALE',
                'parent_id' => '6',
                'class_id' => '1',
                'photo' => 'assets/uploads/students/0000000000-01.jpg'
            ),
            array(
                'student_no' => '20100108',
                'first_name' => 'ELDIN',
                'last_name' => 'MUHAMMAD AKBAR',
                'address' => 'JL. CILENGKRANG II NO. 176, UJUNG BERUNG BANDUNG',
                'phone' => '81516781879',
                'ice_number' => '8171144265',
                'birth_place' => 'BANDUNG',
                'birth_date' => '2003/05/13',
                'gender' => 'MALE',
                'parent_id' => '7',
                'class_id' => '1',
                'photo' => 'assets/uploads/students/0000000000-01.jpg'
            ),
            array(
                'student_no' => '20100108',
                'first_name' => 'FARIS SOFWAN',
                'last_name' => 'RAMDAN JUAENI',
                'address' => 'KOMP. BAROS INDAH BLOK A10 NO. 7, CIMAHI',
                'phone' => '85624681357',
                'ice_number' => '88890119100',
                'birth_place' => 'PURWAKARTA',
                'birth_date' => '2003/01/07',
                'gender' => 'MALE',
                'parent_id' => '8',
                'class_id' => '1',
                'photo' => 'assets/uploads/students/0000000000-01.jpg'
            ),
        ));
        $this->command->info('Students table seeded.');
    }

}