@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Busqueda FUA</div>

                <div class="panel-body">
                    <div class="container">
                        <div class="row">
                            <form class="form-inline">
                                <h5 style="color: red;">SOLO EL NUMERO EN ROJO</h5>
                                <input name="fn" class="form-control input-lg" type="text">
                                <button type="submit" class="btn btn-primary btn-lg"> <i class="fa fa-search"></i> Buscar</button>
                            </form>
                        </div>
                    </div>
                    @if($fuas != null)

                    <h3>Resultados de busqueda: "{{$fn}}"</h3>
                        @if(!$fuas->isEmpty())
                        <table class="table">
                            <tr>
                                <th width="1%">Nro</th>
                                <th width="10%">Numero</th>
                                <th width="50%">Atendido</th>
                                <th width="30%">Usuarios</th>
                                <th width="9px"></th>
                            </tr>
                           @foreach ($fuas as $fua)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td style="font-weight: bold; font-size: 14px; color: red;">{{ $fua->fua_NumFormato }}</td>
                                <td>{{ $fua->afi_Dni }} - {{$fua->afi_ApePaterno}} {{$fua->afi_ApeMaterno}}, {{$fua->afi_Nombres}} {{$fua->afi_SegNombre}} </td>
                                <td>{{ $fua->name }} {{$fua->lastname}}</td>
                                <td><a href="/fuas/{{$fua->id}}/edit" class="btn btn-success">Abrir</a></td>
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
