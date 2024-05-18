<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Tenant;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = Tenant::all();

        $products = [
            ['name' => 'Kemeja', 'price_min' => 50000, 'price_max' => 200000],
            ['name' => 'Celana Jeans', 'price_min' => 100000, 'price_max' => 300000],
            ['name' => 'Sepatu Sneakers', 'price_min' => 150000, 'price_max' => 500000],
        ];

        foreach ($tenants as $tenant) {
            foreach ($products as $product) {
                $name = $product['name'];
                $price = rand($product['price_min'], $product['price_max']);
                $price = round($price, -3);
        
                Product::create([
                    'tenant_id' => $tenant->id,
                    'name' => $name,
                    'price' => $price,
                ]);
            }
        }
    }

    }