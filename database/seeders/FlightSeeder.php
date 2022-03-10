<?php

namespace Database\Seeders;

use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $airlines = ['PIA', 'Air India', 'Emirates', 'Air Sial', 'Ethad Airlines'];
        $from = ['lahore', 'dehli', 'karachi', 'banglor', 'dubai', 'peshawar'];
        $to = ['lahore', 'dehli', 'karachi', 'banglor', 'dubai', 'peshawar'];
        $start_datetime = new Carbon('2021-01-23 11:53:20');
        $end_datetime = new Carbon('2023-05-28 11:53:20');

        for($i=0; $i<10; $i++)
        {
            $flight = new Flight();
            $flight->airline = $airlines[array_rand($airlines)];
            $flight->from = $from[array_rand($from)];
            $flight->to = $to[array_rand($to)];
            $flight->capacity = rand(10, 100);
            $flight->license_no = rand(1000, 5000);
            $flight->availability = $this->randomDate($start_datetime, $end_datetime);
            $flight->save();
        }

    }

    // Find a randomDate between $start_date and $end_date
    private function randomDate($start_date, $end_date)
    {
        // Convert to timetamps
        $min = strtotime($start_date);
        $max = strtotime($end_date);

        // Generate random number using above bounds
        $val = rand($min, $max);

        // Convert back to desired date format
        return date('Y-m-d H:i:s', $val);
    }
}
