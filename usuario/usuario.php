<?php

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

        function insertar_usuario($conexion,$nombre_usuario,$contraseña_usuario,$correo_usuario,$fecha_nacimiento_usuario,$fecha_registro_usuario,$fecha_ultima_conexion){

            $conexion = $conexion->abrir_conexion();
            $conexion->query("Insert into usuario (nombre_usuario,contraseña_usuario,correo_usuario,fecha_nacimiento_usuario,fecha_registro,fecha_ultima_conexion,id_rol) values ('$nombre_usuario','$contraseña_usuario','$correo_usuario','$fecha_nacimiento_usuario','$fecha_registro_usuario','$fecha_ultima_conexion',0, 3)");
            $conexion->close();

        }

        function buscar_usuario($conexion,$nombre_usuario){

            $conexion = $conexion->abrir_conexion();

            $result = $conexion->query("Select * from usuario where nombre_usuario = '$nombre_usuario' ");
            $fila = $result->fetch_assoc();
            $result = $result->num_rows;

            if($result == 1){
                
                $conexion->close();
                return true;

            } else {

                $conexion->close();
                return false;
            
            }  

        }

        function comprobar_contraseña($conexion,$nombre_usuario,$contraseña){

            $conexion = $conexion->abrir_conexion();
            $result = $conexion->query("Select nombre_usuario,contraseña_usuario from usuario where nombre_usuario = '$nombre_usuario' ");
            $fila = $result->fetch_assoc();

            if($fila["nombre_usuario"] == $nombre_usuario && $fila["contraseña_usuario"] == $contraseña){

                $conexion->close();
                return true;

            } else {

                $conexion->close();
                return false;

            }

        }

        function construir_usuario($conexion,$nombre_usuario){

            $conexion = $conexion->abrir_conexion(); 
            $result = $conexion->query("Select * from usuario where nombre_usuario = '$nombre_usuario' ");
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

            $conexion->close();

            return $usuario;

        }

    }

?>