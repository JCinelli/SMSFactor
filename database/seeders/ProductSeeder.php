<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/datas/products.json");
        $products = json_decode($json);

        foreach ($products as $key => $value) {
            Product::create([
                "image" => $value->image,
                "name" => $value->name,
                "description" => $value->description,
                "price" => $value->price
            ]);
        }
    }
}
