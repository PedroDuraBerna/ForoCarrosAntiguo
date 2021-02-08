<?php

require("util/longitud_100.php");
require("util/texto_vacio.php");
require("util/espacios.php");
require("util/caracteres_invalidos.php");
require("validar_usuario.php");
require("validar_contraseña.php");

function validar_login($err,$nombre_usuario,$contraseña_usuario){

    //Validamos usuario

    $err = validar_usuario($err,$nombre_usuario);

    if(isset($err["usuario_existe"])){
        unset($err["usuario_existe"]);
    }

    //Validamos contraseña

    $err = validar_contraseña($err,$contraseña_usuario);

    //Buscamos a ese usuario con esa contraseña si no hay errores

    if(empty($err)){

        $usuario = new usuario;

        if($usuario->buscar_usuario($nombre_usuario)){

            require("util/codificacion/encriptacion.php");

            $contraseña_usuario = $encriptar($contraseña_usuario);

            if(!$usuario->comprobar_contraseña($nombre_usuario,$contraseña_usuario)){

                $err["contraseña_usuario_incorrecta"] = "La contraseña para este eusuario es incorrecta.";
                
            }
        }

    }

    return $err;

}

?>