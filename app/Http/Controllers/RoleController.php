<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    public function changerRole(Request $request, $id)
    {
        $user = User::find($id);
        if ($user->hasRole($request->role)) {
            $user->removeRole($request->role);
        } else {
            $user->assignRole($request->role);
        }
        return redirect('home/utilisateurs');
    }

    public function genererMatricule(Request $request, $id)
    {
        DB::statement('call generer_matricule(?,?)', [$id, $request->dateEmbauche]);
        return redirect('home/utilisateurs');
    }
}
