<?php

    if(isset($_POST["cambiar_firma"])){

        //Recogemos las variables del POST

        $firma_usuario = $_POST["firma_usuario"];

        //validamos

        if(longitud_100($firma_usuario)){
            $err["muy_largo"] = "Mucho texto. Como máximo introduce 100 carácteres";
        }

        if(texto_vacio($firma_usuario)){
            $err["texto_vacio"] = "No has introducido texto";
        }

        if(caracteres_invalidos($firma_usuario)){
            $err["caracteres_invalidos"] = "Has introducido carácteres inválidos";
        }

        //insertamos si no hay errores

        if(empty($err)){
            unset($_SESSION["login"]["firma_usuario"]);
            $_SESSION["login"]["firma_usuario"] = $firma_usuario;
            $usuario = new usuario;
            $usuario->cambiar_firma($_SESSION["login"]["nombre_usuario"],$firma_usuario);
        }

    }

?>