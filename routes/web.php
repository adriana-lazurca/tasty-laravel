<?php

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Route;


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
    $posts = Post::all();

    return view('posts', ["posts" => $posts]);
});

//this approach works with other than ID(ex. slug)
Route::get('posts/{post:slug}', function (Post $post) { //give me the Post where ('slug', $post)->first(); 
    return view('post', ['post' => $post]);
});

//this approach works with ID
// Route::get('posts/{post}', function (Post $post) {
//     return view('post', ['post' => $post]);
// });

//classic approach
// Route::get('posts/{id}', function (string $id) {
//     $post = Post::findOrFail($id);

//     return view('post', ['post' => $post]);
// });

Route::get('categories/{category:slug}', function (Category $category) {
    $posts = Post::all();

    return view('posts', ["posts" => $category->posts]);

});
