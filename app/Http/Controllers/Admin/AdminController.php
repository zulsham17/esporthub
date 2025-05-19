<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin  = DB::taBLE('users')->where('roles', 'admin')
        ->get();

        return view('admin.admins.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'sector' => 'required',
            'staff_id' => 'required',
            'phone_no' => 'required|numeric',

        ]);

        $defaultPW = 'abcd1234';
        DB::table('users')->insert([
            'matric_no' => $request->staff_id,
            'fullname' => strtoupper($request->name),
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'password' => Hash::make($defaultPW),
            'roles' => 'admin',
            'created_at' => now(),
        ]);

        return redirect()->route('settings-admin.index')->with('success', 'Admin berjaya daftar.');
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
        $admin = DB::table('users')->where('id', $id)->where('roles', 'admin')->first();
        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'staff_id' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sector' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone_no' => 'required|string|max:20',
        ]);

        // Update the user in the users table
        DB::table('users')
            ->where('id', $id)
            ->update([
                'matric_no' => $request->staff_id,
                'email' => $request->email,
                'sector' => $request->sector,
                'fullname' => $request->name,
                'phone_no' => $request->phone_no,
            ]);

        return redirect()->route('settings-admin.edit',$id)->with('success', 'Admin berjaya dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Get currently logged-in user ID
        $currentUserId = Auth::id();

        // Check if trying to delete own account
        if ($currentUserId == $id) {
            return redirect()->route('settings-admin.index')->with('error', 'Anda tidak boleh memadam akaun sendiri.');
        }

        // Proceed with deletion if not self
        DB::table('users')
            ->where('id', $id)
            ->where('roles', 'admin')
            ->delete();

        return redirect()->route('settings-admin.index')->with('success', 'Admin berjaya dipadam.');
    }
}
