<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    
    protected $table = "categorias";
    protected $primaryKey = "cat_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Anuncio que corresponde a la categoria
    public function anuncios(){
        return $this->hasMany(Anuncio::class, 'cat_id');
    }
    
}
