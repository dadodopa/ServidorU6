<?php

class ConexionBD
{
    private $baseDatos;
    private $user;
    private $password;
    private $host;

    public function __construct($baseDatos, $user, $password, $host)
    {
        $this->baseDatos = $baseDatos;
        $this->user = $user;
        $this->password = $password;
        $this->host = $host;
    }

    public function abrir()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $conexion = new mysqli();
            $conexion->connect(
                $this->host,
                $this->user,
                $this->password,
                $this->baseDatos
            );
            return $conexion;
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Error de conexión: " . $e->getMessage());
        }
    }

    public function cerrar($conexion)
    {
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
try {
    $conexionEstablecida = $pruebaConexion->abrir();
    echo "Conexion realizada correctamente";
    $pruebaConexion->cerrar($conexionEstablecida);
} catch (Exception $e) {
    echo $e->getMessage();
}
