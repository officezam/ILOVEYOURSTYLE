<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
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
                'name' => 'Amir Shahzad',
                'type' => 'admin',
                'email' => 'officezam@gmail.com',
                'user_address' => 'California',
                'phone' => '+923007272332',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Admin',
                'type' => 'admin',
                'email' => 'admin@gmail.com',
                'user_address' => 'USA',
                'phone' => '+923007272332',
                'password' => bcrypt('pass2word'),
            ]
        ]);
    }
}
