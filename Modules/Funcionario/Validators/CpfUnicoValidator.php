<?php

namespace Modules\Funcionario\Validators;
use App\Entities\{Documento,Relacao};

class CpfUnicoValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        return $this->isValidate($attribute, $value, $parameters);
    }

    protected function isValidate($attribute, $value, $parameters){
        $id = intval($parameters[0]);
        $cpf = preg_replace('/[^0-9]/', '', $value);
        $documento = Documento::where("numero",$cpf)->where("tipo_documento_id", 1)->first();
        if($documento){
            $relacao = Relacao::where("tabela_origem","funcionario")->where("origem_id",$id)->where("tabela_destino","documento")->where("destino_id",$documento->id)->get();
            if(count($relacao)){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }
}