<?php

function mask($mask,$str){

    $str = str_replace(" ","",$str);

    for($i=0;$i<strlen($str);$i++){
        $mask[strpos($mask,"#")] = $str[$i];
    }

    return $mask;
}

function enToBrDate($date){
    return date("d/m/Y", strtotime($date));
}

function brToEnDate($date){ 
    return implode('-', array_reverse(explode('/', $date))) ? : ''; 
}