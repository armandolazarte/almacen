<?php

class ProveedorController extends BaseController
{
    /**
	 * Determina el ID del proveedor o lo da de alta en DB Almacen.
	 *
	 */
    public function getProveedorId ($id_externo)
    {
        $proveedor = $this->consultarProveedorAlmacen($id_externo);
        if ( $proveedor !== false ) { //Verifica que no sea falso para aplicar funciones propias de las colecciones
            $proveedor->toArray();
            $proveedor_id = $proveedor[0]['id'];
            return $proveedor_id;
        } else {
            $prov_externo = $this->consultarProvExterno($id_externo);
            $proveedor_id = $this->insertarProveedor($prov_externo);
            return $proveedor_id;
        }
    }
    
    /**
     * Consulta la información de un proveedor externo.
     * 
     */
    public function consultarProvExterno($id_externo)
    {
        $prov_externo = DB::connection('sgf_benef')->table('tbl_benef')
            ->leftJoin('tbl_proveedor', 'tbl_benef.benef_id', '=', 'tbl_proveedor.benef_id')
            ->where('tbl_benef.benef_id', '=', $id_externo)
            ->get(array('tbl_benef.benef_id', 'benef', 'RFC'));
        return $prov_externo;
    }
    
    /**
     * Inserta el proveedore externo en DB almacén.
     * 
     */
    public function insertarProveedor($prov_externo)
    {
        if (!empty($prov_externo[0]->benef_id)) {
            if ($prov_externo[0]->RFC == null) {
                $prov_externo[0]->RFC = '';
            }
            
            $prov = new Proveedor;
            $prov->proveedor_id = $prov_externo[0]->benef_id;
            $prov->d_proveedor = $prov_externo[0]->benef;
            $prov->rfc = $prov_externo[0]->RFC;
            $prov->save();
            
            return $prov->id;
        } else {
            return false;
        }
    }
    
    /**
     * Consulta la información de un proveedor registrado
     * 
     */
    public function consultarProveedorAlmacen($id_externo)
    {
        //$proveedor = Proveedor::where('proveedor_id', '=', $id_externo)
        //        ->get(array('id'));
        $proveedor = Proveedor::whereProveedorId($id_externo)->get(); //Sustitiuye las dos líneas anteriores
        
        if ( !$proveedor->isEmpty() ) {
            return $proveedor;
        } else {
            return false;
        }
    }
}
