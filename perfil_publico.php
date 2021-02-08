<?php

    require("usuario/usuario.php");

    $usuario = new usuario;

    if(isset($_GET["nombre_usuario"]) && $usuario->buscar_usuario($_GET["nombre_usuario"])){

        $nombre_usuario = $_GET["nombre_usuario"];
        $usuario = $usuario->construir_usuario_publico($nombre_usuario);

?>

<?php 

    require("bloques/header.php");
    require("bloques/navegador.php");
    
    ?>
    <h2>Perfil público</h2>
    <div id="contenedorMiPerfilGlobal">
        <div id="contenedorBiografia">
            <h3>Conóceme</h3>
            <div id="info_principal" class="conoceme_box">
            <p><b>Intereses:</b></p>
            <p><?php echo $usuario["intereses_usuario"] ?></p> 
            </div>
            <div id="info_principal" class="conoceme_box">
            <p><b>Biografía:</b></p>
            <p><?php echo $usuario["biografia_usuario"] ?></p> 
            </div>
            <div id="info_principal" class="conoceme_box">
            <p><b>Firma:</b></p> 
            <p><?php echo $usuario["firma_usuario"] ?></p>
            </div>
        </div>
        <div id="contenedorInformacion">
            <h3>Información del usuario</h3>
            <div id="info_principal_imagen">
            <img src="<?php if($usuario["foto_perfil_usuario"] == null) echo "imagenes/perfil.png"; else echo "imagenes/foto_perfil/" . $usuario["foto_perfil_usuario"] ?>" width="100px" >
            </div>
            <div id="info_principal" class="border_top_brown">
            <p><b>Nombre de usuario:</b> <?php echo $usuario["nombre_usuario"] ?></p>
            </div>
            <div id="info_principal">
            <p><b>Estatus:</b> <?php 
            
                if($usuario["id_rol"] == 1){
                    echo "Administrador";
                } else if($_SESSION["login"]["id_rol"] == 2){
                    echo "Moderador";
                } else {
                    echo "Usuario";
                }

            
            ?></p> 
            </div>
            <div id="info_principal">
            <p><b>Correo:</b> <?php echo $usuario["correo_usuario"] ?></p> 
            </div>
            <div id="info_principal">
            <p><b><a href="">Ver todos los posts de <?php echo $usuario["nombre_usuario"] ?></a></b></p> 
            </div>
        </div>
        <div id="contenedroEstadisticas">
            <h3>Estadísticas</h3>
            <div id="info_principal">
            <p><b>Nº posts escritos:</b> aqui va un numero</p> 
            </div>
            <div id="info_principal">
            <p><b>Nº Mensajes:</b> aqui va un numero</p> 
            </div>
            <div id="info_principal">
            <p><b>Total me gustas:</b> aqui va un numero</p> 
            </div>
            <div id="info_principal">
            <p><b>Visitas a tu perfíl:</b> <?php echo $usuario["contador_visitas_perfil"] ?></p> 
            </div>
            <div id="info_principal">
            <p><b>Fecha nacimiento:</b> <?php echo $usuario["fecha_nacimiento_usuario"] ?></p> 
            </div>
            <div id="info_principal">
            <p><b>Fecha ultima conexión:</b> <?php echo $usuario["fecha_ultima_conexion"] ?></p> 
            </div>
            <div id="info_principal">
            <p><b>Fecha registro:</b> <?php echo $usuario["fecha_registro"] ?></p> 
            </div>
        </div>
    </div>

<?php

    } else {
        echo "error de enlace";
    }

    require("./bloques/footer.php");

?>