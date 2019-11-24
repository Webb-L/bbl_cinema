@extends('default')
@section('content')
<div class="container mt-5">
    @if(!$user->check())
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title">--- 验证和打印电影票 ---</h4>
            <div class="card-text">
                <form action="{{route('logis',['callback'=>'/print'])}}" method="post">
                    <div class="form-group row">
                        <label for="staticTel" class="col-sm-2 col-form-label">电话</label>
                        <div class="col-sm-6">
                            <input type="tel" name="phone" class="form-control" id="inputPhone">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">密码</label>
                        <div class="col-sm-6">
                            <input type="password" name="password" class="form-control" id="inputPassword">
                        </div>
                    </div>
                    @csrf
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary">登录</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer">
            您还没有登录，登录成功后即可打印。
        </div>
    </div>
        @else
    <div class="card mt-5 text-center">
        <div class="card-body">
            <h4 class="card-title text-left">--- 等打印的电影票信息 ---</h4>
            <div class="card-text">
                <table class="table">
                    <tbody>
                    @if(count($data)==0)
                        <h1 class="text-left mt-5">你暂时没有，需要打印的电影票。</h1>
                    @else
                        @foreach($data as $key=>$movie)
                            <tr>
                                <td scope="row">{{$key+1}}</td>
                                <td>《{{$movie->movie()->first()->movie_name}}》</td>
                                <td>上映日期：{{$movie->movie()->first()->release_time}}</td>
                                <td>上映时间：{{$movie->movie()->first()->release_date}}</td>
                                <td>
                                    <a href="{{route('print',$movie)}}" class="btn btn-success">下载电影票></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
