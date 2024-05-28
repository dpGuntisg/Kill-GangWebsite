<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            [
                'name' => 'Guapo',
                'description' => 'Guapo is a brilliant and cunning co-creator of Kill Gang. With sharp intellect and street smarts. Muscular and imposing, his presence commands respect. his strategic acumen has shaped the gang into a formidable force, expanding their influence across the world. Despite his cunning, he adheres to a strict dress code, earning loyalty from his associates', 
                'image_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PINCIS',
                'description' => 'In the shadows, PINCIS reigns supreme—a blend of beauty, brains, and brawn. Regarded as the planets best fighter, he co-created Kill Gang. With striking allure and unmatched strength, he navigates the criminal world, his intelligence and strategic brilliance making him a force to be reckoned with.', 
                'image_id' => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '-shr00m-',
                'description' => '-shr00m- is a hotheaded beatmaker. His intense nature fuels both his music and vices: a gambling addiction that leads him to risky situations and a snus habit that offers fleeting solace. Despite his struggles, -shr00m- compositions pulse with raw energy, becoming the heartbeat of the gangs operations. Hes a complex character, teetering on the edge of self-destruction, his art reflecting the whirlwind of his passions and vices.',
                'image_id' => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=>'Erin',
                'description' => 'Erin, a member of Kill Gang, battled gambling addiction and alcoholism. Despite personal struggles, Erin managed the gangs crucial delivery service efficiently, becoming a linchpin in their operations. Additionally, Erin was a talented rapper, channeling their pain into raw and authentic lyrics. Their story exemplified resilience, showcasing how amidst personal chaos, individuals could excel professionally and creatively, leaving a lasting impact on those around them.',
                'image_id' => 4, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=>'Stefans Filips Podgaiskis',
                'description' => 'Stefans Filips Podgaiskis, a member of the infamous Kill Gang, a deeply complex individual whose life was a turbulent blend of addiction, creativity, and despair. His story was one marked by intense struggles, as he battled not only drug and gambling addictions but also the haunting specter of suicidal thoughts. Despite these inner demons, he emerged as a creative powerhouse, becoming the backbone of Kill Gangs content creation.',
                'image_id' => 5, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=>'Jonka',
                'description' => 'Jonka, a member of the infamous Kill Gang, a complex individual whose life was marked by a series of destructive habits. His story was one of addiction, both to gambling and alcohol, leading him down a perilous path. Despite the darkness that loomed over him, he was also known for his lighthearted and silly demeanor, earning him the nickname "silly goose" among his associates. His lyrical prowess, despite its absurd and playful nature, was undeniable, earning him a peculiar kind of respect among his peers.',
                'image_id' => 6, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=>'Cake Henrijs Apaļais',
                'description' => 'Cakes, a member of Kill Gang, led an unconventional life. Living in a basement on a farm, they found solace in online gaming, particularly League of Legends. Despite their gaming prowess, Cakes struggled with online school, facing challenges that led to academic setbacks. Their unique lifestyle reflected a blend of digital escapism and real-world struggles, making them a distinctive character within the gang.',
                'image_id' => 7, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}