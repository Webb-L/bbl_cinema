<?php

namespace App\Http\Controllers;

use App\bbl_movie_layout;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        if (empty($request->only('keyword', 'date'))) {
            $movie = bbl_movie_layout::all();
            $count = $movie->count();
        } else {
            $request->session()->flash('keyword', $request['keyword']);
            $request->session()->flash('date', $request['date']);
            $movie = bbl_movie_layout::all();
            if ($request->only('keyword')['keyword']) {
                $movie = bbl_movie_layout::where('movie_name', 'like', '%' . $request->only("keyword")['keyword'] . '%')->get();
            }
            if ($request->only('date')['date']) {
                $movie = bbl_movie_layout::all()->where('release_time', str_replace('-', '/', $request->only('date')['date']));
            }
            $count = $movie->count();
        }
        return view('index', compact('count', 'movie'));
    }
}
