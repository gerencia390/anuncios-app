<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo extends Model
{
    use SoftDeletes;
    
    protected $table = "tipos";
    protected $primaryKey = "tip_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Anuncios que corresponde al tipo
    public function anuncios(){
        return $this->hasMany(Anuncio::class, 'tip_id');
    }
}
