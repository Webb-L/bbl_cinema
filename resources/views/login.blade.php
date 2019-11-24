@extends('default')
@section('content')
    <div class="container mt-5">
        <form action="{{route('logis')}}" method="post">
            <h1>{{config('bbl.logins.title')}}</h1>
            <div class="form-group">
                <label for="InputEmail1">{{config('bbl.logins.phone')}}：</label>
                <input type="tel" name="phone" class="form-control" autocomplete id="InputEmail1" maxlength="11">
            </div>
            <div class="form-group">
                <label for="InputPassword1">{{config('bbl.logins.password')}}：</label>
                <input type="password" name="password" class="form-control" maxlength="16" autocomplete id="InputPassword1">
            </div>
            <div class="form-group form-check">
                <label class="form-check-label" for="Check1"></label>
                <input type="checkbox" name="check" class="form-check-input" id="Check1">{{config('bbl.logins.remember')}}
            </div>
            @csrf
            <button type="submit" class="btn btn-primary">{{config('bbl.logins.title')}}</button>
        </form>
    </div>
@endsection
