@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Busqueda Afiliados</div>

                <div class="panel-body">
                    <div class="container">
                        <div class="row">
                            <form class="form-inline">
                                <input name="q" class="form-control input-lg" type="text">
                                <button type="submit" class="btn btn-primary btn-lg"> <i class="fa fa-search"></i> Buscar</button>
                            </form>
                        </div>
                    </div>
                    @if($searchedBooks != null)

                    <h3>Resultados de busqueda: "{{$q}}"</h3>
                        @if(!$searchedBooks->isEmpty())
                        <table class="table">
                            <tr>
                                <th width="10%">DNI</th>
                                <th width="30%">Apellidos y Nombres</th>
                                <th width="10%">Afiliación</th>
                                <th width="10%">Historia</th>
                                <th width="20%">EE.SS.</th>
                                <th width="5%">Edad</th>
                                <th width="15%">Acciones</th>
                            </tr>
                            @foreach ($searchedBooks as $afiliado)
                            <tr>
                                <td>{{ $afiliado->afi_Dni }}</td>
                                <td>{{$afiliado->afi_ApePaterno}} {{$afiliado->afi_ApeMaterno}} {{$afiliado->afi_Nombres}} {{$afiliado->afi_SegNombre}}</td>
                                <td>{{$afiliado->afi_FecFormato}}</td>
                                <td>{{$afiliado->historia}}</td>
                                <td class="alert alert-info"><b>{{$afiliado->pre_Nombre}}</b></td>
                                <td>{{$afiliado->edad}}</td>
                                <td>
                                    <a class="btn btn-success btn-xs" href="fuas/create/{{$afiliado->id}}">Admisión</a>
                                    <!--a class="btn btn-primary btn-xs" href="#">Historial</a-->
                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#historial" data-backdrop="static" data-keyboard="false">Historial</button>

                                </td>        
                            </tr>
                            @endforeach
                        </table>
                        @else
                            {{"No se econtraron resultados"}}
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="historial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document"  style="width: 1200px;">
        <div class="modal-content">
            <div class="modal-header modal-header-primary primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">historial</h4>
            </div>
            <div class="modal-body">
                
                ...

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection
