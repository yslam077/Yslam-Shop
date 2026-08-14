<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name'     => 'Admin',
            'email'    => 'yslam_shop_admin@gmail.com',
            'password' => bcrypt('12345678'),
            'is_admin' => true,
        ]);

        $cat1 = Category::create([
            'name_tk' => 'Saglyk we Gözellik',
            'name_ru' => 'Здоровье и Красота',
            'name_en' => 'Health & Beauty',
            'slug'    => 'saglyk-we-gozelik',
        ]);

        $cat2 = Category::create([
            'name_tk' => 'Çagalar üçin',
            'name_ru' => 'Для детей',
            'name_en' => 'For Kids',
            'slug'    => 'cagalar-ucin',
        ]);

        $cat3 = Category::create([
            'name_tk' => 'Öý hojalyk',
            'name_ru' => 'Товары для дома',
            'name_en' => 'Home Goods',
            'slug'    => 'oy-hojalyk',
        ]);

        $cat4 = Category::create([
            'name_tk' => 'Sport',
            'name_ru' => 'Спорт',
            'name_en' => 'Sports',
            'slug'    => 'sport',
        ]);

        Product::create([
            'category_id' => $cat1->id,
            'name'        => 'Dyzlyk',
            'description' => 'Dyz agyra we basga agyrlara garsy',
            'price'       => 70,
            'image'       => 'img/dyzlyk.png'
        ]);

        Product::create([
            'category_id' => $cat1->id,
            'name'        => 'Dyzlyk licebny',
            'description' => 'Dyz agyra we basga agyrlara garsy',
            'price'       => 120,
            'image'       => 'img/dyzlyk.png'
        ]);

        Product::create([
            'category_id' => $cat1->id,
            'name'        => 'Dyzlyk otly',
            'description' => 'Dyz agyra we basga agyrlara garsy',
            'price'       => 50,
            'image'       => 'img/dyzlyk.png'
        ]);

        Product::create([
            'category_id' => $cat1->id,
            'name'        => 'Dyzlyk agyra garsy',
            'description' => 'Dyz agyra we basga agyrlara garsy',
            'price'       => 150,
            'image'       => 'img/dyzlyk.png'
        ]);
    }
}