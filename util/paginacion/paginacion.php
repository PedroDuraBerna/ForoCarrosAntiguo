<?php

//-----------------------------------------------------PAGINACIÓN

$filas_por_pagina = 10;

if(isset($_GET["pagina"])){

    if($_GET["pagina"] == 1){

        header("Location:paginacion.php");

    } else {

        $pagina = $_GET["pagina"];

    }

} else {

    $pagina = 1;

}

$empezar_desde = ($pagina - 1) * $filas_por_pagina;

require("../conexion/conexion_bd.php");

$conexion = new conexion;

$conexion = $conexion->abrir_conexion();

$result = $conexion->query("Select * from post");

$numero_filas = $result->num_rows;

$numero_paginas = ceil($numero_filas/$filas_por_pagina);

$result->close();

$conexion = $conexion->close();

//-----------------------------------------------------------------CONSULTA LIMITE

$conexion = new conexion;

$conexion = $conexion->abrir_conexion();

$result = $conexion->query("Select * from post order by id_post desc limit $empezar_desde,$filas_por_pagina");

while($fila = $result->fetch_assoc()){

    echo "ID: " . $fila["id_post"] . " TEXTO:  " . $fila["texto_post"] . "<br>";

}

$result->close();

$conexion = $conexion->close();

//--------------------------------------------------------------------PAGINADOR

for($i = 1; $i <= $numero_paginas; $i++){

    echo "<a href='?pagina=" . $i . "'>" . $i . "</a>  ";

}

?>