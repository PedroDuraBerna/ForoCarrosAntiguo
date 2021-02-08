<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        #navegador #boton_ingresar{
            background-color: brown;
        }
    </style>
    <title>Ingresar</title>
</head>
<body>
<?php 

    require("bloques/header.php");
    require("bloques/navegador.php"); 
    require("usuario/usuario.php");
    require("util/conexion/conexion.php");

    $nombre_usuario = "";
    $contraseña_usuario = "";
    $err = array();

    if(isset($_POST["login"])){

        $nombre_usuario = $_POST["nombre_usuario"];
        $contraseña_usuario = $_POST["contraseña_usuario"];

        $err = validar_login($err,$nombre_usuario,$contraseña_usuario);

    }

    function validar_login($err,$nombre_usuario,$contraseña_usuario){

        $caracteres_invalidos = array("'","\"","<",">");

        //no se puede introducir un nombre vacío, carácteres inválidos, espacios o con más de 25 carácteres

        if(strlen($nombre_usuario) == 0 ){
            $err["nombre_vacio"] = "No has introducido el nombre.";
        } else if(strlen($nombre_usuario) >= 1 && strlen($nombre_usuario) < 25){

            //comprobamos que no tenga espacios

            if(strpos($nombre_usuario," ") || ctype_space($nombre_usuario)){
                $err["nombre_contiene_espacio"] = "No pueden haber espacios.";
            }

            //comprobamos que no tenga carácteres inválidos

            for($i = 0; $i < strlen($nombre_usuario); $i++){
                if(in_array($nombre_usuario[$i],$caracteres_invalidos)){
                    $err["usuario_caracteres_invalidos"] = "Has introducido carácteres inválidos en el nombre de usuario.";
                }
            }

            //comprobamos que la contraseña no sea demasiado larga

            if(strlen($contraseña_usuario) >=30){
                $err["contraseña_larga"] = "La contraseña es demasiado larga (Máximo 30 carácteres).";
            }

            //comprobamos si existe el usuario y luego si ese usuario existe con esa contraseña

            $conexion = new conexion;
            $usuario = new usuario;

            if($usuario->buscar_usuario($conexion,$nombre_usuario)){

                //Si existe comprobamos la contraseña

                require("util/codificacion/encriptacion.php");

                $contraseña_usuario = $encriptar($contraseña_usuario);

                if(!$usuario->comprobar_contraseña($conexion,$nombre_usuario,$contraseña_usuario)){

                    $err["contraseña_usuario_incorrecta"] = "La contraseña para este eusuario es incorrecta.";
                    
                }

            } else {

                $err["usuario_no_existe"] = "El usuario no existe.";

            }

        } else if (strlen($nombre_usuario) >= 25 ){
            $err["nombre_largo"] ="El nombre que has introducido es demasiado largo (Máximo 25 carácteres).";
        }

        //comprobamos que la contraseña no este vacía, tenga 8 carácteres y alguna minúscula y mayúscula

        if(strlen($contraseña_usuario) == 0){
            $err["contraseña_vacia"] = "No has introducido contraseña.";
        } else  if(strlen($contraseña_usuario) < 8){
            $err["contraseña_corta"] = "La contraseña es demasiado corta (Mínimo 8 carácteres).";
        } else {

            if(strlen($contraseña_usuario) >= 8){

                if(strpos($contraseña_usuario, " ") || ctype_space($contraseña_usuario)){
                    $err["contraseña_contiene_espacio"] = "La contraseña no puede contener espacios.";
                }
        
                for($i = 0; $i < strlen($contraseña_usuario); $i++){

                    if(in_array($contraseña_usuario[$i],$caracteres_invalidos)){
                        $err["contraseña_caracteres_invalidos"] = "Has introducido carácteres inválidos en la contraseña.";
                    }

                }

            } 

        }

        return $err;

    }

    if(isset($_POST["nuevo_usuario"])){

        echo"<script language='javascript'>window.location='registro.php'</script>;";

        //header("Location: registro.php");

    } 

    if(isset($_POST["login"]) && empty($err)){

        //aquí creo al usuario e inicio sesión con el nombre_usuario

        $conexion = new conexion;
        $usuario = new usuario;
        $usuario = $usuario->construir_usuario($conexion,$nombre_usuario);

        require("util/session/session.php");

        iniciar_sesion($usuario);

        echo"<script language='javascript'>window.location='miperfil.php'</script>;";

        //header("Location: miperfil.php");

    } else {

    ?>
    <h2>Iniciar sesión en ForoCarros</h2>
    <form action="" method="post">
    <div id="contGlobal">
        <div id="contIzquierda">

            <?php

                if(!empty($err)){
                    echo "<div id='cont1'>";
                    echo "<h3>ERROR EN EL ENVIO DEL FORMULARIO</h3>";
                    foreach ($err as $valor){
                        echo "<p class='red nota_caracteres'>".$valor."</p>";
                    }
                    echo "</div>";
                }

            ?>
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
            <div id="cont1">
                <h3>Introduce tus datos:</h3>
            <div class="login_usuario">
                <table>
                    <tr>
                        <td>Usuario:</td>
                        <td><input type="text" name="nombre_usuario" class="input_general"></td>
                    </tr>
                    <tr>
                        <td>Contraseña:</td>
                        <td><input type="password" name="contraseña_usuario" id="" class="input_general"></td>
                    </tr>
                </table>
                <a href="">¿Has olvidado la contraseña?</a>
                <div  id="botones_formulario" class="botones_login"><input class="boton_ingreso" type="submit" name="login" value="Entrar"><input class="boton_ingreso" type="submit" name="nuevo_usuario" value="Nuevo usuario"></div>
                </div>
            </div>
        </div>
        </form>
    </div>
    </form>
    <?php }?>
    <?php require("bloques/footer.php"); ?>
</body>
</html>