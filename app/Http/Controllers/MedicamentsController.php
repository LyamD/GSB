<?php

namespace App\Http\Controllers;

use App\Medicaments;
use App\FamilleMed;
use Illuminate\Http\Request;

class MedicamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicaments = Medicaments::all();

        return view('medicaments.liste')->with('medicaments', $medicaments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medicaments  $medicaments
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $med = Medicaments::find($id);

        return view('medicaments.show')->with('medicament', $med);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicaments  $medicaments
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicaments $medicaments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicaments  $medicaments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicaments $medicaments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicaments  $medicaments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $med = Medicaments::find($id);
        $med->delete();

        return back();
    }

    public function ajouterInteraction(Request $request, $id)
    {
        # code...
    }
}
