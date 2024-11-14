<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homeKadiv()
    {
        if (auth()->user()->role !== 'kadiv') {
            return redirect()->route('home.admin');
        }

        return view('home_kadiv');
    }
}
