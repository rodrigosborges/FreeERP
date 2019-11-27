<?php

namespace Modules\Funcionario\Validators;

class TelefoneValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        return $this->isValidate($attribute, $value);
    }

    protected function isValidate($attribute, $value)
    {
        if (preg_match('/(\(?\d{2}\)?) ?9?\d{4}-?\d{4}/', $value)) {
            return true;
        }else{
            return false;
        }
    }
}