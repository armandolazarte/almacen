<?php

class EntradaSalidaPdf extends Fpdf
{
    var $titulo;
    
    var $req;
    var $ref;
    var $ref_tipo;
    var $fecha_oc;
    var $d_proveedor;
    var $id;
    var $fecha;
    var $d_urg;
    var $cmt;
    var $usr_id;
    
    public function __construct($data = array())
    {
        if ($data['tipo_formato'] == 'Entrada') {
            $this->titulo = 'COMPRAS A PROVEEDOR';
        } else {
            $this->titulo = 'ENTREGAS A DEPENDENCIA';
        }
        
        $this->req = $data['req'];
        $this->ref_tipo = $data['ref_tipo'];
        $this->ref = $data['ref'];
        $this->fecha_oc = $data['fecha_oc'];
        $this->d_proveedor = $data['d_proveedor'];
        $this->id = $data['id'];
        $this->fecha = $data['fecha'];
        $this->d_urg = $data['d_urg'];
        $this->cmt = $data['cmt'];
        $this->usr_id = $data['usr_id'];
        
        parent::__construct();
    }
    
    public function header()
    {
        //Header
        $this->SetFont('Arial','B', 12);
        $this->Cell(190, 5, 'Universidad de Guadalajara', 0, 1, 'C');
        $this->Ln(2);
        $this->Cell(190, 5, 'MOVIMIENTO AL ALMACEN', 0, 1, 'C');
        
        //Info General
        $this->SetFont('Arial','', 10);
        $this->Ln(5);
        $this->Cell(190, 5, $this->titulo, 0, 1, 'C');
        
        $this->Cell(25, 5, 'Referencia', 0, 0, 'L');
        $this->Cell(105, 5, 'Req. ' .$this->req. ' / ' .$this->ref_tipo. ' ' . $this->ref .' ('.$this->fecha_oc.')', 0, 1, 'L');
        
        $this->Cell(25, 5, 'Proveedor', 0, 0, 'L');
        $this->Cell(105, 5, $this->d_proveedor, 0, 1, 'L');
        
        $this->Cell(25, 5, 'Destino', 0, 0, 'L');
        $this->Cell(105, 5, $this->d_urg, 0, 1, 'L');
         
        $this->Cell(130, 5, $this->cmt, 0, 0, 'L');
        
        //Información de Folio
        $this->SetXY(140, $this->GetY()-15);
        $this->Cell(30, 5, 'FOLIO #:', 'B', 2, 'R');
        $this->Cell(30, 5, 'Fecha Captura:', 0, 2, 'R');
        $this->Cell(30, 5, utf8_decode('Fecha Aplicación:'), 0, 2, 'R');
        $this->Cell(30, 5, utf8_decode('Usuario:'), 0, 2, 'R');
        
        $this->SetXY(170, $this->GetY()-20);
        $this->Cell(30, 5, $this->id, 'B', 2, 'C');
        $this->Cell(30, 5, $this->fecha, 0, 2, 'C');
        $this->Cell(30, 5, $this->fecha, 0, 2, 'C');
        $this->Cell(30, 5, $this->usr_id, 0, 1, 'C');
    }
    
}
