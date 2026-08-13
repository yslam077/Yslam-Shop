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
            'name' => 'Admin',
            'email' => 'yslam_shop_admin@gmail.com',
            'password'=>bcrypt('12345678'),
            'is_admin'=>true,
        ]);
        $cat1=Category::create(['name'=>'Saglyk we Gözelik','slug'=>'saglyk-we-gozelik']);
        $cat2=Category::create(['name'=>'Çagalar üçin','slug'=>'cagalar-ucin']);
        $cat3=Category::create(['name'=>'Öý hojalyk','slug'=>'oy-hojalyk']);
        $cat4=Category::create(['name'=>'Sport','slug'=>'sport']);

        Product::create([
            'category_id'=>$cat1->id,
            'name'=>'Dyzlyk',
            'description'=>'Dyz agyra we basga agyrlara garsy',
            'price'=>70,
            'image'=>'img/dyzlyk.png'
        ]);
        Product::create([
            'category_id'=>$cat1->id,
            'name'=>'Dyzlyk licebny',
            'description'=>'Dyz agyra we basga agyrlara garsy',
            'price'=>120000,
            'image'=>'img/dyzlyk.png'
        ]);
        Product::create([
            'category_id'=>$cat1->id,
            'name'=>'Dyzlyk otly',
            'description'=>'Dyz agyra we basga agyrlara garsy',
            'price'=>50,
            'image'=>'img/dyzlyk.png'
        ]);
        Product::create([
            'category_id'=>$cat1->id,
            'name'=>'Dyzlyk agyra garsy',
            'description'=>'Dyz agyra we basga agyrlara garsy',
            'price'=>150,
            'image'=>'img/dyzlyk.png'
        ]);
    }
}
