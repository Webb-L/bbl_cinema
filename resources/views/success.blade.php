@extends('default')
@section('content')
<div class="container mt-5">
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">警告</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    是否取消订单！
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <a href="{{route('cancel',$data)}}" class="btn btn-danger">确认</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <svg t="1573782497112" class="icon" viewBox="0 0 1024 1024" version="1.1"
                     xmlns="http://www.w3.org/2000/svg" p-id="4207" width="128" height="128">
                    <path d="M469.333333 640l0.384 0.384L469.333333 640z m-106.282666 0l-0.384 0.384 0.384-0.384z m48.512 106.666667a87.466667 87.466667 0 0 1-61.653334-24.874667l-179.52-173.632a67.797333 67.797333 0 0 1 0-98.24c28.032-27.157333 73.493333-27.157333 101.589334 0l139.584 134.997333 319.168-308.544c28.032-27.157333 73.493333-27.157333 101.589333 0a67.925333 67.925333 0 0 1 0 98.24L472.981333 722.069333A87.530667 87.530667 0 0 1 411.562667 746.666667z"
                          fill="#78C326" p-id="4208"></path>
                </svg>
                <h1>购买成功</h1>
            </div>
            <div class="card-text">
                <p>此订单包含以下内容：</p>
                <ul>
                    <li>电影名称：<span class="text-warning">{{$name}}</span></li>
                    <li>上映时间：<span class="text-warning">{{$date}}</span></li>
                    <li>上映影厅：<span class="text-warning">{{$data->room_id}}号影厅</span></li>
                </ul>
                <p>购买的座位号：</p>
                <ul>
                    @foreach(explode(',',$data->seat) as $num)
                        <li><span class="text-dark">{{$num}}号</span></li>
                    @endforeach
                </ul>
                <p><strong>请及时打印电影票，观看电影。</strong><br/>谢谢！</p>
            </div>
        </div>
        <div class="card-footer">
            <a href="/" class="btn btn-secondary">返回首页</a>
            @if(!$data->status == 2)
                <a href="{{route('print',$data)}}" class="btn btn-success">下载电影票TXT</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#staticBackdrop">
                    取消订单
                </button>
            @endif
        </div>
    </div>
</div>
@endsection
