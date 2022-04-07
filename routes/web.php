<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('welcome');
});
//ruta principal para posts
Route::get('/', [App\Http\Controllers\PageController::class, 'posts']);
//ruta para un solo post- le ponemos slug para q nos traiga el link con el nombre del post y no con un id
Route::get('blog/{post:slug}', [App\Http\Controllers\PageController::class, 'post'])->name('post');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ruta resource para la parte privada
//middleware dara seguridad de authentificacion y except traera todos los metodos de post excepto show
//ya que show mostrara a cualquiera y sera publico en este caso esto solo se mostrara a los usuarios y no a los invitados(@ghest)
Route::resource('/posts', App\Http\Controllers\Backend\PostController::class)->middleware('auth')->except('show');
