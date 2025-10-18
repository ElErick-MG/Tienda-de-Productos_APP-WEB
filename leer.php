<?php
// Load categories from the database instead of text files.
// Assumption: there is a table named `categorias` with columns `id`, `nombre_es`, `nombre_en`.

// Determine language from cookie (default to English)
$lang = isset($_COOKIE['lang']) && $_COOKIE['lang'] === 'es' ? 'es' : 'en';

// Include DB connection helper
require_once __DIR__ . '/conexion/DBConnection.php';

try {
    $db = new DBConnection();
    // Select the appropriate column based on language
    $col = $lang === 'es' ? 'nombre_es' : 'nombre_en';

    // Make sure the column exists in the table to avoid SQL errors
    $allowedCols = ['nombre_es', 'nombre_en'];
    if (!in_array($col, $allowedCols)) {
        $col = 'nombre_en';
    }

    $sql = "SELECT id, $col AS nombre FROM categorias ORDER BY id";
    $results = $db->read('categorias', '1');

    if ($results === false) {
        // If generic read failed (for example table doesn't exist), attempt direct query for clearer error
        $mysqli = new mysqli('localhost', 'root', '', 'mundo');
        if ($mysqli->connect_errno) {
            echo "Error de conexión a la base de datos.";
        } else {
            $res = $mysqli->query($sql);
            if ($res && $res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    echo htmlspecialchars($row['nombre']) . "<br>";
                }
            } else {
                echo "No hay categorías en la base de datos o la tabla 'categorias' no existe.";
            }
            $mysqli->close();
        }
    } else {
        // The DBConnection::read returned rows; map expected structure if full rows returned
        // If the table has columns nombre_es/nombre_en, transform results to use the chosen column
        $printed = false;
        foreach ($results as $r) {
            if (isset($r[$col])) {
                echo htmlspecialchars($r[$col]) . "<br>";
                $printed = true;
            } elseif (isset($r['nombre'])) {
                echo htmlspecialchars($r['nombre']) . "<br>";
                $printed = true;
            }
        }
        if (!$printed) {
            echo "No hay categorías disponibles en la base de datos.";
        }
    }

    // Close if DBConnection has a close method
    if (method_exists($db, 'close')) {
        $db->close();
    }

} catch (Exception $e) {
    echo "Error al obtener categorías: " . htmlspecialchars($e->getMessage());
}

?>