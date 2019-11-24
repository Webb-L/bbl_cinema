<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{config('bbl.title')}}</title>
    <script src="/js/index.js"></script>
    @yield('header')
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand mb-0 h1" href="{{route('index')}}">{{config('bbl.title')}}</a>
        <div class="btn-toolbar float-left">
            <div class="btn-group mr-2" role="group">
                @if(Auth::guard('user')->check())
                    <a href="{{route('user.index')}}" class="btn btn-primary">{{config('bbl.core')}}</a>
                    @else
                    <a href="{{route('login')}}" class="btn btn-primary">{{config('bbl.login')}}</a>
                    <a href="{{route('register')}}" class="btn btn-outline-primary">{{config('bbl.register')}}</a>
                @endif
            </div>
        </div>
    </div>
</nav>
<div class="container mt-1">
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>错误</strong> {{$error}}
            </div>

            <script>
                $(".alert").alert();
            </script>
        @endforeach
    @endif
    @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>成功</strong> {{session()->get('success')}}
            </div>

            <script>
                $(".alert").alert();
            </script>
    @endif
</div>
@yield('content')
</body>
</html>
