<?php

namespace App\Http\Controllers\FSDKUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthFSDKUserController extends Controller
{
    public function showLogin()
    {
        return view('users.loginuser');
    }

    public function login(Request $request)
    {
        $request->validate([
            'university_id' => 'required',
            'password' => 'required',
        ]);

        $user = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->where('users.university_id', $request->university_id)
            ->select(
                'users.*',
                'roles.role_name'
            )
            ->first();

        if (!$user) {
            return back()
                ->withInput()
                ->with('error', 'University ID or password is incorrect.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withInput()
                ->with('error', 'University ID or password is incorrect.');
        }

        if (strtolower($user->role_name) !== 'user') {
            return back()
                ->withInput()
                ->with('error', 'This account does not have FSDK User access.');
        }

        if (strtolower($user->status) !== 'active') {
            return back()
                ->withInput()
                ->with('error', 'Your account is not active.');
        }

        session([
            'fsdk_user_id' => $user->user_id,
            'fsdk_user_name' => $user->name,
            'fsdk_user_email' => $user->email,
            'fsdk_user_university_id' => $user->university_id,
            'fsdk_user_role' => $user->role_name,
            'fsdk_user_logged_in' => true,
        ]);

        return redirect()->route('user.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget([
            'fsdk_user_id',
            'fsdk_user_name',
            'fsdk_user_email',
            'fsdk_user_university_id',
            'fsdk_user_role',
            'fsdk_user_logged_in',
        ]);

        $request->session()->regenerate();

        return redirect()
            ->route('user.login')
            ->with('success', 'You have been logged out.');
    }
}