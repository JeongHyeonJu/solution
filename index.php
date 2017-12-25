<?php 
session_start();
$action = $_GET['action'];
ob_start();
$isGetReq = $_SERVER['REQUEST_METHOD'] === 'GET';

include_once './vendor/autoload.php';

$templatesPath = './templates/';
$loader = new Twig_Loader_Filesystem($templatesPath);
$twig = new Twig_Environment($loader, array(
    'debug' => true,
));

$actionFile =  $action . '.php';
if(file_exists($actionFile)){
    $k = require_once($actionFile);
    new $k();
} else {
    echo $twig->render('404.twig');
}
