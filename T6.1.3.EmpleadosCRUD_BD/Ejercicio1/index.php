<?php include("conexion.php");
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title>Datos de empleados</title>

    <link href="css/estilos.css" rel="stylesheet">

</head>

<body>
    <nav>
        <script type="text/javascript">
            window.onload = function() {
                document.getElementById("m01").style.background = "aquamarine";

            };
        </script>
        <?php include('layout/nav.php'); ?>
    </nav>
    <div class="contenedor-principal">
        <h1>CUERPO PRINCIPAL</h1>
        <div class="contenido">
            <h2>Lista de empleados</h2>
            <hr />

            <div class="listado">
                <table class="listado">
                    <tr>
                        <th>No</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Lugar de nacimiento</th>
                        <th>Fecha de nacimiento</th>
                        <th>Teléfono</th>
                        <th>Cargo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    <?php
                    //RECUPERAR LOS DATOS DE LOS EMPLEADOS Y MOSTRARLOS COMO LAS FILAS DE LA TABLA
                    $consulta = "SELECT * FROM empleados";
                    $resultado = $con->query($consulta);
                    $contador = 1;
                    while ($fila = $resultado->fetch_assoc()) {
                    ?>

                        <tr>
                            <th><?php echo $contador++ ?></th>
                            <th><?php echo $fila["codigo"] ?></th>
                            <th><?php echo $fila["nombres"] ?></th>
                            <th><?php echo $fila["lugar_nacimiento"] ?></th>
                            <th><?php echo date_format(date_create($fila["fecha_nacimiento"]), "d-m-Y") ?></th>
                            <th><?php echo $fila["telefono"] ?></th>
                            <th><?php echo $fila["puesto"] ?></th>
                            <th><?php echo $fila["estado"] ?></th>
                            <th><a href="./profile.php?cod=<?php echo $fila['codigo']?>">Ver</a>/ <a href="./edit.php?cod=<?php echo $fila['codigo']?>">Editar</a></th>
                        </tr>

                    <?php

                    }

                    ?>
                </table>
            </div>
        </div>
    </div>
    <footer>
        <?php include('layout/footer.php'); ?>
    </footer>
</body>

</html>