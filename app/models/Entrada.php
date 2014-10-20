<?php

class Entrada extends Eloquent
{
    
    //Entrada __has_many__ EntradaArticulo
    public function entradaArticulos()
    {
        return $this->hasMany('EntradaArticulo');
    }
    
    //Entrada __has_many__ Salida
    public function salidas()
    {
        return $this->hasMany('Salida');
    }
    
    //Entrada __belongs_to__ Urg
    public function urg()
    {
        return $this->belongsTo('Urg');
    }
    
    //Entrada __belongs_to__ Proveedor
    public function Proveedor()
    {
        return $this->belongsTo('Proveedor');
    }
}
