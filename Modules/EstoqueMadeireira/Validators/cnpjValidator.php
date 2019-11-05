<?php
namespace Modules\EstoqueMadeireira\Validators;
class cnpjValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        return $this->isValidate($attribute, $value);
    }
    protected function isValidate($attribute, $value)
    {
		$value = preg_replace('/[^0-9]/', '', (string) $value);
		// Valida tamanho
		if (strlen($value) != 14)
			return false;
		// Valida primeiro dígito verificador
		for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
		{
			$soma += $value{$i} * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}
		$resto = $soma % 11;
		if ($value{12} != ($resto < 2 ? 0 : 11 - $resto))
			return false;
		// Valida segundo dígito verificador
		for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
		{
			$soma += $value{$i} * $j;
			$j = ($j == 2) ? 9 : $j - 1;
		}
		$resto = $soma % 11;
		return $value{13} == ($resto < 2 ? 0 : 11 - $resto);
}
}