@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">RECUPERACI&Oacute;N DE CONTRASEÑA</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-12">
             <div class="panel">
                <div class="panel-body">
                 @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                {!! Form::open(['route'=>'password.email', 'method'=>'POST']) !!}
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8 col-sm-offset-2">
                        <div class="form-group">
                           {!! Form::label("Correo Electronico Registrado") !!}
                           {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Correo Electronico']) !!}
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong style="color:#fd625e;">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-sm-offset-3">
                        <button type="submit" class="btn btn-primary btn-block ">
                            {{ __('Recuperar') }}
                        </button>
                    </div>
                </div> 
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="padding-bottom:20%;"></div>
@endsection