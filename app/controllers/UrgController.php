<?php

class UrgController extends BaseController
{
    
    public function consultarUrgExternas()
    {
        $urg_importadas = Urg::lists('urg');
        if ( count($urg_importadas) > 0 ) {
            $urg_externas = DB::connection('sgf14')->table('tbl_ures')
                    ->whereNotIn ('ures', $urg_importadas)
                    ->get();
        } else {
            $urg_externas = DB::connection('sgf14')->table('tbl_ures')
                    ->get();
        }
        
        return $urg_externas;
    }
    
    public function importarUrgNuevas()
    {
        $urg_externas = $this->consultarUrgExternas();
        if ( count($urg_externas) > 0 ) {
            foreach($urg_externas as $urg_nueva)
            {
                $urg = new Urg;
                $urg->urg = $urg_nueva->ures;
                $urg->d_urg = $urg_nueva->d_ures;
                
                $urg->save();
            }
        }
    }
    
    public function listarUrg()
    {
        $this->importarUrgNuevas();
        
        $urg_data = Urg::where('estatus', '=', '')
                    ->get();
        return View::make('', compact('urg_data'));
    }

}
