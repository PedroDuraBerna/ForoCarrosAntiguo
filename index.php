<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        #navegador #boton_inicio{
            background-color: brown;
        }
    </style>
    <title>ForoCarros</title>
</head>
<body>
<?php require("bloques/header.php"); ?>
    <?php require("bloques/navegador.php");?>
    <h2>Bienvenido a ForoCarros</h2>
    <div id="contGlobal">
        <div id="contIzquierda">
            <div id="cont1">
                <h3>Últimos posts</h3>
            </div>
            <div id="cont1">
                <h3>Posts más gustados</h3>
            </div>
        </div>
        <div id="contDerecha">
            <div id="cont2">
                <h3>Estadísticas</h3>
            </div>
            <div id="cont3">
                <h3>Regístrate</h3>
            </div>
        </div>
    </div>
    <?php require("bloques/footer.php"); ?>
</body>
</html>