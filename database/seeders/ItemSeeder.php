<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use Faker\Factory as Faker;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Adjust the number of items to seed
        $numberOfItems = 20;

        for ($i = 0; $i < $numberOfItems; $i++) {
            Item::create([
                'picture' => $faker->imageUrl(400, 300, 'cats'), // Generate random image URLs
                'name' => $faker->word,
                'price' => $faker->randomFloat(2, 10, 100),
                'category' => $faker->randomElement(['Category 1', 'Category 2', 'Category 3']),
                // Add more columns if necessary
            ]);
        }
    }
}

