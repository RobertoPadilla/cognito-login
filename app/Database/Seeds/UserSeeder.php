<?php

namespace App\Database\Seeds;

use App\Models\User;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new User();
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $user->save([
                'nickname' => $faker->userName(),
                'email' => $faker->safeEmail(),
                'password' => password_hash('password', PASSWORD_DEFAULT),
            ]);
        }

        # Runnning the ImageSeeder
        $this->call(ImageSeeder::class);
    }
}
