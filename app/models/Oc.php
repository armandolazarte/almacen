class Oc extends Eloquent
{
    public $table = 'oc';
    
    //Oc __has_many__ OcArticulo
    public function ocArticulos()
    {
        return $this->hasMany('OcArticulo');
    }
}