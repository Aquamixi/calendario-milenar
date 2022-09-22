<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function calendario_milenar(Request $request)
    {
        if($request->month){
            $time = $request->month;
        }
        else{
            $time = Carbon::today();
        }

        $today = Carbon::today();
        $today_time = strtotime('today');

        $first_day = Carbon::createFromDate('1979-12-15');
        $last_day = $first_day->addDays(1000);

        return view('calendario_milenar', compact('today_time', 'time', 'today', 'last_day', 'first_day'));
    }

    public static function prevMonth($time){
        return date('Y-m-d', strtotime("-1 month", $time));
    }

    public static function thisMonth($time){
        return date('Y-m-d', strtotime("this month", $time));
    }

    public static function nextMonth($time){
        return date('Y-m-d', strtotime("+1 month", $time));
    }

    public static function getMonthTime($time){
        $monthTime = strtotime(date('Y-m-1'));

        if(isset($time)){
            extract(date_parse_from_format('Y-m-d', $time));

            $monthTime = strtotime("{$year}-{$month}-1");
        }

        return $monthTime;
    }
}
