<?php

namespace App\Http\Controllers;

use App\bbl_movie_layout;
use App\Purchase;
use App\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data = Vote::where('id', $id)->first();
        $movie_id = $request->movie;
        if(bbl_movie_layout::where('layout_id',$movie_id)->first()->tickets<=0)return back();
        $error_seat = [];
        $movie_date = bbl_movie_layout::where('layout_id', $request->movie)->first();
        $Purchase = Purchase::where('status','!=','2')->where('room_id', $id)->where('movie_id', $movie_id)
            ->whereDate('created_at', '<=', strtotime($movie_date->release_time . ' ' . $movie_date->release_date))
            ->get();
        foreach ($Purchase as $purchase) {
            foreach (explode(',', $purchase->seat) as $seat) {
                array_push($error_seat, $seat);
            }
        }
        $error_seat = implode(',',$error_seat);
        return view('vote', compact('data', 'movie_id', 'error_seat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'che' => 'required|max:6',
        ], [
            'required' => '请选择你要购买的座位！',
            'max' => '最多只能买6张！',
        ]);
        if (!$request->movie) {
            return redirect(route('index'));
        }
        if(bbl_movie_layout::where('layout_id',$request->movie)->first()->tickets<=0)return back();
        $error_seat = [];
        $seat = [];
        $movie_date = bbl_movie_layout::where('layout_id', $request->movie)->first();
        $Purchase = Purchase::where('status', '!=', '2')->where('user_id', \Auth::guard('user')->user()->id)
            ->where('room_id', $id)->where('movie_id', $request->movie)
            ->whereDate('created_at', '<=', strtotime($movie_date->release_time . ' ' . $movie_date->release_date))
            ->get();
        foreach ($Purchase as $purchase) {
            array_push($seat, explode(',', $purchase->seat));
        }
        foreach ($seat as $seata) {
            foreach ($seata as $seatb) {
                foreach ($request->che as $che) {
                    if ($che == $seatb) {
                        array_push($error_seat, $che);
                    }
                }
            }
        }
        if (!empty($error_seat)) {
            return back()->withErrors(implode(',', $error_seat) . " 位置已被购买，请选择其他位置。");
        }
        $data['user_id'] = \Auth::guard('user')->user()->id;
        $data['room_id'] = $id;
        $data['movie_id'] = $request->movie;
        $data['seat'] = implode(',', $request->che);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        $data['created_at'] = date('Y-m-d H:i:s', time());
        $tickets = bbl_movie_layout::where('layout_id', $request->movie)->first()->tickets;
        if($tickets - count($request->che)<=0){
            return back()->withErrors("抱歉我们只剩下{$tickets}张票！");
        }
        if (!$tickets <= 0) {
            $print_id = Purchase::insertGetId($data);
            if ($print_id) {
                if ( bbl_movie_layout::where('layout_id', $request->movie)->update(['tickets' => $tickets - count($request->che)])) {
                    return redirect(route('success', $print_id));
                } else {
                    bbl_movie_layout::where('layout_id', $request->movie)->delete();
                }
            } else {
                return back()->withErrors("购买失败，请重试！");
            }
        } else {
            return back()->withErrors("已经卖完了，请您去找别的影厅购买！");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
