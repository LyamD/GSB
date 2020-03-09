<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class VisiteurMedicauxController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() {

        $user = Auth::user();
        $regions = $user->dirige();
        return view('visites.responsable.listeVisiteursParRegions')->with('regions', $regions);
    }

    public function show($id)
    {

        $user = User::find($id);
        $visites = $user->visiteurMedicaux();

        return view("visites.listeParVisiteur");
    }
}
