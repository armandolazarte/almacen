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
}
