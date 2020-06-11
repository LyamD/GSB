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

// ----- resources

//RegionController
Route::resource('home/regions', 'RegionController')->only(
    ['index', 'store', 'update', 'destroy']
);


//VisiteurMedicauxController
Route::resource('home/utilisateurs/visiteur', 'VisiteurMedicauxController')->only(
    ['show']
)->middleware(['permission:gerer_visite']);

Route::resource('home/utilisateurs/visiteur', 'VisiteurMedicauxController')->only(
    ['index', 'update', 'edit']
)->middleware(['permission:gerer_visiteur']);


//SpecialitesController
Route::resource('home/practiciens/specialites', 'SpecialitesController')->only(
    ['index', 'store', 'update', 'destroy']
)->middleware(['permission:gerer_specialites']);


//MedicamentsController
Route::resource('home/medicaments', 'MedicamentsController')->only(
    ['index', 'show', 'create', 'edit', 'store', 'update', 'destroy']
)->middleware(['permission:gerer_medicaments']);

Route::resource('home/interactions', 'InteractionsController')->only([
    'store', 'update', 'destroy'
])->middleware(['permission:gerer_medicaments']);

Route::resource('home/famille', 'FamilleMedicamentController')->only(
    ['index', 'show', 'edit', 'store', 'update', 'destroy']
)->middleware(['permission:gerer_medicaments']);

//VisiteController
Route::resource('home/visite', 'VisiteController')->only(
    ['index', 'show', 'create', 'edit', 'store', 'update', 'destroy']
)->middleware(['permission:gerer_visite']);
// ---- resources 'manuelle'


//Utilisateurs
Route::get('home/utilisateurs/{id}/changerRole', 'RoleController@changerRole')
    ->middleware(['permission:controler_region'])->name('utilisateurs.changerRole');

Route::get('home/utilisateurs',function()
{
    $users = App\User::all();
        return view('admin.listeUser')->with('users', $users);
})->middleware(['permission:gerer_utilisateurs'])->name('utilisateurs.liste');


//employées
Route::put('home/utilisateurs/genererMatricule/{id}', 'RoleController@genererMatricule')
    ->middleware(['permission:gerer_utilisateurs'])->name('utilisateurs.genererMatricule');


//Visiteurs Medicaux
Route::post('home/utilisateurs/visite/updateBudget/{id}', 'VisiteurMedicauxController@updateBudget')
    ->middleware(['permission:gerer_visiteur'])->name('visiteur.updateBudget');


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

