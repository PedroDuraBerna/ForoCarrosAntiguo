<?php
    
    function validar_contraseña($err,$contraseña){

        $minusculas = false;
        $mayusculas = false;
        $numeros = false;
    
        if(texto_vacio($contraseña)){
            $err["contraseña_vacia"] = "No has introducido contraseña.";
        } else  if(strlen($contraseña) < 8){
            $err["contraseña_corta"] = "La contraseña es demasiado corta (Mínimo 8 carácteres).";
        } else {
    
            if(strlen($contraseña) >= 8){
    
                if(espacios($contraseña)){
                    $err["contraseña_contiene_espacio"] = "La contraseña no puede contener espacios.";
                }
        
                for($i = 0; $i < strlen($contraseña); $i++){
                    if($contraseña[$i] == ctype_lower($contraseña[$i])){
                        $minusculas = true;
                    }
                    if($contraseña[$i] == ctype_upper($contraseña[$i])){
                        $mayusculas = true;
                    }
                    if(is_numeric($contraseña[$i])){
                        $numeros = true;
                    }
                    if(caracteres_invalidos($contraseña)){
                        $err["contraseña_caracteres_invalidos"] = "Has introducido carácteres inválidos en la contraseña.";
                    }
                }
    
                if($minusculas == false){
                    $err["contraseña_falta_minuscula"] = "No has introducido ninguna minúscula en la contraseña.";
                }
                if($mayusculas == false){
                    $err["contraseña_falta_mayuscula"] = "No has introducido ninguna mayúscula en la contraseña.";
                }
                if($numeros == false){
                    $err["contraseña_falta_numeros"] = "No has introducido ningun número en la contraseña.";
                }
    
            } 
    
        }
    
        if(strlen($contraseña) >=30){
            $err["contraseña_larga"] = "La contraseña es demasiado larga (Máximo 30 carácteres).";
        }

        return $err;

    }

?>