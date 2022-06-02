<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        for ($i = 0; $i < 13; $i++) {
            $product = new Product();
            $product->name =  Str::random(10);
            $product->category_id = rand(1, 6);
            $product->brand_id = rand(3, 16);
            $product->quantity = rand(5, 50);
            $product->price = rand(10, 500);
            $product->tags = Str::random(5);
            $product->description = Str::random((700));
            $product->product_image = "images/products/" . $i + 1 . ".jpg";
            $product->review = rand(0,100);
            $product->rating = rand(1,5);
            $product->save();
        }
    }
}
