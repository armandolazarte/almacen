class OcArticulo extends Eloquent
{
    public $table = 'oc_articulos';
    
    // OcArticulo __belongs_to__ Oc
    public function oc()
    {
        return $this->belongsTo('Oc');
    }
    
    //OcArticulo __belongs_to__ Articulo
//    public function articulos()
//    {
//        return $this->belongsTo('Articulo');
//    }
}