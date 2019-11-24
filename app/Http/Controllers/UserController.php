<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\User;
use Auth;
use foo\bar;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::guard('user')->user();
        $data = Purchase::orderBy('created_at','desc')->where('user_id',$user->id)->get();
        return view('userinfo',compact('user','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session()->flash('old_data', [$request['name'],$request['phone']]);
        $this->validate($request, [
            'name' => 'required|min:3|max:10',
            'phone' => 'required|size:11',
            'password' => 'required|min:6|max:16',
            'password_confirmation' => 'required|min:6|max:16'
        ]);
        if ($request->password != $request->password_confirmation) {
            return back()->withErrors("密码和确认密码不一致！");
        }
        if (!$request->only('check')) {
            return back()->withErrors("请同意协议！");
        }
        $user['name'] = $request->name;
        $user['phone'] = $request->phone;
        $user['password'] = bcrypt($request->password);
        $user['updated_at'] = date('Y-m-d H:i:s', time());
        $user['created_at'] = date('Y-m-d H:i:s', time());
        if (User::insert($user)) {
            session()->flash('success','注册成功！');
            return redirect('login');
        } else {
            return back()->withErrors("注册账号失败，请重试！");
        }
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
        $this->validate($request,[
            'name' => 'required|min:3|max:10'
        ]);
        $data['name'] = $request->name;
        if(!empty($request->password)){
            if(empty($request->newpassword)){
                return back()->withErrors("新密码不能为空！");
            }else {
                if(\Hash::check($request->password,Auth::guard('user')->user()->password)){
                    $data['password'] = bcrypt($request->newpassword);
                }else {
                    return back()->withErrors("登录密码错误！");
                }
            }
        }
        if(User::where('id',Auth::guard('user')->user()->id)->update($data)) {
            if(empty($data['password'])) {
                session()->flash('success','昵称修改成功!');
                return back();

            }else {
                Auth::logout();
                return redirect(route('index'));
            }
        }else {
            return back()->withErrors("修改信息失败！");
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
