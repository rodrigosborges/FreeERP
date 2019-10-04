<?php
namespace Modules\Cliente\Validators;
use App\Entities\Documento;
class DocUniqueValidator
{

    public function validate($attribute, $value, $parameters, $validator)
    {
        return $this->isValidate($attribute, $value,$parameters);
    }

    protected function isValidate($attribute, $value,$parameters)
    {
        $value = preg_replace('/\D/', '', $value);
        
        $documento = Documento::join('cliente' , 'documento.id', '=', 'cliente.documento_id')
                                ->where('cliente.id', '<>', $parameters[0])
                                ->where('numero', '=', $value)->count();

        return $documento == 0;

    }
}