<?php

namespace Modules\Funcionario\Validators;

class DateAfterValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        return $this->isValidate($attribute, $value, $parameters[0]);
    }

    protected function isValidate($attribute, $value, $parameter)
    {
        return strtotime($value) > strtotime($parameter);
    }
}