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
        
        return view('visiteurs.listeParRegions')->with('regions', $regions);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {

        
    }

    public function edit($id)
    {
        $visiteur = VisiteurMedicaux::find($id);

        return view("visiteurs.edit")->with('visiteur', $visiteur);
    }

    public function update(Request $request,  $id)
    {
        $visiteur = VisiteurMedicaux::find($id);
        $visiteur['objectif'] = $request->input('objectif');
        $visiteur['avantages'] = $request->input('avantages');
        $visiteur['prime'] = $request->input('prime');
        //$visiteur['budget'] = empty($request->input('budget'))  ? $visiteur['budget'] : $request->input('budget');

        $visiteur->save();
        
        return redirect('home/utilisateurs/visiteur');
    }

    public function updateBudget(Request $request, $id)
    {
        $visiteur = VisiteurMedicaux::find($id);
        $regID = $visiteur->getRegionActuelle();

        $region = Region::find($regID);

        $newBudgetRegion = ($region['budgetGlobalAnnuel'] - $request->budget);

        if ($newBudgetRegion >= 0) {
            $region['budgetGlobalAnnuel'] = $newBudgetRegion;
            $region->save();
            $visiteur['budget'] += $request->budget;
            $visiteur->save();

        } else {
            
        }

        return back()->withInput();

    }
}
