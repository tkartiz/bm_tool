<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'roll' => 'user',
                'name' => 'Aさん',
                'affiliation' => '営業部',
                'email' => 'test@test.com',
                'phone' => '01234567891',
                'password' => Hash::make('password123'),
            ],
            [
                'roll' => 'user',
                'name' => 'Bさん',
                'affiliation' => '販売部',
                'email' => 'demo@demo.com',
                'phone' => '01234567891',
                'password' => Hash::make('password123'),
            ]
        ]);
    }
}
