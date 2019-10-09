<?php

namespace Modules\Usuario\Rules;

use Illuminate\Contracts\Validation\Rule;

class VerificarSenha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public $error;

    public function __construct()
    {
        // $this->error = $error;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  string  $mensagem
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $senha)
    {
        //TESTE

        if( strlen($senha) < 8 ) {
            $error = 'A senha deve ter mais de 8 caracteres';
            return false;
        }
        // if( strlen($senha) > 20 ) {
        //     $error .= "Password too long!
        // ";
        // }
        
        // if( !preg_match("#[0-9]+#", $senha) ) {
        // $error .= "Password must include at least one number!
        // ";
        // }
        // if( !preg_match("#[a-z]+#", $senha) ) {
        // $error .= "Password must include at least one letter!
        // ";
        // }
        // if( !preg_match("#[A-Z]+#", $senha) ) {
        // $error .= "Password must include at least one CAPS!
        // ";
        // }
        // if( !preg_match("#\W+#", $senha) ) {
        // $error .= "Password must include at least one symbol!
        // ";
        // }


        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $error;
    }
}
