<?php

    class conexion{

        private $host = "localhost";
        private $user = "root";
        private $pass = "";
        private $database ="forocarros";
        private $conexion;

        public function abrir_conexion(){
            $this->conexion = new mysqli($this->host,$this->user,$this->pass,$this->database);
            return $this->conexion;
        }

        public function cerrar_conexion(){
            $this->conexion->close();
            return $this->conexion;
        }

    }

?>