<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    
    {
        $equipment = DB::table('equipment')
        ->whereIn('status',(['Tersedia','Sudah Dibaiki', 'Sudah Diganti']))
        ->count();

        $application = DB::table('application')
            ->where('status', 'Diproses')
            ->count();

        $user = DB::table('users')
            ->count();

        return view('admin.dashboard', compact('equipment', 'application', 'user'));
    }
}
