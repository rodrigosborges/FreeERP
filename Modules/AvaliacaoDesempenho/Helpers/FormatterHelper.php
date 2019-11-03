<?php

class FormatterHelper {

  public static function multiSelectValues($array){
    $newarray = [];
    foreach($array as $element){
      array_push($newarray,$element->id);
    }
    return $newarray;
  }

  public static function filter($inputs, $fields = array()) {

    foreach ($fields as $key => $field){

      if (array_key_exists($field, $inputs))
      $inputs[$field] = strtoupper(
        str_replace(
          array("à", "á", "â", "ã", "ä", "è", "é", "ê", "ë", "ì", "í", "î", "ï", "ò", "ó", "ô", "õ", "ö", "ù", "ú", "û", "ü", "À", "Á", "Â", "Ã", "Ä", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï", "Ò", "Ó", "Ô", "Õ", "Ö", "Ù", "Ú", "Û", "Ü", "ç", "Ç", "ñ", "Ñ", "`", "´", "^", "~", "¨"),
          array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "c", "C", "n", "N", "", "", "", "", ""),
          $inputs[$field]
          )
        );
      }

      return $inputs;
    }

    public static function dateToPtBR($date) {

      $result = new DateTime($date);

      return $result->format("d/m/Y");
    }

    public static function dateToEn($date) {

      $result = new DateTime($date);

      return $result->format("Y-d-m");
    }

    public static function dateTimeToPtBR($datetime) {

      $result = new DateTime($datetime);

      return $result->format("d/m/Y H:i:s");
    }

    public static function dateToMySQL($date) {
      $result = date("Y-m-d",strtotime(str_replace('/','-', $date)));

      return $result;
    }

    public static function dateToWeekday($date) {

      $result = explode("/", $date);

      //                                         $mes,       $dia,       $ano
      $dia_da_semana = date("w", mktime(0, 0, 0, $result[1], $result[0], $result[2]));

      switch ($dia_da_semana) {

        case"0": $dia_da_semana = "DOM";
        break;
        case"1": $dia_da_semana = "SEG";
        break;
        case"2": $dia_da_semana = "TER";
        break;
        case"3": $dia_da_semana = "QUA";
        break;
        case"4": $dia_da_semana = "QUI";
        break;
        case"5": $dia_da_semana = "SEX";
        break;
        case"6": $dia_da_semana = "SAB";
        break;
      }

      return $dia_da_semana;
    }

    public static function mask($mask, $str) {

      $str = str_replace(" ", "", $str);

      for($i = 0; $i < strlen($str); $i++) {

        $mask[strpos($mask, "#")] = $str[$i];
      }

      return $mask;
    }



    /**
    * Formata os valores de uma array para letra maíuscula
    * @param $value : Array a ser formatada
    * @param $keys : Array contendo o nome dos campos que serão formatadas
    *                Caso seja vazia, todos os campos serão formatados
    **/
    public static function toUpperCase($values, $except= [], $keys = []) {
      $result = $values;
      if (empty($keys)) {
        foreach ($values as $key => $value) {
          if(!in_array($key, $except)){
            if (!is_array($result[$key])) {
              $result[$key] = mb_strtoupper($value, 'UTF-8');
            }
          }
        }
      } else {
        foreach ($keys as $key) {
          $result[$key] = mb_strtoupper($result[$key], 'UTF-8');
        }
      }

      return $result;
    }

    public static function toUpperInput($value){
      return $value = strtoupper($value);
    }

    /**
    * Formata todos os valores de uma array para letra maíuscula
    * @param $value: array ou valor que será convertido
    * @param $except: chaves a não serem formatadas
    **/
    public static function recursiveToUpperCase($values, $except = []) {
      $result = [];

      foreach ($values as $key => $value) {
        if (is_array($value)) { // Caso haja uma array dentro, chama recursivamente
          $result[$key] = self::recursiveToUpperCase($value);
        } else {
          if(!in_array($key, $except)){
            $result[$key] = mb_strtoupper($value, 'UTF-8');
          }else{
            $result[$key] = $value;
          }
        }
      }

      return $result;
    }
    /**
    * Formata todos as primeiras letras para maíuscula
    * @param $value: valor que será convertido
    * @param $except: palavras a não serem formatadas
    **/
    public static function ucwords_improved($value, $except){
      return join(' ',
      array_map(
        create_function('$value','return (!in_array($value, ' . var_export($except, true) . ')) ? ucfirst($value) : $value;'
      ),
      explode(' ', strtolower($value))
      )
    );
  }

  /**
  * XXX: Poderia ser renomeado para não gerar problemas de interpretação
  *        E acabar por tentar usar em strings com caracteres alfanumericos
  * Remove os sinais de retornando apenas os números
  * @param String $data : Valor a ser formatadop
  * @return String : Valor sem sinais e letras
  **/
  public static function removeSignals($data) {
    return preg_replace("/[^0-9]+/", "", $data);
  }

  /* Formatadores de data por extenso e normal */
  public static function setFullDate($date){
    if(substr($date, -8, 8) !== "00:00:00"){
      return strftime('%d/%m/%Y às %H:%M', strtotime($date));
    }else{
      return strftime('%d/%m/%Y', strtotime($date));
    }
  }
  public static function brToEnDate($date){ return implode('-', array_reverse(explode('/', $date))) ? : ''; }
  public static function enToBrDate($date){ return implode('/', array_reverse(explode('-', $date))) ? : ''; }

  /**
  * Faz a limpeza do Array, removendo todos os indices com valores e arrays filhas vazias
  * @param Array|Mixed $data : Array com os dados a serem limpos
  * @return Array|Mixed : Array sem índices vazios
  **/
  public static function clearData($data) {
    $result = [];

    foreach ($data as $key => $value){
      if (is_array($value)) { // Caso haja uma array dentro, chama recursivamente
        $result[$key] = self::clearData($value);
        if(empty($result[$key])){
          $result[$key] = null;
        }
      } else {
        $value = trim($value);
        if(!empty($value)){
          $result[$key] = $value;
        } else {
          $result[$key] = null;
        }
      }
    }

    return $result;
  }

  /**
  * Pega o valor do CPF e adiciona os sinais, retornando ###.###.###-##
  * @param String $cpf : CPF sem sinais
  * @return String: CPF com sinais
  **/
  public static function setCPF($cpf){
    $newCPF = substr_replace($cpf   , '-', 9, 0);
    $newCPF = substr_replace($newCPF, '.', 6, 0);
    $newCPF = substr_replace($newCPF, '.', 3, 0);
    return $newCPF;
  }

  public static function enToBrTimes($times){
    $times = str_replace(":", "-", $times);
    return $times;
  }

  public static function setRG($rg){
    $newRG = substr_replace($rg   , '-', 8, 0);
    $newRG = substr_replace($newRG, '.', 5, 0);
    $newRG = substr_replace($newRG, '.', 2, 0);
    return $newCPF;
  }

  public static function removeSinais($valor){
    $valor = trim($valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    $valor = str_replace("(", "", $valor);
    $valor = str_replace(")", "", $valor);
    return $valor;
  }


  /**
  * Pega o valor do CEP e adiciona os sinais, retornando #####-###
  * @param String $cep : CEP sem sinais
  * @return String: CEP com sinais
  **/
  public static function setCEP($cep){
    if(!empty($cep)){
      $cep = substr_replace($cep, '-', 5, 0);
    }
    return $cep;
  }

  public static function setTelephone($tel){
    if(!empty($tel)) {
      $tel = substr_replace($tel, '-', -4, 0);
      $tel = substr_replace($tel, ') ', 2, 0);
      $tel = substr_replace($tel, '(', 0, 0);
    }
    return $tel;
  }


  public static function camelToSnakeCase($value) {
    return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $value));
  }

  public static function getAgeMonthFromDate($date) {
    list($year, $month, $day) = explode('-', $date);
    $today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $birth = mktime( 0, 0, 0, $month, $day, $year);
    $age = (((($today - $birth) / 60) / 60) / 24) / 365.25;
    $month = floor(12 * ($age - floor($age)));
    $age = floor($age);

    return ['anos' => $age, 'meses' => $month];
  }


  public static function array_values_recursive($array) {
    $flat = array();

    foreach($array as $value) {
      if (is_array($value)) {
        $flat = array_merge($flat, Self::array_values_recursive($value));
      }
      else {
        $flat[] = $value;
      }
    }
    return $flat;
  }

  public static function setTelefone($tel){
    if(strlen($tel) == 11){
      $tel = substr_replace($tel, '-', 7, 0);
      $tel = substr_replace($tel, '-', 3, 0);
      $tel = substr_replace($tel, ' ', 2, 0);
      $tel = substr_replace($tel, ')', 2, 0);
      $tel = substr_replace($tel, '(', 0, 0);
    }else{
      $tel = substr_replace($tel, '-', 6, 0);
      $tel = substr_replace($tel, ' ', 2, 0);
      $tel = substr_replace($tel, ')', 2, 0);
      $tel = substr_replace($tel, '(', 0, 0);
    }
    return $tel;
  }

  public static function somenteNumeros($data) {
    return preg_replace("/[^0-9]+/", "", $data);
  }

}
