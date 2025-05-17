<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')
            ->where('roles', 'student')
            ->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::transaction(function () use ($id) {

            $applicationIds = DB::table('application')
                ->where('user_id', $id)
                ->pluck('id');

                if($applicationIds->isNotEmpty()){

                    $equipmentIds = DB::table('application_details')
                    ->whereIn('application_id', $applicationIds)
                    ->pluck('equipment_id');

                    DB::table('equipment')
                    ->whereIn('id', $equipmentIds)
                    ->update(['status' => 'Tersedia']);

                    DB::table('application_details')
                    ->whereIn('application_id', $applicationIds)
                    ->delete();

                    DB::table('application')
                    ->whereIn('id', $applicationIds)
                    ->delete();
                }

            DB::table('users')->where('id', $id)->delete();
        });

        return redirect()->route('user.index')->with('success', 'Pengguna dan semua permohonannya telah dipadam.');
    }
}
