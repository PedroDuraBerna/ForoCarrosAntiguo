<?php
    function espacios($texto){
        if(strpos($texto," ") || ctype_space($texto)){
            return true;
        } else {
            return false;
        }
    }
?>