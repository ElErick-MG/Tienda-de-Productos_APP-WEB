<?php
// Determine language from cookie (default to English)
$lang = isset($_COOKIE['lang']) && $_COOKIE['lang'] === 'es' ? 'es' : 'en';
$filename = $lang === 'es' ? 'categorias_es.txt' : 'categorias_en.txt';

if (!file_exists($filename)) {
    echo "No se encontró el archivo de categorías: " . htmlspecialchars($filename);
    return;
}

$fp = fopen($filename, 'r');
if (!$fp) {
    echo "No se puede abrir el fichero " . htmlspecialchars($filename);
    return;
}

while (!feof($fp)) {
    $linea = fgets($fp);
    if ($linea === false) break;
    echo htmlspecialchars(trim($linea)) . "<br>";
}

fclose($fp);
?>