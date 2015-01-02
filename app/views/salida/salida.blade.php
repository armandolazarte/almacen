@extends('layouts.base')

@section('navegacion')
        <ul class="barra_botones">
            <li><a class="button_barra" href="/">Inicio</a></li>
            <li><a class="button_seleccionado" href="/salida">Salidas</a></li>
            <li><a class="button_barra" href="{{ action('SalidaController@nueva') }}">Nueva</a></li>
            <li><a class="button_barra" href="{{ action('SalidaController@info') }}">Consultar</a></li>
        </ul>
@stop

@section('identifica')
        <div class="titulo">Salidas</div>
        <div class="subtitulo"></div>
@stop

@section('contenido')

<h3>Selecciones la acción a realizar<h3>

@stop