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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//resources
Route::resource('home/regions', 'RegionController')->only(
    ['index', 'store', 'update', 'destroy']
);

//resources 'manuelle'
Route::get('home/utilisateurs/{id}/changerRole', 'RoleController')->middleware(['permission:controler_region'])->name('utilisateurs.changerRole');

Route::get('home/utilisateurs',function()
{
    $users = App\User::all();
        return view('admin.listeUser')->with('users', $users);
})->middleware(['role:superAdmin'])->name('utilisateurs.liste');