<?php

    if(isset($_POST["cambiar_contraseña"])){

        //Recogemos las variables de la sesión

        $contraseña_original = $_SESSION["login"]["contraseña_usuario"];

        $contraseña_original = $desencriptar($contraseña_original);

        //Recogemos las variables del POST

        if(isset($_POST["antigua"])){
            $contraseña_antigua = $_POST["antigua"];
        } else {
            $contraseña_antigua = "";
        }

        if(isset($_POST["nueva"])){
            $contraseña_nueva = $_POST["nueva"];
        } else {
            $contraseña_nueva = "";
        }

        if(isset($_POST["repetida"])){
            $contraseña_repetida= $_POST["repetida"];
        } else {
            $contraseña_repetida = "";
        }

        //Validamos las variables del POST

        if($contraseña_antigua != ""){
            $err = validar_contraseña($err,$contraseña_antigua);
        } else {
            $err["no_hay_antigua"] = "No has introducido la contraseña antigua";
        }

        if($contraseña_nueva != ""){
            $err = validar_contraseña($err,$contraseña_nueva);
        } else {
            $err["no_hay_nueva"] = "No has introducido la contraseña nueva";
        }

        if($contraseña_repetida != ""){
            $err = validar_contraseña($err,$contraseña_repetida);
        } else {
            $err["no_hay_repetida"] = "No has introducido la contraseña repetida";
        }
        

        //Comprobamos que la contraseña nueva y repetida coinciden

        if($contraseña_nueva != $contraseña_repetida){
            $err["no_coinciden_nueva_repetida"] = "Las contraseña nueva no coincide con la repetida";
        }

        //Comprobamos que hemos introducido la contraseña antigua correctamente si existe que has introducido la antigua

        if($contraseña_antigua != ""){
            if($contraseña_original != $contraseña_antigua){
                $err["no_coincide_nueva_original"] = "Has introducido mal tu contraseña antigua";
            }
            if($contraseña_original == $contraseña_nueva){
                $err["no_mismas"] = "La contraseña que quieres cambiar es idéntica a la que ya tienes, MERLUZO";
            }
        }

        //Insertamos si no hay errores

        if(empty($err)){
            $contraseña_nueva = $encriptar($contraseña_nueva);
            unset($_SESSION["login"]["contraseña_usuario"]);
            $_SESSION["login"]["contraseña_usuario"] = $contraseña_nueva;
            $usuario = new usuario;
            $usuario->cambiar_contraseña($_SESSION["login"]["nombre_usuario"],$contraseña_nueva);
        }

    }

?>