<?php
// Array de descripciones de libros
$descripciones = [
"ElQuijote"=> "Una obra maestra de Miguel de Cervantes que narra las aventuras de un caballero idealista.",
"CienAñosdeSoledad"=> "Una historia mágica de realismo latinoamericano escrita por Gabriel García Márquez.",
"1984"=> "Una novela distópica de George Orwell que explora temas de control y vigilancia."
];
// Verificar si se ha pasado un código por la URL
$titulo=$_GET["titulo"]?? "";
// Comprobar si el código existe en el array, si no existe se mostrará “No se ha seleccionado ningún
//libro” o un mensaje similar.
if (!array_key_exists($titulo, $descripciones)) {
    $descripcion="No se ha introducido ningún titulo";
}else $descripcion=$descripciones[$titulo];

?>
<!DOCTYPE html>
<html>
<head>
 <title>Descripción del Libro</title>
</head>
<body>
 <h1>Descripción del Libro</h1>
 <p><?php echo $descripcion; ?></p>
 <a href="index.php">Volver al listado</a>
</body>
</html>