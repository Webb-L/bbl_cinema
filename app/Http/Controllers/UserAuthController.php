<?php

namespace App\Http\Controllers;

use Doctrine\DBAL\Events;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::guard('user')->attempt($request->only('phone', 'password'), $request->only('check'))) {
            if ($request->callback) {
                return redirect($request->callback);
            } else {
                return redirect('/');
            }
        } else {
            return back()->withErrors("登录失败请重试！");
        }
    }

    public function register()
    {
        return view('register');
    }
}
