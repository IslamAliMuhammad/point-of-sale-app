<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // Create Categories
        $categoriesAr = ['مستلزمات رياضية', 'الكمبيوتر', 'العاب', 'الكترونيات', 'المنزل والكتب', 'موبايلات وتابلت', 'منتجات العناية بالطفل', 'الصحة والجمال', 'ازياء', 'بقالة'];
        $categoriesEn = ['Supermarket', 'Fashion', 'Health & Beauty', 'Baby Products', 'Phone & Tablets', 'Home & Office', 'Electronics', 'Gaming','Computers', 'Sporting Goods'];

        foreach($categoriesAr as $index => $categoryAr) {
            $category = Category::create([
                'ar' => [
                    'name' => $categoryAr
                ],
                'en' => [
                    'name' => $categoriesEn[$index]
                ]
            ]);
        }

        $categories = Category::all();

        // Create products for categories
        foreach($categories as $category) {
            Product::factory()->count(random_int(1, 20))->create([
                'category_id' => $category->id,
            ]);
        }

        // Create users
        $users = User::factory()->count(100)->create();

        //Create clients
        $clients = Client::factory()->count(100)->create();



    }
}
