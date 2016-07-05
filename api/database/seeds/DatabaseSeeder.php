<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Ingredient;
use App\Category;
use App\Level;
use App\User;
use App\Recipe;
use App\Step;

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
        $this->call('StepTableSeeder');
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
        Ingredient::create(array('name' => 'Papa'));
        Ingredient::create(array('name' => 'Batata'));
        Ingredient::create(array('name' => 'Cebolla'));
        Ingredient::create(array('name' => 'Tomate'));
        Ingredient::create(array('name' => 'Lechuga'));
        Ingredient::create(array('name' => 'Aceite'));
        Ingredient::create(array('name' => 'Sal'));
    }
}
class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->delete();
        Category::create(array('name' => 'Carnes'));
        Category::create(array('name' => 'Pastas'));
        Category::create(array('name' => 'Tartas'));
        Category::create(array('name' => 'Pescados'));
        Category::create(array('name' => 'Sopas'));
        Category::create(array('name' => 'Postres'));
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
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => \Illuminate\Support\Facades\Hash::make('1234'),
            'level_id' => 1
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
            'name' => 'Lomo al horno en salsa de queso',
            'description' => 'Descripción: Esta receta fue diseñada especialmente para las personas amantes de la de carne de res. Se trata de un plato de lomo de res en salsa de queso, ideal, también, para todos los que adoramos el queso. Se dice que la carne de vaca es una proteína de alta calidad, puesto que aporta diversos minerales y vitaminas esenciales para conservar la salud del organismo, como hierro, zinc y vitamina B12. Aún así, se recomienda moderar su consumo y servir alrededor de los 120 gramos por porción.',
            'img' => 'test.jpg',
            'dificulty' => 'Dificultad baja',
            'time' => '1 hora y media',
            'people' => '2 Personas',
            'cost' => 'Precio alto',
            'user_id' => 1,
            'category_id' => 1
            )
        );
    }
}
class StepTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('steps')->delete();
        Step::create(array(
            'description' => 'Lleva una sartén a fuego medio con un poco de aceite. Cuando esté caliente, coloca la pieza de lomo con un poco de sal y pimienta. Sella la carne para que se forme una costra por fuera y quede jugosa por dentro al momento de hornearla.',
            'recipe_id' => 1
        ));
        Step::create(array(
            'description' => 'Lleva el lomo de res sellado a una refractaria y precalienta el horno a 200ºC. Debes tener en cuenta que la cocción de la carne dependerá del punto que quieras que tenga. Mi lomo pesaba un kilo y medio, así que lo dejé en el horno durante unos 35-40 minutos aproximadamente. Así pues, hornea el lomo de res y ve vigilando para no pasarte de término de cocción.',
            'recipe_id' => 1
        ));
        Step::create(array(
            'description' => 'Mientras tienes el lomo de res en el horno puedes ir preparando la salsa de queso. Para ello, en un tazón hondo añade el queso crema con la crema de leche, bate con la ayuda de un batidor de mano hasta que se mezclen los dos ingredientes. Si lo deseas, puedes consultar esta receta de salsa de queso holandés un tanto diferente pero igual de deliciosa.',
            'recipe_id' => 1
        ));
        Step::create(array(
            'description' => 'Adiciona el vino blanco, el caldo de res, el tomillo y la cebolla de verdeo finamente picada. Vuelve a mezclar hasta que se integren los ingredientes. Si deseas, puedes añadir o reemplazar cualquier ingrediente por otro que sea de tu preferencia.',
            'recipe_id' => 1
        ));
    }
}