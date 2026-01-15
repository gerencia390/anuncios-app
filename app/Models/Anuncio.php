<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $table = "anuncios";
    protected $primaryKey = "anu_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Anuncio que corresponde a la categoria
    public function categoria(){
        return $this->belongsTo(Categoria::class, 'cat_id');
    }

    //Anuncio que corresponde al tipo
    public function tipo(){
        return $this->belongsTo(Tipo::class, 'tip_id');
    }

    //Anuncio que corresponde al usuario
    public function usuario(){
        return $this->belongsTo(Usuario::class, 'usu_id');  
    }
}
