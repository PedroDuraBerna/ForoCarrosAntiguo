<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        #navegador #boton_registrarte{
            background-color: brown;
        }
    </style>
    <title>Registrarse</title>
</head>
<body>
    <?php 
    require("bloques/header.php");
    require("bloques/navegador.php"); 
    require("registro/validar_formulario_registro.php");
    require("usuario/usuario.php");
    require("util/codificacion/encriptacion.php");
    ?>
    <h2>Registrarse en ForoCarros</h2>

        <?php 

        $err = array();

            if(isset($_POST["restaurar_campos"]) || !isset($_POST["registrarse"])){
                $nombre_usuario = "";
                $fecha_nacimiento = "";
                $contraseña = "";
                $contraseña_repetida = "";
                $correo = "";
            }
            
            if(isset($_POST["registrarse"])){

                $nombre_usuario = $_POST["nombre_usuario"];
                $fecha_nacimiento = $_POST["fecha_nacimiento"];
                $contraseña = $_POST["contraseña"];
                $contraseña_repetida = $_POST["contraseña_repetida"];
                $correo = $_POST["correo"];
                $err = validar_formulario_registro($err,$nombre_usuario,$fecha_nacimiento,$contraseña,$contraseña_repetida,$correo);
                if(!isset($_POST["acepto_normas"])){
                    $err["normas_inaceptadas"] = "No has aceptado las normas del foro.";
                }

            }

            if(isset($_POST["registrarse"]) && empty($err)){
                
                $fecha = getdate();
                $año = $fecha["year"];
                $mes = $fecha["mon"];
                $dia = $fecha["mday"];
                $horas = $fecha["hours"];
                $minutos = $fecha["minutes"];
                $segundos = $fecha["seconds"];
                $fecha_registro_usuario = "$año/$mes/$dia $horas:$minutos:$segundos";
                $fecha_ultima_conexion = $fecha_registro_usuario;

                $contraseña = $encriptar($contraseña);

                $usuario = new usuario;
                $conexion = new conexion;
                $usuario->insertar_usuario($conexion,$nombre_usuario,$contraseña,$correo,$fecha_nacimiento,$fecha_registro_usuario,$fecha_ultima_conexion);
                echo "<div class='registro usuario_registrado_correctamente'>";
                echo "<h3>usuario registrado correctamente</h3>";
                echo "<a href='ingreso.php'><p class='nota_caracteres'>Ingresar en ForoCarros</p></a>";
                echo "<a href='index.php'><p class='nota_caracteres'>Ir al inicio</p></a>";
                echo "</div>";
            } else {

    if(!empty($err)){
        echo "<div class='registro'>";
        echo "<h3>ERROR EN EL ENVIO DEL FORMULARIO</h3>";
        foreach ($err as $valor){
            echo "<p class='red nota_caracteres'>".$valor."</p>";
        }
        echo "</div>";
    }

?>

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"] ?>">
    <div class="registro">
        <h3>Información requerida</h3>
        <table>
            <tr>
                <td class="izq">Usuario:</td>
                <td><input class="input_general" type="text" name="nombre_usuario" value="<?php echo $nombre_usuario ?>"> <?php ?> </td>   
            <tr>
            <tr>
                <td class="izq"></td>
                <td>Nombre para iniciar sesión y para ser conocido en ForoCarros. Recomendamos usar un nick para no poder ser identificado. Tu nombre puede tener como máximo 25 letras y no se permiten espacios ni carácteres inválidos.<span class="red">*</span></td>
            </tr>  
            <tr>
                <td class="izq">Fecha nacimiento:</td>
                <td><input class="input_general" type="date" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento ?>"></td>  
            <tr>
        </table>
        <hr>
        <table>
            <tr>
                <td class="izq">Contraseña:</td>
                <td><input class="input_general" type="password" name="contraseña"></td>
            </tr>
            <tr>
                <td class="izq">Confirmar contraseña:</td>
                <td><input class="input_general" type="password" name="contraseña_repetida"></td>
            </tr>
            <tr>
                <td class="izq"></td>
                <td>Introduce una contraseña mayor o igual a 8 carácteres, que incluya: mayúsculas, minúsculas y almenos un número. No se permiten los espacios ni los carácteres inválidos.<span class="red">*</span></td>
            </tr>
        </table>
        <hr>
        <table>
            <tr>
                <td class="izq">Correo:</td>
                <td><input class="input_general" type="text" name="correo" value="<?php echo $correo ?>"></td>
            </tr>
            <tr>
            <td class="izq"></td>
                <td>Introduce una correo válido. No se permiten los espacios ni los carácteres inválidos.<span class="red">*</span></td>
            </tr>
        </table>
        <p class="nota_caracteres"><b><span class="red">*</span>Carácteres inválidos: <span class="red">'<>"</span></b></p>
    </div>
    <div class="registro">
        <h3>Normas del foro</h3>
        <p class="px20izq">Para seguir, debes aceptar las normas del foro:</p>
        <div id="normas">
            <h4>Reglas del foro</h4>
            <p>El registro a este foro es gratuito, por lo que queda prohibida la compra/venta de cuentas del foro.</p><br>
            <p>Al aceptar estas reglas, garantizas que no escribirás ningún mensaje que sea obsceno, vulgar, orientado sexualmente, de odio, amenazante, o cualquier otro que infrinja las reglas o leyes... XD es broma, haz lo que quieras bro.</p>
        </div>
        <hr>
        <input class="px20izq" type="checkbox" name="acepto_normas" value="acepto_normas" <?php if(isset($_POST["acepto_normas"]) && !isset($_POST["restaurar_campos"])) echo "checked='checked'" ?> > <b>Haciendo click aquí acepto las normas.</b> 
    </div>
    <div id="botones_formulario"><input class="der10px" type="submit" value="Registrarse" name="registrarse"><input class="der10px" type="submit" value="Restaurar campos" name="restaurar_campos"></div>
    </form>
<?php 
    }
require("bloques/footer.php"); ?>
</body>
</html>