<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userr;
class HomeController extends Controller
{
    public function homeKadiv()
    {
        if (auth()->user()->role !== Userr::ROLE_KADIV) {
            return redirect()->route('home.admin');
        }

        return view('home_kadiv');
    }
}
