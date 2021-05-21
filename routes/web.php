<?php

use App\Models\Post;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\RecipesController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/posts');
});

Route::get('/posts', function () {
    $posts = Post::all();

    return view('posts', ["posts" => $posts]);
});

//this approach works with other than ID(ex. slug)
// Route::get('posts/{post:slug}', function (Post $post) { //give me the Post where ('slug', $post)->first(); 
//     return view('post', ['post' => $post]);
// });

//this approach works with ID
// Route::get('posts/{post}', function (Post $post) {
//     return view('post', ['post' => $post]);
// });

//classic approach
Route::get('posts/{id}', function (string $id) {
    $post = Post::findOrFail($id);
    return view('post', ['post' => $post]);
});

Route::get('categories/{category:slug}', function (Category $category) {
    $posts = Post::all();

    return view('posts', ["posts" => $category->posts]);
});

//return api for backend(from the file)
Route::get('api/v1/recipes', function () {
    $recipes = getRecipes();

    return response()->json($recipes, 200, [], JSON_PRETTY_PRINT);
});

//return api for frontend(from the DB)
Route::get('api/v2/recipes', function () {
    $recipes = Recipe::all();
    return response()->json($recipes, 200, ["nume" => "pui"], JSON_PRETTY_PRINT);
});

function getRecipes()
{
    // get data from a file
    $recipesJson = file_get_contents(base_path("database/data/recipes.json"));
    $recipes = json_decode($recipesJson);

    return $recipes;
}

Route::post('api/recipes', function (Post ...$posts) {
    return response("Created recipes", 200);
});
