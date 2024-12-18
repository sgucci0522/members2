<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index($monthOffset = 0)
    {
	$users = User::orderBy('id','asc')->get();

	// 前半か後半か
	    $toDay = Carbon::now();
	    $toDays = $toDay->format('d');
	if ($monthOffset == 0) {
	    if ($toDays < 17) {
	        $kubun = 0;
	    } else {
	        $kubun = 1;
	    }
	} else {
	    if ($toDays < 17) {
		if ($monthOffset > 0) {
		    $kubun = $monthOffset % 2;
		} else {
		    $kubun = -$monthOffset % 2;
		}
	    } else {
	        if ($monthOffset > 0) {
		    $kubun = ( $monthOffset + 1) % 2;
		} else {
		    $kubun = -( $monthOffset + 1) % 2; 
		}	
	    }
	}

	// 現在の月を取得
	if ($monthOffset == 0) {
	    $currentMonth = $toDay->copy();
	    $add = 0;
	} else {
	    if ($toDays < 17) {
		if ($monthOffset > 0) {
	            $currentMonth = Carbon::now()->addMonths(round(($monthOffset-1)/2));
	            $add = round(($monthOffset-1)/2);
		} else {
	            $currentMonth = Carbon::now()->addMonths(round($monthOffset/2));
	            $add = round($monthOffset/2);
		} 
	    } else {
		if ($monthOffset > 0) {
	            $currentMonth = Carbon::now()->addMonths(round($monthOffset/2));
	            $add = round($monthOffset/2);
		} else {
	            $currentMonth = Carbon::now()->addMonths(round(($monthOffset+1)/2));
	            $add = round(($monthOffset+1)/2);
		}
	    }
	}

	// 初日を取得
	$startOfMonth = $currentMonth->copy()->startOfMonth();

	//if ($kubun == 1 && $toDays < 17 or $kubun == 1 && $toDays > 16) {
	if ($kubun == 1) {
	    for ($i = 1; $i < 17 ;$i++) {
		$startOfMonth = $startOfMonth->addDay();
	    }
	}

	$startOfMonth2 = $startOfMonth->copy();

	// 月の初日が何曜日かを取得
	$firstDayOfWeek = $startOfMonth->dayOfWeek;

	// 現在の月の最終日を取得
	if ($kubun == 1) {
	     $endOfMonth = $currentMonth->copy()->endOfMonth();
	} else {
	    $endOfMonth = $startOfMonth->copy();	
	    for ($i = 1; $i < 16 ;$i++) {
		$endOfMonth = $endOfMonth->addDay();
	    }
	}
        // 1日から最終日までの日付を取得
        $daysInMonth = [];
        for ($day = $startOfMonth; $day <= $endOfMonth; $day->addDay()) {
            $daysInMonth[] = $day->copy();
        }


        // カレンダーのビューにデータを渡す

        return view('calendar.index', compact('currentMonth', 'daysInMonth', 'firstDayOfWeek','monthOffset','startOfMonth2','endOfMonth','kubun','add','users'));
    }
}

