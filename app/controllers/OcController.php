<?php

class OcController extends BaseController
{
    
    public function consultarOcExternas()
    {
        $oc_importadas = Oc::lists('oc');
        if ( count($oc_importadas) > 0 ) {
            $oc_externas = DB::connection('sgf14')->table('tbl_oc')
                    ->leftJoin('sgf_benef.tbl_benef', 'tbl_oc.benef_id', '=', 'sgf_benef.tbl_benef.benef_id')
                    //->where ('fecha_oc', '>', '2014-09-01')
                    ->whereNotIn ('oc', $oc_importadas)
                    ->get();
        } else {
            $oc_externas = DB::connection('sgf14')->table('tbl_oc')
                    ->leftJoin('sgf_benef.tbl_benef', 'tbl_oc.benef_id', '=', 'sgf_benef.tbl_benef.benef_id')
                    //->where ('fecha_oc', '>', '2014-09-01')
                    ->get();
        }
        
        return $oc_externas;
    }
    
    public function importarOcNuevas()
    {
        $oc_externas = $this->consultarOcExternas();
        if ( count($oc_externas) > 0 ) {
            foreach($oc_externas as $oc_nueva)
            {
                $proveedor = new ProveedorController();
                $proveedor_id = $proveedor->getProveedorId($oc_nueva->benef_id);
                if ( $proveedor_id !== false ) {
                    $oc = new Oc;
                    $oc->oc = $oc_nueva->oc;
                    $oc->fecha_oc = $oc_nueva->fecha_oc;
                    $oc->req = $oc_nueva->req;
                    $oc->db_origen = 'sgf14';
        	        $oc->proveedor_id = $proveedor_id;
                    $oc->urg_id = '';
                    $oc->estatus = '';
                    $oc->save();
                    
                    //Insetar artículos @articulos
                    $articulosExternos = $this->getArticulosExternos($oc_nueva->oc);
                    foreach ( $articulosExternos as $articuloExterno )
                    {
                        $articulo = new Articulo;
                        $articulo->articulo = $articuloExterno->art.' '.$articuloExterno->esp;
                        $articulo->unidad = $articuloExterno->unidad;
                        $articulo->rubro_id = 0;
                        $articulo->save();
                        
                        //Insertar artículos @oc_articulos
                        $oc_art = new OcArticulo;
                        $oc_art->oc()->associate($oc);
                        $oc_art->articulo()->associate($articulo);
                        $oc_art->art_count = $articuloExterno->art_count;
                        $oc_art->esp = $articuloExterno->art.' '.$articuloExterno->esp;
                        $oc_art->cantidad = $articuloExterno->cantidad;
                        $oc_art->costo = $articuloExterno->costo;
                        $oc_art->impuesto = $articuloExterno->impuesto;
                        $oc_art->unidad = $articuloExterno->unidad;
                        $oc_art->save();
                    }
                }
            }
        }
    }
    
    public function getOc()
    {
        $this->importarOcNuevas();
        $oc_data = Oc::where('estatus', '=', '')
                    ->get();
        return $oc_data;
    }
    
    public function getArticulosExternos($oc)
    {
        //Obtener No. de Requisición a partir de OC
        $oc = Oc::whereOc($oc)->get(array('req'));
        $arr_req = $oc->lists('req');
        $req = $arr_req[0];
        
        $articulos = DB::connection('sgf14')->table('tbl_req_art')
                ->leftJoin('tbl_articulos', 'tbl_articulos.art_id', '=', 'tbl_req_art.art_id')
                ->where('req', '=', $req)
                ->get(array('art_count', 'art', 'esp', 'cantidad', 'costo', 'impuesto', 'monto', 'unidad'));
        
        return $articulos;
    }
}
