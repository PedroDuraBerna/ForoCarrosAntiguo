
<style>
        #navegador #boton_ingresar{
            background-color: brown;
        }
</style>

<?php 

    require("bloques/header.php");
    require("bloques/navegador.php"); 

    require("usuario/usuario.php");
    require("validaciones/validar_login.php");
    require("util/session/session.php");

    $nombre_usuario = "";
    $contraseña_usuario = "";
    $err = array();

    if(isset($_POST["login"])){

        $nombre_usuario = $_POST["nombre_usuario"];
        $contraseña_usuario = $_POST["contraseña_usuario"];

        $err = validar_login($err,$nombre_usuario,$contraseña_usuario);

    }

    if(isset($_POST["nuevo_usuario"])){

        echo"<script language='javascript'>window.location='registro.php'</script>;";

        //header("Location: registro.php");

    } 

    if(isset($_POST["login"]) && empty($err)){

        //aquí creo al usuario e inicio sesión con el nombre_usuario

        $usuario = new usuario;
        $usuario = $usuario->construir_usuario($nombre_usuario);

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
                        <td><input type="text" name="nombre_usuario" class="input_general" value="<?php if(isset($_POST["login"])) echo $_POST["nombre_usuario"] ?>"></td>
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