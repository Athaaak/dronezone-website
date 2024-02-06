<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function homepage()
    {
        return view('homepage');
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function explore()
    {
        return view('explore-option');
    }
    public function exploreprofessional()
    {
        return view('professional');
    }

    public function exploregeneral()
    {
        return view('general');
    }

    public function article()
    {
        return view('article');
    }

    public function provider()
    {
        return view('provider');
    }
}
