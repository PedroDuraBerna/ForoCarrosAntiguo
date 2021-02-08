<?php

    if(isset($_POST["cambiar_biografia"])){

        //Recogemos las variables del POST

        $biografia_usuario = $_POST["biografia_usuario"];

        //validamos

        if(longitud_1000($biografia_usuario)){
            $err["muy_largo"] = "Mucho texto. Como máximo introduce 1000 carácteres";
        }

        if(texto_vacio($biografia_usuario)){
            $err["texto_vacio"] = "No has introducido texto";
        }

        if(caracteres_invalidos($biografia_usuario)){
            $err["caracteres_invalidos"] = "Has introducido carácteres inválidos";
        }

        //insertamos si no hay errores

        if(empty($err)){
            unset($_SESSION["login"]["biografia_usuario"]);
            $_SESSION["login"]["biografia_usuario"] = $biografia_usuario;
            $usuario = new usuario;
            $usuario->cambiar_biografia($_SESSION["login"]["nombre_usuario"],$biografia_usuario);
        }

    }

?>