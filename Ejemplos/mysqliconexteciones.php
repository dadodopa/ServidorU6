<?php
$usuario_bd = "root";
$password_bd = "";
$host_bd ="localhost";
$nombre_bd = "prueba";
$conexion = null;
try {

//Conexión en 1 paso
//$conexion = new mysqli($host_bd, $usuario_bd,$password_bd, $nombre_bd);

//Conexión en 2 pasos
echo "<br>Estableciendo conexión...";
$conexion = new mysqli();
$conexion->connect($host_bd, $usuario_bd, $password_bd, $nombre_bd);
echo "<br>Conexión establecida...";
echo "<br>Propiedades de la conexión...";
echo "<pre>";
print_r($conexion);
echo "</pre>";
echo "<br>Hago mis consultas...";

echo "Cierro la conexión, si lo necesito o se lo dejo al finally";
$conexion->close();
echo "<br>Todavía existe el objeto...y el error es conexion_error: ".$conexion->connect_errno." como si la conexión estuviese establecida!!!!";
$conexion=null;

} catch (mysqli_sql_exception $e) {
  echo 'ERROR:' . $e->getMessage();
  echo "El objeto conexión existe! Aún cuando se ha producido un error.";
  echo "<br>es objeto: " . is_object($conexion);
  echo "<br>clase: " . get_class($conexion);
  echo "<br>conexion_error: ".$conexion->connect_errno;


} catch (Exception $e) {
  echo 'ERROR DESCONOCIDO:' . $e->getMessage();

} finally {
  echo "<br>Hola, estoy en el finally!";
  // Nos aseguramos de cerrar la conexión si estuviese abierta
  // Como vimos el objeto conexión existe aunque no se haya establecido la conexión, así que no nos llega comprobar que exista,
  // tenemos que mirar si está establecida, por ejemplo, que no exista un código de error.
 

  //if (get_class($conexion)=="mysqli" && !$conexion->connect_error) {

  if ($conexion instanceof mysqli && $conexion->connect_error == 0) {
     $conexion->close();
     echo "<br>Conexión cerrada en el finally.<br>";
     echo "<br>es objeto: " . is_object($conexion);
     echo "<br>clase: " . get_class($conexion);
     $conexion=null;

}

}