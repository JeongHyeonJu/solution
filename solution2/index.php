<?php
session_start();

require_once '../vendor/autoload.php';

$action = $_REQUEST['action'];

$loader = new Twig_Loader_Filesystem('./templates');
$twig   = new Twig_Environment($loader, []);

$namespace = ucfirst($_REQUEST['namespace']);

if (empty($namespace)) {
    $front = ['login', 'join'];
    $admin = ['admin1', 'admin2', 'logout'];

    if (in_array($action, $front)) {
        $namespace = 'front';
    }
    if (in_array($action, $admin)) {
        $namespace = 'admin';
    }
}
$template = $namespace . '/' . $action . '.twig';

$action = ucfirst($action);
$namespace = ucfirst($namespace);
$className = "\\{$namespace}\\{$action}";

$model = new $className;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data                = $model->get();
    $data['message']     = $_SESSION['message'];
    $_SESSION['message'] = '';
} else {
    $data = $model->post();
}

echo $twig->render($template, $data);
