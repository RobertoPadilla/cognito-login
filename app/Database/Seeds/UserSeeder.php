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
            $nickname = $faker->userName();
            $user->save([
                'nickname' => $nickname,
                'email' => $faker->safeEmail(),
                'password' => password_hash('password', PASSWORD_DEFAULT),
            ]);

            $aws = new \App\Controllers\AWSController();
            $aws->registrate($nickname, 'password');
        }

        # Runnning the ImageSeeder
        $this->call(ImageSeeder::class);
    }
}
