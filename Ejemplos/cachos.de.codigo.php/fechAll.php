<?php
$stmt = $conexion->query("SELECT * FROM empleados");
$datos = $stmt->fetchAll();
