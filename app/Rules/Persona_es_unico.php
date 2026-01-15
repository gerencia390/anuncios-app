<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Persona;

class Persona_es_unico implements Rule
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
        if(Persona::existe_persona_por_nro_documento($value)){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El nro de documento ya está registrado, modifique los datos o intente autocompletar.';
    }
}
