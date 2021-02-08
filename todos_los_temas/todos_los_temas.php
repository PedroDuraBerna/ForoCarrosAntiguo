<?php

require("./util/conexion/conexion.php");

    function mostrar_temas(){

        $html = "";

        $conexion = new conexion;
        $conexion = $conexion->abrir_conexion();
        $result = $conexion->query("Select * from tema");

        for($i = 1; $i <= $result->num_rows; $i++){
            $fila[$i] = $result->fetch_assoc();
            $html.= "<a href='./temas.php?tema=" . $fila[$i]['nombre_tema'] . "' class='link_temas'><div class='fila_tema'><br>";
            $html.= "<div id='cabecera_1'><img src='" . $fila[$i]['imagen_tema'] . "' class='imagen_fila_tema'/>";
            $html.= "<span><h4>" . $fila[$i]['nombre_tema'] . "</h4></span></div>";
            $html.= "<div id='cabecera_2'><span>0</span></div>";
            $html.= "<div id='cabecera_3'><span>0</span><br></div>";
            $html.= "</div></a>";
        }

        return $html;

    }

?>