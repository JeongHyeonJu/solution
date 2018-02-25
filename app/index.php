<?php
require_once '../vendor/autoload.php';

$action = $_REQUEST['action'];


if (in_array($action, ['login', 'join'])) {
    $namespace = 'front';
}
if (in_array($action, ['admin1', 'admin2'])) {
    $namespace = 'admin';
}
$templatePath = "{$namespace}/{$action}" . ".twig";
$namespace    = ucfirst($namespace);
$action       = ucfirst($action);

$modelName = "\\{$namespace}\\{$action}";
$model     = new $modelName();

$loader = new Twig_Loader_Filesystem('./templates');
$twig   = new Twig_Environment($loader, []);

echo $twig->render($templatePath);

