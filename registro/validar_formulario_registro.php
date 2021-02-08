<?php 

require("./util/conexion/conexion.php");

function validar_formulario_registro($err,$nombre_usuario,$fecha_nacimiento,$contraseña,$contraseña_repetida,$correo){

    $caracteres_invalidos = array("'","\"","<",">");

    //no se puede introducir un nombre vacío, carácteres inválidos, espacios o con más de 25 carácteres

    if(strlen($nombre_usuario) == 0 ){
        $err["nombre_vacio"] = "No has introducido el nombre.";
    } else if(strlen($nombre_usuario) >= 25 ){
        $err["nombre_largo"] ="El nombre que has introducido es demasiado largo (Máximo 25 carácteres).";
    }

    if(strpos($nombre_usuario," ") || ctype_space($nombre_usuario)){
        $err["nombre_contiene_espacio"] = "No pueden haber espacios en el nombre.";
    }

    for($i = 0; $i < strlen($nombre_usuario); $i++){
        if(in_array($nombre_usuario[$i],$caracteres_invalidos)){
            $err["usuario_caracteres_invalidos"] = "Has introducido carácteres inválidos en el nombre de usuario.";
        }
    }

    //comprobamos el nombre en la base de datos

    $conexion = new conexion;
    $conexion = $conexion->abrir_conexion();

    $result = $conexion->query("Select * from usuario where nombre_usuario = '$nombre_usuario' ");
    $result = $result->num_rows;

    if($result >= 1){
        $err["usuario_existe"] = "El usuario ya existe.";
    }

    $conexion->close();

    //comprobamos el correo en la base de datos

    $conexion = new conexion;
    $conexion = $conexion->abrir_conexion();

    $result = $conexion->query("Select * from usuario where correo_usuario = '$correo' ");
    $result = $result->num_rows;

    if($result >= 1){
        $err["correo_existe"] = "El correo ya existe.";
    }

    $conexion->close();

    //comprobamos que el correo no esta vacío y luego que el formato del correo sea correcto

    if(strlen($correo) == 0){

        $err["correo_vacio"] = "No has introducido el correo.";

    } else if(strlen($correo) >=0 && strlen($correo) <=100){

        if(false === strpos($correo, "@") && false === strpos($correo, ".")){
            $err["correo_incorrecto"] = "Formato de correo incorrecto.";
        }
    
        if(ctype_space($correo) || strpos($correo," ")){
            $err["correo_contiene_espacios"] = "El correo contiene espacios";
        }

        for($i = 0; $i < strlen($correo); $i++){
            if(in_array($correo[$i],$caracteres_invalidos)){
                $err["correo_caracteres_invalidos"] = "Has introducido carácteres inválidos en el correo.";
            }
        }

    } else if(strlen($correo) > 100){

        $err["correo_largo"] = "El correo que has introducido es demasiado largo. Máximo 100 carácteres.";

    }

    //comprobamos que la contraseña no este vacía, tenga 8 carácteres y alguna minúscula y mayúscula

    $minusculas = false;
    $mayusculas = false;
    $numeros = false;

    if(strlen($contraseña) == 0){
        $err["contraseña_vacia"] = "No has introducido contraseña.";
    } else  if(strlen($contraseña) < 8){
        $err["contraseña_corta"] = "La contraseña es demasiado corta (Mínimo 8 carácteres).";
    } else {

        if(strlen($contraseña) >= 8){

            if(strpos($contraseña, " ") || ctype_space($contraseña)){
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
                if(in_array($contraseña[$i],$caracteres_invalidos)){
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

    //Comprobamos si las contraseñas son iguales

    if($contraseña != $contraseña_repetida){
        $err["contraseñas_diferentes"] = "Las contraseñas no coinciden.";
    }

    //Comprobamos si hemos introducido la fecha de nacimiento

    if($fecha_nacimiento == 0){
        $err["fecha_vacia"] = "No has introducido fecha de nacimiento.";
    }

    return $err;

}

?>