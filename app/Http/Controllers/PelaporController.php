<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelaporController extends Controller
{
    public function dashboard()
    {
        return view('pelapor.dashboard');
    }
}
