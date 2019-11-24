<?php

namespace App\Http\Controllers;

use App\Purchase;
use Illuminate\Http\Request;

class SuccessController extends Controller
{
    function show($id)
    {
        $data = Purchase::where('id', $id)->first();
        if(\Auth::guard('user')->check()){
            if ($data->user_id == \Auth::guard('user')->user()->id) {
                $movie = \App\bbl_movie_layout::where('layout_id', $data->movie_id)->first();
                $name = $movie->movie_name;
                $date = $movie->release_date . ' ' . $movie->release_time;
                return view('success', compact('data', 'name', 'date'));
            } else {
                return redirect(route('index'));
            }
        }else {
            return redirect(route('login'));
        }
    }
}
