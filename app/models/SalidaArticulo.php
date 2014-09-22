class SalidaArticulo extends Eloquent
{
    
    //SalidaArticulo __belongs_to__ Salida
    public function salida()
    {
        return $this->belongsTo('Salida');
    }
    
    //SalidaArticulo __belongs_to__ Articulo
    public function articulo()
    {
        return $this->belongsTo('Articulo');
    }
}