<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Authenticatable
{
    use SoftDeletes;
    use HasFactory;
    protected $table = "usuarios";
    protected $primaryKey = "usu_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */

    //Anuncios que corresponde al usuario
    public function anuncios(){
        return $this->hasMany(Anuncio::class, 'tip_id');
    }

}
