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
        <div class="titulo">Entradas</div>
        <div class="subtitulo">Listado de Ordenes de Compra</div>
@stop

@section('contenido')

    <table class="data_table">
        <thead><tr> <th>Orden de Compra</th>  <th>Fecha OC</th> <th>Requisición</th> <th>URG</th> <th>Estatus</th> </tr></thead>
        @foreach ($oc_data as $oc)
        <tr>
            <td>{{ $oc->oc }}</td> <td>{{ $oc->fecha_oc }}</td> <td>{{ $oc->req }}</td> <td></td> <td>{{ $oc->estatus }}</td>
        </tr>
        @endforeach
    </table>

@stop
