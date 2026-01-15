<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;

class CaptchaTest extends Controller
{
    //
    public function index(Request $request)
    {
        return view('captcha_test.login');
    }


    public function validar(Request $request)
    {

        $validatedData = $request->validate([
            'g-recaptcha-response' => 'required|recaptchav3:captcha,0.9' 
        ]);        

        echo "Paso la validacion";

    }

}
