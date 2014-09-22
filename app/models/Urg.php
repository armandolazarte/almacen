<?php

class Urg extends Eloquent
{
    public $table = 'urg';
    
    //Urg __has_many__ Entrada
    public function entradas()
    {
        return $this->hasMany('Entrada');
    }
    
    //Urg __has_many__ Salida
    public function salidas()
    {
        return $this->hasMany('Salida');
    }
}
