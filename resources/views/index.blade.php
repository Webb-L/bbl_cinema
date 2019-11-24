@extends('default')
@section('content')
<div class="container">
    <form action="" method="get" class="mt-5 mb-5">
        <div class="form-row">
            <div class="form-group col-6">
                <lable>{{config('bbl.index.keyword')}}</lable>
                <input type="text" name="keyword" class="form-control" value="{{session('keyword')}}">
            </div>
            <div class="form-group col-4">
                <lable>{{config('bbl.index.date')}}</lable>
                <input type="date" name="date" class="form-control" value="{{session('date')}}">
            </div>
            <div class="form-group col-2 d-flex">
                <button type="submit" class="btn btn-outline-success mt-auto bd-highlight">{{config('bbl.index.search')}}</button>
            </div>
        </div>
    </form>
    @if(!$count<=0)
    <table class="table table-border-less">
        <thead>
        <tr>
            <th>#</th>
            <th>{{config('bbl.index.name')}}</th>
            <th>{{config('bbl.index.releasetime')}}</th>
            <th>{{config('bbl.index.releasedate')}}</th>
            <th>{{config('bbl.index.moviehall')}}</th>
            <th>{{config('bbl.index.price')}}</th>
            <th>{{config('bbl.index.surplusticket')}}</th>
            <th>{{config('bbl.index.purchase')}}</th>
        </tr>
        </thead>
        <tbody>
            @foreach($movie as $data)
                @if(strtotime($data->release_time.' '.$data->release_date)>time()-600)
                    @if(\App\Vote::where('id',$data->release_room)->first())
                        <tr>
                            <td>{{$data->layout_id}}</td>
                            <td>{{$data->movie_name}}</td>
                            <td>{{$data->release_date}}</td>
                            <td>{{$data->release_time}}</td>
                            <td>{{$data->release_room}}</td>
                            <td>{{$data->price}}</td>
                            <td>{{$data->tickets<=0?'没票了':$data->tickets}}</td>
                            <td><a href="{{route('vote.show',[$data->release_room,"movie={$data->layout_id}"])}}" class="btn btn-success {{$data->tickets<=0?'disabled':''}}">{{config('bbl.index.immediateorder')}}></a></td>
                        </tr>
                    @endif
                @endif
            @endforeach
        </tbody>
    </table>
        @else
        <h1 class="text-center">还没有发布新电影，请稍等！</h1>
    @endif
</div>
@endsection
