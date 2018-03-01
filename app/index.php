<?php
require_once '../vendor/autoload.php';
session_start();

$action = $_REQUEST['action'];


if (in_array($action, ['login', 'join'])) {
    $namespace = 'front';
}
if (in_array($action, ['admin1', 'admin2','logout'])) {
    $namespace = 'admin';
}
$data         = [
    'action' => $action,
];
$templatePath = "{$namespace}/{$action}" . ".twig";
$namespace    = ucfirst($namespace);
$action       = ucfirst($action);

$modelName = "\\{$namespace}\\{$action}";
$model     = new $modelName();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data            = array_merge($model->get(), $data);
    $data['message'] = $_SESSION['message'];
    unset($_SESSION['message']);
} else {
    $model->post();
}

$loader = new Twig_Loader_Filesystem('./templates');
$twig   = new Twig_Environment($loader);

echo $twig->render($templatePath, $data);

