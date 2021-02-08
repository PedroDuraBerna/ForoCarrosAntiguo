<?php

    function validar_usuario($err,$nombre_usuario){

        $se_cumple_lo_principal = true;

        //no se puede introducir un nombre vacío, carácteres inválidos, espacios o con más de 25 carácteres

        if(texto_vacio($nombre_usuario)){
            $err["nombre_vacio"] = "No has introducido el nombre.";
            $se_cumple_lo_principal = false;
        } else if(strlen($nombre_usuario) < 25 ){

            if(espacios($nombre_usuario)){
                $err["nombre_contiene_espacio"] = "No pueden haber espacios en el nombre.";
                $se_cumple_lo_principal = false;
            }
            if(caracteres_invalidos($nombre_usuario)){
                $err["usuario_caracteres_invalidos"] = "Has introducido carácteres inválidos en el nombre de usuario.";
                $se_cumple_lo_principal = false;
            }

        } else {
            $err["nombre_largo"] ="El nombre que has introducido es demasiado largo (Máximo 25 carácteres).";
            $se_cumple_lo_principal = false;
        }

        //comprobamos el nombre en la base de datos si se cumple lo principal, para evitar inyecciones sql

        if($se_cumple_lo_principal){

            $conexion = new conexion;
            $conexion = $conexion->abrir_conexion();
    
            $result = $conexion->query("Select * from usuario where nombre_usuario = '$nombre_usuario' ");
            $result = $result->num_rows;
    
            if($result >= 1){
                $err["usuario_existe"] = "El usuario ya existe.";
            }
    
            $conexion->close();
        }

        return $err;

    }

?>