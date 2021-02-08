<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        #navegador #boton_mi_perfil{
            background-color: brown;
        }
    </style>
    <title>Mi Perfil</title>
</head>
<body>
    <?php require("bloques/header.php"); ?>
    <?php require("bloques/navegador.php"); ?>
    <h2>Mi perfil de usuario</h2>
    <div id="contenedorMiPerfilGlobal">
        <div id="contenedorBiografia">
            <h3>Conóceme</h3>
            <div id="info_principal" class="conoceme_box">
            <p><b>Intereses:</b></p>
            <p>Tus intereses</p> 
            </div>
            <div id="info_principal" class="conoceme_box">
            <p><b>Biografía:</b></p>
            <p>asdf asdf asdf asdf as asdf asdf adsdf dsaf sdfa sdfasdfas dfasd fasdf asdf asdf asdfasdf asdf asdf asdf asdfasdfasdfasdfasdfasd fsad fasdfasdf asdf asdf asdf asdf asdf sfa sdfasdfadsfasdfasd fasdfasd fasdfasdf asdf asdf asdf asdf asdf adsdf dsaf sdfa sdfasdfas dfasd fasdf asdf asdf asdfasdf asdf asdf asdf asdfasdfasdfasdfasdfasd fsad fasdfasdf asdf asdf asdf asdf asdf sfa sdfasdfadsfasdfasd fasdfasd fasdfasdf asdf asdf asdf asdf asdf adsdf dsaf sdfa sdfasdfas dfasd fasdf asdf asdf asdfasdf asdf asdf asdf asdfasdfasdfasdfasdfasd fsad fasdfasdf asdf asdf asdf asdf asdf sfa sdfasdfadsfasdfasd fasdfasd fasdfasdf asdfasdf</p> 
            </div>
            <div id="info_principal" class="conoceme_box">
            <p><b>Firma:</b></p> 
            <p>Mamahuevo</p>
            </div>
        </div>
        <div id="contenedorInformacion">
            <h3>Información del usuario</h3>
            <div id="info_principal_imagen">
                <img src="imagenes/perfil.png" width="60px" >
            </div>
            <div id="info_principal" class="border_top_brown">
            <p><b>Nombre de usuario:</b> TuNombreDeUsuario</p>
            </div>
            <div id="info_principal">
            <p><b>Estatus:</b> Administrador</p> 
            </div>
            <div id="info_principal">
            <p><b>Correo:</b> TuCorreoDeUsuario@correo.com</p> 
            </div>
            <div id="info_principal">
             <p><b>Enlace a tu perfil público: </b> <a href="">enlaceatuperfil.com</a></p>
            </div>
            <div id="info_principal">
            <p><b><a href="">Ver todos mis posts</a></b></p> 
            </div>
            <div id="info_principal">
            <p><b><a href="">Cambiar de correo</a></b></p> 
            </div>
            <div id="info_principal">
            <p><b><a href="">Cambiar de contraseña</a></b></p> 
            </div>
            <div id="info_principal">
            <p><b><a href="">Cambiar de foto de perfil</a></b></p> 
            </div>
            <div id="info_principal">
            <p><b><a href="">Cambiar intereses</a></b></p> 
            </div>
            <div id="info_principal">
            <p><b><a href="">Cambiar biografía</a></b></p> 
            </div>
            <div id="info_principal">
            <p><b><a href="">Cambiar firma</a></b></p> 
            </div>
        </div>
        <div id="contenedroEstadisticas">
            <h3>Estadísticas</h3>
            <div id="info_principal">
            <p><b>Nº posts escritos:</b> 456</p> 
            </div>
            <div id="info_principal">
            <p><b>Nº Mensajes:</b> 1112</p> 
            </div>
            <div id="info_principal">
            <p><b>Total me gustas:</b> 55541</p> 
            </div>
            <div id="info_principal">
            <p><b>Visitas a tu perfíl:</b> 1250</p> 
            </div>
            <div id="info_principal">
            <p><b>Fecha registro:</b> 19/01/2021</p> 
            </div>
        </div>
    </div>
    <?php require("bloques/footer.php"); ?>
</body>
</html>