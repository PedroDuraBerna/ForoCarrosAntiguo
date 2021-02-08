<?php

    if(isset($_POST["cambiar_foto_perfil"])){

        $tipos_permitidos = array("image/png","image/jpeg","image/gif","image/swf","image/tiff","image/jpeg2000");

        //Recogemos las variables del POST

        $foto_perfil_usuario = time().$_FILES["foto_perfil"]["name"];
        $tipo = $_FILES["foto_perfil"]["type"];
        $tmp_name = $_FILES["foto_perfil"]["tmp_name"];
        $tamaño = $_FILES["foto_perfil"]["size"];

        //validamos

        if($tamaño >= 1000000){
            $err["muy_grande"] = "La imagen es demasiado grande. Máximo 1 megabyte.";
        }

        if(!in_array($tipo,$tipos_permitidos)){
            $err["tipo"] = "No se admite el formato de imagen. Tipos permitidos: png, jpg, gif, tiff, swf, jpeg2000";
        }

        //insertamos si no hay errores cambiamos la foto

        if(empty($err)){

            $usuario = new usuario;

            $foto = $usuario->ver_foto($_SESSION["login"]["nombre_usuario"]);

            if($foto != null){
                unlink("./imagenes/foto_perfil/" . $foto);
            }
            move_uploaded_file($tmp_name,"./imagenes/foto_perfil/" . $foto_perfil_usuario);
            $usuario->cambiar_foto($_SESSION["login"]["nombre_usuario"],$foto_perfil_usuario);
        }

    }

?>