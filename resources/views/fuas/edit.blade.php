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
            <div class="panel-heading"><h3>EDITAR FUA <strong>({{$afiliado->afi_Dni}} - {{$afiliado->afi_Nombres}} {{$afiliado->afi_SegNombres}} {{$afiliado->afi_ApePaterno}} {{$afiliado->afi_ApeMaterno}} - {{$afiliado->historia}})</strong>
                <a class="btn btn-success btn-lg" href="../../fuas/create/{{$afiliado->id}}"> * Añadir FUA</a>
            </h3></div>
            <div class="panel-body">
                <div id="alertas"></div>
                <input type="hidden" name="id_afiliado" value="{{$fua->id_afiliado}}" id="id_afiliado">
                <input type="hidden" name="afi_Dni" value="{{$afiliado->afi_Dni}}" id="afi_Dni">

                <form action="{{ route('fuas.update', $fua->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>Numero de Formato:</strong>
                                <input type="text" name="fua_NumFormato" id="fua_NumFormato" class="form-control input-lg" style="color: red;" value="{{$fua->fua_NumFormato}}"disabled>
                                <small>SOLO el número en ROJO. Ejm: <span style="color: red">1007267</span></small>
                            </div>
                        </div>
                        <!--div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>Personal:</strong>
                                <select name="fua_profesional" class="form-control" @if($fua->estado == 2) disabled @endif>
                                    @if(!$users->isEmpty())
                                        @foreach ($users as $user)
                                            @if($user->id == $fua->fua_profesional)
                                                <option value="{{$user->id}}" selected>{{$user->name}} {{$user->lastname}}</option>
                                            @else
                                                <option value="{{$user->id}}">{{$user->name}} {{$user->lastname}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                <small>Profesional que figurara en el FUA</small>
                            </div>
                        </div-->
                        <div class="col-xs-7 col-sm-7 col-md-7">
                            <div class="form-group">
                                <strong>Codigo Prestacional:</strong>
                                <select name="fua_CodigoPrestacional" class="form-control input-lg" onchange="javascript:checkCP();" id="fua_CodigoPrestacional"  @if($fua->estado == 2) disabled @endif>
                                    <option value=""> -  SIN ASIGNAR - </option>
                                    @foreach ($CODPREST as $item)
                                        @if($fua->fua_CodigoPrestacional == $item->codigo)
                                            <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                        @else
                                            <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                        @endif
                                    @endforeach
                                    
                                </select>

                            </div>
                        </div>
                         <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong># Historia</strong>
                                <input name="afi_historia" class="form-control input-lg" id="afi_historia" value="{{$fua->afi_historia}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <strong>Personal que atiende</strong>
                                <select name="fua_Personal" class="form-control" @if($fua->estado == 2) disabled @endif>
                                    @foreach ($PERSONAL as $item)
                                        @if($fua->fua_Personal == $item->codigo)
                                            <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                        @else
                                            <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <strong>Lugar de Atención</strong>
                                <select name="fua_LugarDesc" class="form-control" @if($fua->estado == 2) disabled @endif>
                                    @foreach ($LUGATEN as $item)
                                        @if($fua->fua_LugarDesc == $item->codigo)
                                            <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                        @else
                                            <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <strong>Atención</strong>
                                <select name="fua_Atencion" class="form-control"@if($fua->estado == 2) disabled @endif>
                                    @foreach ($TIPOATEN as $item)
                                        @if($fua->fua_Atencion == $item->codigo)
                                            <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                        @else
                                            <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @if($afiliado->afi_IdSexo == 'F' || $afiliado->afi_IdSexo == '0')
                    <div class="row alert alert-info" id="panelSaludMaterna" @if($fua->fua_CodigoPrestacional != '009' && $fua->fua_CodigoPrestacional != '010' && $fua->fua_CodigoPrestacional != '011' && $fua->fua_CodigoPrestacional != '013') style="display: none;" @endif>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>SALUD MATERNA</strong>
                                <select name="fua_SaludMaterna" class="form-control"  id="fua_SaludMaterna" readonly>
                                    <option value="0">- NO -</option>
                                    @foreach ($MATERNA as $item)
                                        @if($fua->fua_SaludMaterna == $item->codigo)
                                            <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                        @else
                                            <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <strong>Fecha Probable de Parto / Fecha de Parto</strong>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker2" name="fua_fechaParto" value="{{$fua->fua_fechaParto}}" id="fua_fechaParto" onchange="javascript:enableBtnGuardar()" autocomplete= "off" @if($fua->estado == 2) disabled @endif>
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
                                    <input type="text" class="form-control datepicker" name="fua_fechaAtencion" value="{{$fua->fua_fechaAtencion}}" @if($fua->estado == 2) disabled @endif>
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
                                        <input type="number" class="form-control" name="fua_horaAtencion" min="0" max="23" value="{{$fua->fua_horaAtencion}}" @if($fua->estado == 2) disabled @endif>
                                        <small>HORA</small>
                                    </div>
                                    <div class="col-xs-6">
                                        <input type="number" class="form-control" name="fua_minAtencion" min="0" max="59" value="{{$fua->fua_minAtencion}}" @if($fua->estado == 2) disabled @endif>
                                        <small>MINUTO</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>Concepto Prestacional</strong>
                                <select name="fua_ConceptoPrestacional" class="form-control" @if($fua->estado == 2) disabled @endif>
                                    @foreach ($CONPREST as $item)
                                        @if($fua->fua_ConceptoPrestacional == $item->codigo)
                                            <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                        @else
                                            <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-3 col-sm-3 col-md-3">
                            <div class="form-group">
                                <strong>Destino asegurado</strong>
                                <select name="fua_DestinoAsegurado" class="form-control" @if($fua->estado == 2) disabled @endif>
                                    <option value=""> -  SIN ASIGNAR - </option>
                                    @foreach ($DESTASEG as $item)
                                        @if($fua->fua_DestinoAsegurado == $item->codigo)
                                            <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                        @else
                                            <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#actividades_preventivas" data-backdrop="static" data-keyboard="false">
                            Actividades Preventivas y Otros
                        </button>
                        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#vacunas_dosis" data-backdrop="static" data-keyboard="false">
                            Vacunas N° de Dosis
                        </button>
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#diagnosticos" data-backdrop="static" data-keyboard="false">
                            Diagnósticos <span class="badge badge-light" id="dx_count">{{$DXcount}}</span>
                        </button>



                    </div>
                    <hr width="98%"/>
                    <div class="row col-md-12">
                        @if($fua->estado == 1)
                            <button type="submit" class="btn btn-success btn-lg" id="btnGuardar">Guardar</button>
                            <a type="button" class="btn btn-danger btn-lg" href="{{ route('fua.close',$fua->id) }}">Cerrar FUA</a>
                        @endif
                        @if($fua->estado == 2)
                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#printFUA" data-backdrop="static" data-keyboard="false" onclick="javascript:printFUA()">IMPRIMIR
                            </button>
                        @endif
                    </div>

                    {{ csrf_field() }}
                </form>

            </div>
        </div>
    </div>
</div>








<!-- Modal -->
    <div class="modal fade" id="actividades_preventivas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document"  style="width: 1200px;">
            <div class="modal-content">
                <div class="modal-header modal-header-primary primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Actividades preventivas y otros</h4>
                </div>
                <div class="modal-body">
                    <form id="detailsAPO">
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>Peso</strong>
                                <input type="number" name="apo_peso" class="form-control" value="{{$fua->apo_peso}}" step="any" @if($fua->estado == 2) disabled @endif>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>Talla</strong>
                                <input type="number" name="apo_talla" class="form-control" value="{{$fua->apo_talla}}" step="any" @if($fua->estado == 2) disabled @endif>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>P.A.</strong>
                                <input type="text" name="apo_pa" class="form-control" value="{{$fua->apo_pa}}" @if($fua->estado == 2) disabled @endif>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>IMC</strong>
                                <input type="text" name="apo_imc" value="{{$fua->apo_imc}}"class="form-control" step="any">
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>IMC CALCULADO</strong>
                                <input type="text" value="{{$fua->apo_imc_c}}" class="form-control" step="any" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">GESTANTE</a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>CPN (N°)</strong>
                                            <input type="number" name="apo_1_cpn" class="form-control" value="{{$fua->apo_1_cpn}}" step="any" @if($fua->estado == 2) disabled @endif>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>Edad Gestacional</strong>
                                            <input type="number" name="apo_1_egest" class="form-control" value="{{$fua->apo_1_egest}}"step="any" @if($fua->estado == 2) disabled @endif>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>Altura Uterina</strong>
                                            <input type="text" name="apo_1_au" class="form-control" value="{{$fua->apo_1_au}}"step="any" @if($fua->estado == 2) disabled @endif>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>Parto Vertical</strong>
                                            <input type="text" name="apo_1_pv" class="form-control" value="{{$fua->apo_1_pv}}"step="any" @if($fua->estado == 2) disabled @endif>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>Control Puerpera (N°)</strong>
                                            <input type="text" name="apo_1_cp" class="form-control" value="{{$fua->apo_1_pv}}" step="any" @if($fua->estado == 2) disabled @endif>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">RECIEN NACIDO</a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>Edad Gest RN (SEM)</strong>
                                            <input type="number" name="apo_2_egest" class="form-control" value="{{$fua->apo_2_egest}}" step="any" @if($fua->estado == 2) disabled @endif>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>APGAR</strong>
                                            <input type="number" name="apo_2_apgar" class="form-control" value="{{$fua->apo_2_apgar}}" step="any" @if($fua->estado == 2) disabled @endif>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>Corte Tardio de Cordon</strong>
                                            <input type="text" name="apo_2_ctc" class="form-control" value="{{$fua->apo_2_ctc}}" step="any"@if($fua->estado == 2) disabled @endif>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                        GESTANTE/RN/NIÑO/ADOLESCENTE/JOVEN Y ADULTO/ADULTO MAYOR</a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong>CRED N°</strong>
                                                <input type="number" name="apo_3_cred" class="form-control" step="any" max="13" min="1" value="{{$fua->apo_3_cred}}" @if($fua->estado == 2) disabled @endif>
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong>R.N.Prematuro</strong>
                                                <select name="apo_3_prem" class="form-control" @if($fua->estado == 2) disabled @endif>
                                                    @foreach ($BIFURCA as $item)
                                                        @if($fua->apo_3_prem == $item->codigo)
                                                            <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                                        @else
                                                            <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong>Bajo peso al nacer</strong>
                                                <select name="apo_3_bpn" class="form-control" @if($fua->estado == 2) disabled @endif>
                                                    @foreach ($BIFURCA as $item)
                                                        @if($fua->apo_3_bpn == $item->codigo)
                                                            <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                                        @else
                                                            <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong>ENFER. CONGENITA</strong>
                                                <select name="apo_3_ec" class="form-control" @if($fua->estado == 2) disabled @endif>
                                                    @foreach ($BIFURCA as $item)
                                                        @if($fua->apo_3_ec == $item->codigo)
                                                            <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                                        @else
                                                            <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong># Fam. Gest.</strong>
                                                <input type="number" name="apo_3_fg" class="form-control" value="{{$fua->apo_3_fg}}" @if($fua->estado == 2) disabled @endif>
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong>PAB (cm)</strong>
                                                <input type="number" name="apo_3_pab" class="form-control" step="any" value="{{$fua->apo_3_pab}}" @if($fua->estado == 2) disabled @endif>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong>TAP / EEDP o TEPSI</strong>
                                                <select name="apo_3_tap" class="form-control" @if($fua->estado == 2) disabled @endif>
                                                    @foreach ($BIFURCA as $item)
                                                        @if($fua->apo_3_tap == $item->codigo)
                                                            <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                                        @else
                                                            <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong>Cons. Nutricional</strong>
                                                <select name="apo_3_cn" class="form-control" @if($fua->estado == 2) disabled @endif>
                                                    @foreach ($BIFURCA as $item)
                                                        @if($fua->apo_3_cn == $item->codigo)
                                                            <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                                        @else
                                                            <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong>Cons. Integral</strong>
                                                <select name="apo_3_ci" class="form-control" @if($fua->estado == 2) disabled @endif>
                                                    @foreach ($BIFURCA as $item)
                                                        @if($fua->apo_3_ci == $item->codigo)
                                                            <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                                        @else
                                                            <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                        JOVEN Y ADULTO</a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>Evaluación Integral</strong>
                                            <select name="apo_4_ei" class="form-control" @if($fua->estado == 2) disabled @endif>
                                                    @foreach ($BIFURCA as $item)
                                                        @if($fua->apo_4_ei == $item->codigo)
                                                            <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                                        @else
                                                            <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                        ADULTO MAYOR</a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>VACAM</strong>
                                            <select name="apo_5_vacam" class="form-control" @if($fua->estado == 2) disabled @endif>
                                                @foreach ($BIFURCA as $item)
                                                    @if($fua->apo_5_vacam == $item->codigo)
                                                        <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                                    @else
                                                        <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Tamizaje de Salud Mental</strong>
                                            <select name="apo_5_tsm" class="form-control" @if($fua->estado == 2) disabled @endif>
                                                @foreach ($MENTAL as $item)
                                                    @if($fua->apo_5_tsm == $item->codigo)
                                                        <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                                    @else
                                                        <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


                </div>
                <div class="modal-footer">
                    @if($fua->estado == 2)
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    @else
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="javascript:saveAPO()" >Guardar</button>
                    @endif

                </div>
            </div>
        </div>
    </div>
<div class="modal fade" id="vacunas_dosis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document"  style="width: 1200px;">
        <div class="modal-content">
            <div class="modal-header modal-header-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Vacunas N° de Dosis</h4>
            </div>
            <div class="modal-body">
                <form id="vacunas">
                <div class="row">
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>BCG</strong>
                            <input type="number" name="vac_BCG" class="form-control"  value="{{$fua->vac_BCG}}" @if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>DPT</strong>
                            <input type="number" name="vac_DPT" class="form-control" value="{{$fua->vac_DPT}}" @if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>APO</strong>
                            <input type="number" name="vac_APO" class="form-control" value="{{$fua->vac_APO}}" @if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>ASA</strong>
                            <input type="number" name="vac_ASA" class="form-control" value="{{$fua->vac_ASA}}" @if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>SPR</strong>
                            <input type="number" name="vac_SPR" class="form-control" value="{{$fua->vac_SPR}}" @if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>SR</strong>
                            <input type="number" name="vac_SR" class="form-control"/ value="{{$fua->vac_SR}}" @if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>HVB</strong>
                            <input type="number" name="vac_HVB" class="form-control" value="{{$fua->vac_HVB}}" @if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>INFLUENZA</strong>
                            <input type="number" name="vac_INF" class="form-control" value="{{$fua->vac_INF}}"@if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>PAROTID</strong>
                            <input type="number" name="vac_PAR" class="form-control" value="{{$fua->vac_PAR}}"@if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>RUBEOLA</strong>
                            <input type="number" name="vac_RUB" class="form-control" value="{{$fua->vac_RUB}}" @if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>ROTAVIRUS</strong>
                            <input type="number" name="vac_ROT" class="form-control" value="{{$fua->vac_ROT}}" @if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>DT Adulto</strong>
                            <input type="number" name="vac_DT" class="form-control" value="{{$fua->vac_DT}}" @if($fua->estado == 2) disabled @endif>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>IPV</strong>
                            <input type="number" name="vac_IPV" class="form-control" value="{{$fua->vac_IPV}}" @if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>PENTAVAL</strong>
                            <input type="number" name="vac_PEN" class="form-control" value="{{$fua->vac_PEN}}" @if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>ANTIAMARILICA</strong>
                            <input type="number" name="vac_AAM" class="form-control" value="{{$fua->vac_AAM}}" @if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>ANTINEUMOC</strong>
                            <input type="number" name="vac_ANE" class="form-control" value="{{$fua->vac_ANE}}" @if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>ANTITETANICA</strong>
                            <input type="number" name="vac_ATE" class="form-control" value="{{$fua->vac_ATE}}" @if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>COMP. PARA EDAD</strong>
                            <select name="vac_CED" class="form-control" @if($fua->estado == 2) disabled @endif>
                                @foreach ($BIFURCA as $item)
                                    @if($fua->vac_CED == $item->codigo)
                                        <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                    @else
                                        <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>VPH</strong>
                            <input type="number" name="vac_VPH" class="form-control" value="{{$fua->vac_VPH}}" @if($fua->estado == 2) disabled @endif/>
                        </div>
                    </div>
                    <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="form-group">
                            <strong>OTRA VACUNA</strong>
                            <input type="text" name="vac_OV" class="form-control" value="{{$fua->vac_OV}}" @if($fua->estado == 2) disabled @endif/></div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>GRUPO DE RIESGO HVB</strong>
                            <select name="vac_GRHVB" class="form-control" @if($fua->estado == 2) disabled @endif>
                                @foreach ($BIFURCA as $item)
                                    @if($fua->vac_CED == $item->codigo)
                                        <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                    @else
                                        <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                 @if($fua->estado == 2)
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                @else
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="javascript:saveVAC()">Guardar</button>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="diagnosticos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document"  style="width: 1200px;">
        <div class="modal-content">
            <div class="modal-header modal-header-info">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Diagnósticos</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                     @if($fua->estado != 2)

                    <div class="col-xs-6">
                        <fieldset>
                            <legend>Búsqueda</legend>
                            <input class="form-control input-lg" name="diag" id="keyword_dx" onkeyup="javascript:buscarDx()" />
                            <div style="height: 300px; border:1px solid #CCC; overflow-y: scroll; margin-top: 10px;" id="lista"></div>


                        </fieldset>
                    </div>
                    @endif

                     
                    @if($fua->estado == 2)
                        <div class="col-xs-12">
                    @else
                        <div class="col-xs-6">
                    @endif
                        <fieldset>
                            <legend>Seleccionados</legend>
                        </fieldset>
                        
                        <form id="selectedDx">
                            <input id="controlDx" name="controlDx" type="hidden" value="{{$fua->controlDx}}">
                            <div id="seleccionados">
                                    @foreach($DX as $d)
                                    <div class='row' id='regDx{{$d->id}}'>
                                        <div class='col-sm-2'>
                                            <select class='form-control' name='classDx[]' @if($fua->estado == 2) disabled @endif>
                                                @foreach ($CLASEDX as $item)
                                                    @if($d->clase == $item->codigo)
                                                        <option value="{{$item->codigo}}" selected>{{$item->valor}}</option>
                                                    @else
                                                        <option value="{{$item->codigo}}">{{$item->valor}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class='col-sm-2'>{{$d->codigo}}</div>
                                        <div class='col-sm-6'>
                                            <input type='hidden' name='codDx[]' value='{{$d->dxid}}'/>{{$d->descripcion}}
                                        </div>
                                        
                                        @if($fua->estado != 2)
                                        <div class='col-sm-1'><a href='javascript:removeDx({{$d->id}})' class='btn btn-danger'>
                                            <span class='glyphicon-minus'></span></a></div>
                                        @endif
                                        <hr width='100%'/>
                                    </div>
                                    @endforeach
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                 @if($fua->estado == 2)
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                @else
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="javascript:saveDx()">Guardar</button>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="printFUA" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document"  style="width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Imprimir</h4>
            </div>
            <div class="modal-body" id="consolaPRINT">
            </div>
                
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="cadenaPeticion" value="afi_depa={{$afiliado->afi_depa}}&afi_prov={{$afiliado->afi_prov}}&afi_dist={{$afiliado->afi_dist}}&pre_CodEjeAdm={{$afiliado->pre_CodEjeAdm}}&afi_IdEESSAte={{$afiliado->afi_IdEESSAte}}&pre_Nombre={{$afiliado->pre_Nombre}}&afi_IdDisa={{$afiliado->afi_IdDisa}}&afi_IdDistrito={{$afiliado->afi_IdDistrito}}&afi_TipoFormato={{$afiliado->afi_TipoFormato}}&afi_NroFormato={{$afiliado->afi_NroFormato}}&afi_IdTipoDocumento={{$afiliado->afi_IdTipoDocumento}}&afi_Dni={{$afiliado->afi_Dni}}&afi_FecFormato={{$afiliado->afi_FecFormato}}&afi_ApePaterno={{$afiliado->afi_ApePaterno}}&afi_ApeMaterno={{$afiliado->afi_ApeMaterno}}&afi_Nombres={{$afiliado->afi_Nombres}}&afi_SegNombre={{$afiliado->afi_SegNombre}}&afi_IdSexo={{$afiliado->afi_IdSexo}}&afi_FecNac={{$afiliado->afi_FecNac}}&fechaActual={{$afiliado->fechaActual}}&edad={{$afiliado->edad}}&afi_IdEstado={{$afiliado->afi_IdEstado}}&afi_FecBaja={{$afiliado->afi_FecBaja}}&historia={{$afiliado->historia}}&fua_NumFormato={{$fua->fua_NumFormato}}&fua_CodigoPrestacional={{$fua->fua_CodigoPrestacional}}&id_afiliado={{$fua->id_afiliado}}&fua_Personal={{$fua->fua_Personal}}&fua_Lugar={{$fua->fua_Lugar}}&fua_LugarDesc={{$fua->fua_LugarDesc}}&fua_Atencion={{$fua->fua_Atencion}}&fua_fechaAtencion={{$fua->fua_fechaAtencion}}&fua_horaAtencion={{$fua->fua_horaAtencion}}&fua_minAtencion={{$fua->fua_minAtencion}}&fua_ConceptoPrestacional={{$fua->fua_ConceptoPrestacional}}&fua_DestinoAsegurado={{$fua->fua_DestinoAsegurado}}&fua_SaludMaterna={{$fua->fua_SaludMaterna}}&fua_fechaParto={{$fua->fua_fechaParto}}&fua_peso={{$fua->fua_peso}}&fua_talla={{$fua->fua_talla}}&fua_imc={{$fua->fua_imc}}&fua_profesional={{$fua->fua_profesional}}&apo_peso={{$fua->apo_peso}}&apo_talla={{$fua->apo_talla}}&apo_pa={{$fua->apo_pa}}&apo_imc={{$fua->apo_imc}}&apo_1_cpn={{$fua->apo_1_cpn}}&apo_1_egest={{$fua->apo_1_egest}}&apo_1_au={{$fua->apo_1_au}}&apo_1_pv={{$fua->apo_1_pv}}&apo_1_cp={{$fua->apo_1_cp}}&apo_2_egest={{$fua->apo_2_egest}}&apo_2_apgar={{$fua->apo_2_apgar}}&apo_2_ctc={{$fua->apo_2_ctc}}&apo_3_cred={{$fua->apo_3_cred}}&apo_3_prem={{$fua->apo_3_prem}}&apo_3_bpn={{$fua->apo_3_bpn}}&apo_3_ec={{$fua->apo_3_ec}}&apo_3_fg={{$fua->apo_3_fg}}&apo_3_pab={{$fua->apo_3_pab}}&apo_3_tap={{$fua->apo_3_tap}}&apo_3_cn={{$fua->apo_3_cn}}&apo_3_ci={{$fua->apo_3_ci}}&apo_4_ei={{$fua->apo_4_ei}}&apo_5_vacam={{$fua->apo_5_vacam}}&apo_5_tsm={{$fua->apo_5_tsm}}&vac_BCG={{$fua->vac_BCG}}&vac_DPT={{$fua->vac_DPT}}&vac_APO={{$fua->vac_APO}}&vac_ASA={{$fua->vac_ASA}}&vac_SPR={{$fua->vac_SPR}}&vac_SR={{$fua->vac_SR}}&vac_HVB={{$fua->vac_HVB}}&vac_INF={{$fua->vac_INF}}&vac_PAR={{$fua->vac_PAR}}&vac_RUB={{$fua->vac_RUB}}&vac_ROT={{$fua->vac_ROT}}&vac_DT={{$fua->vac_DT}}&vac_IPV={{$fua->vac_IPV}}&vac_PEN={{$fua->vac_PEN}}&vac_AAM={{$fua->vac_AAM}}&vac_ANE={{$fua->vac_ANE}}&vac_ATE={{$fua->vac_ATE}}&vac_CED={{$fua->vac_CED}}&vac_VPH={{$fua->vac_VPH}}&vac_OV={{$fua->vac_OV}}&vac_GRHVB={{$fua->vac_GRHVB}}&controlDx={{$fua->controlDx}}&estado={{$fua->estado}}&prof_name={{$PROFESIONAL->name}}&prof_lastname={{$PROFESIONAL->lastname}}&prof_especialidad={{$PROFESIONAL->especialidad}}&prof_colegiatura={{$PROFESIONAL->colegiatura}}&prof_dni={{$PROFESIONAL->dni}}&strDX={{$strDX}}"/>






<script>
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        language: "es",
        autoclose: true,
        todayHighlight: true,
        //startDate: "today",
    });
    $('.datepicker2').datepicker({
        format: "yyyy-mm-dd",
        language: "es",
        autoclose: true,
        todayHighlight: true    
    });

    function buscarDx(){

        if($("#keyword_dx").val().length >= 3){
            $("#lista").html("Cargando...");
            $.ajax({
                type: 'GET',
                url: '/api/diag/'+$("#keyword_dx").val(),
                dataType: 'json',
                success: function (data){
                    if(data != ""){
                        var str = "<table class='table table-striped'>";
                        $.each(data, function(index, element) {
                            str += "<tr>";
                            str += "<td class='col-sm-1'>"+element.codigo+"</td>";
                            str += "<td class='col-sm-10'>"+element.descripcion+"</td>";
                            str += "<td class='col-sm-1'><a href='javascript:seleccionarDx("+element.id+")' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-plus'></span></a></td>";
                            str += "</tr>";
                        });
                        str += "</table>";
                        $("#lista").html(str);
                    }else{
                        $("#lista").html("Sin resultados.");
                    }
                }
            });
        }else{
            $("#lista").html("Escriba almenos 3 carácteres.");
        }
    }

    function removeDx(id){
        var control = JSON.parse("[" + $("#controlDx").val() + "]");
        control.splice(control.indexOf(id),1);
        $("#dx_count").html(control.length);
        $("#controlDx").val(control.toString());
        $("#regDx"+id).remove();
    }
    function seleccionarDx(id){
        var control = JSON.parse("[" + $("#controlDx").val() + "]");
        if(control.length < 5){
            if(!control.includes(id)){
                control.push(id);
                $("#controlDx").val(control.toString());
                $.ajax({
                    type: 'GET',
                    url: '/api/dx/'+id,
                    dataType: 'json',
                    success: function (data){
                        str = "<div class='row' id='regDx"+id+"'>";
                        str += "<div class='col-sm-2'>";
                        str += "<select class='form-control' name='classDx[]'>";
                        str += "<option value='1'>P</option>";
                        str += "<option value='2'>D</option>";
                        str += "<option value='3'>R</option>";
                        str += "</select></div>";
                        str += "<div class='col-sm-2'>"+data.codigo+"</div>";
                        str += "<div class='col-sm-6'><input type='hidden' name='codDx[]' value='"+id+"'/>"+data.descripcion+"</div>";
                        str += "<div class='col-sm-2'><a href='javascript:removeDx("+id+")' class='btn btn-danger'><span class='glyphicon glyphicon-minus'></span></a></div>";
                        str += "<hr width='100%'/>"

                        str += "</div>";
                        $("#seleccionados").append(str);
                    }
                });

                $("#dx_count").html(control.length);
            }else{
                alert("Dx ya ha sido seleccionado");
            }
        }else{
            alert("Solo puede seleccionar 05 Dx.");
        }
    }

    function saveDx(){
        var peticion = $("#selectedDx").serialize();
        //alert(peticion);
        if(peticion != ""){
             $.ajax({
                    type: 'GET',
                    url: '/api/saveDx/{{$fua->id}}',
                    data: peticion,
                    dataType: 'json',
                    success: function (data){
                    }
                });
             $("#diagnosticos").modal("hide");
        }else{
            alert("Debe de seleccionar Dx");
        }
    }

    function saveAPO(){
        var peticion = $("#detailsAPO").serialize();
        
        $.ajax({
            type: 'GET',
            url: '/api/saveAPO/{{$fua->id}}',
            data: peticion,
            dataType: 'json',
            success: function (data){
            }
        });
         $("#actividades_preventivas").modal("hide");
    }

    function saveVAC(){
        var peticion = $("#vacunas").serialize();
        console.info(peticion);
        $.ajax({
            type: 'GET',
            url: '/api/saveVAC/{{$fua->id}}',
            data: peticion,
            dataType: 'json',
            success: function (data){
            }
        });
         $("#vacunas_dosis").modal("hide");
    }


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

    function printFUA(){

        
        var iframe = "<iframe src='http://localhost/cipreportes/plantilla.php?"+$("#cadenaPeticion").val()+"' frameborder='0' width='100%'></iframe>";

        $("#consolaPRINT").html(iframe);
        /*        
        $.ajax({
            type: 'GET',
            url: 'http://localhost/cipreportes/plantilla.php',
            dataType: 'json',
            success: function (data){
                $("#consolaPRINT").html(data);
            }
        });*/
    }
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