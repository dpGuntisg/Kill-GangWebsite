<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AwardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('awards')->insert([
            'id' => 1,
            'name' => '2022 KAINDORF SPRING GAMES',
            'date' => '2022-05-01',
            'description' => 'VERY COOL GAME',
            'image_id' => 9,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}