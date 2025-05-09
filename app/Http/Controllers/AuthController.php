<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


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

    public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken();

        return redirect()->route('login-page')->with('success', 'Berjaya log keluar.');
    }

    public function forgotpasswordpage(){
        return view("auth/forgot-password");
    }

    public function forgotpassword(Request $request){

        $validate = $request->validate([

            'email'    => 'required|email',
        ]);

        $user = DB::table('users')->where('email', $validate['email'])->first();

        if (!$user || !isset($user->email)) {
            return back()->withErrors(['email' => 'Email tidak dijumpai.']);
        }

    $temporaryPassword = Str::random(10);
        DB::table('users')
            ->where('email', $validate['email'])
            ->update(['password' => bcrypt($temporaryPassword)]);

        Mail::raw("Kata laluan sementara anda: $temporaryPassword", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Temporary Password');
        });

        return back()->with('success', 'Kata laluan sementara telah dihantar ke emel anda.');
    }
}
