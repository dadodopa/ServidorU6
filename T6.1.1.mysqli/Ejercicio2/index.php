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

    public function getSueldoMayor($valor)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $conexionEstablecida = $this->abrir();
            $sql = "SELECT nombre, sueldo FROM empleados 
                WHERE sueldo > $valor";
            $resultado = $conexionEstablecida->query($sql);

            if ($resultado->num_rows > 0) {

                echo "<h2>Estos son los empreados con un sueldo superior a $valor </h2>
            <table>";
                printf(
                    "<tr>
                <th>%-20s</th>
                <th> %-20s</th>
                </tr>
                ",
                    "Nombre",
                    "Sueldo"
                );
                while ($fila = $resultado->fetch_assoc()) {
                    printf(
                        "
                    <tr>
                    <td>%-20s</td>
                    <td> %-20.2f <td>
                    </tr>",
                        $fila['nombre'],
                        $fila['sueldo']
                    );
                }
                echo "</table>";
            } else echo "NO hay empleados con el sueldo superior a $valor";
        } catch (mysqli_sql_exception $e) {
            throw new Exception("Error de conexión " . $e->getMessage());
        } finally {
            $this->cerrar($conexionEstablecida);
        }
    }
}

// Prueba de conexión
$pruebaConexion = new ConexionBD(
    "programacion_ejemplos",
    "Daniel",
    "abc123.",
    "localhost"
);


try{
$pruebaConexion->getSueldoMayor(20000);
} catch(Exception $e){
    echo $e->getMessage();
}
