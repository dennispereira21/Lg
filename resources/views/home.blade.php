@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Bienvenidos</h4>
            <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="padding-bottom:20%;"></div>
@endsection
