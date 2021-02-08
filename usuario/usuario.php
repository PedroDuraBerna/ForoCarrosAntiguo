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
            $this->fecha_nacimiento = $usuario["fecha_nacimiento_usuario"];
            $this->fecha_registro = $usuario["fecha_registro"];
            $this->fecha_ultima_conexion = $usuario["fecha_ultima_conexion"];
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
            $this->fecha_nacimiento = $usuario["fecha_nacimiento_usuario"];
            $this->fecha_registro = $usuario["fecha_registro"];
            $this->fecha_ultima_conexion = $usuario["fecha_ultima_conexion"];
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

    }

?>