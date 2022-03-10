<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {

        $flights = Flight::all()->map(function($flight){
            return [
                'airline' => $flight->airline,
                'license' => $flight->license_no,
                'start' => $flight->availability
            ];
        })->toArray();

        return view('admin_dashboard', compact('flights'));
    }

}
