<?php

$usuario_bd = "root";
$password_bd = "";
$host_bd ="localhost";
$nombre_bd = "prueba";

//A partir de la versión 8.1 los fallos en la conexión generan excepciones, anteriormente generaban un warning.
mysqli_report(MYSQLI_REPORT_OFF); // Desactivamos las excepciones para realizar pruebas.


//Conexión en 1 paso
$conexion = new mysqli($host_bd, $usuario_bd,$password_bd, $nombre_bd);

echo "<pre>";
print_r($conexion);
echo "</pre>";

if ($conexion==null){
echo "<br>El objeto conexión está vacío.";
} else {
echo "<br>El objeto conexión NO está vacío."; //Que no quiere decir que esté abierta.
}

if ($conexion->connect_errno==0){
echo "Cerrando la conexión";
$conexion->close();
}

echo "<h3>Por aquí tengo más código en el script.</h3>";

//PRUEBAS - mysqli_report(MYSQLI_REPORT_OFF) - Genera advertencias (en lugar de excepciones) y la ejecución del script continua.
//- cuando la conexión es satisfactoria, vemos como se produce el cierre de conexión.
//- cuando la conexión FALLA, vemos que el objeto no está vacío porque contiene la información del error, pero ya no se intenta realizar el cierre.


//Comentando mysqli_report(MYSQLI_REPORT_OFF)
//- cuando la conexión FALLA - Fatal error: Uncaught mysqli_sql_exception: Access denied for user 'root'@'localhost' (using password: YES)
// y el script no continua no vemos más mensajes.