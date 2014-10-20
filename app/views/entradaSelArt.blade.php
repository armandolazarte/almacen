@extends('layouts.base')

@section('navegacion')
        <ul class="barra_botones">
            <li><a class="button_barra" href="/">Inicio</a></li>
            <li><a class="button_barra" href="/entrada">Entradas</a></li>
            <li><a class="button_seleccionado" href="{{ action('EntradaController@nueva') }}">Nueva (Sel. OC)</a></li>
            <li><a class="button_barra" href="{{ action('EntradaController@info') }}">Consultar</a></li>
        </ul>
@stop

@section('identifica')
        <div class="titulo">Entradas</div>
        <div class="subtitulo">Artículos en Orden de Compra</div>
@stop

@section('contenido')

<div>
    {{ Form::open(array('action' => 'EntradaController@crearEntrada')) }}
    
    {{ Form::label('urg_id', 'Unidad Responsable:') }}
    {{ Form::select('urg_id', Urg::lists('d_urg', 'id')) }}
    <br />
    {{ Form::label('cmt', 'Comentarios:') }}
    {{ Form::text('cmt', '', array('size' => '100')) }}
    
    <table class="data_table">
        <thead><tr> <th>Selección</th> <th>Artículo</th> <th>Cantidad</th> <th>Costo</th> <th>IVA</th> <th>Total</th> <th>Unidad</th> </tr></thead>
         @foreach ($oc_articulos as $art)
        <tr>
            <td>{{ Form::checkbox('art_count[]', $art->art_count, true) }}</td> <td>{{ $art->esp }}</td> <td>{{ $art->cantidad }}</td> <td>{{ $art->costo }}</td> <td>{{ $art->impuesto }}</td> <td>{{ $art->monto }}</td> <td>{{ $art->unidad }}</td>
        </tr>
         @endforeach
    </table>
    {{ Form::hidden('oc', $no_oc) }}
    
    {{ Form::submit('Aceptar') }}
    
    {{ Form::close() }}
</div>

@stop
