<?php 

if(isset($_POST["cerrar_sesion"])){
    session_start();
    unset($_SESSION["login"]);
    header("Location: index.php");
    // require("./util/session/session.php");
    // cerrar_sesion();
}

session_start();

if(isset($_SESSION["login"])) echo "<form action='index.php' method='post'><div class='sesion_iniciada'><p>" . $_SESSION["login"]["nombre_usuario"] . " <input type='submit' name='cerrar_sesion' value='Cerrar Sesión'></p></div></form>"; ?>
<header><h1>ForoCarros</h1></header>