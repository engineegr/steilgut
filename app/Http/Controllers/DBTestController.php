<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;

class DBTestController extends Controller
{
    public function byTitle(Request $request, $title, $harvest) {
        $subwandBottles = DB::table('wines')->where('title', 'LIKE', '%' . $title . '%')
        ->where('harvest', '>', intval($harvest))->get();

        Log::info('Debug [DBTestController:byTitle] title: ' . $title);
        Log::info('Debug [DBTestController:byTitle] harvest: ' . $harvest);

        return view('db_test')->with('subwandBottles', $subwandBottles);
    }
}
