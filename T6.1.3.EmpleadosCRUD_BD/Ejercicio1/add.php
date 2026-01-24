<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <title>Alta Empleado</title>

    <link href="css/estilos.css" rel="stylesheet">
</head>

<body>
    <nav>
        <script type="text/javascript">
            window.onload = function() {
                document.getElementById("m02").style.background = "aquamarine";

            };
        </script>
        <?php include("layout/nav.php"); ?>
    </nav>
    <div class="contenedor-principal">
        <h1>CUERPO PRINCIPAL</h1>
        <div class="contenido">
            <h2>Datos del empleados &raquo; Agregar datos</h2>
            <hr />

            <?php
            /* Si se ha pulsado añadir formateamos los datos, comprobamos que no exista un empleado con el mismo código y los añadimos */
            if (isset($_POST['bGuardar'])) {
                $codigo = mysqli_real_escape_string($con, (strip_tags($_POST["codigo"], ENT_QUOTES))); //Escanpando caracteres 
                $nombres = mysqli_real_escape_string($con, (strip_tags($_POST["nombres"], ENT_QUOTES))); //Escanpando caracteres 
                $lugar_nacimiento = mysqli_real_escape_string($con, (strip_tags($_POST["lugar_nacimiento"], ENT_QUOTES))); //Escanpando caracteres 
                $fecha_nacimiento = mysqli_real_escape_string($con, (strip_tags($_POST["fecha_nacimiento"], ENT_QUOTES))); //Escanpando caracteres 
                $direccion = mysqli_real_escape_string($con, (strip_tags($_POST["direccion"], ENT_QUOTES))); //Escanpando caracteres 
                $telefono = mysqli_real_escape_string($con, (strip_tags($_POST["telefono"], ENT_QUOTES))); //Escanpando caracteres 
                $puesto = mysqli_real_escape_string($con, (strip_tags($_POST["puesto"], ENT_QUOTES))); //Escanpando caracteres 
                $estado = mysqli_real_escape_string($con, (strip_tags($_POST["estado"], ENT_QUOTES))); //Escanpando caracteres 

                //HACER LAS VALIDACIONES DE DATOS QUE SE CONSIDEREN EN CUANTO A TIPOS Y DEMÁS VALORES 
                //primero cambiamos el formato de la valiable que obtenemos del formulario a formato fecha
                $fecha_nacimiento = DateTime::createFromFormat("d/m/Y", $fecha_nacimiento);
                //con el siente if comprobamos que la fecha de nacimiento no esté en el formato inadecuado en caso de estar mal se guarda el error en un array
                if (!$fecha_nacimiento) {
                    $errores[] = "Fecha inválida";
                }
                //con el siguiente if comprobamos que el telefono sea de una cadena de número no sea ni menos ni más de 9
                if (!preg_match("/^[0-9]{9}$/", $telefono)) {
                    $errores[] = "Teléfono incorrecto";
                }
                //con el siguiente if comprobamos que el nombre del empleado sea una cadena de caracteres alfabeticos que esté entre 3 y 50
                if (!preg_match("/^[A-Za-z ]{3,50}$/", $nombres)) {
                    $errores[] = "Nombre inválido";
                }
                //con el siguiente if comprobamos que la variable de estado sea entre una de las cadenas que tenemos en una array llamada estados_validos
                $estados_validos = ["Fijo", "Contratado", "Externo"];
                if (!in_array($estado, $estados_validos)) {
                    $errores[] = "Estado incorrecto";
                }

                //Comprobamos si existe algún empleado con el mismo código en la base de datos
                if (empty($errores)) {
                    $conexion = new mysqli($db_host = "localhost", $db_user = "root", $db_pass = "", $db_name = "crud02_empleados");
                    
                }
                //Si existe mostramos un aviso al usuario

                //Si no existe añadimos al empleado


            }
            ?>
            <!-- El formulario se ejecuta en la misma página -->
            <form class="alta" action="" method="post">
                <div class="">
                    <label>Código</label>
                    <input type="text" name="codigo" class="" placeholder="Código" required>
                </div>
                <div class="">
                    <label>Nombre</label>
                    <input type="text" name="nombres" class="" placeholder="Nombres" required>
                </div>
                <div class="">
                    <label>Lugar de nacimiento</label>
                    <input type="text" name="lugar_nacimiento" class="" placeholder="Lugar de nacimiento" required>
                </div>
                <div class="">
                    <label>Fecha de nacimiento</label>
                    <input type="text" name="fecha_nacimiento" class="" data-date-format="dd-mm-yyyy" placeholder="00-00-0000" required />
                </div>
                <div class="">
                    <label>Dirección</label>
                    <textarea name="direccion" class="" placeholder="Dirección"></textarea>
                </div>
                <div class="">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="" placeholder="Teléfono" required>
                </div>
                <div class="">
                    <label>Puesto</label>
                    <input type="text" name="puesto" class="" placeholder="Puesto" required>
                </div>
                <div class="">
                    <label>Estado</label>
                    <select name="estado" class="">
                        <option value=""> ----- </option>
                        <option value="1">Fijo</option>
                        <option value="2">Contratado</option>
                        <option value="3">Externo</option>
                    </select>

                </div>
                <!-- Botones -->
                <div class="">
                    <label>&nbsp;</label>
                    <input type="submit" name="bGuardar" class="" value="Guardar datos">
                    <a href="index.php" class="">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <?php include('layout/footer.php'); ?>
    </footer>
</body>

</html>