<?php

    function validar_correo($err,$correo){

        $se_cumple_lo_principal = true;

        //comprobamos que el correo no esta vacío y luego que el formato del correo sea correcto

        if(texto_vacio($correo)){
            $err["correo_vacio"] = "No has introducido el correo.";
            $se_cumple_lo_principal = false;
        } else if(!longitud_100($correo)){

            if(false === strpos($correo, "@") && false === strpos($correo, ".")){
                $err["correo_incorrecto"] = "Formato de correo incorrecto.";
                $se_cumple_lo_principal = false;
            }
        
            if(espacios($correo)){
                $err["correo_contiene_espacios"] = "El correo contiene espacios";
                $se_cumple_lo_principal = false;
            }

            if(caracteres_invalidos($correo)){
                $err["correo_caracteres_invalidos"] = "Has introducido carácteres inválidos en el correo.";
                $se_cumple_lo_principal = false;
            }

        } else {
            $err["correo_largo"] = "El correo que has introducido es demasiado largo. Máximo 100 carácteres.";
            $se_cumple_lo_principal = false;
        }

        //comprobamos el correo en la base de datos si se cumple lo principal, para evitar inyecciones sql

        if($se_cumple_lo_principal){

            $conexion = new conexion;
            $conexion = $conexion->abrir_conexion();

            $result = $conexion->query("Select * from usuario where correo_usuario = '$correo' ");
            $result = $result->num_rows;

            if($result >= 1){
                $err["correo_existe"] = "El correo ya existe.";
            }

            $conexion->close();
        }

        return $err;
    }
?>