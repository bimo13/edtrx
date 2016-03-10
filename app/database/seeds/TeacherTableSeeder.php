<?php

class TeacherTableSeeder extends Seeder {

    public function run() {
        DB::table('teacher_details')->truncate();
        DB::table('teacher_details')->insert(array(
            array(
                'user_id' => '2',
                'teacher_no' => '2007001002',
                'address' => 'JL. PASIRKALIKI DALAM I NO. 56/102, CICENDO - BANDUNG',
                'phone_1' => '+62811111',
                'phone_2' => '',
                'birth_place' => 'BANDUNG',
                'birth_date' => '1975/01/01',
                'gender' => 'MALE',
                'photo' => 'assets/uploads/teachers/0000000000-02.jpg'
            ),
            array(
                'user_id' => '3',
                'teacher_no' => '2007001003',
                'address' => 'JL. BABAKAN JERUK II NO. 88, PASTEUR - BANDUNG',
                'phone_1' => '+62811111',
                'phone_2' => '',
                'birth_place' => 'TASIKMALAYA',
                'birth_date' => '1975/01/01',
                'gender' => 'MALE',
                'photo' => 'assets/uploads/teachers/0000000000-02.jpg'
            ),
            array(
                'user_id' => '4',
                'teacher_no' => '2007001004',
                'address' => 'KOMP. KOPO PERMAI BLOK ALAMANDA CLUSTER I NO. 7, BANDUNG',
                'phone_1' => '+62811111',
                'phone_2' => '',
                'birth_place' => 'GARUT',
                'birth_date' => '1975/01/01',
                'gender' => 'MALE',
                'photo' => 'assets/uploads/teachers/0000000000-02.jpg'
            ),
            array(
                'user_id' => '5',
                'teacher_no' => '2007001005',
                'address' => 'PERUMAHAN BUMI ASRI RAHAYU, BLOK C4 NO. 17, BANDUNG',
                'phone_1' => '+62811111',
                'phone_2' => '',
                'birth_place' => 'GARUT',
                'birth_date' => '1975/01/01',
                'gender' => 'MALE',
                'photo' => 'assets/uploads/teachers/0000000000-02.jpg'
            ),
            array(
                'user_id' => '6',
                'teacher_no' => '2007001006',
                'address' => 'JL. MANOKWARI NO. 18, ANTAPANI - BANDUNG',
                'phone_1' => '+62811111',
                'phone_2' => '',
                'birth_place' => 'BANDUNG',
                'birth_date' => '1975/01/01',
                'gender' => 'MALE',
                'photo' => 'assets/uploads/teachers/0000000000-02.jpg'
            ),
            array(
                'user_id' => '7',
                'teacher_no' => '2007001007',
                'address' => 'KOMP. TAMAN KOPO INDAH I BLOK J8 NO. 8, BANDUNG',
                'phone_1' => '+62811111',
                'phone_2' => '',
                'birth_place' => 'JAKARTA',
                'birth_date' => '1975/01/01',
                'gender' => 'FEMALE',
                'photo' => 'assets/uploads/teachers/0000000000-02.jpg'
            ),
            array(
                'user_id' => '8',
                'teacher_no' => '2007001008',
                'address' => 'KOMP. TAMAN KOPO INDAH I BLOK A4 NO. 23, BANDUNG',
                'phone_1' => '+62811111',
                'phone_2' => '',
                'birth_place' => 'SUMEDANG',
                'birth_date' => '1975/01/01',
                'gender' => 'FEMALE',
                'photo' => 'assets/uploads/teachers/0000000000-02.jpg'
            ),
            array(
                'user_id' => '9',
                'teacher_no' => '2007001009',
                'address' => 'PERUMAHAN KOPO ELOK, JL. DELIMA 2 NO. 7, BANDUNG',
                'phone_1' => '+62811111',
                'phone_2' => '',
                'birth_place' => 'CIANJUR',
                'birth_date' => '1975/01/01',
                'gender' => 'FEMALE',
                'photo' => 'assets/uploads/teachers/0000000000-02.jpg'
            ),
            array(
                'user_id' => '10',
                'teacher_no' => '2007001010',
                'address' => 'JL. ABDULRAHMAN SHALEH Gg. CITRA NO. 77/104, CICENDO BANDUNG',
                'phone_1' => '+62811111',
                'phone_2' => '',
                'birth_place' => 'CIANJUR',
                'birth_date' => '1975/01/01',
                'gender' => 'FEMALE',
                'photo' => 'assets/uploads/teachers/0000000000-02.jpg'
            ),
            array(
                'user_id' => '11',
                'teacher_no' => '2007001011',
                'address' => 'JL. KOMODOR UDARA SUPADIO Gg. IBU DIOH NO. 6, CICENDO BANDUNG',
                'phone_1' => '+62811111',
                'phone_2' => '',
                'birth_place' => 'BANDUNG',
                'birth_date' => '1975/01/01',
                'gender' => 'MALE',
                'photo' => 'assets/uploads/teachers/0000000000-02.jpg'
            ),
            array(
                'user_id' => '12',
                'teacher_no' => '2007001012',
                'address' => 'KOMP. PERUM. AD, JL. PAK GATOT NO. 18, HEGARMANAH BANDUNG',
                'phone_1' => '+62811111',
                'phone_2' => '',
                'birth_place' => 'BANDUNG',
                'birth_date' => '1975/01/01',
                'gender' => 'FEMALE',
                'photo' => 'assets/uploads/teachers/0000000000-02.jpg'
            ),
            array(
                'user_id' => '13',
                'teacher_no' => '2007001013',
                'address' => 'JL. PESANTREN, KOMP. MUTIARA KENCANA, BLOK D NO. 80, CIMAHI',
                'phone_1' => '+62811111',
                'phone_2' => '',
                'birth_place' => 'SUMEDANG',
                'birth_date' => '1975/01/01',
                'gender' => 'MALE',
                'photo' => 'assets/uploads/teachers/0000000000-02.jpg'
            ),
            array(
                'user_id' => '14',
                'teacher_no' => '2007001014',
                'address' => 'JL. H. NAWI NO. 171, PADALARANG',
                'phone_1' => '+62811111',
                'phone_2' => '',
                'birth_place' => 'PONTIANAK',
                'birth_date' => '1975/01/01',
                'gender' => 'MALE',
                'photo' => 'assets/uploads/teachers/0000000000-02.jpg'
            ),
            array(
                'user_id' => '15',
                'teacher_no' => '2007001015',
                'address' => 'KOMP. RAHAYU INDAH II BLOK MILENIA I NO. 85',
                'phone_1' => '+62811111',
                'phone_2' => '',
                'birth_place' => 'PALEMBANG',
                'birth_date' => '1975/01/01',
                'gender' => 'FEMALE',
                'photo' => 'assets/uploads/teachers/0000000000-02.jpg'
            ),
            array(
                'user_id' => '16',
                'teacher_no' => '2007001001',
                'address' => 'JL. LENGKONG KECIL Gg. H. IMRON NO. 111/72, BANDUNG',
                'phone_1' => '+62811111',
                'phone_2' => '',
                'birth_place' => 'PURWAKARTA',
                'birth_date' => '1975/01/01',
                'gender' => 'MALE',
                'photo' => 'assets/uploads/teachers/0000000000-02.jpg'
            )
        ));
    }
}