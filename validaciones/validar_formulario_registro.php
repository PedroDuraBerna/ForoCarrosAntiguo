<?php 

require("util/longitud_100.php");
require("util/texto_vacio.php");
require("util/espacios.php");
require("util/caracteres_invalidos.php");
require("validar_correo.php");
require("validar_usuario.php");
require("validar_contraseña.php");

function validar_formulario_registro($err,$nombre_usuario,$fecha_nacimiento,$contraseña,$contraseña_repetida,$correo){

    //Validamos el usuario

    $err = validar_usuario($err,$nombre_usuario);

    //Validamos el correo

    $err = validar_correo($err,$correo);

    //Validamos la contraseña

    $err = validar_contraseña($err,$contraseña);

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