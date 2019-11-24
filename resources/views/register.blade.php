@extends('default')
@section('content')
    <div class="container mt-5">
        <form action="{{route('user.store')}}" method="post">
            <h1>{{config('bbl.registers.title')}}</h1>
            <div class="form-group">
                <label for="name">{{config('bbl.registers.name')}}：</label>
                <input type="text" name="name" id="name" autocomplete class="form-control" maxlength="10" value="{{session('old_data')[0]}}" placeholder="">
                <small id="helpId" class="text-muted">请输入长度为2到10的昵称</small>
            </div>
            <div class="form-group">
                <label for="phone">{{config('bbl.registers.phone')}}：</label>
                <input type="tel" name="phone" class="form-control" autocomplete value="{{session('old_data')[1]}}" maxlength="11" id="phone">
            </div>
            <div class="form-group">
                <label for="password">{{config('bbl.registers.password')}}：</label>
                <input type="password" name="password" maxlength="16" autocomplete class="form-control" id="password">
                <small class="text-muted">请输入长度为6到16位的密码</small>
            </div>
            <div class="form-group">
                <label for="confirmpassword">{{config('bbl.registers.confirmpassword')}}：</label>
                <input type="password" name="password_confirmation" autocomplete maxlength="16" class="form-control" id="confirmpassword">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" name="check" autocomplete class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">我同意 <a href="">《相关条款》</a></label>
            </div>
            @csrf
            <button type="submit" class="btn btn-primary submit">{{config('bbl.registers.title')}}</button>
        </form>
    </div>
@endsection
