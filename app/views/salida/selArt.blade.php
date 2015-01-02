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
        <div class="subtitulo">Selección de Artículos en Entrada</div>
@stop

@section('contenido')

<div>
    {{ Form::open(array('action' => 'SalidaController@crearSalida')) }}
    
    {{ Form::label('cmt', 'Comentarios:') }}
    {{ Form::text('cmt', $entrada->cmt, array('size' => '100')) }}
    
    <table class="data_table">
        <thead><tr> <th>Selección</th> <th>Artículo</th> <th>Cantidad</th> <th>Costo</th> <th>IVA</th> <th>Total</th> <th>Unidad</th> </tr></thead>
         @foreach ($articulos as $art)
        <tr>
            <td>{{ Form::checkbox('articulos[]', $art->id, true) }}</td> <td>{{ $art->articulo->articulo }}</td> <td>{{ Form::text('cantidad_'.$art->id, $art->cantidad, array('size' => '5')) }}</td> <td>{{ $art->costo }}</td> <td>{{ $art->impuesto }}</td> <td>{{ $art->monto }}</td> <td>{{ $art->articulo->unidad }}</td>
        </tr>
         @endforeach
    </table>
    {{ Form::hidden('entrada_id', $entrada->id) }}
    {{ Form::hidden('urg_id', $entrada->urg_id) }}
    
    {{ Form::submit('Aceptar') }}
    
    {{ Form::close() }}
</div>

@stop