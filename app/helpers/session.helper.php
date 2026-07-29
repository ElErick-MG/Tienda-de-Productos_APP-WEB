<?php
/**
 * Helper de sesión.
 * Verifica que el usuario tenga una sesión activa válida.
 * Si no, redirige al login.
 *
 * Uso: require_once __DIR__ . '/../app/helpers/session.helper.php';
 *      requireSession();
 */

function requireSession(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['nombre']) || !isset($_SESSION['clave'])) {
        header('Location: index.php');
        exit();
    }
}

/**
 * Resuelve el idioma activo en base a GET, Cookie o defecto 'es'.
 *
 * @return string 'es' o 'en'
 */
function resolveLanguage(): string {
    $lang = 'es';
    if (isset($_GET['lang']) && in_array($_GET['lang'], ['es', 'en'])) {
        $lang = $_GET['lang'];
        $remember = isset($_COOKIE['recordarme']) && $_COOKIE['recordarme'] === '1';
        if ($remember) {
            setcookie('lang', $lang, 0, '/');
        }
    } elseif (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], ['es', 'en'])) {
        $lang = $_COOKIE['lang'];
    }
    return $lang;
}

/**
 * Carga el array de textos del idioma indicado.
 *
 * @param string $lang  'es' o 'en'
 * @param string $section Sección del array ('panel', 'producto', 'carrito', 'login')
 * @return array
 */
function loadTexts(string $lang, string $section): array {
    $file = __DIR__ . '/../lang/' . $lang . '.php';
    if (!file_exists($file)) {
        $file = __DIR__ . '/../lang/es.php';
    }
    $all = require $file;
    return $all[$section] ?? [];
}

/**
 * Retorna la tabla de productos según el idioma.
 *
 * @param string $lang
 * @return string
 */
function productsTable(string $lang): string {
    return ($lang === 'en') ? 'productosen' : 'productoses';
}

/**
 * Cuenta los ítems en el carrito de la sesión actual.
 *
 * @return int
 */
function cartCount(): int {
    return isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
}
