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
                                <th width="20%">DNI</th>
                                <th width="30%">Apellidos y Nombres</th>
                                <th width="10%">Afiliación</th>
                                <th width="10%">Edad</th>
                                <th width="20%">Acciones</th>
                            </tr>
                            @foreach ($searchedBooks as $afiliado)
                            <tr>
                                <td>{{ $afiliado->afi_Dni }}</td>
                                <td>{{$afiliado->afi_ApePaterno}} {{$afiliado->afi_ApeMaterno}} {{$afiliado->afi_Nombres}} {{$afiliado->afi_SegNombre}}</td>                                
                                <td>{{$afiliado->afi_FecFormato}}</td>
                                <td>{{$afiliado->edad}}</td>
                                <td>
                                    <a class="btn btn-success btn-xs" href="fuas/create/{{$afiliado->id}}">Admisión</a>
                                    <a class="btn btn-primary btn-xs" href="#">Historial</a>
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
@endsection
