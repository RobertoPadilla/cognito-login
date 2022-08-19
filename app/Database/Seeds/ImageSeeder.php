<?php

namespace App\Database\Seeds;

use App\Models\Image;
use CodeIgniter\Database\Seeder;

class ImageSeeder extends Seeder
{
    public function run()
    {
        $image = new Image();
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < rand(10, 100); $i++) {
            $image->save([
                'user_id' => rand(1, 10),
                'object_key' => $faker->imageUrl(),
            ]);
        }
    }
}
