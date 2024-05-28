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

            [
                'id' => 1,
                'filename' => 'Guntis.jpg',
                'filepath' => 'storage/images/Guntis.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'filename' => 'Klavs.png',
                'filepath' => 'storage/images/Klavs.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'filename' => 'kevin.jpg',
                'filepath' => 'storage/images/kevin.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'filename' => 'monkey.jpg',
                'filepath' => 'storage/images/monkey.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'filename' => 'stefans.png',
                'filepath' => 'storage/images/stefans.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'filename' => 'Jekabs.png',
                'filepath' => 'storage/images/Jekabs.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'filename' => 'Henrijs.png',
                'filepath' => 'storage/images/Henrijs.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'filename' => 'default_member_img.png',
                'filepath' => 'storage/images/default_member_img.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'filename' => 'default_awards_image.png',
                'filepath' => 'storage/images/default_awards_image.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            

        ]);
    }
}
