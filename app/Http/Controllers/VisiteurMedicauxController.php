<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisiteurMedicaux;
use App\Region;
use Illuminate\Support\Facades\Auth;

class VisiteurMedicauxController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() {

        $user = Auth::user();
        if ($user->hasRole('superAdmin')) {
            $regions = Region::all();
        } else {
            $regions = $user->dirige()->get();
        }
        
        return view('visites.visiteurs.listeVisiteursParRegions')->with('regions', $regions);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {

        $visiteur = VisiteurMedicaux::find($id);

        return view("visites.visiteurs.visiteur")->with('visiteur', $visiteur);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request,  $id)
    {
        $visiteur = VisiteurMedicaux::find($id);
        $visiteur->objectif = empty($request->input('objectif'))  ? $visiteur->objectif : $request->input('objectif');
        $visiteur->budget = empty($request->input('budget'))  ? $visiteur->budget : $request->input('budget');

        return back()->withInput();
    }
}
