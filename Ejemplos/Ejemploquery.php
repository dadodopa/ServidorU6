<?php

$usuario_bd = "root";
$password_bd = "";
$host_bd ="localhost";
$nombre_bd = "programacion_ejemplos";

mysqli_report(MYSQLI_REPORT_STRICT);
//MYSQLI_REPORT_ALL;

$conexion=null;
try{

//Conexión en 1 paso
//$conexion = new mysqli($host_bd, $usuario_bd,$password_bd, $nombre_bd);

//Conexión en 2 pasos
$conexion = new mysqli();
$conexion->connect($host_bd, $usuario_bd,$password_bd, $nombre_bd);

echo "<pre>";
print_r($conexion);
echo "</pre>";
$query = "INSERT INTO personas (dni, nombre, edad) VALUES ('42345678L', 'María', 30)";

//Ver errores
//$query = "INSERT INTO personas (dni, nombre) VALUES ('42345678L', 'María', 30)";
//$query = "INSERT INTO personas (dni, nombre, edad) VALUES ('42345678B', 'María', 'AAA')"; //No da error inserta 0 en edad.
//$query = "INSERT INTO personas (dni, nombre, edad) VALUES ('hhh42345678Bddddddddd', 'María', 'AAA')"; //No da error corta la cadena, según el tamaño.
//IMPORTANTE QUE LOS DATOS ESTÉN BIEN VALIDADOS PARA NO INSERTAR BASURA.

$resultado=$conexion->query($query);
var_dump($resultado);
echo "<br>ERROR: ".$conexion->errno;
echo "<br>Cierro la conexión.";
$conexion->close();
$conexion=null;

}catch(mysqli_sql_exception $e){
  echo '<br>ERROR: '.$e->getMessage();
  echo "<br>ERROR: ".$conexion->errno;


}catch (Exception $e){
  echo '<br>ERROR DESCONOCIDO:'.$e->getMessage();

}finally {

   if ($conexion instanceof mysqli && $conexion->connect_error == 0) {
          $conexion->close();
          $conexion=null;
          echo "<br>Conexión cerrada en el finally.<br>";
   }
}

//Ejemplo de erorres capturados

//ERROR: Duplicate entry '42345678L' for key 'PRIMARY'
//ERROR: 1062

//ERROR: Column count doesn't match value count at row 1
//ERROR: 1136