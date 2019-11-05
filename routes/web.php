<?php

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
//     return view('login');
// });

Auth::routes();

// Route::get('/', function() {
//     return view('home');
// });

// Route::view('/', 'auth/login');
// Route::view('/missao', 'missao');
Route::view('/criar', 'criar');
// Route::view('/home', 'home');

Route::get('/teste', 'UsuarioController@index');
Route::get('/usuarios/{usuario}', 'UsuarioController@show')->name('usuarios.show');
Route::get('/npcs/{npc}', 'NpcController@show')->name('npcs.show');
Route::get('/quests/{usuario}/{quest}', 'QuestController@show')->name('quests.show');
Route::get('/npcs/{npc}/{quest}', 'QuestController@showq')->name('quests.showq');
Route::delete('/npcs/{npc}/{quest}', 'QuestController@destroy');

// Route::view('/', 'login');
// Route::get('/usuario/login', 'Auth\UsuarioLoginController@showLoginForm')->name('usuario.login');
// Route::post('/usuario/login', 'Auth\UsuarioLoginController@login')->name('usuario.login.submit');

Route::get('/teste', function () {
     $quests = DB::select('select * from quest');
     return view('teste', ['quests' => $quests]);
});