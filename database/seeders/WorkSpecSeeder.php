<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class WorkSpecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('workspecs')->insert([
            [
                'application_id' => 1,
                'size' => 'A4',
                'format' => '入稿',
                'article' => '出力のみ',
                'content' => null,
                'file' => null,
                'quantity' => 1,
                'unit' => '枚',
            ],
            [
                'application_id' => 1,
                'size' => 'A3',
                'format' => '入稿',
                'article' => '出力のみ',
                'content' => null,
                'file' => null,
                'quantity' => 10,
                'unit' => '枚',
            ],
            [
                'application_id' => 1,
                'size' => 'A1',
                'format' => '入稿',
                'article' => '出力のみ',
                'content' => null,
                'file' => null,
                'quantity' => 2,
                'unit' => '枚',
            ],
            [
                'application_id' => 3,
                'size' => 'A2',
                'format' => '入稿',
                'article' => '出力のみ',
                'content' => null,
                'file' => null,
                'quantity' => 5,
                'unit' => '枚',
            ],
        ]);
    }
}
