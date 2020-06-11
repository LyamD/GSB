<?php

use Illuminate\Http\Request;
use App\Visite;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'api\LoginController@Login');


Route::get("visitesBase", function () {
    return Visite::all();
});

Route::middleware('auth:api')->get("visites", function ()
{
    return DB::table('visiteapi')->get();
});

/* Route::get("visites", function () {
    return DB::table('visiteapi')->get();
}); */

Route::post("visites/new", function (Request $request) {
    $visite = new Visite();
    $visite->dateMission = $request->dateMission;
    $visite->motif = $request->motif;
    $visite->visiteurMedicaux_id = $request->visiteur_nom;
    $visite->utilisateurs_id = $request->utilisateurs_nom;
    $visite->save();

    $visite->utilisateurs_nom = $visite->utilisateurs_id;
    $visite->visiteur_nom = $visite->utilisateurs_id;
    return $visite;
});