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

}
