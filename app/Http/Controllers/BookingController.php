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
        foreach ($bookings as $booking) {
            $events[] = [
                'title' => $booking->title,
                'start' => $booking->start_date,
//                'end' => $booking->end_date,
            ];
        }
        return view('welcome', ['events' => $events]);
    }

    public function storeBooking(Request $request)
    {
//        for ($i = 0; $i < $request->slots; $i++) {
//            $booking = new Booking();
//            $booking->title = $request->title;
//            $booking->start_date = $request->slots[$i];
////            $booking->end_date = $request->slots[$i];
//            $booking->save();
//
//        }

        foreach ($request->slots as $slot)
        {
            $booking = new Booking();
            $booking->title = $request->title;
            $booking->start_date = $slot;
//            $booking->end_date = $request->slots[$i];
            $booking->save();
        }

        return response()->json("done");

    }
}
