@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Bienvenidos
                @if(Auth::user()->hasRole('admin'))
                    Administrador
                @else
                    Usuario
                @endif
            </h4>
            <div class="card-body">
            @if (Session::has('success'))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-success alert-dismissable text-center">
                          <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>{{Session::get('success')}}</strong>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Usuarios</div>
                        <div class="panel-body">
                             @if(Auth::user()->hasRole('admin'))
                                <div align="right">
                                    <a href="{{ route('users.create') }}" class="btn btn-success" title="Registrar" type="bottom"><i class="fa fa-pencil"></i></a>
                                </div><br>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Imagen</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Correo Electronico</th>
                                            @if(Auth::user()->hasRole('admin'))
                                            <th class="text-center">Herramientas</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user) 
                                            <tr>
                                                <td class="text-center"><img class="img-circle" width="8%" src="/storage/profile/{{$user->profile}}"></td>
                                                <td class="text-center">{{ $user->name }}</td>
                                                <td class="text-center">{{ $user->email }}</td>
                                                @if(Auth::user()->hasRole('admin'))
                                                <td class="text-center">
                                                    {!! Form::open(['route'=>['users.destroy', $user->id], 'id'=>'form-id', 'method'=>'DELETE']) !!}
                                                    <a href="{{ route('users.edit',$user->id) }}" type="button" class="btn btn-info">Editar</a>
                                                            {!! Form::button('Delete', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                                                  {!! Form::close() !!}
                                                    
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table> 
                            </div>
                                <div align="center">{!! $users->render()!!}</div> 
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
