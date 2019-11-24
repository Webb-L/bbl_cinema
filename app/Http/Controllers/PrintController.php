<?php

namespace App\Http\Controllers;

use App\Purchase;
use http\Env\Response;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function index(){
        $user = \Auth::guard('user');
        $data = Purchase::where('status','0')->get();
        return view('printing',compact('user','data'));
    }

    public function cancel($id)
    {
        $data = Purchase::where('id', $id)->first();
        if (!$data->user_id == \Auth::guard('user')->user()->id) {
            return redirect(route('index'));
        }
        if($data->status != 2) {
            if (Purchase::where('id', $id)->update(['status' => '2'])) {
                session()->flash('success','订单取消成功!');
                return back();
            } else {
                return back()->withErrors("订单取消失败，请重试！");
            }
        }else {
            return back()->withErrors("订单已经被你取消了，请勿重复取消！");
        }
    }

    public function print($id)
    {
        $data = Purchase::where('id', $id)->first();
        if (!$data->user_id == \Auth::guard('user')->user()->id) {
            return redirect(route('index'));
        }
        if($data->status == 0) {
            $filename = './export/film_' . str_replace(':', '', str_replace(' ', '', str_replace('-', '', $data->created_at))) . '.txt';
            if (file_put_contents($filename, $data)) {
                if (Purchase::where('id', $id)->update(['status' => '1'])) {
                    return response()->download(public_path() . $filename);
                }else {
                    return back()->withErrors("打印出错，请重试！");
                }
            }
        }else {
            return back()->withErrors("您已经打印过了,如果丢失请联系客服！");
        }
    }
}
