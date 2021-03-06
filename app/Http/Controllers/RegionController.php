<?php

namespace App\Http\Controllers;

use App\Region;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if ($this->middleware(['controler_region'])) {
            $regions = Region::all();
            return view('region.listeStructure')->with('regions', $regions);
        } else {
            abort(403, "Permission refusée");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $region = new Region;
        $region->nomRegion = $request->input('nomRegion');

        $region->save();
        
        return redirect('home/regions');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $region->nomRegion = empty($request->input('nomRegion'))  ? $region->nomRegion : $request->input('nomRegion');
        $region->budgetGlobalAnnuel = empty($request->input('budgetGlobalAnnuel'))  ? $region->budgetGlobalAnnuel : $request->input('budgetGlobalAnnuel');

        if (!empty($request->utilisateurs_id)) {
            $user = User::find($request->utilisateurs_id);
            $region->responsable()->associate($user);
        }

        $region->save();

        //return redirect('home/regions/liste');
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        //
    }

    public function employeeFinPassage(Request $request, $id, $idEmployee)
    {
        $region = Region::find($id);
        $region->employee()->updateExistingPivot($idEmployee, ['dateFin' => $request->dateFin]);
        //return redirect('home/regions/liste');
        return back()->withInput();
    }

    public function employeeDebutPassage(Request $request, $id)
    {
        $region = Region::find($id);
        $region->employee()->attach($request->user_id, ['dateDebut' => $request->dateDebut]);
        //return redirect('home/regions/liste');
        return back()->withInput();
    }

    public function employeeDeletePassage($id, $idEmployee)
    {
        $region = Region::find($id);
        $region->employee()->detach($idEmployee);
        //return redirect('home/regions/liste');
        return back()->withInput();
    }
}
