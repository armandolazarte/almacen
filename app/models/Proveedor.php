class Proveedor extends Eloquent
{
    public $table = 'proveedores';
    
    //Proveedor __has_many__ Entrada
    public function entradas()
    {
        return $this->hasMany('Entrada');
    }
}