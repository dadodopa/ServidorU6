<?php

include 'Persona.php';

$usuario_bd = "root";

$password_bd = "";

$host_bd = "localhost";

$nombre_bd = "programacion_ejemplos";

//mysqli_report(MYSQLI_REPORT_STRICT);

MYSQLI_REPORT_ALL;

$conexion = null;

try {

    //Conexión en 1 paso

    //$conexion = new mysqli($host_bd, $usuario_bd,$password_bd, $nombre_bd);

    //Conexión en 2 pasos

    $conexion = new mysqli();

    $conexion->connect($host_bd, $usuario_bd, $password_bd, $nombre_bd);

    echo "<pre>";

    print_r($conexion);

    echo "</pre>";

    //INICIO CUERPO DE LA CONSULTA

    $query = "SELECT * FROM personas ORDER BY dni";

    $resultado = $conexion->query($query);

    print_r($resultado);

    while ($p = $resultado->fetch_object("Persona")) {

        //print_r($fila);

        echo "</br>";

        echo serialize($p);

        echo "</br>";

        echo "DNI: " . $p->getDni() . " --> Nombre:" . $p->getNombre() . " --> Edad:" . $p->edad . "<br/>";

        //edad no existe en la clase, si los atributos no están definidos pasan a existir y ser públicos.

    }

    $resultado->close(); //Para la liberar la memoria utilizada por el resultset

    //Ejemplo clase genérica

    echo "<br><br>stdClass<br>";

    $resultado = $conexion->query($query);

    print_r($resultado);

    while ($p = $resultado->fetch_object()) { //stdClass

        //print_r($fila);

        echo "</br>";

        echo serialize($p);

        echo "</br>";

        echo "DNI: " . $p->dni . " --> Nombre:" . $p->nombre . " --> Edad:" . $p->edad . "<br/>";
    }

    $resultado->close(); //Para la liberar la memoria utilizada por el resultset

    //FIN CUERPO DE LA CONSULTA

    $conexion->close();

    $conexion = null;
} catch (mysqli_sql_exception $e) {

    echo '<br>ERROR: ' . $e->getMessage();

    echo "<br>ERROR: " . $conexion->errno;
} catch (Exception $e) {

    echo '<br>ERROR DESCONOCIDO:' . $e->getMessage();
} finally {

    if ($conexion instanceof mysqli && $conexion->connect_error == 0) {

        $conexion->close();

        $conexion = null;

        echo "<br>Conexión cerrada en el finally.<br>";
    }
}
