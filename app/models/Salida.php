class Salida extends Eloquent
{
    
    //Salida __has_many__ SalidaArticulo
    public function salidaArticulos()
    {
        return $this->hasMany('SalidaArticulo');
    }
    
    //Salida __belongs_to__ Entrada
    public function entrada()
    {
        return $this->belongsTo('Entrada');
    }
    
    //Salida __belongs_to__ Urg
    public function urg()
    {
        return $this->belongsTo('Urg');
    }
}