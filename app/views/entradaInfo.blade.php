@extends('layouts.base')

@section('navegacion')
        <ul class="barra_botones">
            <li><a class="button_barra" href="/">Inicio</a></li>
            <li><a class="button_barra" href="/entrada">Entradas</a></li>
            <li><a class="button_barra" href="{{ action('EntradaController@nueva') }}">Nueva (Sel. OC)</a></li>
            <li><a class="button_seleccionado" href="{{ action('EntradaController@info') }}">Consultar</a></li>
        </ul>
@stop

@section('identifica')
        <div class="titulo">Entradas</div>
        <div class="subtitulo">Información de Entrada</div>
@stop

@section('contenido')
<div>
    {{-- Muestra información de una entrada --}}
    @if(!empty($id))
    <table class="data_table">
        <thead><tr> <th>ID Entrada</th> <th>Fecha de entrada</th> <th>Documento Origen</th> <th>Fecha Doc. Origen</th> <th>URG</th> <th>Proveedor</th> <th>Comentarios</th> <th>Usuario</th> </tr></thead>
        <tr>
            <td>{{ $entrada->id }}</td> <td>{{ $entrada->fecha_entrada }}</td> <td>{{ $entrada->ref_tipo }} {{ $entrada->ref }}</td> <td>{{ $entrada->ref_fecha }}</td> <td>{{ $entrada->urg_id }}</td> <td>{{ $entrada->proveedor_id }}</td> <td>{{ $entrada->cmt }}</td> <td>{{ $entrada->usr_id }}</td>
        </tr>
    </table>
        
    {{-- Lista todas las entradas --}}
    @elseif( count($entradas) > 0 )
        <table class="data_table">
        <thead><tr> <th>ID Entrada</th> <th>Fecha de entrada</th> <th>Documento Origen</th> <th>Fecha Doc. Origen</th> <th>URG</th> <th>Proveedor</th> <th>Comentarios</th> <th>Usuario</th> </tr></thead>
        @foreach( $entradas as $entrada )
            <tr>
                <td>{{ $entrada->id }}</td> <td>{{ $entrada->fecha_entrada }}</td> <td>{{ $entrada->ref_tipo }} {{ $entrada->ref }}</td> <td>{{ $entrada->ref_fecha }}</td> <td>{{ $entrada->urg_id }}</td> <td>{{ $entrada->proveedor_id }}</td> <td>{{ $entrada->cmt }}</td> <td>{{ $entrada->usr_id }}</td>
            </tr>
        @endforeach
        </table>
    
    {{-- Muestra que no hay entradas --}}
    @else
        <h2>No hay registros</h2>
    @endif
    
</div>

@stop