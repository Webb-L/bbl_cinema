@extends('default')
@section('content')
    <div class="modal" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">警告</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    是否取消订单！
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <a href="" id="staticBackdrop" class="btn btn-danger">确认</a>
                </div>
            </div>
        </div>
    </div>
<div class="container mt-5">
    <ul class="nav nav-pills mb-3" id="pills-tab">
        <li class="nav-item">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home">我的信息</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="pills-profile-tab" data-toggle="pill" href="#pills-profile">购票信息</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home">
            <form action="{{route('user.update',$user->id)}}" method="post">
                @method('PUT')
                <div class="form-group row">
                    <label for="tel" class="col-sm-2 col-form-label">手机号</label>
                    <div class="col-sm-10">
                        <input type="tel" class="form-control"  disabled id="tel" value="{{str_replace(substr($user->phone,3,7),'********',$user->phone)}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">用户昵称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" autocomplete id="name" name="name" value="{{$user->name}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">登录密码</label>
                    <div class="col-sm-10">
                        <input type="password" autocomplete class="form-control" name="password" id="password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="newPassword3" class="col-sm-2 col-form-label">新密码</label>
                    <div class="col-sm-10">
                        <input type="password" autocomplete class="form-control" name="newpassword" id="newPassword3">
                    </div>
                </div>
                @csrf
                <div class="form-group row">
                    <label for="newPassword3" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-outline-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="pills-profile">
            @if(count($data))
                <table class="table table-border-less">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>名称</th>
                        <th>座位</th>
                        <th>价格</th>
                        <th>购买时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key=>$movie)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$movie->movie()->first()->movie_name}}</td>
                            <td>
                                @foreach(explode(',',$movie->seat) as $num)
                                    <span class="badge badge-success">{{$num}}号</span>
                                @endforeach
                            </td>
                            <td>￥{{count(explode(',',$movie->seat)) * $movie->movie()->first()->price}}</td>
                            <td>{{$movie->created_at}}</td>
                            @if(strtotime($movie->created_at)>=strtotime($movie->movie()->first()->release_time.' '.$movie->movie()->first()->release_date))
                                    <td class="text-danger">已取消</td>
                                @else
                                @if($movie->status == 0)
                                    <td class="text-primary">待出票</td>
                                @elseif($movie->status == 1)
                                    <td class="text-success">已完成</td>
                                @else
                                    <td class="text-danger">已取消</td>
                                @endif
                            <td>
                                @if($movie->status ==0)
                                    <a href="{{route('print',$movie)}}" class="btn btn-success">出票></a>
                                    <button type="submit" data-id="{{$movie->id}}" class="btn btn-outline-secondary cancel">取消</button>
                                @endif
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h1>您还有购票记录！</h1>
            @endif
        </div>
    </div>
</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script>
    $(function () {
        $('.cancel').on('click',function () {
            $('#myModal').modal('show');
            $('#staticBackdrop').attr('href',"print/"+$(this).data('id')+"/cancel")
        });
    })
</script>
@endsection
