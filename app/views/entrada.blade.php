@extends('layouts.base')

@section('navegacion')
        <ul class="barra_botones">
            <li><a class="button_barra" href="/">Inicio</a></li>
            <li><a class="button_seleccionado" href="/entrada">Entradas</a></li>
            <li><a class="button_barra" href="{{ action('EntradaController@nueva') }}">Nueva (Sel. OC)</a></li>
            <li><a class="button_barra" href="{{ action('EntradaController@info') }}">Consultar</a></li>
        </ul>
@stop

@section('identifica')
        <div class="titulo">Entradas</div>
        <div class="subtitulo"></div>
@stop

@section('contenido')

<h3>Selecciones la acción a realizar<h3>

@stop