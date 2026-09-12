<?php

namespace App\Http\Controllers\FSDKUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingController extends Controller
{    
    public function index() {
        return view('index');
    }

    public function faq(){
        return view('users.faq');
    }
    public function reportIssue()
    {
        return view('users.report-issue');
    }

    

    public function register()
    {
        return view('users.register');
    }
}