@extends('layouts.base')

@section('navegacion')
        <ul class="barra_botones">
            <li><a class="button_barra" href="/">Inicio</a></li>
            <li><a class="button_barra" href="/salida">Salidas</a></li>
            <li><a class="button_seleccionado" href="{{ action('SalidaController@nueva') }}">Nueva</a></li>
            <li><a class="button_barra" href="{{ action('SalidaController@info') }}">Consultar</a></li>
        </ul>
@stop

@section('identifica')
        <div class="titulo">Nueva Salida</div>
        <div class="subtitulo">Selección de Entrada</div>
@stop

@section('contenido')

    @if( $entradas->isEmpty() )
        <h3>No hay Entradas por seleccionar</h3>
    @else
        {{ Form::open(array('action' => 'SalidaController@selArticulos')) }}
        
        <table class="data_table">
            <thead><tr> <th>ID Entrada</th> <th>Fecha Entrada</th> <th>Orden de Compra</th> <th>URG</th> <th>Proveedor</th> <th>Comentarios</th> </tr></thead>
            @foreach ($entradas as $entrada)
            <tr>
                <td>{{ Form::radio('id', $entrada->id) }}{{ $entrada->id }}</td> <td>{{ $entrada->fecha_entrada }}</td> <td> {{ $entrada->ref_tipo }} {{ $entrada->ref }}</td> <td>{{ $entrada->urg_id }}</td> <td>{{ $entrada->proveedor_id }}</td> <td>{{ $entrada->cmt }}</td>
            </tr>
            @endforeach
        </table>
        
        {{ Form::submit('Aceptar') }}
        
        {{ Form::close() }}
    @endif
    
@stop