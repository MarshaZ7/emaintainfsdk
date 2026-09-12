<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{    
    public function showLogin()
    {
        return view('auth.loginadmin');
    }

    public function showRegister()
    {
        return view('auth.regisadmin');
    }

    public function register(Request $request)
    {
        $request->validate([
            'university_id' => 'required',
            'name'          => 'required',
            'email'         => 'required|email',
            'password'      => 'required|min:6|confirmed',
            'phone'         => 'nullable',
        ]);

        // Check email
        $emailExists = DB::table('users')
            ->where('email', $request->email)
            ->exists();

        if ($emailExists) {
            return back()
                ->withInput()
                ->with('error', 'Email already registered.');
        }

        // Check university ID
        $universityExists = DB::table('users')
            ->where('university_id', $request->university_id)
            ->exists();

        if ($universityExists) {
            return back()
                ->withInput()
                ->with('error', 'University ID already registered.');
        }

        $adminRole = DB::table('roles')
            ->where('role_name', 'Admin')
            ->first();

        if (!$adminRole) {
            return back()
                ->withInput()
                ->with('error', 'Admin role has not been created in the database.');
        }


        DB::table('users')->insert([
            'role_id'       => $adminRole->role_id,
            'university_id' => $request->university_id,
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'phone'         => $request->phone,
            'status'        => 'active',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);


        return redirect()
            ->route('admin.login')
            ->with('success', 'Admin account successfully created. Please login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);


        $user = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->where('users.email', $request->email)
            ->select(
                'users.*',
                'roles.role_name'
            )
            ->first();

        if (!$user) {
            return back()
                ->withInput()
                ->with('error', 'Email or password is incorrect.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withInput()
                ->with('error', 'Email or password is incorrect.');
        }


        if (strtolower($user->role_name) !== 'admin') {
            return back()
                ->withInput()
                ->with('error', 'This account does not have administrator access.');
        }

        if (strtolower($user->status) !== 'active') {
            return back()
                ->withInput()
                ->with('error', 'Your account is not active.');
        }

        session([
            'admin_id'       => $user->user_id,
            'admin_name'     => $user->name,
            'admin_email'    => $user->email,
            'admin_role'     => $user->role_name,
            'admin_logged_in' => true,
        ]);


        return redirect()
            ->route('admin.dashboard');
    }


    public function logout(Request $request)
    {
        $request->session()->forget([
            'admin_id',
            'admin_name',
            'admin_email',
            'admin_role',
            'admin_logged_in',
        ]);

        $request->session()->regenerate();

        return redirect()
            ->route('admin.login')
            ->with('success', 'You have been logged out.');
    }
}