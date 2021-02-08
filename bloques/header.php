<?php 

session_start();

if(isset($_POST["cerrar_sesion"])){
    session_start();
    unset($_SESSION["login"]);
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ForoCarros</title>
</head>
<body>

<?php if(isset($_SESSION["login"])) echo "<form action='index.php' method='post'><div class='sesion_iniciada'><p>" . $_SESSION["login"]["nombre_usuario"] . " <input type='submit' name='cerrar_sesion' value='Cerrar Sesión'></p></div></form>"; ?>
<header><h1>ForoCarros</h1></header>
