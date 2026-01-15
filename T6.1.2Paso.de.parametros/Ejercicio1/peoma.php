<?php
// Lista de poemas en varios idiomas
$poemaMachado = [
 'es' => "Caminante, son tus huellas\nel camino y nada más;\ncaminante, no hay camino,
\nse hace camino al andar.",
 'en' => "Traveler, your footsteps\nare the path and nothing more;\ntraveler, there is no
path,\nthe path is made by walking.",
 'fr' => "Voyageur, ce sont tes empreintes\nle chemin et rien de plus;\nvoyageur, il n'y a pas
de chemin,\nle chemin se fait en marchant."
];
// Obtener el idioma de la URL
$idioma = $_GET['idioma'] ?? 'es'; // Predeterminado a 'es' si no se proporciona

// Validar el idioma solicitado
if (!array_key_exists($idioma, $poemaMachado)) {
 $idioma = 'es'; // Cambiar a español si el idioma no es válido
}
// Seleccionar el poema correspondiente
$poema = $poemaMachado[$idioma];
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($idioma) ?>">
<head>
 <meta charset="UTF-8">
 <title>Poema en <?= htmlspecialchars(strtoupper($idioma)) ?></title>
</head>
<body>
 <h1>Poema en <?= htmlspecialchars($idioma) ?></h1>
 <pre><?= htmlspecialchars($poema) ?></pre>
 <a href="index.php">Volver a la selección de idiomas</a>
</body>
</html>