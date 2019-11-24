@extends('default')
@section('header')
    <style>
        .optional,
        .cannot,
        .already {
            margin: 0 20px;
        }

        .optional div,
        .cannot div,
        .already div,
        .form-group label div {
            width: 32px;
            height: 32px;
            margin: 0 auto;
        }

        .selection {
            display: flex;
        }

        .form-group label div {
            text-align: center;
            line-height: 32px;
        }
    </style>
@endsection()
@section('content')
    <div class="container mt-5">
        <h1>{{config('bbl.vote.title')}}</h1>
        <div class="form">
            <div class="form-group">
                <label for="">{{config('bbl.vote.explain')}}：</label>
                <div class="selection">
                    <div class="optional">
                        <div class="rounded-circle border border-success"></div>
                        <span>{{config('bbl.vote.sure')}}</span>
                    </div>
                    <div class="cannot">
                        <div class="rounded-circle bg-danger"></div>
                        <span>{{config('bbl.vote.mustnot')}}</span>
                    </div>
                    <div class="already">
                        <div class="rounded-circle bg-success"></div>
                        <span>{{config('bbl.vote.already')}}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">{{config('bbl.vote.already')}}：</label>
                <div class="selected btn-group">
                </div>
            </div>
        </div>
        <p class="d-none">{{$num=1}}</p>
        <form action="{{route('vote.update',[$data,"movie={$movie_id}"])}}" method="post">
            @method('PUT')
            <table class="table mt-5">
                <tbody>
                @if(empty($data))
                    <h1>该影厅还未被开放或者已经被删除！</h1>
                @else
                    @for($row=1;$row<=$data->row;$row++)
                        <tr>
                            <td class="row">{{$row}}{{config('bbl.vote.row')}}</td>
                            @for($number=1;$number<=$data->number;$number++)
                                <td>
                                    <div class="form-group">
                                        <label for="{{$row}}row{{$number}}num">
                                            <div class="rounded-circle border border-success che">{{$num}}</div>
                                            <input type="checkbox" name="che[]" id="{{$row}}row{{$number}}num" class="d-none" value="{{$num++}}">
                                        </label>
                                    </div>
                                </td>
                            @endfor
                        </tr>
                    @endfor
                @endif
                </tbody>
            </table>
            @csrf
            <button type="submit" class="btn btn-primary">提交</button>
        </form>
    </div>
    <script src="/js/jquery.min.js"></script>
    <script>
        $(function () {
            var error_seat = "{{($error_seat)}}";
            $('.che').each(function (i,t) {
                error_seat.split(',').map(function (a) {
                    if($(t).text() == a) {
                        $(t).attr('class','rounded-circle border text-white bg-danger che').data('type','e');
                        $(t).parent().children()[1].remove();
                    }else {
                        return;
                    }
                })
            });
            var row = {{$data?$data->row:''}};
            var numbers = {{$data?$data->number:''}};
            $('.che').on('click', function () {
                if($(this).data('type')=='e') return;
                if ($($(this).parent().parent().children().children()[1]).is(':checked')) {
                    $(this).attr('class', 'rounded-circle border border-success che');
                    var ele = $($(this).parent().parent().children().children()[1]).attr('id');
                    $('.selected .btn').each(function (i, t) {
                        if ($(t).data('id') == ele) {
                            $(t).remove()
                        }
                    });
                } else {
                    $(this).attr('class', 'rounded-circle text-white bg-success');
                    $('.selected').append('<button class="btn btn-success" data-id='+$($(this).parent().parent().children().children()[1]).attr('id')+'>' + $($(this).parent().parent().children().children()[1]).attr('id').replace('row', '{{config("bbl.vote.row")}}').replace('num', '{{config("bbl.vote.num")}}') + '</button>')
                }
            })
        })
    </script>
@endsection()
