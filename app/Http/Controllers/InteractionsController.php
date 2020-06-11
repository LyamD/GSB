<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interactions;

class InteractionsController extends Controller
{
    public function store(Request $request)
    {
        $int = new Interactions();

        $int['Produit_id'] = $request->input('Produit_id');
        $int['Produit_1_id'] = $request->input('Produit_1_id');
        $int['interaction'] = $request->input('interaction');

        $int->save();

        return back()->withInput();
    }

    public function update($id)
    {
        $int = Interactions::find($id);
        $int['Produit_id'] = $request->input('Produit_id');
        $int['Produit_1_id'] = $request->input('Produit_1_id');
        $int['interaction'] = $request->input('interaction');

        $int->save();

        return back()->withInput();
    }

    public function destroy($id)
    {
        $int = Interactions::find($id);

        $int->delete();

        return back();
    }
}
