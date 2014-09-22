class EntradaArticulo extends Eloquent
{
    
    //EntradaArticulo __belongs_to__ Entrada
    public function entrada()
    {
        return $this->belongsTo('Entrada');
    }
    
    //EntradaArticulo __belongs_to__ Articulo
    public function articulo()
    {
        return $this->belongsTo('Articulo');
    }
}