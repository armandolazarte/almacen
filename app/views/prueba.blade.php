@extends('layouts.base')

@section('navegacion')
        <ul class="barra_botones">
            <li><a class="button_barra" href="/">Inicio</a></li>
            <li><a class="button_seleccionado" href="#">Entradas</a></li>
            <li><a class="button_barra" href="#">Salidas</a></li>
            <li><a class="button_barra" href="#">Reportes</a></li>
        </ul>
@stop

@section('identifica')
        <div class="titulo">PRUEBA</div>
        <div class="subtitulo">Listado de Ordenes de Compra</div>
@stop

@section('contenido')
{{ var_dump($oc_externas) }}
<div>
    <table class="data_table">
        <thead><tr> <th>Orden de Compra</th>  <th>Fecha OC</th> <th>Requisición</th> <th>URG</th> <th>Estatus</th> </tr></thead>
    </table>
</div>

@stop
