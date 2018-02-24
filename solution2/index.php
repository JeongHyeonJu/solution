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

if (file_exists($action . '.php')) {
    require_once "./$action.php";

    $model = (new $action);
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $data                = $model->get();
        $data['message']     = $_SESSION['message'];
        $_SESSION['message'] = '';
    } else {
        $data = $model->post();
    }
}

echo $twig->render($action . '.twig', $data);
