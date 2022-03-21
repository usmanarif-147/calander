<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookings()
    {
        $events = array();
        $bookings = Booking::all();
        foreach ($bookings as $booking)
        {
            $events[] = [
                'title' => $booking->title,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
            ];
        }
        return view('welcome', ['events' => $events]);
    }
}
