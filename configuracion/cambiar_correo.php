<?php

    if(isset($_POST["cambiar_correo"])){

        //Recogemos la variables del POST

        if(isset($_POST["nuevo_correo"])){
            $nuevo_correo = $_POST["nuevo_correo"];
        } else {
            $nuevo_correo = "";
        }

        //validamos el correo

        $err = validar_correo($err,$nuevo_correo);

        //insertamos el correo si no hay errores

        if(empty($err)){
            unset($_SESSION["login"]["correo_usuario"]);
            $_SESSION["login"]["correo_usuario"] = $nuevo_correo;
            $usuario = new usuario;
            $usuario->cambiar_correo($_SESSION["login"]["nombre_usuario"],$nuevo_correo);
    
        }
    }

?>