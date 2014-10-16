@extends('layouts.base')

@section('navegacion')
        <ul class="barra_botones">
            <li><a class="button_seleccionado" href="/entradas/nueva">Nueva (Sel. OC)</a></li>
            <li><a class="button_barra" href="#">Consultar</a></li>
        </ul>
@stop

@section('identifica')
        <div class="titulo">Nueva Entrada</div>
        <div class="subtitulo">Selección de Orden de Compra</div>
@stop

@section('contenido')

    @if( $oc_data->isEmpty() )
        <h3>No hay Ordenes de Compra por seleccionar</h3>
    @else
        {{ Form::open(array('action' => 'EntradaController@selArticulos')) }}
        
        <table class="data_table">
            <thead><tr> <th>Orden de Compra</th>  <th>Fecha OC</th> <th>Requisición</th> <!--<th>URG</th>--> <th>Estatus</th> </tr></thead>
            @foreach ($oc_data as $oc)
            <tr>
                <td> {{ Form::radio('oc', $oc->oc) }}  {{ $oc->oc }}</td> <td>{{ $oc->fecha_oc }}</td> <td>{{ $oc->req }}</td> <!--<td></td>--> <td>Importada</td>
            </tr>
            @endforeach
        </table>
        
        {{ Form::submit('Aceptar') }}
        
        {{ Form::close() }}
    @endif
    
@stop
