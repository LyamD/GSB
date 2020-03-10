<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\VisiteurMedicaux;
use App\Responsables;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    public function changerRole(Request $request, $id)
    {
        $user = User::find($id);
        if ($user->hasRole($request->role)) {
            $user->removeRole($request->role);
        } else {
            $this->assignerRole($request->role, $id);
        }
        return redirect('home/utilisateurs');
    }

    public function genererMatricule(Request $request, $id)
    {
        DB::statement('call generer_matricule(?,?)', [$id, $request->dateEmbauche]);
        return redirect('home/utilisateurs');
    }

    private function assignerRole($role, $id)
    {
        $user = User::find($id);
        switch ($role) {
            case 'visiteurMedicaux':
                $user->assignRole($role);
                $visiteurMedicaux = VisiteurMedicaux::firstOrCreate(['id' => $id]);
                $visiteurMedicaux->id = $id;

                $visiteurMedicaux->objectif = "Non défini";
                $visiteurMedicaux->prime = 0;
                $visiteurMedicaux->avantages = "Aucun";
                $visiteurMedicaux->budget = 0;

                $visiteurMedicaux->save();
                break;
            
            case 'responsable' :
                $user->assignRole($role);
                $responsable = Responsables::firstOrCreate(['id' => $id]);
                $responsable->id = $id;
                $responsable->save();
                break;

            default:
                $user->assignRole($role);
                break;
        }
    }
}
