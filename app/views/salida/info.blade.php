@extends('layouts.base')

@section('navegacion')
        <ul class="barra_botones">
            <li><a class="button_barra" href="/">Inicio</a></li>
            <li><a class="button_barra" href="/salida">Salidas</a></li>
            <li><a class="button_barra" href="{{ action('SalidaController@nueva') }}">Nueva</a></li>
            <li><a class="button_seleccionado" href="{{ action('SalidaController@info') }}">Consultar</a></li>
        </ul>
@stop

@section('identifica')
        <div class="titulo">Salidas</div>
        <div class="subtitulo">Información de Salida</div>
@stop

@section('contenido')
<div>
    {{-- Muestra información de una salida --}}
    @if(!empty($id))
    <table class="data_table">
        <thead><tr> <th>ID Salida</th> <th>Fecha de salida</th> <th>Documento Origen</th> <th>URG</th> <th>Comentarios</th> <th>Usuario</th> </tr></thead>
        <tr>
            <td>{{ $salida->id }}</td> <td>{{ $salida->fecha_salida }}</td> <td>{{ $salida->entrada->ref_tipo }} {{ $salida->entrada->ref }}</td> <td>{{ $salida->urg_id }}</td>  <td>{{ $salida->cmt }}</td> <td>{{ $salida->usr_id }}</td>
        </tr>
    </table>
    
    {{-- @todo Mostrar artículos en salida --}}
    
    {{-- Lista todas las salidas --}}
    @elseif( count($salidas) > 0 )
        <table class="data_table">
        <thead><tr> <th>ID Salida</th> <th>Fecha de salida</th> <th>Documento Origen</th> <th>URG</th> <th>Comentarios</th> <th>Usuario</th> </tr></thead>
        @foreach( $salidas as $salida )
            <tr>
                <td>{{ $salida->id }}</td> <td>{{ $salida->fecha_salida }}</td> <td>{{ $salida->entrada->ref_tipo }} {{ $salida->entrada->ref }}</td> <td>{{ $salida->urg_id }}</td>  <td>{{ $salida->cmt }}</td> <td>{{ $salida->usr_id }}</td>
            </tr>
        @endforeach
        </table>
    
    {{-- Muestra que no hay salidas --}}
    @else
        <h2>No hay registros de salidas</h2>
    @endif
    
</div>

@stop