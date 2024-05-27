<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            'id' => 1,
            'filename' => 'Guntis.jpg',
            'filepath' => 'storage/images/Guntis.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
