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
            } else {
                $data['entradas'] = array();
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
    
    public function formato($id)
    {
        $entrada = Entrada::find($id);
        if ($entrada->ref_tipo == 'OC') {
            $oc = Oc::whereOc($entrada->ref)->get();
        }
        $articulos = EntradaArticulo::whereEntradaId($id)->get();
        
        $data['tipo_formato'] = 'Entrada';
        $data['req'] = $oc[0]->req;
        $data['ref_tipo'] = $entrada->ref_tipo;
        $data['ref'] = $entrada->ref;
        $data['fecha_oc'] = $oc[0]->fecha_oc;
        $data['d_proveedor'] = $entrada->proveedor->d_proveedor;
        $data['entrada_id'] = $entrada->id;
        $data['fecha_entrada'] = $entrada->fecha_entrada;
        $data['d_urg'] = $entrada->urg->d_urg;
        $data['cmt'] = $entrada->cmt;
        $data['usr_id'] = $entrada->usr_id;
        $sum_total = 0;
        
        $fpdf = new EntradaSalidaPdf($data);
        $fpdf->AddPage();
        
        //Artículos
        $fpdf->SetFont('Arial','', 10);
        $fpdf->Cell(20, 5, utf8_decode('Código'), 'TB', 0, 'C');
        $fpdf->Cell(90, 5, utf8_decode('Descripción'), 'TB', 0, 'C');
        $fpdf->Cell(20, 5, 'Cantidad', 'TB', 0, 'C');
        $fpdf->Cell(30, 5, 'Precio Unitario', 'TB', 0, 'C');
        $fpdf->Cell(30, 5, 'Total', 'TB', 1, 'C');
        
        foreach($articulos as $art) {
            $y_inicial = $fpdf->GetY();
            $fpdf->SetX(30);
            $fpdf->MultiCell(90, 4, utf8_decode($art->articulo->articulo), 0, 'L');
            $y_final = $fpdf->GetY();
            $h_renglon = $y_final - $y_inicial;
            
            $fpdf->SetY($y_inicial);
            $fpdf->Cell(20, $h_renglon, $art->id, 0, 0, 'C');
            $fpdf->SetXY(120, $y_inicial);
            $fpdf->Cell(20, $h_renglon, $art->cantidad, 0, 0, 'C');
            $fpdf->Cell(30, $h_renglon, number_format($art->costo, 2), 0, 0, 'C');
            $fpdf->Cell(30, $h_renglon, number_format($art->costo * $art->cantidad, 2), 0, 2, 'R');
            
            $sum_total += $art->costo * $art->cantidad;
        }
        $fpdf->Cell(30, 5, number_format($sum_total, 2), 'T', 2, 'R');
        
        return View::make($fpdf->Output());
    }
}
