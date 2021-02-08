<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Configuración del usuario</title>
</head>
<body>
<?php

    //Estructura

    require("bloques/header.php");
    require("bloques/navegador.php");

    //Validaciones

    require("validaciones/util/longitud_1000.php");
    require("validaciones/util/longitud_100.php");
    require("validaciones/util/texto_vacio.php");
    require("validaciones/util/espacios.php");
    require("validaciones/util/caracteres_invalidos.php");
    require("validaciones/validar_correo.php");
    require("validaciones/validar_contraseña.php");
    require("util/codificacion/encriptacion.php");
    require("usuario/usuario.php");

    //Array de errores

    $err = array();

    //Redirección al código

    require("configuracion/cambiar_correo.php");
    require("configuracion/cambiar_contraseña.php");
    require("configuracion/cambiar_intereses.php");
    require("configuracion/cambiar_biografia.php");
    require("configuracion/cambiar_firma.php");
    require("configuracion/cambiar_foto_perfil.php");

?>

<h2>Configuración de usuario</h2>

<?php

    //volvemos a redireccionar la página si no rellenamos los campos bien a la primera

    if(isset($_POST["cambiar_correo"]) && !empty($err)){
    }

    //con esto comprobamos que el usuario del que queremos configurar la cuenta es el mismo que ha iniciado la sesión

    if((isset($_SESSION["login"]["nombre_usuario"]) == isset($_GET["nombre_usuario"])) || !empty($err)){

        //Mostramos errores si los hay

        if(!empty($err)){
            echo "<div class='registro'>";
            echo "<h3>ERROR EN EL ENVIO DEL FORMULARIO</h3>";
            foreach ($err as $valor){
                echo "<p class='red nota_caracteres'>".$valor."</p>";
            }
            echo "</div>";
        }

?>

<div id="contGlobal">
        <div id="contIzquierda">
            <div id="cont1">

<?php

        //Mostramos el formulario que nos diga el get

        if(isset($_GET["cambiar_correo"]) || isset($_POST["cambiar_correo"]) && !empty($err)){
            if(isset($_POST['correo_usuario']) && !empty($err)){
                $correo_cache = $_POST['correo_usuario'];
            } else {
                $correo_cache = "";
            }
            echo "<h3>Cambio de correo</h3>";
            echo "<div id='config_user'>";
            echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
            echo "<p><b>Tu correo actual es:</b></p>";
            echo "<p>" . $_SESSION['login']['correo_usuario'] . "</p>";
            echo "<p><b>Introduce tu nuevo correo:</b></p>";
            echo "<p><input type='text' name='nuevo_correo' value='$correo_cache'></p>";
            echo "<p><input type='submit' id='boton_config' value='Cambiar' name='cambiar_correo'></p>";
            echo "</form>";
            echo "</div>";
        }

        if(isset($_GET["cambiar_contraseña"]) || isset($_POST["cambiar_contraseña"]) && !empty($err)){
            echo "<h3>Cambio de contraseña</h3>";
            echo "<div id='config_user'>";
            echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
            echo "<p>Introduce tu antigua contraseña:</p>";
            echo "<p><input type='password' name='antigua'></p>";
            echo "<p>Introduce tu nueva contraseña:</p>";
            echo "<p><input type='password' name='nueva'></p>";
            echo "<p>Repite la contraseña:</p>";
            echo "<p><input type='password' name='repetida'></p>";
            echo "<p><input type='submit' id='boton_config' value='Cambiar' name='cambiar_contraseña'></p>";
            echo "</form>";
            echo "</div>";
        }

        if(isset($_GET["cambiar_foto_perfil"]) || isset($_POST["cambiar_foto_perfil"]) && !empty($err)){
            $usuario = new usuario;
            $usuario = $usuario->construir_usuario($_SESSION["login"]["nombre_usuario"]);
            echo "<h3>Cambio de foto de perfíl</h3>";
            echo "<div id='config_user'>";
            echo "<form action='".$_SERVER['PHP_SELF']."' method='post' enctype='multipart/form-data'>";
            echo "<p><b>Tu foto actual es:</b> </p>";
            echo "<div id='config_foto'>";
            if($usuario["foto_perfil_usuario"] == null){
                echo "<p><img src='imagenes/perfil.png'></p>";
            } else {
                echo "<p><img src='imagenes/foto_perfil/" . $usuario["foto_perfil_usuario"] . "'></p>";
            }
            echo "</div>";
            echo "<p><b>Introduce tu nueva foto de perfíl:</b></p>";
            echo "<p><input type='file' name='foto_perfil'></p>";
            echo "<p><input type='submit' id='boton_config' value='Cambiar' name='cambiar_foto_perfil'></p>";
            echo "</form>";
            echo "</div>";
        }

        if(isset($_GET["cambiar_intereses"]) || isset($_POST["cambiar_intereses"]) && !empty($err)){
            if(isset($_POST['intereses_usuario']) && !empty($err)){
                $intereses_cache = $_POST['intereses_usuario'];
            } else {
                $intereses_cache = "";
            }
            echo "<h3>Cambio de intereses</h3>";
            echo "<div id='config_user'>";
            echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
            echo "<p><b>Tus intereses actuales son:</b></p>";
            if($_SESSION['login']['intereses_usuario'] == ""){
                echo "<p><i>Todavía no has introducido intereses</i></p>";
            } else {
                echo "<p>" . $_SESSION['login']['intereses_usuario'] . "</p>";
            }
            echo "<p><b>Introduce tus nuevos intereses:</b></p>";
            echo "<p><textarea name='intereses_usuario' rows='5'>$intereses_cache</textarea></p>";
            echo "<p><input type='submit' id='boton_config' value='Cambiar' name='cambiar_intereses'></p>";
            echo "</form>";
            echo "</div>";
        }

        if(isset($_GET["cambiar_biografia"]) || isset($_POST["cambiar_biografia"]) && !empty($err)){
            if(isset($_POST['biografia_usuario']) && !empty($err)){
                $biografia_cache = $_POST['biografia_usuario'];
            } else {
                $biografia_cache = "";
            }
            echo "<h3>Cambio de biografía</h3>";
            echo "<div id='config_user'>";
            echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
            echo "<p><b>Tu biografía actual es:</b></p>";
            if($_SESSION['login']['biografia_usuario'] == ""){
                echo "<p><i>Todavía no has introducido biografía</i></p>";
            } else {
                echo "<p>" . $_SESSION['login']['biografia_usuario'] . "</p>";
            }
            echo "<p><b>Introduce tu nueva biografía:</b></p>";
            echo "<p><textarea name='biografia_usuario' rows='5'>$biografia_cache</textarea></p>";
            echo "<p><input type='submit' id='boton_config' value='Cambiar' name='cambiar_biografia'></p>";
            echo "</form>";
            echo "</div>";
        }

        if(isset($_GET["cambiar_firma"]) || isset($_POST["cambiar_firma"]) && !empty($err)){
            if(isset($_POST['firma_usuario']) && !empty($err)){
                $firma_cache = $_POST['firma_usuario'];
            } else {
                $firma_cache = "";
            }
            echo "<h3>Cambio de firma</h3>";
            echo "<div id='config_user'>";
            echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
            echo "<p><b>Tu firma actual es:</b></p>";
            if($_SESSION['login']['firma_usuario'] == ""){
                echo "<p><i>Todavía no has introducido firma</i></p>";
            } else {
                echo "<p>" . $_SESSION['login']['firma_usuario'] . "</p>";
            }
            echo "<p><b>Introduce tu nueva firma:</b></p>";
            echo "<p><textarea name='firma_usuario' rows='5'>$firma_cache</textarea></p>";
            echo "<p><input type='submit' id='boton_config' value='Cambiar' name='cambiar_firma'></p>";
            echo "</form>";
            echo "</div>";
        }
 
    } else {
        echo "<div class='registro'>";
        echo "<h3>Éxito</h3>";
        echo "<h2>Actualización realizada correctamente</h2>";
        echo "</div>";
    }
    
?>

            </div>
        </div>
    </div>

<?php require("bloques/footer.php"); ?>

</body>
</html>