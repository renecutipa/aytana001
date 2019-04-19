@extends('fuas.layout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">FUAs Abiertos</div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            
                        </div>
                        <!-- Seccion de mensajes -->
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <!-- Fin de seccion de mensajes -->

                        <table class="table table-bordered table-stripped">
                            <tr>
                                <th width="1%">Nro</th>
                                <th width="10%">Numero</th>
                                <th width="50%">Atendido</th>
                                <th width="25%">Usuario</th>
                                <th width="5px"></th>
                            </tr>
                            @foreach ($fuas as $fua)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $fua->fua_NumFormato }}</td>
                                <td>{{ $fua->afi_Dni }} - {{$fua->afi_ApePaterno}} {{$fua->afi_ApeMaterno}}, {{$fua->afi_Nombres}} {{$fua->afi_SegNombre}} </td>
                                <td>{{ $fua->name }} {{$fua->lastname}}</td>
                                <td><a href="/fuas/{{$fua->id}}/edit" class="btn btn-xs btn-success">Abrir</a>
                                    <a href="/fuas/{{$fua->id}}/anular" class="btn btn-xs btn-danger">Anular</a></td>
                            </tr>
                            @endforeach
                            
                        </table>

                    </div>
                    <div class="row">
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection