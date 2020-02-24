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

// ---- resources 'manuelle'

//Utilisateurs
Route::get('home/utilisateurs/{id}/changerRole', 'RoleController@changerRole')
    ->middleware(['permission:controler_region'])->name('utilisateurs.changerRole');

Route::get('home/utilisateurs',function()
{
    $users = App\User::all();
        return view('admin.listeUser')->with('users', $users);
})->middleware(['role:superAdmin'])->name('utilisateurs.liste');

//employées
Route::put('home/utilisateurs/genererMatricule/{id}', 'RoleController@genererMatricule')
    ->middleware(['role:superAdmin'])->name('utilisateurs.genererMatricule');

// Regions
Route::get('home/regions/liste', function()
{
    $regions = App\Region::all();
    return view('region.liste')->with('regions', $regions);
})->middleware(['permission:acceder_region'])->name('regions.liste');

Route::put('home/regions/employeeFinPassage/{id}/{idEmployee}', 'RegionController@employeeFinPassage')
    ->middleware(['permission:changer_employee_region'])->name('regions.employeeFinPassage');

Route::put('home/regions/employeeDebutPassage/{id}', 'RegionController@employeeDebutPassage')
->middleware(['permission:changer_employee_region'])->name('regions.employeeDebutPassage');

Route::delete('home/regions/employeeDeletePassage/{id}/{idEmployee}', 'RegionController@employeeDeletePassage')
    ->middleware(['permission:changer_employee_region'])->name('regions.employeeDeletePassage');

