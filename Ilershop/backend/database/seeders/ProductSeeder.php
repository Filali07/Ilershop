// backend/database/seeders/ProductSeeder.php
<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Electrónica
            [
                'name' => 'iPhone 13 Pro',
                'description' => 'Pantalla Super Retina XDR de 6.1", 128GB',
                'price' => 999.99,
                'stock' => 50,
                'image' => 'products/iphone13.jpg',
                'category_id' => 1,
            ],
            [
                'name' => 'Samsung Galaxy S22',
                'description' => 'AMOLED de 6.8", 256GB, 8GB RAM',
                'price' => 899.99,
                'stock' => 30,
                'image' => 'products/galaxy_s22.jpg',
                'category_id' => 1,
            ],
            // Moda
            [
                'name' => 'Zapatillas Nike Air Max',
                'description' => 'Tallas 38-45, color blanco/negro',
                'price' => 129.99,
                'stock' => 100,
                'image' => 'products/nike_airmax.jpg',
                'category_id' => 2,
            ],
            // ... (17 productos más)
        ];

        Product::insert($products);
    }
}