<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            'id' => 1,
            'name' => 'guntis',
            'description' => 'very cool man',
            'image_id' => 1, // Assuming the image_id corresponds to the image with ID 1
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}