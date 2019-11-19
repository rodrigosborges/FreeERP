<?php 
    function dateToPtBR($date) {

        $result = new DateTime($date);
        
        return $result->format("d/m/Y");
    }
        
    function dateToEn($date) {
    
        $result = new DateTime($date);
        
        return $result->format("Y-d-m");
    }