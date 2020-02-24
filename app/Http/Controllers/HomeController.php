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
        // $respRegion = Role::create(['name' => 'respRegion']);
        // $indefini = Role::create(['name' => 'indefini']);

        // $perm1 = Permission::create(['name' => 'acceder_region']);
        // $perm2 = Permission::create(['name' => 'changer_budget_region']);
        // $perm3 = Permission::create(['name' => 'changer_budget_region_all']);
        // $perm4 = Permission::create(['name' => 'controler-region']);
        // $perm5 = Permission::create(['name' => 'changer_employee_region']);

        // $superAdmin->syncPermissions(Permission::all()->pluck('name'));
        // $employe->givePermissionTo($perm1);
        // $respRegion->syncPermissions([$perm1, $perm2]);

        // $user = Auth::user();
        // $user->assignRole($superAdmin);

        return view('home');
    }
}
