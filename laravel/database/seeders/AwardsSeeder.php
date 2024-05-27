<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AwardsTableSeeder extends Seeder
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
            'date' => '2022-05-01', // Adjust the date format as needed
            'description' => 'VERY COOL GAME',
            'image_id' => 1, // Assuming the image_id corresponds to the image with ID 1
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}