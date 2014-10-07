<?php

class Oc extends Eloquent
{
    public $table = 'oc';
    
    //Oc __has_many__ OcArticulo
    public function ocArticulos()
    {
        return $this->hasMany('OcArticulo');
    }
    
    // Oc __belongs_to__ Proveedor
    public function proveedor()
    {
        return $this->belongsTo('Proveedor');
    }
    
    // OcArticulo __belongs_to__ Urg
    public function urg()
    {
        return $this->belongsTo('Urg');
    }
}
