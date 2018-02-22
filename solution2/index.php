<?php
session_start();

require_once '../vendor/autoload.php';

$action = $_REQUEST['action'];
//if (file_exists($action . '.php')) {
//    require_once $action . '.php';
//}

//if (!empty($_SESSION['email'])) {
//    header('Location: http://localhost:8080/index.php?action=admin1');
//    exit();
//}
//if (!empty($_SESSION['email'])) {
//    header('Location: http://localhost:8080/index.php?action=admin1');
//    exit();
//}

//if (empty($_SESSION['email'])) {
//    header('Location: http://localhost:8080/index.php?action=login');
//    exit();
//}

$loader = new Twig_Loader_Filesystem('./templates');
$twig   = new Twig_Environment($loader, []);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo $twig->render($action . '.twig', []);
} else {
    if (file_exists($action . '.php')) {
        require_once "./$action.php";
    }
}
