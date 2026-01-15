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

    public function cerrar($conexion)
    {
        $conexion->close();
    }

    public function getSueldoMayor($valor)
    {
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
        $this->cerrar($conexionEstablecida);
    }
    public function eliminarEmpleados($dni){
        $conexionEstablecida = $this->abrir();
        $sentecia=$conexionEstablecida->prepare("DELETE FROM empleados
        WHERE dni = ?");
        $sentecia->bind_param("s",$dni);
        $sentecia->execute();
        if ($sentecia->affected_rows>0) {
            echo "Se ha eliminado correctamente el empleado con DNI $dni";
        } else{
            echo "No se encontró ningún empleado con ese DNI: $dni";
        }
        $conexionEstablecida->close();
    }
    public function actualizarSalario($dni, $nuevoSalario){
        $conexionEstablecida= $this->abrir();
        $sentecia =$conexionEstablecida->prepare("UPDATE empleados 
        SET sueldo = ? 
        WHERE dni = ?");
        $sentecia->bind_param("ds",$nuevoSalario, $dni);
        $sentecia->execute();
        if ($sentecia->affected_rows>0) {
            echo "Se ha editado el sueldo a $nuevoSalario del empleado con el dni: $dni<br>";
        } else echo "No se ha encontrado ningún empleado con el dni: $dni <br>";
        $conexionEstablecida->close();
    }
    public function añadirDireccion(){
        $conexionEstablecida= $this->abrir();
        $sentecia="ALTER TABLE empleados ADD direccion VARCHAR(50)";
        if($conexionEstablecida->query($sentecia)){
            echo "Columna 'direccion' añadida correctamente";
        } else {
            echo "Error al añadir la columna: "- $conexionEstablecida->error;
        }
        $this->cerrar($conexionEstablecida);
    }
}

// Prueba de conexión
$pruebaConexion = new ConexionBD(
    "programacion_ejemplos",
    "Daniel",
    "abc123.",
    "localhost"
);

$pruebaConexion->añadirDireccion();