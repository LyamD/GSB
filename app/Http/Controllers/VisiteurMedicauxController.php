<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
//use Illuminate\Support\Facades\Auth;

class VisiteurMedicauxController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() {

        $visiteurs = User::role('visiteurMedicaux')->get();
        return view('visites.responsable.listeVisiteurs')->with('visiteurs', $visiteurs);
    }

    public function show($id)
    {

        $user = User::find($id);
        $visites = $user->visiteurMedicaux();

        return view("visites.listeParVisiteur");
    }
}
