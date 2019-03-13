@extends('fuas.layout')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h3>Editar FUA <strong>({{$afiliado->afi_Dni}} - {{$afiliado->afi_Nombres}} {{$afiliado->afi_SegNombres}} {{$afiliado->afi_ApePaterno}} {{$afiliado->afi_ApeMaterno}} - {{$afiliado->historia}})</strong></h3></div>

                    <div class="panel-body">
                    <!--div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('fuas.index') }}"> Atrás</a>
                            </div>
                        </div>
                    </div-->

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('fuas.update', $fua->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Numero de Formato:</strong>
                                        <input type="text" name="fua_NumFormato" class="form-control input-lg" style="color: red;" value="{{$fua->fua_NumFormato}}"disabled>
                                        <small>SOLO el número en ROJO. Ejm: <span style="color: red">1007267</span></small>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Personal:</strong>
                                        <select name="fua_profesional" class="form-control input-lg">
                                            @if(!$users->isEmpty())
                                                @foreach ($users as $user)
                                                    @if($user->id == $fua->fua_profesional)
                                                        <option value="{{$user->id}}">{{$user->name}} {{$user->lastname}}</option>
                                                    @else
                                                        <option value="{{$user->id}}">{{$user->name}} {{$user->lastname}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        <small>Se asignara el profesional que figurara en el FUA</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Código RENAES</strong>
                                        <input type="text" name="autores" class="form-control input-lg" value="3010" disabled>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Nombre de la IPRESS</strong>
                                        <input type="text" name="autores" class="form-control input-lg" value="AMPATIRI" disabled>
                                    </div>
                                </div>

                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong>Personal que atiende</strong>
                                        <select name="fua_Personal" class="form-control input-lg">
                                            <option value="1">DE LA IPRESS</option>
                                            <option value="2">ITINERANTE</option>
                                            <option value="3">OFERTA FLEXIBLE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong>Lugar de Atención</strong>
                                        <select name="fua_Lugar" class="form-control input-lg">
                                            <option value="1">INTRAMURAL</option>
                                            <option value="2">EXTRAMURAL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong>Atención</strong>
                                        <select name="fua_Atencion" class="form-control input-lg">
                                            <option value="1">AMBULATORIA</option>
                                            <option value="2">REFERENCIA</option>
                                            <option value="3">EMERGENCIA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Concepto Prestacional</strong>
                                        <select name="fua_ConceptoPrestacional" class="form-control input-lg">
                                            <option value="1">ATENCIÓN DIRECTA</option>
                                            <option value="2">TRASLADO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Destino asegurado</strong>
                                        <select name="fua_DestinoAsegurado" class="form-control input-lg">
                                            <option value="1">CITA</option>
                                            <option value="2">ALTA</option>
                                            <option value="3" disabled>HOSPITALIZACIÓN</option>
                                        </select>
                                    </div>
                                </div>
                                <hr width="80%" />
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong>Peso</strong>
                                        <input type="number" name="fua_peso" class="form-control input-lg" value="{{$fua->fua_peso}}" step="any">
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong>Talla</strong>
                                        <input type="number" name="fua_talla" class="form-control input-lg" value="{{$fua->fua_talla}}" step="any">
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <strong>IMC</strong>
                                        <input type="text" name="autores" class="form-control input-lg" value="{{$fua->fua_imc}}" step="any" disabled>
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    @if($fua->estado == 1)
                                        <button type="submit" class="btn btn-success btn-lg">Guardar</button>
                                        <a type="button" class="btn btn-danger btn-lg" href="{{ route('fua.close',$fua->id) }}">Cerrar FUA</a>
                                    @endif
                                    @if($fua->estado == 2)
                                        <a type="button" class="btn btn-info btn-lg" href="#">IMPRIMIR</a>
                                    @endif
                                </div>

                            </div>

                            {{ csrf_field() }}
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#actividades_preventivas" data-backdrop="static" data-keyboard="false">
        Actividades Preventivas y Otros
    </button>
    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#vacunas_dosis" data-backdrop="static" data-keyboard="false">
        Vacunas N° de Dosis
    </button>
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#diagnosticos" data-backdrop="static" data-keyboard="false">
        Diagnósticos
    </button>

    <!-- Modal -->
    <div class="modal fade" id="actividades_preventivas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document"  style="width: 1200px;">
            <div class="modal-content">
                <div class="modal-header modal-header-primary primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Actividades preventivas y otros</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>Peso</strong>
                                <input type="number" name="fua_peso" class="form-control" value="{{$fua->fua_peso}}" step="any">
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>Talla</strong>
                                <input type="number" name="fua_talla" class="form-control" value="{{$fua->fua_talla}}" step="any">
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>P.A.</strong>
                                <input type="number" name="fua_talla" class="form-control" value="{{$fua->fua_talla}}" step="any">
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>IMC</strong>
                                <input type="text" name="imc" class="form-control" value="{{$fua->fua_imc}}" step="any" disabled>
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
                                            <input type="number" name="fua_peso" class="form-control" step="any">
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>Edad Gestacional</strong>
                                            <input type="number" name="fua_talla" class="form-control" step="any">
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>Altura Uterina</strong>
                                            <input type="text" name="imc" class="form-control" step="any">
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>Parto Vertical</strong>
                                            <input type="text" name="imc" class="form-control" step="any">
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>Control Puerpera (N°)</strong>
                                            <input type="text" name="imc" class="form-control" step="any">
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
                                            <input type="number" name="fua_peso" class="form-control" step="any">
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>APGAR</strong>
                                            <input type="number" name="fua_talla" class="form-control" step="any">
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            <strong>Corte Tardio de Cordon</strong>
                                            <input type="text" name="imc" class="form-control" step="any">
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
                                                <input type="number" name="cred_num" class="form-control" step="any" max="13" min="1">
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong>R.N.Prematuro</strong>
                                                <input type="checkbox" name="rn_prematuro" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong>Bajo peso al nacer</strong>
                                                <input type="checkbox" name="bajo_peso" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong>ENFER. CONGENITA</strong>
                                                <input type="checkbox" name="enf_congenita" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong># Fam. Gest.</strong>
                                                <input type="number" name="num_fam_gest" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong>PAB (cm)</strong>
                                                <input type="number" name="pab_cm" class="form-control" step="any">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong>TAP / EEDP o TEPSI</strong>
                                                <input type="checkbox" name="tap_eedp_tepsi" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong>Cons. Nutricional</strong>
                                                <input type="checkbox" name="cons_nutricional" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-2">
                                            <div class="form-group">
                                                <strong>Cons. Integral</strong>
                                                <input type="checkbox" name="cons_integral" class="form-control">
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
                                            <input type="checkbox" name="cons_integral" class="form-control">
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
                                            <input type="checkbox" name="cons_integral" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Tamizaje de Salud Mental</strong>
                                            <select class="form-control" name="salud_mental">
                                                <option value="0">- NINGUNO -</option>
                                                <option value="PAT">PAT.</option>
                                                <option value="NOR">NOR.</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
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
                    <div class="row">
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>BCG</strong>
                                <input type="number" name="vac_bcg" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>DPT</strong>
                                <input type="number" name="vac_dpt" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>APO</strong>
                                <input type="number" name="vac_apo" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>ASA</strong>
                                <input type="number" name="vac_asa" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>SPR</strong>
                                <input type="number" name="vac_spr" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>SR</strong>
                                <input type="number" name="vac_sr" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>HVB</strong>
                                <input type="number" name="vac_hvb" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>INFLUENZA</strong>
                                <input type="number" name="vac_influenza" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>PAROTID</strong>
                                <input type="number" name="vac_parotid" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>RUBEOLA</strong>
                                <input type="number" name="vac_rubeola" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>ROTAVIRUS</strong>
                                <input type="number" name="vac_rotavirus" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>DT Adulto</strong>
                                <input type="number" name="vac_dt_adulto" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>IPV</strong>
                                <input type="number" name="vac_ipv" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>PENTAVAL</strong>
                                <input type="number" name="vac_pentaval" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>ANTIAMARILICA</strong>
                                <input type="number" name="vac_antiamarilica" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>ANTINEUMOC</strong>
                                <input type="number" name="vac_antineumoc" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>ANTITETANICA</strong>
                                <input type="number" name="vac_antitetanica" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>COMP. PARA EDAD</strong>
                                <select name="vac_completas" class="form-control">
                                    <option value="0">- Seleccione -</option>
                                    <option value="1">SI</option>
                                    <option value="2">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>VPH</strong>
                                <input type="number" name="vac_vph" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="form-group">
                                <strong>OTRA VACUNA</strong>
                                <input type="text" name="vac_otra" class="form-control"/>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>GRUPO DE RIESGO HVB</strong>
                                <select name="vac_completas" class="form-control">
                                    <option value="0">- Seleccione -</option>
                                    <option value="1">TRABAJADOR DE SALUD</option>
                                    <option value="2">TRABAJADORAS SEXUALES</option>
                                    <option value="3">HSH</option>
                                    <option value="4">PRIVADO LIBERTAD</option>
                                    <option value="5">FF.AA.</option>
                                    <option value="6">POLICIA NACIONAL</option>
                                    <option value="7">ESTUDIANTES DE SALUD</option>
                                    <option value="8">POLITRANFUNDIDOS</option>
                                    <option value="9">DROGO DEPENDIENTES</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="diagnosticos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document"  style="width: 1200px;">
            <div class="modal-content">
                <div class="modal-header modal-header-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Actividades preventivas y otros</h4>
                </div>
                <div class="modal-body">



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection