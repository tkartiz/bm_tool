<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            CreatorSeeder::class,
            ApplicationSeeder::class,
            WorkSpecSeeder::class,
            WorkSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
