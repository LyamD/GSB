<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visite;
use App\User;

class VisiteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $visites = Visite::all();

        return view('visite.liste')->with('visites', $visites);
    }

    public function show($id)
    {
        $visite = Visite::find($id);

        return view('visite.show')->with('visite', $visite);
    }

    public function create()
    {
        $practiciens = User::role('practicien')->get();
        $visiteurs = User::role('visiteurMedicaux')->get();

        return view('visite.create')->with('practiciens', $practiciens)->with('visiteurs', $visiteurs);
    }

    public function store(Request $request)
    {
        $visite = new Visite();

        $visite->motif = $request->input('motif');
        $visite->bilan = $request->input('bilan');
        $visite->dateMission = $request->input('dateMission');
        $visite->visiteurMedicaux_id = $request->input('visiteurMedicaux_id');
        $visite->utilisateurs_id = $request->input('utilisateurs_id');

        $visite->save();
        return redirect('home/visite');
    }
}
