<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AppController extends Controller
{
    public function __construct()
    {
        // $this->middleware('admin');
    }

    public function index()
    {
        return view('app.index');
    }

    public function custom_logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
