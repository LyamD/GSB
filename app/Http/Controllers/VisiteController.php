<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visite;

class VisiteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        # code...
    }

    public function show($id)
    {
            
    }

    public function create()
    {
        # code...
    }
}
