<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('about', function () {
    $team = [
        ['name' => 'иванов', 'post' => 'директор'],
        ['name' => 'петров', 'post' => 'прогер']
    ];
    return view('about', ['team' => $team]);
});
*/

Route::get('about', [PageController::class, 'about']);
Route::get('team', [PageController::class, 'team']);

Route::resource('articles', ArticleController::class);
