<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profilePage(){

        $user = Auth::user();
        if (!$user) return redirect('/login');

        return view('profile.show', compact('user'));
    }

    public function update(Request $request){

        $user = Auth::user();

        $request->validate([
            'matric_no' => 'required|string',
            'fullname' => 'required|string',
            'sector' => 'required|string',
            'phone_no' => 'required|string',
            'email' => 'required|email',
            // Add validation as needed
        ]);

        DB::table('users')->where('id', $user->id)->update([
            'matric_no' => $request->matric_no,
            'fullname' => $request->fullname,
            'sector' => $request->sector,
            'phone_no' => $request->phone_no,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profil berjaya dikemaskini.');
    }

    public function resetPasswordPage()
    {
        return view('profile.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Katalaluan semasa tidak tepat.']);
        }

        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'password' => Hash::make($request->new_password),
            ]);

        return redirect()->back()->with('success', 'Katalaluan berjaya ditukar.');
    }
        
    
}
