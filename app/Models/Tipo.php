<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
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
