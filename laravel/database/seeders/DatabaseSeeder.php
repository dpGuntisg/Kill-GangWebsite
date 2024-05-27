<?php

namespace Database\Seeders;

use App\Http\Controllers\ImageController;
use App\Models\Member;
use Illuminate\Database\Seeder;
use App\Models\User;

namespace Database\Seeders;

use App\Http\Controllers\ImageController;
use App\Models\Member;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(ImagesTableSeeder::class); 
        $this->call(AdminUserSeeder::class); 
        $this->call(AwardsTableSeeder::class); 
        $this->call(MembersTableSeeder::class); 

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
