<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $categories = Category::select('id', 'name', 'image')->where('type', 'parts')->get();
        return view('app.index', compact('categories'));
    }

    public function custom_logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
