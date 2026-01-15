<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'El campo :attribute debe ser aceptado.',
    'accepted_if' => 'El campo :attribute debe ser aceptado cuando :other es :value.',
    'active_url' => 'El campo :attribute no contiene una URL válida.',
    'after' => 'El campo :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'El campo :attribute debe contener una fecha posterior o igual a :date.',
    'alpha' => 'El campo :attribute solo debe contener letras.',
    'alpha_dash' => 'El campo :attribute solo debe contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El campo :attribute solo debe contener letras y números.',
    'array' => 'El campo :attribute debe ser un arreglo.',
    'before' => 'El campo :attribute debe contener una fecha anterior a  :date.',
    'before_or_equal' => 'El campo :attribute debe contener una fecha anterior o igual a :date.',
    'between' => [
        'numeric' => 'El campo :attribute debe estar entre :min y :max.',
        'file' => 'El campo :attribute debe tener entre :min y :max kilobytes.',
        'string' => 'El campo :attribute debe tener entre :min y :max caracteres.',
        'array' => 'El campo :attribute debe tener entre :min y :max items.',
    ],
    'boolean' => 'El campo :attribute debe ser falso o verdadero.',
    'confirmed' => 'El campo de confirmación :attribute no coincide.',
    'current_password' => 'La contraseña no es correcta.',
    'date' => 'El campo :attribute no contiene una fecha valida.',
    'date_equals' => 'El campo :attribute debe contener una fecha igual a :date.',
    'date_format' => 'El campo :attribute no coincide con el formato :format.',
    'different' => 'El campo :attribute y :other deben ser diferentes.',
    'digits' => 'El campo :attribute debe contener :digits digitos.',
    'digits_between' => 'El campo :attribute debe contener entre :min y :max digitos.',
    'dimensions' => 'El campo :attribute tiene dimensiones de imagen no validas.',
    'distinct' => 'El campo :attribute tiene un valor duplicado.',
    'email' => 'El campo :attribute debe contener un e-mail válido.',
    'ends_with' => 'El campo :attribute debe terminar con uno de los siguientes valores: :values.',
    'exists' => 'El campo seleccionado :attribute no es válido.',
    'file' => 'El campo :attribute debe contener un archivo.',
    'filled' => 'El campo :attribute debe contener un valor.',
    'gt' => [
        'numeric' => 'El campo :attribute debe ser mayor que :value.',
        'file' => 'El campo :attribute debe tener más de :value kilobytes.',
        'string' => 'El campo :attribute debe tener más de :value caracteres.',
        'array' => 'El campo :attribute debe tener más de :value elementos.',
    ],
    'gte' => [
        'numeric' => 'El campo :attribute debe ser mayor o igual que :value.',
        'file' => 'El campo :attribute debe tener igual o más de :value kilobytes.',
        'string' => 'El campo :attribute debe tener igual o más de :value caracteres.',
        'array' => 'El campo :attribute debe tener :value elementos o más.',
    ],
    'image' => 'El campo :attribute debe contener una imagen.',
    'in' => 'El campo seleccionado :attribute no es válido.',
    'in_array' => 'El campo :attribute no existe en :other.',
    'integer' => 'El campo :attribute debe ser un entero.',
    'ip' => 'El campo :attribute debe contener una dirección IP válida.',
    'ipv4' => 'El campo :attribute debe contener una dirección IPv4 válida.',
    'ipv6' => 'El campo :attribute debe contener una dirección IPv6 válida.',
    'json' => 'El campo :attribute debe contener una cadena JSON válida.',
    'lt' => [
        'numeric' => 'El campo :attribute debe ser menor que :value.',
        'file' => 'El campo :attribute debe tener menos que :value kilobytes.',
        'string' => 'El campo :attribute debe tener menos de :value caracteres.',
        'array' => 'El campo :attribute debe tener menos de :value elementos.',
    ],
    'lte' => [
        'numeric' => 'El campo :attribute debe ser menor o igual que :value.',
        'file' => 'El campo :attribute igual o menos de :value kilobytes.',
        'string' => 'El campo :attribute debe tener igual o menos de :value caracteres.',
        'array' => 'El campo :attribute debe tener igual o menos de :value elementos.',
    ],
    'max' => [
        'numeric' => 'El campo :attribute no debe ser mayor que :max.',
        'file' => 'El campo :attribute no debe tener mas de :max kilobytes.',
        'string' => 'El campo :attribute no debe tener mas de :max caracteres.',
        'array' => 'El campo :attribute no debe tener mas de :max elementos.',
    ],
    'mimes' => 'El campo :attribute debe contener un archivo de tipo: :values.',
    'mimetypes' => 'El campo :attribute debe contener un archivo de tipo: :values.',
    'min' => [
        'numeric' => 'El campo :attribute debe ser mayor que :min.',
        'file' => 'El campo :attribute debe tener al menos :min kilobytes.',
        'string' => 'El campo :attribute debe contener al menos :min characters.',
        'array' => 'El campo :attribute debe contener al menos :min elementos.',
    ],
    'multiple_of' => 'El campo :attribute debe ser multiplo de :value.',
    'not_in' => 'El campo seleccionado :attribute no es válido.',
    'not_regex' => 'El campo :attribute no tiene formato válido.',
    'numeric' => 'El campo :attribute debe ser un número.',
    'password' => 'La contraseña no es correcta.',
    'present' => 'El campo :attribute debe estar presente.',
    'regex' => 'El campo :attribute no tiene formato válido.',
    'required' => 'El campo :attribute es requerido.',
    'required_if' => 'El campo :attribute es requerido cuando :other es :value.',
    'required_unless' => 'El campo :attribute es requerido a menos que :other tenga los valores :values.',
    'required_with' => 'El campo :attribute es requerido cuando :values estan presentes.',
    'required_with_all' => 'El campo :attribute es requerido cuando :values estan todos presentes.',
    'required_without' => 'El campo :attribute es requeido cuando :values no estan presentes.',
    'required_without_all' => 'El campo :attribute es requerido cuando ninguno de :values estan presentes.',
    'prohibited' => 'El campo :attribute esta prohibido.',
    'prohibited_if' => 'El campo :attribute esta prohibido cuando :other es :value.',
    'prohibited_unless' => 'El cmapo :attribute es prohibido a menos que :other esté en :values.',
    'prohibits' => 'El campo :attribute prohibe la presencia de :other.',
    'same' => 'El campo :attribute y :other deben coincidir.',
    'size' => [
        'numeric' => 'El campo :attribute debe ser de tamaño :size.',
        'file' => 'El campo :attribute debe ser de :size kilobytes.',
        'string' => 'El campo :attribute debe tener :size caracteres.',
        'array' => 'El campo :attribute debe contener :size elementos.',
    ],
    'starts_with' => 'El campo :attribute debe empezar con lo siguiente: :values.',
    'string' => 'El campo :attribute debe ser una cadena de caracteres.',
    'timezone' => 'El campo :attribute debe ser una zona horaria válida.',
    'unique' => 'El campo :attribute ya está registrado.',
    'uploaded' => 'El campo :attribute no se pudo subir al servidor.',
    'url' => 'El campo :attribute debe ser una URL válida.',
    'uuid' => 'El campo :attribute debe ser un identificador UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
