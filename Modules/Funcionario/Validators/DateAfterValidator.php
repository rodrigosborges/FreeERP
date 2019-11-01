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
        $entrada = \DateTime::createFromFormat('d/m/Y H:i:s', $parameter);
        $entrada = $entrada->format('Y-m-d H:i:s');
        $saida = \DateTime::createFromFormat('d/m/Y H:i:s', $value);
        $saida = $saida->format('Y-m-d H:i:s');

        return strtotime($saida) > strtotime($entrada);
    }
}