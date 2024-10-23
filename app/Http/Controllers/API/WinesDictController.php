<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wine;
use DB;
use Image;

class WinesDictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wines = DB::Table('wines')->paginate(2);
        foreach($wines as $wine) {
            $image_file = Image::make($wine->image)->encode('png');
            $wine->image = "data:image/png;base64," . base64_encode($image_file);
        }

        $count = Wine::count();
        return response()->json(compact('wines', 'count'));
    }

    public function count() {
        return response()->make(Wine::count());
    }

}
