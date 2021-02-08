<?php
    function caracteres_invalidos($texto){
        $caracteres_invalidos = array("'","\"","<",">");
        for($i = 0; $i < strlen($texto); $i++){
            if(in_array($texto[$i],$caracteres_invalidos)){
                return true;
            }
        }
        return false;
    }
?>