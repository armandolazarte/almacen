<?php

class EntradaController extends BaseController
{
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
        
    }
}
