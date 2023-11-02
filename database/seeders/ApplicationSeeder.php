<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applications')->insert([
            [
                'user_id' => 1,
                'subject' => '秋祭りイベント',
                'applicated_at' => null,
                'desired_dlvd_at' => date('2023-12-10'),
                'works_quantity' => 3,
                'severity' => '通常',
                'ttl_price_incl' => null,
                'ttl_price_exc' => null,
            ],
            [
                'user_id' => 2,
                'subject' => 'ハロウィーンイベント',
                'applicated_at' => null,
                'desired_dlvd_at' => date('2023-12-25'),
                'works_quantity' => null,
                'severity' => '急ぎ',
                'ttl_price_incl' => null,
                'ttl_price_exc' => null,
            ],
            [
                'user_id' => 1,
                'subject' => 'オクトーバーフェストイベント',
                'applicated_at' => null,
                'desired_dlvd_at' => date('2024-01-10'),
                'works_quantity' => 1,
                'severity' => '超急ぎ',
                'ttl_price_incl' => null,
                'ttl_price_exc' => null,
            ],
        ]);
    }
}
