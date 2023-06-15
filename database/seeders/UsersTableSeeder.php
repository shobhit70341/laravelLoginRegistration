<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 1500; $i++) {
            $profileImgPath = null;
            $image = $faker->image(public_path('storage/profile_images'), 400, 400, null, false);

            if ($image) {
                $profileImgPath = 'profile_images/' . basename($image);
            }

            $mobile = $faker->phoneNumber;
            $password = $mobile . '@123';

            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'mobile' => $mobile,
                'password' => Hash::make($password),
                'profile_img' => $profileImgPath,
            ]);
        }
    }
}
