@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('dni') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">DNI</label>

                            <div class="col-md-6">
                                <input id="dni" type="text" class="form-control" name="dni" value="{{ old('dni') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombres</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Apellidos</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('especialidad') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Especialidad</label>

                            <div class="col-md-6">
                                <select id="especialidad" class="form-control" name="especialidad">
                                    <option value="1"> 1  - MEDICO</option>
                                    <option value="2"> 2  - FARMACEUTICO</option>
                                    <option value="3"> 3  - CIRUJANO DENTISTA</option>
                                    <option value="4"> 4  - BIOLOGO</option>
                                    <option value="5"> 5  - OBSTETRIZ</option>
                                    <option value="6"> 6  - ENFERMERA</option>
                                    <option value="7"> 7  - TRABAJADORA SOCIAL</option>
                                    <option value="8"> 8  - PSICOLOGA</option>
                                    <option value="9"> 9  - TECNOLOGO MEDICO</option>
                                    <option value="10">10 - NUTRICIÓN</option>
                                    <option value="11">11 - TECNICO ENFERMERIA</option>
                                    <option value="12">12 - AUXILIAR DE ENFERMERIA</option>
                                    <option value="13">13 - OTRO</option>

                                </select>    
                                
                                @if ($errors->has('especialidad'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('especialidad') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('colegiatura') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Colegiatura</label>

                            <div class="col-md-6">
                                <input id="colegiatura" type="text" class="form-control" name="colegiatura" value="{{ old('colegiatura') }}" autofocus>

                                @if ($errors->has('colegiatura'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('colegiatura') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Dirección E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirma Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
