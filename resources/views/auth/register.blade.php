@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">REGISTRARTE</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-12">
             <div class="panel">
                <div class="panel-body">
                {!! Form::open(['route'=>'register', 'method'=>'POST', 'files'=>true]) !!}
                @csrf
                <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2">
                    <div class="form-group">
                        {!! Form::label("Nombre") !!}
                       {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Nombre']) !!}
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:#fd625e;">{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2">
                    <div class="form-group">
                        {!! Form::label("Correo Electronico") !!}
                       {!! Form::email('email', old('email'), ['class'=>'form-control', 'placeholder'=>'Correo Electronico']) !!}
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:#fd625e;">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2">
                    <div class="form-group">
                        {!! Form::label("Contraseña") !!}
                       <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong style="color:#fd625e;">{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2">
                    <div class="form-group">
                        {!! Form::label("Confirmar Contraseña") !!}
                       <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-8 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary btn-block ">
                            {{ __('Registrar') }}
                        </button>
                    </div>
                </div> 
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection