<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PilotController extends Controller
{
    public function dashboard()
    {
        return view('pilot_dashboard');
    }
}
