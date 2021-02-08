<div id="navegador">
    <ul>
        <a href="index.php" ><li id="boton_inicio"><img src="imagenes/inicio.png" width="30px" /> <span class="opcion_inicio">Inicio</span></li></a>
        <a href="temas.php" ><li id="boton_temas"><img src="imagenes/buscar.png" width="30px" /> <span class="opcion_inicio">Temas</span></li></a>
        <?php 
            if(isset($_SESSION["login"])){
                echo "<a href='miperfil.php' ><li id='boton_mi_perfil'><img src='imagenes/perfil.png' width='30px' /> <span class='opcion_inicio'>Mi Perfil</span></li></a>";
                echo "<a href='postear.php' ><li id='boton_postear'><img src='imagenes/pluma.png' width='30px' /> <span class='opcion_inicio'>Postear</span></li></a>";
            } else {
                echo "<a href='ingreso.php' ><li id='boton_ingresar'><img src='imagenes/ingresar.png' width='30px' /> <span class='opcion_inicio'>Ingresar</span></li></a>";
                echo "<a href='registro.php' ><li id='boton_registrarte'><img src='imagenes/registrarte.png' width='30px' /> <span class='opcion_inicio'>Registrarse</span></li></a>";
            }
         ?>
    </ul>
</div>