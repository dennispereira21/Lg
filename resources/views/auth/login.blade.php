@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">INICIA SESI&OacuteN PARA INGRESAR</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
             <div class="panel">
                <div class="panel-body">
                    {!! Form::open(['route'=>'login', 'method'=>'POST']) !!}
                        @csrf
                        <div class="form-group">
                            {!! Form::label("Usuario / Correo Electronico") !!}
                            {!! Form::text('email', old('email'), ["id"=>"email", "class"=>"form-control", "placeholder"=>"Ingresa tu Correo Electronico", "attributes" => "required","autofocus"]) !!}
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color:#fd625e;">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label("Contraseña") !!}
                            {!! Form::password('password',["class"=>"form-control", "placeholder"=>"Ingresa tu Contraseña", "attributes"=>"required"]) !!}
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color:#fd625e;">{{ $errors->first('password') }}</strong>
                                </span>
                            @endif  
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="checkbox" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}> {{ __('Recordar Contraseña') }}
                            </div>
                        </div>
                        {!! Form::submit('Iniciar Sesion', ["class"=>"btn btn-primary btn-block"]) !!}
                    {!! Form::close() !!}
                    <div class="text-center">
                        <a class="d-block small mt-3" href="{{ route('password.request') }}"> ¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection