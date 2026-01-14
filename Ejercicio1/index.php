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
        try {
            $conexion = new mysqli();
            $conexion->connect(
                $this->host,
                $this->user,
                $this->password,
                $this->baseDatos
            );

            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            
        } catch (mysqli_sql_exception $e) {
            echo "ERROR:" . $e->getMessage();
            echo "El objeto conexión existe! Aún cuando se ha producido un error:";
            echo "<br>es objeto" . is_object($conexion);
            echo "<br>clase: " . get_class($conexion);
            echo "<br>conexion_error:" . $conexion->connect_errno;
        } catch (Exception $e) {
            echo "ERROR DESCONOCIDO: " . $e->getMessage();
        } finally{
            return $conexion;
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

$conexionEstablecida = $pruebaConexion->abrir();
echo "Conexión realizada correctamente";

$pruebaConexion->cerrar($conexionEstablecida);
