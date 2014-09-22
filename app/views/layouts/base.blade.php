<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/almacen.css') }}" />
    @section('head')
    <title>CUSUR :: Almacén</title>
    @show
</head>

<body>
    <div id="col_central">
        <div class="banner">
            <br /><br /><br />Almacén
        </div>
        
@section('navegacion')
        <ul class="barra_botones">
            <li><a class="button_seleccionado" href="escolar.html">Inicio</a></li>
            <li><a class="button_barra" href="#">Entradas</a></li>
            <li><a class="button_barra" href="#">Salidas</a></li>
            <li><a class="button_barra" href="#">Reportes</a></li>
        </ul>
@show
        
@section('sesion')
        <div class="sesion">ID Sesión</div>
@show
        
@section('identifica')
        <div class="titulo">Almacén</div>
        <div class="subtitulo">Inicio</div>
@show
        
        @yield('contenido')
        
    </div>
</body>
</html>
