<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function loginpage(){
        return view("auth/login");
    }

    public function registerpage()
    {
        return view("auth/register");
    }

    public function login(Request $request){
        
        $validate = $request->validate([
                    'email'    => 'required|email',
                    'password' => 'required',
                     ]);

        $user = DB::table('users')->where('email', $validate['email'])->first();

        if ($user && Hash::check($validate['password'], $user->password)) {
            // Login the user
            auth()->loginUsingId($user->id);
            $request->session()->regenerate();

            // Redirect based on user level
            if ($user->roles == 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat Datang Admin!');
            } elseif ($user->roles == 'student') {
                return redirect()->route('user.dashboard')->with('success', 'Selamat Datang Pengguna!');
            }  else {
                return redirect()->route('login')->withErrors([
                    'email' => 'User level not recognized.',
                ]);
            }
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Email atau kata laluan tidak sah.',
        ]);


    }

    public function register(Request $request){

        $this->validate($request,[
            'matric'    => 'required',
            'email'     => 'required|email|unique:users',
            'name'      => 'required',
            'sector'    => 'required',
            'phone_no'  => 'required|numeric',
            'password'  => 'required|min:8|confirmed',
            
            ],
            [
                'password.required'  => 'Sila masukkan kata laluan.',
                'password.min'       => 'Kata laluan mesti mengandungi sekurang-kurangnya 8 aksara.',
                'password.confirmed' => 'Kata laluan dan pengesahan tidak sepadan.',
            ]);

        $data = [
            'matric_no'     => $request->matric,
            'email'         => $request->email,
            'phone_no'      => $request->phone_no,
            'fullname'      => strtoupper($request->name),
            'sector'        => $request->sector,
            'password'      => Hash::make($request->password),
            'created_at'    => now(),
            'roles'         => 'student'
        ];

        DB::table('users')->insert($data);

        // dd($data);

        Session::flash('success','Pendaftaran berjaya! Sila log masuk');

        return redirect()->route('login-page');

    }
}
