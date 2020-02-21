<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RoleController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $user = User::find($id);
        if ($user->hasRole($request->role)) {
            $user->removeRole($request->role);
        } else {
            $user->assignRole($request->role);
        }
        return redirect('home/utilisateurs');
    }
}
