<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('login.name', 'Login') }}</title>
    {!!Html::style('css/bootstrap.css')!!} 
    {!!Html::style('css/font-awesome.css')!!} 
    {!!Html::style('css/style.css')!!}
</head>
<body>
    @guest
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Registrar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
     @else
     <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <strong>Email: </strong>info@yourdomain.com
                    &nbsp;&nbsp;
                    <strong>Usuario: </strong>{{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </header>
     <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="#">Usuarios</a></li>
                            <li><a href="{{ route('logout') }}">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endguest
     <div class="container-fluir">
        @yield('content')
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    Copyright © 2018 Website Developer Dennis Pereira
                </div>
            </div>
        </div>
    </footer>
{!!Html::script('js/jquery-1.11.1.js')!!} 
{!!Html::script('js/bootstrap.js')!!} 
</body>
</html>