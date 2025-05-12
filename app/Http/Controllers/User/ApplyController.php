<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplyController extends Controller
{
    public function index(){


    }

    public function create()
    {
        $types = DB::table('equipment')->select('type')->distinct()->get();

        return view('user.application.create', compact('types'));
    }

    public function store(){
        
    }

    
}
