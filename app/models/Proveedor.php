<?php

class Proveedor extends Eloquent
{
    public $table = 'proveedores';
    
    //Proveedor __has_many__ Entrada
    public function entradas()
    {
        return $this->hasMany('Entrada');
    }
    
    //Proveedor __has_many__ Oc
    public function oc()
    {
        return $this->hasMany('Oc');
    }
}
