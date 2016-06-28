<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Ingredient;
use App\Category;
use App\Level;
use App\User;
use App\Recipe;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UserTableSeeder');
        $this->call('IngredientTableSeeder');
        $this->call('CategoryTableSeeder');
        $this->call('LevelTableSeeder');
        $this->call('RecipeTableSeeder');
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
class LevelTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('levels')->delete();
        Level::create(array('name' => 'user'));
        Level::create(array('name' => 'admin'));
    }
}
class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'name' => 'fran',
            'email' => 'fran@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('12345678')
            )
        );
    }
}
class RecipeTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('recipes')->delete();
        Recipe::create(array(
            'name' => 'user',
            'description' => 'lala',
            'img' => 'url',
            'dificulty' => 1,
            'time' => '1 hora y media',
            'people' => '2 Personas',
            'user_id' => 1,
            'category_id' => 1
            )
        );
    }
}