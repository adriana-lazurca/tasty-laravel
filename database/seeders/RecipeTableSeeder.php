<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table();
        $recipes = getRecipes();

        foreach ($recipes as $recipe) {
            Recipe::create(array(
                'name' => $recipe->name,
                'image' => $recipe->image,
                'ingredients' => $recipe->ingredients,
                'instructions' => $recipe->instructions
            ));
        }
    }

    function getRecipes()
    {
        // get data from somewhere
        $recipesJson = file_get_contents(base_path("database/data/recipes.json"));
        $recipes = json_decode($recipesJson);

        return $recipes;
    }
}
