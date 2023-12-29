<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'role' => 'admin',
                'name' => '鷹嘴',
                'affiliation' => '部長',
                'email' => 'm.t@ffg.com',
                'phone' => '01234567891',
                'password' => Hash::make('password123'),
            ],
            [
                'role' => 'admin',
                'name' => '松本',
                'affiliation' => '社長',
                'email' => 'y.m@ffg.com',
                'phone' => '01234567891',
                'password' => Hash::make('password123'),
            ]
        ]);
    }
}
