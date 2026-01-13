<?php

class ConexionBD {
    private $baseDatos;
    private $user;
    private $password;
    private $host;

    public function __construct($baseDatos, $user, $password, $host) {
        $this->baseDatos = $baseDatos;
        $this->user = $user;
        $this->password = $password;
        $this->host = $host;
    }

    public function abrir() {
        $db = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->baseDatos
        );

        if ($db->connect_error) {
            die("Error de conexión: " . $db->connect_error);
        }

        return $db;
    }

    public function cerrar($conexion) {
        $conexion->close();
    }
}

// Prueba de conexión
$pruebaConexion = new ConexionBD(
    "programacion_ejemplos",
    "Daniel",
    "abc123.",
    "localhost"
);

$conexionEstablecida = $pruebaConexion->abrir();
echo "Conexión realizada correctamente";

$pruebaConexion->cerrar($conexionEstablecida);
