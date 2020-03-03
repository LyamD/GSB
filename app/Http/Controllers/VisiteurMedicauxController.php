<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class VisiteurMedicauxController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:visiteurMedicaux']);
    }

    public function show($id)
    {
        $user = User::find($id);
        $visites = $user->visiteurMedicaux();

        return view("visites.listeParVisiteur");
    }
}
