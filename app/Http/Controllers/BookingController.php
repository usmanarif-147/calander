<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookings(Request $request)
    {
        if($request->ajax())
        {
            $events = array();
            $bookings = Booking::all();
            foreach ($bookings as $booking) {
                $events[] = [
                    'id' => $booking->id,
                    'title' => $booking->title,
                    'start' => $booking->start_date,
                ];
            }
            return response()->json($events);
        }

        return view('welcome');
//        return view('welcome', ['bookings' => $events]);
    }

    public function storeBooking(Request $request)
    {
        $arr = [];
        foreach ($request->slots as $slot)
        {
            $booking = new Booking();
            $booking->title = $request->title;
            $booking->start_date = $slot;
            $booking->save();
            array_push($arr, $booking);
        }

        return response()->json([
            'bookings' => $arr
        ]);

    }

    public function updateBooking(Request $request)
    {

    }

    public function deleteBooking(Request $request)
    {
        $booking = Booking::find($request->id)->delete();
        return response()->json($booking);
    }
}
