<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'code' => '0001',
                'name' => 'Patient0001',
                'gender' => 1,
                'birth_date' => Carbon::now(),
                'address' => str_random(50),
                'tel' => '+84974422633',
                'email' => 'patient0001@gmail.com',
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'code' => '0002',
                'name' => 'Patient0002',
                'gender' => 0,
                'birth_date' => Carbon::now(),
                'address' => str_random(50),
                'tel' => '+84974422633',
                'email' => 'patient0002@gmail.com',
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 2,
                'created_by' => 2
            ],
            [
                'code' => '0003',
                'name' => 'Patient0003',
                'gender' => 1,
                'birth_date' => Carbon::now(),
                'address' => str_random(50),
                'tel' => '+84974422633',
                'email' => 'patient0003@gmail.com',
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 2
            ],
            [
                'code' => '0004',
                'name' => 'Patient0004',
                'gender' => 0,
                'birth_date' => Carbon::now(),
                'address' => str_random(50),
                'tel' => '+84974422633',
                'email' => 'patient0004@gmail.com',
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 2,
                'created_by' => 1
            ],
            [
                'code' => '0005',
                'name' => 'Patient0005',
                'gender' => 1,
                'birth_date' => Carbon::now(),
                'address' => str_random(50),
                'tel' => '+84974422633',
                'email' => 'patient0005@gmail.com',
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'code' => '0006',
                'name' => 'Patient0006',
                'gender' => 0,
                'birth_date' => Carbon::now(),
                'address' => str_random(50),
                'tel' => '+84974422633',
                'email' => 'patient0006@gmail.com',
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 2,
                'created_by' => 2
            ],
            [
                'code' => '0007',
                'name' => 'Patient0007',
                'gender' => 1,
                'birth_date' => Carbon::now(),
                'address' => str_random(50),
                'tel' => '+84974422633',
                'email' => 'patient0007@gmail.com',
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 2,
                'created_by' => 2
            ],
            [
                'code' => '0008',
                'name' => 'Patient0008',
                'gender' => 1,
                'birth_date' => Carbon::now(),
                'address' => str_random(50),
                'tel' => '+84974422633',
                'email' => 'patient0008@gmail.com',
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 2,
                'created_by' => 2
            ],
            [
                'code' => '0009',
                'name' => 'Patient0009',
                'gender' => 0,
                'birth_date' => Carbon::now(),
                'address' => str_random(50),
                'tel' => '+84974422633',
                'email' => 'patient0009@gmail.com',
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 2,
                'created_by' => 2
            ],
            [
                'code' => '0010',
                'name' => 'Patient0010',
                'gender' => 0,
                'birth_date' => Carbon::now(),
                'address' => str_random(50),
                'tel' => '+84974422633',
                'email' => 'patient0010@gmail.com',
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ]
        ]);
    }
}
