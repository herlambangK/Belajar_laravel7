<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', function () {
//     $name = "<h1>bembie </h1>";
//     $post = "fjlahfkjadbkfja 
//     jadhfkafl 
//     hjnflafnl";

//     return view('welcome', ['name' => $name], ['posts' => $post]);
// });

// Route::get('/series/create', function () {
//     return view('series.create');
// });

// Route::get('/', 'HomeController'); 
Route::get('posts/', 'PostController@index')->name('posts.index');


Route::prefix('posts')->middleware('auth')->group(function(){
    
    Route::get('create', 'PostController@create')->name('posts.create');
    Route::post('store', 'PostController@store');
    
    Route::get('{post:slug:}/edit', 'PostController@edit');
    Route::patch('{post:slug}/edit', 'PostController@update');
    
    Route::delete('{post:slug}/delete', 'PostController@destroy');

    
});

Route::get('posts/{post:slug}', 'PostController@show');


Route::get('categories/{category:slug}', 'CategoryController@show');


 Route::get('tags/{tag:slug}', 'TagController@show');




// Route::get('contact', function (Request $request) {
//     // request()->fullUrl()
//     return $request->is('contact')  ? true : false;
// });

// Route::get('about', function (Request $request) {
//     return $request->fullUrl();
// });

Route::view('contact', 'contact');
Route::view('about', 'about');
Route::view('login', 'login');
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');