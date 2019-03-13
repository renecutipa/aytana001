<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min_b.css')}}" crossorigin="anonymous">
    <!--link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}" crossorigin="anonymous"-->
    
    <script src="{{asset('js/jquery-1.11.3.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" crossorigin="anonymous"></script>
    <!-- Jquery -->
    
    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker.standalone.css')}}">
    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
    <!-- Languaje -->
    <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>

</head>
<body>
<div id="app">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{route('home')}}">FUAs ABIERTOS</a></li>
                    <li><a href="{{route('buscarAfiliado')}}">BUSCAR AFILIADO</a></li>
                    <li><a href="{{route('buscarFUA')}}">BUSCAR FUA</a></li>
                    <!--li><a href="#">CAMBIAR FUA</a></li-->
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <!--li><a href="{{ route('register') }}">Register</a></li-->
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="container">
    <div class="content">

        <div class="panel panel-primary">
            <div class="panel-heading"><h3>Abrir FUA <strong>({{$afiliado->afi_Dni}} - {{$afiliado->afi_Nombres}} {{$afiliado->afi_SegNombres}} {{$afiliado->afi_ApePaterno}} {{$afiliado->afi_ApeMaterno}})</strong></h3></div>
            <div class="panel-body">
                <div id="alertas"></div>
                <form action="{{ route('fuas.store') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_afiliado" value="{{$afiliado->id}}" id="id_afiliado">
                    <input type="hidden" name="afi_Dni" value="{{$afiliado->afi_Dni}}" id="afi_Dni">
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>Numero de Formato:</strong>
                                <input type="text" name="fua_NumFormato" id="fua_NumFormato" class="form-control input-lg" style="color: red;" onchange="javascript:enableBtnGuardar()" autocomplete="off">
                                <small>SOLO el número en ROJO. Ejm: <span style="color: red">1007267</span></small>
                            </div>
                        </div>
                        <!--div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>Personal:</strong>
                                <select name="fua_profesional" class="form-control">
                                    @if(!$users->isEmpty())
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}} {{$user->lastname}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small>Profesional que figurara en el FUA</small>
                            </div>
                        </div-->
                        <div class="col-xs-7 col-sm-7 col-md-7">
                            <div class="form-group"
                                <strong>Codigo Prestacional:</strong>
                                <select name="fua_CodigoPrestacional" class="form-control input-lg" id="fua_CodigoPrestacional" onchange="javascript:checkCP();">
                                    <option value=""> -  SIN ASIGNAR - </option>
                                    @foreach ($CODPREST as $item)
                                        <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                    @endforeach
                                    
                                </select>

                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong># Historia</strong>
                                <input name="afi_historia" class="form-control input-lg" id="afi_historia" value="{{$afiliado->historia}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <strong>Personal que atiende</strong>
                                <select name="fua_Personal" class="form-control">
                                    @foreach ($PERSONAL as $item)
                                        <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <strong>Lugar de Atención</strong>
                                <select name="fua_LugarDesc" class="form-control">
                                    @foreach ($LUGATEN as $item)
                                        <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                        @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <strong>Atención</strong>
                                <select name="fua_Atencion" class="form-control">
                                    @foreach ($TIPOATEN as $item)
                                        <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @if($afiliado->afi_IdSexo == 'F' || $afiliado->afi_IdSexo == '0')
                    <div class="row alert alert-info" id="panelSaludMaterna" style="display: none;">
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>SALUD MATERNA</strong>
                                <select name="fua_SaludMaterna" class="form-control" id="fua_SaludMaterna" readonly>
                                    <option value="0">- NO -</option>
                                    @foreach ($MATERNA as $item)
                                            <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <strong>Fecha Probable de Parto / Fecha de Parto</strong>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker2" name="fua_fechaParto" id="fua_fechaParto" onchange="javascript:enableBtnGuardar()" autocomplete= "off">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>Fecha de Atención</strong>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" name="fua_fechaAtencion" autocomplete= "off">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>Hora de Atención</strong>
                                <div class="input-group">
                                    <div class="col-xs-6">
                                        <input type="number" class="form-control" name="fua_horaAtencion" min="0" max="23">
                                        <small>HORA</small>
                                    </div>
                                    <div class="col-xs-6">
                                        <input type="number" class="form-control" name="fua_minAtencion" min="0" max="59"
                                        <small>MINUTO</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>Concepto Prestacional</strong>
                                <select name="fua_ConceptoPrestacional" class="form-control">
                                    @foreach ($CONPREST as $item)
                                        <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>Destino asegurado</strong>
                                <select name="fua_DestinoAsegurado" class="form-control">
                                    <option value=""> -  SIN ASIGNAR - </option>
                                    @foreach ($DESTASEG as $item)
                                        <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr width="98%"/>
                    <div class="row col-md-12">
                            <button type="submit" class="btn btn-success btn-lg" id="btnGuardar" disabled="true">Guardar</button>
                    </div>

                    {{ csrf_field() }}
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        language: "es",
        autoclose: true,
        todayHighlight: true,
        startDate: "today",
    });
    $('.datepicker2').datepicker({
        format: "yyyy-mm-dd",
        language: "es",
        autoclose: true,
        todayHighlight: true
    });

// INICIO ACCIONES DE CODIGO PRESTACIONAL
    function checkCP(){
        setSaludMaterna();
        $.ajax({
                type: 'GET',
                url: '/api/cp/'+$("#id_afiliado").val()+'/'+$("#fua_CodigoPrestacional").val(),
                dataType: 'json',
                success: function (data){
                    if(data.estado == "error"){
                        $('#btnGuardar').prop('disabled', true);
                        $("#alertas").html("<div class='alert alert-danger'> <strong>ERROR: </strong>"+data.mensaje+"</div>");
                       
                    }
                    else{
                        $("#alertas").html("");
                        $('#btnGuardar').prop('disabled', false);
                    }
                }
            });
    }
    // FIN ACCIONES DE CODIGO PRESTACIONAL

function setSaludMaterna(){
    if($('#fua_CodigoPrestacional').val() == '009' || $('#fua_CodigoPrestacional').val() == '010' || $('#fua_CodigoPrestacional').val() == '011' || $('#fua_CodigoPrestacional').val() == '013'){
        $("#panelSaludMaterna").show();

        if($('#fua_CodigoPrestacional').val() == '009' || $('#fua_CodigoPrestacional').val() == '011' || $('#fua_CodigoPrestacional').val() == '013'){
            $("#fua_SaludMaterna").val('001');
        }
        if($('#fua_CodigoPrestacional').val() == '010'){
            $("#fua_SaludMaterna").val('002');
        }

        $('#btnGuardar').prop('disabled', true);

    }else{
        $("#panelSaludMaterna").hide();
        $('#btnGuardar').prop('disabled', false);
    }
}

function enableBtnGuardar(){
    if($('#fua_NumFormato').val() != ""){
        $('#btnGuardar').prop('disabled', false);
    }    
}

</script>
</body>
</html>