<?php

class SalidaController extends BaseController
{
    public function info($id = null)
    {
        $data['id'] = $id;
        if ( !empty($id) ) {
            $salida = Salida::find($id);
            $data['salida'] = $salida;
        } else {
            $salidas = Salida::all();
            if ( !$salidas->isEmpty() ) {
                $data['salidas'] = $salidas;
            } else {
                $data['salidas'] = array();
            }
        }
        
        return View::make('salida.info', $data);
    }
    
    public function nueva()
    {
        //Listar Entradas en formulario
        $entradas = Entrada::all();
        //$entradas = Entrada::with('urg', 'proveedor')->all();
        //Seleccionar
        return View::make('salida.nueva', compact('entradas'));
    }
    
    public function selArticulos()
    {
        //Listar artículos y cantidades
        $entrada = Entrada::find(Input::get('id'));
        //mostrar cantidad de artículos x salir
        $articulos = EntradaArticulo::whereEntradaId(Input::get('id'))->get();
        return View::make('salida.selArt', compact('entrada', 'articulos'));
    }
    
    public function crearSalida()
    {
        //Recuperar información
        
        //Crear Salida
        $salida = new Salida;
        $salida->entrada_id = Input::get('entrada_id');
        $salida->fecha_salida = date("Y-m-d");
        $salida->urg_id = Input::get('urg_id');
        $salida->cmt =  Input::get('cmt');
        $salida->usr_id = '';
        $salida->save();
        
        //Insertar artículos @entradas_articulos
        /*
         * @todo Validar cantidades -> Que pasa si no son validas?
         * Validar Sum(Cantidad Entrada) - Sum(Cantidad Salida) > 0
         */
        $articulos = Input::get('articulos');
        foreach ($articulos as $articulo_id)
        {
            $salida_articulo = new SalidaArticulo;
            $salida_articulo->salida()->associate($salida);
            $salida_articulo->articulo_id = $articulo_id;
            $salida_articulo->cantidad = Input::get('cantidad_'.$articulo_id);
            $salida_articulo->save();
        }
        
        //Mostrar información de salida (Redirect)
        return Redirect::action('SalidaController@info', array('id' => $salida->id));
    }
}
