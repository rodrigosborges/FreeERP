<?php
namespace Modules\Assistencia\Validators;
class TelefoneValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        return $this->isValidate($attribute, $value);
    }
    protected function isValidate($attribute, $value)
    {
        if(preg_match('/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/', $value)){
            return true;
        }else{
            return false;
        }
    }
}