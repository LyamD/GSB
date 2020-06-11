<?php

namespace App\Http\Controllers;

use App\Medicaments;
use App\FamilleMed;
use App\Interactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MedicamentsController extends Controller
{

    public function update(Request $request, $id)
    {

        $medicament = Medicaments::find($id);
        Log::debug('requested medoc : ' . $medicament);
        Log::debug('request : ' . $request);

        $medicament['nomCommercial'] = $request->input('nomCommercial');
        $medicament['effets'] = $request->input('effets');
        $medicament['contreIndications'] = $request->input('contreIndications');
        $medicament['prixEchantillon'] = $request->input('prixEchantillon');
        $medicament['familleMedicament_id'] = $request->input('familleID');

        Log::debug('medoc avant save : ' . $medicament);

        $medicament->save();

        return redirect('home');
    }
    
    public function index()
    {
        $medicaments = Medicaments::all();

        return view('medicaments.liste')->with('medicaments', $medicaments);
    }

    
    public function create()
    {
        $familles = FamilleMed::all();
        return view('medicaments.create')->with('familles', $familles);
    }

    public function store(Request $request)
    {
        $medicament = new Medicaments();

        $medicament['numeroProduit'] = $request->input('numeroProduit');
        $medicament['nomCommercial'] = $request->input('nomCommercial');
        $medicament['effets'] = $request->input('effets');
        $medicament['contreIndications'] = $request->input('contreIndications');
        $medicament['prixEchantillon'] = $request->input('prixEchantillon');
        $medicament['familleMedicament_id'] = $request->input('familleID');

        $medicament->save();

        return redirect('home/medicaments');
    }

    
    public function show($id)
    {
        $med = Medicaments::find($id);
        $interactions = Interactions::where('Produit_id', $med['id'])
                                            ->orWhere('Produit_1_id', $med['id'])
                                            ->get();

        return view('medicaments.show')->with('medicament', $med)->with('interactions', $interactions);
    }

    
    public function edit($id)
    {
        $med = Medicaments::find($id);
        $medliste = Medicaments::all();
        $familles = FamilleMed::all();
        $interactions = Interactions::where('Produit_id', $med['id'])
                                            ->orWhere('Produit_1_id', $med['id'])
                                            ->get();

        return view('medicaments.edit')->with('medicament', $med)->with('familles', $familles)->with('interactions', $interactions)->with('medliste', $medliste);
    }

    
    public function destroy($id)
    {
        $med = Medicaments::find($id);
        $med->delete();

        return back();
    }
}
