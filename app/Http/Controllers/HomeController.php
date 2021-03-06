<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // $superAdmin = Role::create(['name' => 'superAdmin']);
        // $employe = Role::create(['name' => 'employe']);
        // $responsable = Role::create(['name' => 'responsable']);
        // $indefini = Role::create(['name' => 'indefini']);
        // $visiteurMedicaux = Role::create(['name' => 'visiteurMedicaux']);
        // $practicien = Role::create(['name' => 'practicien']);

        // $perm1 = Permission::create(['name' => 'acceder_region']);
        // $perm2 = Permission::create(['name' => 'changer_budget_region']);
        // $perm3 = Permission::create(['name' => 'changer_budget_region_all']);
        // $perm4 = Permission::create(['name' => 'controler_region']);
        // $perm5 = Permission::create(['name' => 'changer_employee_region']);
        // $perm6 = Permission::create(['name' => 'gerer_visite']);
        // $perm7 = Permission::create(['name' => 'gerer_visiteur']);
        // $perm8 = Permission::create(['name' => 'gerer_utilisateurs']);
        // $perm9 = Permission::create(['name' => 'gerer_specialites']);
        // $perm10 = Permission::create(['name' => 'attribuer_specialites']);
        // $perm11 = Permission::create(['name' => 'gerer_medicaments']);

        // $superAdmin = Role::findByName('superAdmin');
        // $responsable = Role::findByName('responsable');
        
        // $superAdmin->syncPermissions(Permission::all()->pluck('name'));
        // $employe->givePermissionTo($perm1);
        // $responsable->syncPermissions([$perm1, $perm2, $perm7, $perm5, $perm9, $perm10, $perm11]);
        // $visiteurMedicaux->givePermissionTo($perm6);

        // $user = Auth::user();
        // $user->assignRole($superAdmin);

        return view('home');
    }
}
