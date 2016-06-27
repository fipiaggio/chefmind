<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Ingredient;
use App\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('users')->insert([
            'name' => 'fran',
            'email' => 'fran@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('12345678')
        ]);*/
        $this->call('IngredientTableSeeder');
    }
}
class IngredientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredients')->delete();
        Ingredient::create(array('name' => 'papa'));
        Ingredient::create(array('name' => 'batata'));
        Ingredient::create(array('name' => 'cebolla'));
        Ingredient::create(array('name' => 'tomate'));
        Ingredient::create(array('name' => 'lechuga'));
        Ingredient::create(array('name' => 'aceite'));
        Ingredient::create(array('name' => 'sal'));
    }
}
class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->delete();
        Category::create(array('name' => 'desayuno'));
        Category::create(array('name' => 'almuerzo'));
        Category::create(array('name' => 'plato caliente'));
        Category::create(array('name' => 'plato frio'));
        Category::create(array('name' => 'cena'));
        Category::create(array('name' => 'postre'));
        Category::create(array('name' => 'sopa'));
    }
}