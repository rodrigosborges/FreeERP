<?php 

class FuncionarioHelper {

    public static function brToEnDate($date) {
        return implode('-', array_reverse(explode('/', $date))) ? : '';
    }

    public static function enToBrDate($date) {
        return implode('/', array_reverse(explode('-', $date))) ? : '';
    }

    public static function removeMascaraTelefone($valor) {
        $valor = trim($valor);
        $valor = str_replace("(", "", $valor);
        $valor = str_replace(")", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace(" ", "", $valor);
        return $valor;
    }

}