<?php

use Illuminate\Database\Seeder;

class ProductsCollectionSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();

        //Create random categories
        $categories = [];
        foreach (range(1,2) as $number){
            $categories[] = factory(\App\Models\Category::class)->create([
                'name' => $faker->word,
            ]);
        }

        //Create random products
        foreach (range(1,2) as $number){
            $newProduct = factory(\App\Models\Product::class)->create([
                'name' => $faker->word,
                'price' => $faker->randomNumber(3),
                'description' => $faker->text(200),
            ]);

            //Append product to random category
            $randCategoryKeys = always_array(array_rand($categories, rand(1, 3)));
            foreach ($randCategoryKeys as $randCategoryKey) {
                $categories[$randCategoryKey]->products()->save($newProduct);
            }
        }
    }
}