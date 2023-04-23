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
        // Récupération des données a partir d'un fichier json
        $json = File::get("database/datas/products.json");
        $products = json_decode($json);

        // Insertion des produits
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
