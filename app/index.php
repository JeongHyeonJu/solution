<?php
require_once '../vendor/autoload.php';
session_start();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/login', 'front_membership_login');
    $r->addRoute('POST', '/login', 'front_membership_login');
    $r->addRoute('GET', '/join', 'front_membership_join');
    $r->addRoute('POST', '/join', 'front_membership_join');
    $r->addRoute('GET', '/logout', 'admin_dashboard_logout');
    $r->addRoute('POST', '/logout', 'admin_dashboard_logout');
    $r->addRoute('GET', '/admin1', 'admin_dashboard_admin1');
    $r->addRoute('POST', '/admin1', 'admin_dashboard_admin1');
    $r->addRoute('GET', '/admin2', 'admin_dashboard_admin2');
    $r->addRoute('POST', '/admin2', 'admin_dashboard_admin2');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri        = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars    = $routeInfo[2];

        $templatePath = preg_replace('/_/', '/', $handler) . ".twig";
        $modelName    = preg_replace('/_/', '\\\\', substr($handler, 0, strrpos($handler, '_')));
        $action       = substr($handler, strrpos($handler, '_') + 1, strlen($handler));

        $model = new $modelName();
        $data  = ['action' => $action,];

        if ($httpMethod === 'GET') {
            $data            = array_merge($model->{'get' . ucfirst($action)}(), $data);
            $data['message'] = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $model->{'post' . ucfirst($action)}();
        }

        $loader = new Twig_Loader_Filesystem('./templates');
        $twig   = new Twig_Environment($loader);

        echo $twig->render($templatePath, $data);

        break;
}

