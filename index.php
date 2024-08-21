<?php ob_start(); session_start(); define('X', 1);
ini_set('display_errors', 1);

$UserId = (int) ($_SESSION['onlines']['id'] ?? 0);
// GET CONFİG FİLE
require_once __DIR__.'/config/config.php';
require_once __DIR__.'/config/functions.php';


// If in page login or ajax api remove header
// Global use id
$getId = (int)($_GET['id'] ?? 0);
//Global use do
$do = isset($_GET['do']) ? htmlspecialchars($_GET['do']) : NULL;


//ROUTE - SET - EXPLODE
$routeExplode = explode('?', $_SERVER['REQUEST_URI']);
$route = array_values(array_filter(explode('/', $routeExplode[0] ?? '')));
if (SUB_DIR) {
    array_shift($route);
}

// ROUTE SET FOR HOME
if (!route(0)) {
    $route[0] = 'home';
}

// IF NOT EXISTS CONTROLLER FILE SET 404
if (!file_exists(controller(route(0)))) {
    $alert =  Alert('<strong>' . $route[0] . '</strong> controller not found');
    $route[0] = 'home';
}

if ($UserId < 1 && route(0) != 'login'){
    go('login');
    exit;
}

// REQUIRE CONTROLLER FILE
require controller(route(0));
