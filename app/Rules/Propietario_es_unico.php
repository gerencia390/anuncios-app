<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Propietario_real;

class Propietario_es_unico implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        if(Propietario_real::existe_propietario_real_por_nro_documento($value) == false){
            return true;//no existe nada en la BD :: es unico
        }else{
            return false;//existe en la bd :: no es unico
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El propietario con el nro de documento ya está registrado, modifique los datos o intente autocompletar';
    }
}
