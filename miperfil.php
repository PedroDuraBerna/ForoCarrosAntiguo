
<style>
        #navegador #boton_mi_perfil{
            background-color: brown;
        }
</style>

    <?php 

    require("usuario/usuario.php");

    require("bloques/header.php");
    require("bloques/navegador.php");

    $usuario = new usuario;
    $usuario = $usuario->construir_usuario($_SESSION["login"]["nombre_usuario"]);
    
    ?>
    <h2>Mi perfil de usuario</h2>
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
                } else if($usuario["id_rol"] == 2){
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
            <p><b>Fecha nacimiento:</b> <?php echo $usuario["fecha_nacimiento_usuario"] ?></p> 
            </div>
            <div id="info_principal">
            <p><b>Fecha registro:</b> <?php echo $usuario["fecha_registro"] ?></p> 
            </div>
            <div id="info_principal">
            <p><b>Fecha ultima conexión:</b> <?php echo $usuario["fecha_ultima_conexion"] ?></p> 
            </div>
            <div id="info_principal" class='no_cabe_texto'>
                <p><b>Enlace a tu perfil público: </b></p>
                <p><a href="perfil_publico.php?nombre_usuario=<?php echo $usuario["nombre_usuario"] ?>">http://localhost/ForoCarros/V3%20ACTUAL/perfil_publico.php?nombre_usuario=PeterHard</a></p>
            </div>
            <div id="info_principal_boton">
            <p><b><a href="">Ver todos mis posts</a></b></p> 
            </div>
            <div id="info_principal_boton">
            <p><b><a href="configuracion.php?nombre_usuario=<?php echo $usuario["nombre_usuario"] ?>&cambiar_correo">Cambiar correo</a></b></p> 
            </div>
            <div id="info_principal_boton">
            <p><b><a href="configuracion.php?nombre_usuario=<?php echo $usuario["nombre_usuario"] ?>&cambiar_contraseña">Cambiar contraseña</a></b></p> 
            </div>
            <div id="info_principal_boton">
            <p><b><a href="configuracion.php?nombre_usuario=<?php echo $usuario["nombre_usuario"] ?>&cambiar_foto_perfil">Cambiar foto de perfil</a></b></p> 
            </div>
            <div id="info_principal_boton">
            <p><b><a href="configuracion.php?nombre_usuario=<?php echo $usuario["nombre_usuario"] ?>&cambiar_intereses">Cambiar intereses</a></b></p> 
            </div>
            <div id="info_principal_boton">
            <p><b><a href="configuracion.php?nombre_usuario=<?php echo $usuario["nombre_usuario"] ?>&cambiar_biografia">Cambiar biografía</a></b></p> 
            </div>
            <div id="info_principal_boton">
            <p><b><a href="configuracion.php?nombre_usuario=<?php echo $usuario["nombre_usuario"] ?>&cambiar_firma">Cambiar firma</a></b></p> 
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
        </div>
    </div>
    <?php require("bloques/footer.php"); ?>

    <script>

    </script>