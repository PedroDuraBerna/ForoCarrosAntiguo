
<style>
        #navegador #boton_temas{
            background-color: brown;
        }
</style>

<?php 
    
    require("bloques/header.php");
    require("bloques/navegador.php"); 
    require("todos_los_temas/todos_los_temas.php");

?>

    <h2>Temas de ForoCarros</h2>
    <div id="contGlobal">
        <div id="contIzquierda">
            <div id="cont1">
                <div id="cabecera_temas">
                    <span id='cabecera_1'>Tema</span><span id='cabecera_2'>nº posts</span><span id='cabecera_3'>nº mensajes</span>
                </div>
                <?php echo mostrar_temas(); ?>
            </div>
        </div>
    </div>
    
    <?php require("bloques/footer.php"); ?>