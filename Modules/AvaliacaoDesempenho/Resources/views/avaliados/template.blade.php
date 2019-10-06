<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Avaliação</title>

    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link href="{{ url('css/material-icons.css') }}" rel="stylesheet">

    @yield('css')

</head>

<body>

    <div class="container-fluid content">

        @if(Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get("success")}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(Session::get('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{Session::get('warning')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{Session::get('error')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @yield('content')

    </div>

    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src="{{ url('js/popper.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.min.js') }}"></script>

    @yield('scripts')

</body>

</html>