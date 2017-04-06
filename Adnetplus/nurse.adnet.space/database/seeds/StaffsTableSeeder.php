<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StaffsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staffs')->insert([
            [
                'code' => 'admin',
                'name' => 'Admin',
                'gender' => 1,
                'birth_date' => Carbon::now(),
                'nationality' => 2, // Japan
                'address' => str_random(100),
                'tel' => '+84974422633',
                'email' => 'khoiv.adnetplus@gmail.com',
                'password' => bcrypt('123'),
                'is_admin' => true,
                'remember_token' => null,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'code' => '0001',
                'name' => 'Test0001',
                'gender' => 1,
                'birth_date' => Carbon::now(),
                'nationality' => 1, // Vietnam
                'address' => str_random(100),
                'tel' => '+84974422633',
                'email' => 'test01@gmail.com',
                'password' => bcrypt('123'),
                'is_admin' => false,
                'remember_token' => '',
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ],
            [
                'code' => '0002',
                'name' => 'Test0002',
                'gender' => 0,
                'birth_date' => Carbon::now(),
                'nationality' => 1, // Vietnam
                'address' => str_random(50),
                'tel' => '+84974422633',
                'email' => 'test02@gmail.com',
                'password' => bcrypt('123'),
                'is_admin' => false,
                'remember_token' => null,
                'delete_flag' => false,
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_by' => 1,
                'created_by' => 1
            ]
        ]);
    }
}
