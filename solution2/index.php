<?php
session_start();

require_once '../vendor/autoload.php';

$action = $_REQUEST['action'];

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
