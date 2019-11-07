<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>FreeERP @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        #sidebar {
            background: #303e45;
            position: fixed;
            min-width: 210px;
            min-height: 100vh;
        }

        #sidebar a {
            color: #cfd8dc
        }

        #sidebar a:hover {
            background: #29353d
        }

        #sidebar a.active {
            color: #fff;
            background: #29353d;
        }

        #module-info {
            color: #fff;
            min-height: 64px;
            padding-left: 10px;
        }

        #module-info i {
            font-size: 36px;
        }

        #module-info h1 {
            max-width: 100px;
            font-size: 18px;
            margin: 0;
        }

        #workspace {
            width: 100%;
            margin-left: 210px;
            background: #f3f6f7;
        }

        #header {
            z-index: 99;
            width: calc(100% - 210px);
            background: #fff;
            position: fixed;
            padding: 0 16px;
            height: 64px;
            color: #5f6368;
        }

        #content {
            margin-top: 64px;
            padding: 16px;
            min-height: calc(100vh - 128px);
        }

        #footer {
            color: #5f6368;
            height: 64px;
            padding-left: 16px;
            border-top: 1px solid #cfd8dc;
        }

        .btn-circle {
            border-radius: 50%;
            cursor: pointer;
            padding: 10px;
        }

        .btn-circle:hover {
            background: #ededed;
        }

        #notificacoes {
            z-index: 100;
            margin-top: 64px;
            background-color: #FFF;
            display: none;
            position: absolute;
            top: 0;
            right: 0;
            font-size: small;
            border-radius: 0 0 10px 10px;
            color: #5f6368;
        }

        #notificacoes ul {
            padding: 5px 15px 0 15px;
            margin: 0;
            list-style-type: none;
        }

        #notificacoes ul li {
            margin-bottom: 10px;
        }

        #notificacoes ul li a {
            margin-left: 10px;
        }

        .badge-notifications {
            position: relative;
            top: -20px;
            left: -20px;
        }

        #notificacao:hover {
            text-decoration: none;
        }
    </style>
    @yield('css')
</head>
<body>
<div id="notificacoes" class="shadow-sm">
    <ul>
        @foreach(auth()->user()->unreadNotifications as $notificacao)
            <li>
                @if($notificacao->type == 'Modules\Calendario\Notifications\NotificarConviteParaEvento' && \Modules\Calendario\Entities\Convite::where('id', $notificacao->data['convite_id'])->count() > 0)
                    <a href="{{route('convites.ver', \Modules\Calendario\Entities\Convite::find($notificacao->data['convite_id'])->id)}}">
                        {{\Modules\Calendario\Entities\Convite::find($notificacao->data['convite_id'])->evento->agenda->funcionario->nome}}
                        convidou você para um evento.
                    </a>
                    <a href="#" class="float-right">X</a>
                @endif

            </li>
        @endforeach
    </ul>
</div>
<div class="d-flex">
    <div id="sidebar">
        <div class="shadow-sm d-flex align-items-center" id="module-info">
            <i class="material-icons mr-2">{{$moduleInfo['icon']}}</i>
            <h1>{{$moduleInfo['name']}}</h1>
        </div>
        <nav class="nav flex-column">
            @foreach ($menu as $item)
                <a class="nav-link d-flex align-items-center" href="{{$item['route']}}">
                    <i class="material-icons mr-2">{{$item['icon']}}</i>
                    <span> {{$item['tool']}} </span>
                </a>
            @endforeach
        </nav>
    </div>
    <div class="d-flex flex-column" id="workspace">
        <div class="shadow-sm d-flex align-items-center justify-content-between" id="header">
            <div class="d-flex align-items-center">
                <i class="material-icons mr-2 btn-circle" onclick="toggleMenu()">menu</i>
                <span>Menu</span>
            </div>
            <div class="d-flex align-items-center">
                <a href="#" id="notificacao">
                    <i class="material-icons btn-circle">notifications</i>
                    <span class="badge badge-pill badge-secondary badge-notifications">
                        {{auth()->user()->unreadNotifications->count()}}
                    </span>
                </a>
                <i class="material-icons mr-2 btn-circle">apps</i>
                <a href="{{route('logout')}}">
                    <i class="material-icons btn-circle">person</i>{{\Modules\Calendario\Entities\Funcionario::where('user_id', auth()->id())->first()->nome}}
                </a>
            </div>
        </div>
        <div id="content">
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
        <div class="d-flex align-items-center" id="footer">
            Desenvolvido por IFSP Caraguatatuba &copy
        </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Toggle Menu Script -->
<script>
    function toggleMenu() {
        var sidebar = document.getElementById('sidebar');
        var workspace = document.getElementById('workspace');
        var header = document.getElementById('header');

        var displaySidebar = sidebar.style.display === "none" ? "block" : "none";
        var marginLeftWorkspace = workspace.style.marginLeft === "0px" ? "210px" : "0px";
        var widthHeader = header.style.width === "100%" ? "calc(100% - 210px)" : "100%";

        sidebar.style.display = displaySidebar;
        workspace.style.marginLeft = marginLeftWorkspace;
        header.style.width = widthHeader;
    }

    $(function () {
        if ('{{auth()->user()->unreadNotifications->count()}}' > 0) {
            $('#notificacao').click(function (e) {
                $('#notificacoes').toggle();
            });
        }
    });
</script>
@yield('js')
</body>
</html>
