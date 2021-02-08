<?php

require("./util/conexion/conexion.php");

    class usuario {

        private $id;
        private $id_rol;
        private $nombre;
        private $contraseña;
        private $correo;
        private $biografia;
        private $firma;
        private $intereses;
        private $fecha_nacimiento;
        private $fecha_registro;
        private $fecha_ultima_conexion;
        private $foto_perfil;
        private $contador_visitas_perfil;
        private $conexion;

        function insertar_usuario($nombre_usuario,$contraseña_usuario,$correo_usuario,$fecha_nacimiento_usuario,$fecha_registro_usuario,$fecha_ultima_conexion){

            $this->conexion = new conexion;
            $this->conexion = $this->conexion->abrir_conexion();
            if(!$this->conexion->query("Insert into usuario (nombre_usuario,contraseña_usuario,correo_usuario,fecha_nacimiento_usuario,fecha_registro,fecha_ultima_conexion,contador_visitas_perfil,id_rol) values ('$nombre_usuario','$contraseña_usuario','$correo_usuario','$fecha_nacimiento_usuario','$fecha_registro_usuario','$fecha_ultima_conexion',0, 3)")){
                echo $this->conexion->error;
            }
            $this->conexion->close();

        }

        function buscar_usuario($nombre_usuario){

            $this->conexion = new conexion;
            $this->conexion = $this->conexion->abrir_conexion(); 
            $result = $this->conexion->query("Select * from usuario where nombre_usuario = '$nombre_usuario' ");
            $fila = $result->fetch_assoc();
            $result = $result->num_rows;

            if($result == 1){
                
                $this->conexion->close();
                return true;

            } else {

                $this->conexion->close();
                return false;
            
            }  

        }

        function comprobar_contraseña($nombre_usuario,$contraseña){

            $this->conexion = new conexion;
            $this->conexion = $this->conexion->abrir_conexion(); 
            $result = $this->conexion->query("Select nombre_usuario,contraseña_usuario from usuario where nombre_usuario = '$nombre_usuario' ");
            $fila = $result->fetch_assoc();

            if($fila["nombre_usuario"] == $nombre_usuario && $fila["contraseña_usuario"] == $contraseña){

                $this->conexion->close();
                return true;

            } else {

                $this->conexion->close();
                return false;

            }

        }

        function construir_usuario($nombre_usuario){

            $this->conexion = new conexion;
            $this->conexion = $this->conexion->abrir_conexion(); 
            $result = $this->conexion->query("Select * from usuario where nombre_usuario = '$nombre_usuario' ");
            $usuario = $result->fetch_assoc();

            $this->id = $usuario["id_usuario"];
            $this->id_rol = $usuario["id_rol"];
            $this->nombre = $usuario["nombre_usuario"];
            $this->contraseña = $usuario["contraseña_usuario"];
            $this->correo = $usuario["correo_usuario"];
            $this->biografia = $usuario["biografia_usuario"];
            $this->firma = $usuario["firma_usuario"];
            $this->intereses = $usuario["intereses_usuario"];

            $fecha1 = explode("-",$usuario["fecha_nacimiento_usuario"]);
            $año = $fecha1[0];
            $mes = $fecha1[1];
            $dia = $fecha1[2];
            $this->fecha_nacimiento = $dia . "/" . $mes . "/" . $año;
            $usuario["fecha_nacimiento_usuario"] = $this->fecha_nacimiento;

            $fecha2 = explode("-",$usuario["fecha_registro"]);
            $año = $fecha2[0];
            $mes = $fecha2[1];
            $dia = $fecha2[2];
            $fecha21 = explode(" ",$dia);
            $dia = $fecha21[0];
            $hora = $fecha21[1];
            $this->fecha_registro = $dia . "/" . $mes . "/" . $año . " a las " . $hora;
            $usuario["fecha_registro"] = $this->fecha_registro;

            $fecha3 = explode("-",$usuario["fecha_ultima_conexion"]);
            $año = $fecha3[0];
            $mes = $fecha3[1];
            $dia = $fecha3[2];
            $fecha31 = explode(" ",$dia);
            $dia = $fecha31[0];
            $hora = $fecha31[1];
            $this->fecha_ultima_conexion = $dia . "/" . $mes . "/" . $año . " a las " . $hora;
            $usuario["fecha_ultima_conexion"] = $this->fecha_ultima_conexion;

            $this->foto_perfil = $usuario["foto_perfil_usuario"];
            $this->contador_visitas_perfil = $usuario["contador_visitas_perfil"];

            $this->conexion->close();

            return $usuario;

        }

        function construir_usuario_publico($nombre_usuario){

            $this->conexion = new conexion;
            $this->conexion = $this->conexion->abrir_conexion(); 
            $result = $this->conexion->query("Select * from usuario where nombre_usuario = '$nombre_usuario' ");
            $usuario = $result->fetch_assoc();

            $this->id_rol = $usuario["id_rol"];
            $this->nombre = $usuario["nombre_usuario"];
            $this->correo = $usuario["correo_usuario"];
            $this->biografia = $usuario["biografia_usuario"];
            $this->firma = $usuario["firma_usuario"];
            $this->intereses = $usuario["intereses_usuario"];

            $fecha1 = explode("-",$usuario["fecha_nacimiento_usuario"]);
            $año = $fecha1[0];
            $mes = $fecha1[1];
            $dia = $fecha1[2];
            $this->fecha_nacimiento = $dia . "/" . $mes . "/" . $año;
            $usuario["fecha_nacimiento_usuario"] = $this->fecha_nacimiento;

            $fecha2 = explode("-",$usuario["fecha_registro"]);
            $año = $fecha2[0];
            $mes = $fecha2[1];
            $dia = $fecha2[2];
            $fecha21 = explode(" ",$dia);
            $dia = $fecha21[0];
            $hora = $fecha21[1];
            $this->fecha_registro = $dia . "/" . $mes . "/" . $año . " a las " . $hora;
            $usuario["fecha_registro"] = $this->fecha_registro;

            $fecha3 = explode("-",$usuario["fecha_ultima_conexion"]);
            $año = $fecha3[0];
            $mes = $fecha3[1];
            $dia = $fecha3[2];
            $fecha31 = explode(" ",$dia);
            $dia = $fecha31[0];
            $hora = $fecha31[1];
            $this->fecha_ultima_conexion = $dia . "/" . $mes . "/" . $año . " a las " . $hora;
            $usuario["fecha_ultima_conexion"] = $this->fecha_ultima_conexion;

            $this->foto_perfil = $usuario["foto_perfil_usuario"];
            $this->contador_visitas_perfil = $usuario["contador_visitas_perfil"];

            $this->conexion->close();

            return $usuario;

        }

        function cambiar_correo($nombre_usuario,$correo_usuario){

            $this->conexion = new conexion;
            $this->conexion = $this->conexion->abrir_conexion();
            $result = $this->conexion->query("Update usuario set correo_usuario ='" . $correo_usuario . "' where nombre_usuario ='" . $nombre_usuario . "'");

            $this->conexion->close();

        }

        function cambiar_intereses($nombre_usuario,$intereses_usuario){

            $this->conexion = new conexion;
            $this->conexion = $this->conexion->abrir_conexion();
            $result = $this->conexion->query("Update usuario set intereses_usuario ='" . $intereses_usuario . "' where nombre_usuario ='" . $nombre_usuario . "'");

            $this->conexion->close();

        }

        function cambiar_biografia($nombre_usuario,$biografia_usuario){

            $this->conexion = new conexion;
            $this->conexion = $this->conexion->abrir_conexion();
            $result = $this->conexion->query("Update usuario set biografia_usuario ='" . $biografia_usuario . "' where nombre_usuario ='" . $nombre_usuario . "'");

            $this->conexion->close();

        }

        function cambiar_firma($nombre_usuario,$firma_usuario){

            $this->conexion = new conexion;
            $this->conexion = $this->conexion->abrir_conexion();
            $result = $this->conexion->query("Update usuario set firma_usuario ='" . $firma_usuario . "' where nombre_usuario ='" . $nombre_usuario . "'");

            $this->conexion->close();

        }

        function cambiar_contraseña($nombre_usuario,$contraseña_usuario){

            $this->conexion = new conexion;
            $this->conexion = $this->conexion->abrir_conexion();
            $result = $this->conexion->query("Update usuario set contraseña_usuario ='" . $contraseña_usuario . "' where nombre_usuario ='" . $nombre_usuario . "'");

            $this->conexion->close();

        }

        function cambiar_foto($nombre_usuario,$foto_perfil_usuario){
            $this->conexion = new conexion;
            $this->conexion = $this->conexion->abrir_conexion(); 
            $result = $this->conexion->query("Update usuario set foto_perfil_usuario = '" . $foto_perfil_usuario . "' where nombre_usuario = '$nombre_usuario' ");
            $this->conexion->close();
        }

        function ver_foto($nombre_usuario){
            $this->conexion = new conexion;
            $this->conexion = $this->conexion->abrir_conexion(); 
            $result = $this->conexion->query("Select foto_perfil_usuario from usuario where nombre_usuario = '" . $nombre_usuario . "'");
            $result = $result->fetch_array();
            $this->conexion->close();
            return $result["foto_perfil_usuario"];
        }

        function contar_visita($nombre_usuario){
            $this->conexion = new conexion;
            $this->conexion = $this->conexion->abrir_conexion(); 
            $result = $this->conexion->query("Select contador_visitas_perfil from usuario where nombre_usuario = '" . $nombre_usuario . "'");
            $result = $result->fetch_array();
            $visita = $result["contador_visitas_perfil"] + 1;
            $result = $this->conexion->query("Update usuario set contador_visitas_perfil = " . $visita . " where nombre_usuario = '" . $nombre_usuario . "'");
            $this->conexion->close();
            return $visita;
        }

        function cambiar_fecha_ultima_conexion($nombre_usuario){
            $this->conexion = new conexion;
            $this->conexion = $this->conexion->abrir_conexion();
            
                $fecha_total = getdate();
                $año = $fecha_total["year"];
                $mes = $fecha_total["mon"];
                $dia = $fecha_total["mday"];
                $horas = $fecha_total["hours"];
                $minutos = $fecha_total["minutes"];
                $segundos = $fecha_total["seconds"];
                $fecha = "$año-$mes-$dia $horas:$minutos:$segundos";

            $result = $this->conexion->query("Update usuario set fecha_ultima_conexion = '" . $fecha . "' where nombre_usuario = '" . $nombre_usuario . "'");
            $this->conexion->close();
        }

        function mostrar_fecha_ultima_conexion(){

        }

    }

?>