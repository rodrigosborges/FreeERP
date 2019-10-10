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
        $this->error = " ";
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
        global $error;
        //TESTE

        if( strlen($senha) < 8 ) {
            $error = "A senha deve ter mais de 8 caracteres";
            return false;
        }
        elseif( strlen($senha) > 16 ) {
            $error = "A senha deve ter menos de 16 caracteres";
            return false;
        }
        
        elseif( !preg_match("#[0-9]+#", $senha) ) {
            $error = "A senha deve conter ao menos um número";
            return false;
        }
        elseif( !preg_match("#[a-z]+#", $senha) ) {
            $error = "A senha deve conter ao menos uma letra minúscula";
            return false;
        }
        elseif( !preg_match("#[A-Z]+#", $senha) ) {
            $error = "A senha deve deve conter ao menos uma letra maiúscula";
            return false;
        }
        elseif( !preg_match("#\W+#", $senha) ) {
            $error = "A senha deve ter conter ao menos um caractere especial";
            return false;
        }


        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        global $error;
        return $error;
    }
}
