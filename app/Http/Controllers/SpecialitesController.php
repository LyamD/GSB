<?php

namespace App\Http\Controllers;

use App\Specialites;
use Illuminate\Http\Request;
use App\User;

class SpecialitesController extends Controller
{
    

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $specialites = Specialites::all();
        return view('specialites.liste')->with('specialites', $specialites);
    }


    public function store(Request $request)
    {
        $specialites = new Specialites();
        $specialites->nomSpecialite = $request->nomSpecialite;
        $specialites->save();
    }

    
    public function update(Request $request, Specialites $specialites)
    {
        $specialites->nomSpecialite = $request->nomSpecialite;
        $specialites->save();
    }

    public function destroy(Specialites $specialites)
    {
        $specialites->destroy();
    }
}
