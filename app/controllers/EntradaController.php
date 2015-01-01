<?php

class EntradaController extends BaseController
{
    public function info($id = null)
    {
        $data['id'] = $id;
        if ( !empty($id) ) {
            $entrada = Entrada::find($id);
            $data['entrada'] = $entrada;
        } else {
            $entradas = Entrada::all();
            if ( !$entradas->isEmpty() ) {
                $data['entradas'] = $entradas;
            }
        }
        
        return View::make('entradaInfo', $data);
    }
    
    public function nueva()
    {
        $urg = new UrgController();
        $urg->importarUrgNuevas();
        
        $oc = new OcController();
        $oc_data = $oc->getOc();
        //$data['oc_data'] = $oc_data; //puede remplazar compact('oc_data')
        return View::make('entradaSelOc', compact('oc_data'));
    }
    
    public function selArticulos()
    {
        $no_oc = Input::get('oc');
        $oc = Oc::where('oc', '=', $no_oc)->get();
        
        $oc_articulos = OcArticulo::where('oc_id', '=', $oc[0]->id)->get();
        return View::make('entradaSelArt', compact('oc_articulos', 'no_oc'));
    }
    
    public function crearEntrada()
    {
        //Recupera información de OC
        $oc = Oc::where('oc', '=', Input::get('oc'))->get();
        
        //Crear Entrada
        $entrada = new Entrada;
        $entrada->fecha_entrada = date("Y-m-d");
        $entrada->ref = $oc[0]->oc;
        $entrada->ref_tipo = 'OC';
        $entrada->ref_fecha = $oc[0]->fecha_oc;
        $entrada->urg_id = Input::get('urg_id');
        $entrada->proveedor_id = $oc[0]->proveedor_id;
        $entrada->cmt = Input::get('cmt');
        $entrada->usr_id = '';
        $entrada->save();
        
        //Insertar artículos @entradas_articulos
        $arr_art_count = Input::get('art_count');
        foreach ($arr_art_count as $art_count)
        {
            $oc_articulo = OcArticulo::where('oc_id', '=', $oc[0]->id)->where('art_count', '=', $art_count)->get();
            $entradas_articulos = new EntradaArticulo;
            $entradas_articulos->entrada()->associate($entrada);
            $entradas_articulos->articulo_id = $oc_articulo[0]->articulo_id;
            $entradas_articulos->cantidad = $oc_articulo[0]->cantidad;
            $entradas_articulos->costo = $oc_articulo[0]->costo;
            $entradas_articulos->impuesto = $oc_articulo[0]->impuesto;
            $entradas_articulos->save();
        }
        
        $oc[0]->estatus = 'Entrada Generada';
        $oc[0]->save();
        
        //Mostrar información de entrada (Redirect)
        return Redirect::action('EntradaController@info', array('id' => $entrada->id));
    }
}
