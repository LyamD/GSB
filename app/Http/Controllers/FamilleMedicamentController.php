<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FamilleMed;

class FamilleMedicamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $familles = FamilleMed::all();

        return view('medicaments.listeFamille')->with('familles', $familles);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $famille = new FamilleMed();

        $famille['nomFamille'] = $request->input('nomFamille');
        $famille->save();

        return back()->withInput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $famille = FamilleMed::find($id);
        $famille->delete();
        return back()->withInput();
    }
}
