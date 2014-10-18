<?php

class Articulo extends Eloquent
{
    
    //Articulo __has_many__ EntradaArticulo
    public function entradaArticulos()
    {
        return $this->hasMany('EntradaArticulo');
    }
    
    //Articulo __has_many__ SalidaArticulo
    public function salidaArticulos()
    {
        return $this->hasMany('SalidaArticulo');
    }
    
    //Articulo __has_many__ OcArticulo
    public function ocArticulos()
    {
        return $this->hasMany('OcArticulo');
    }
}
