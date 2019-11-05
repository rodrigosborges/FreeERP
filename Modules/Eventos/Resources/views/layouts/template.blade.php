<!DOCTYPE html>
<!-- Código php adicionado ao template pra não ter que ficar passando em todas as views -->
<?php
    $moduleInfo = [
        'icon' => 'event',
        'name' => 'Eventos',
    ];
    $menu = [
        ['icon' => 'home', 'tool' => 'Início', 'route' => route('eventos.index')],
        ['icon' => 'event', 'tool' => 'Eventos', 'route' => route('eventos.exibir')],
        ['icon' => 'people', 'tool' => 'Pessoas', 'route' => route('eventos.pessoas')],
        ['icon' => 'school', 'tool' => 'Certificados', 'route' => '#'],
    ];
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>FreeERP @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <!-- DataTables CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <style>
            #sidebar {
                background: #303e45;
                position: fixed;
                min-width: 210px;
                min-height: 100vh;
            }
            #sidebar a { color: #cfd8dc }
            #sidebar a:hover { background: #29353d }
            #sidebar a.active {
                color: #fff;
                background: #29353d;
            }
            #module-info {
                color: #fff;
                min-height: 64px;
                padding-left: 10px;
            }
            #module-info i { font-size: 36px; }
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
            .btn-circle:hover { background: #ededed; }
        </style>
        @yield('css')
    </head>
    <body>
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
                        <i class="material-icons mr-2 btn-circle">apps</i>
                        <a class="text-dark" href="{{url('/logout')}}"><i class="material-icons btn-circle">person</i></a>
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
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
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
        <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <!-- JQuery Mask Plugin -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        
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
        </script>
        
        <!-- Seleção do item do menu  -->
        <script>
            $(function () {
                $.when(
                    $('#sidebar a.nav-link span').each(function () {
                        switch ($(this).text().trim()) {
                            case 'Início':
                                $(this).parent('a').addClass('inicio');
                                break;
                            case 'Eventos':
                                $(this).parent('a').addClass('eventos');
                                break;
                            case 'Pessoas':
                                $(this).parent('a').addClass('pessoas');
                                break;
                            case 'Certificados':
                                $(this).parent('a').addClass('certificados');
                                break;
                        }
                    }))
                .done(function () {
                    switch ('{{ \Illuminate\Support\Facades\Route::currentRouteName() }}'.trim()) {
                        case 'eventos.index':
                            $('.inicio').addClass('active');
                            break;
                        case 'eventos.exibir':
                        case 'eventos.cadastrar':
                        case 'eventos.editar':
                        case 'programacao.exibir':
                        case 'programacao.cadastrar':
                            $('.eventos').addClass('active');
                            break;
                        case 'eventos.pessoas':
                        case 'pessoas.exibir':
                        case 'pessoas.cadastrar':
                        case 'pessoas.editar':    
                            $('.pessoas').addClass('active');
                            break;
                        case 'certificados.index':
                            $('.certificados').addClass('active');
                            break;
                    }
                });
            });
        </script>
        
        <!-- Máscara de telefone -->
        <script>
            <!-- Código disponível no site do jQuery Mask Plugin -->
            var SPMaskBehavior = function (val){
                return val.replace(/\D/g, '').length === 11 ? '(00)00000-0000' : '(00)0000-00009';
            },
            spOptions = {
                onKeyPress: function (val, e, field, options){
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };
            $(function() {
                $('[name=telefone]').mask(SPMaskBehavior, spOptions);
            });
        </script>
        
        <!-- Selects de estados e cidades -->
        <script type="text/javascript">
            $('select[name=estado]').change(function () {
                var idestado = $(this).val();
                buscarCidades(idestado);
            });

            function buscarCidades (idestado, idcidade){
                $.get('/eventos/get-cidades/' + idestado, function (cidades) {
                    $('select[name=cidade]').empty();
                    $.each(cidades, function (index, value) {
                        if(idcidade !== null){
                            if(idcidade === value.id)
                                $('select[name=cidade]').append('<option value=' + value.id + ' selected>' + value.nomeCidade + '</option>');
                            else
                                $('select[name=cidade]').append('<option value=' + value.id + '>' + value.nomeCidade + '</option>');
                        }else{
                            $('select[name=cidade]').append('<option value=' + value.id + '>' + value.nomeCidade + '</option>');
                        }
                    });
                });
            }
        </script>
        @yield('js')
    </body>
</html>