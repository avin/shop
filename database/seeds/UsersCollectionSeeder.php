<?php

use Illuminate\Database\Seeder;

class UsersCollectionSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();

        //Create admin role
        $adminRole = factory(\App\Models\Role::class)->create([
            'name' => 'Administrator',
            'slug' => 'admin',
        ]);

        //Create admin user
        $adminUser = factory(\App\Models\User::class)->create([
            'login' => 'admin',
            'full_name' => 'John Doe',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);

        $adminRole->users()->save($adminUser);

        //Create random users
        foreach (range(1,10) as $number){
            factory(\App\Models\User::class)->create([
                'email' => $faker->unique()->email,
                'login' => $faker->unique()->word,
                'full_name' => $faker->unique()->name,
                'password' => Hash::make('secret')
            ]);
        }
    }
}