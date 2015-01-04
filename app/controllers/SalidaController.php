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
    
    public function formato($id)
    {
        $salida = Salida::find($id);
        $entrada = Entrada::find($salida->entrada_id);
        if ($entrada->ref_tipo == 'OC') {
            $oc = Oc::whereOc($entrada->ref)->get();
        }
        $articulos = SalidaArticulo::whereSalidaId($id)->get();
        $artEntrada = EntradaArticulo::whereEntradaId($salida->entrada_id)->get(array('costo', 'impuesto'));
        
        $data['tipo_formato'] = 'Salida';
        $data['req'] = $oc[0]->req;
        $data['ref_tipo'] = $entrada->ref_tipo;
        $data['ref'] = $entrada->ref;
        $data['fecha_oc'] = $oc[0]->fecha_oc;
        $data['d_proveedor'] = $entrada->proveedor->d_proveedor;
        $data['id'] = $id;
        $data['fecha'] = $salida->fecha_salida;
        $data['d_urg'] = $entrada->urg->d_urg;
        $data['cmt'] = $salida->cmt;
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
            $i = 0;
            $y_inicial = $fpdf->GetY();
            $fpdf->SetX(30);
            $fpdf->MultiCell(90, 4, utf8_decode($art->articulo->articulo), 0, 'L');
            $y_final = $fpdf->GetY();
            $h_renglon = $y_final - $y_inicial;
            
            $fpdf->SetY($y_inicial);
            $fpdf->Cell(20, $h_renglon, $art->id, 0, 0, 'C');
            $fpdf->SetXY(120, $y_inicial);
            $fpdf->Cell(20, $h_renglon, number_format($art->cantidad), 0, 0, 'C');
            $fpdf->Cell(30, $h_renglon, number_format($artEntrada[$i]->costo, 2), 0, 0, 'C');
            $fpdf->Cell(30, $h_renglon, number_format($artEntrada[$i]->costo * $art->cantidad, 2), 0, 2, 'R');
            
            $sum_total += $artEntrada[$i]->costo * $art->cantidad;
            $i++;
        }
        $fpdf->Cell(30, 5, number_format($sum_total, 2), 'T', 2, 'R');
        
        return View::make($fpdf->Output());
    }
}
