<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for ($i=1; $i<=10; $i++) {
        //     \App\Models\Product::create([
        //         'product_name' => 'Product' . $i,
        //         'product_img' => 'img/product' . $i . '.png',
        //         'price' => rand(1, 10000)
        //     ]);
        // }

        for ($i=1; $i<=10; $i++) {
            \App\Models\Product::create([
                'product_name' => '商品' . $i,
                'product_img' => 'img/product' . $i . '.png',
                'price' => rand(1, 10000)
            ]);
        }
    }
}
