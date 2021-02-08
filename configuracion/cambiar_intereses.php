<?php

    if(isset($_POST["cambiar_intereses"])){

        //Recogemos las variables del POST

        $intereses_usuario = $_POST["intereses_usuario"];

        //validamos

        if(longitud_100($intereses_usuario)){
            $err["muy_largo"] = "Mucho texto. Como máximo introduce 100 carácteres";
        }

        if(texto_vacio($intereses_usuario)){
            $err["texto_vacio"] = "No has introducido texto";
        }

        if(caracteres_invalidos($intereses_usuario)){
            $err["caracteres_invalidos"] = "Has introducido carácteres inválidos";
        }

        //insertamos si no hay errores

        if(empty($err)){
            unset($_SESSION["login"]["intereses_usuario"]);
            $_SESSION["login"]["intereses_usuario"] = $intereses_usuario;
            $usuario = new usuario;
            $usuario->cambiar_intereses($_SESSION["login"]["nombre_usuario"],$intereses_usuario);
        }

    }

?>