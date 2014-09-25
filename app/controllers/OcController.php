<?php

class OcController extends BaseController
{
    
	public function consultarOcExternas()
	{
	    $oc_importadas = Oc::lists('oc');
	    if ( count($oc_importadas) > 0 ) {
	    	$oc_externas = DB::connection('sgf14')->table('tbl_oc')
    		        //->where ('fecha_oc', '>', '2014-09-01')
                    ->whereNotIn ('oc', $oc_importadas)
                    ->get();
		} else {
            $oc_externas = DB::connection('sgf14')->table('tbl_oc')
    		        //->where ('fecha_oc', '>', '2014-09-01')
                    ->get();
		}
        
		return $oc_externas;
		
        //$data['oc_externas'] = $oc_externas;
        //return View::make('prueba', $data);
	}
	
	public function importarOcNuevas()
	{
	    $oc_externas = $this->consultarOcExternas();
	    if ( count($oc_externas) > 0 ) {
	        foreach($oc_externas as $oc_nueva)
	        {
    	        $oc = new Oc;
    	        $oc->oc = $oc_nueva->oc;
    	        $oc->fecha_oc = $oc_nueva->fecha_oc;
    	        $oc->req = $oc_nueva->req;
    	        $oc->db_origen = 'sgf14';
    	        $oc->urg_id = '';
    	        $oc->estatus = '';
    	        
    	        $oc->save();
	        }
	    }
	}
	
	public function listarOc()
	{
	    $this->importarOcNuevas();
	    
        $oc_data = Oc::where('estatus', '=', '')
                    ->get();
        //$data['oc_data'] = $oc_data; //puede remplazar compact('oc_data')
        return View::make('oc-listar', compact('oc_data'));
	}

}
