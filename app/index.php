<?php
require_once '../vendor/autoload.php';
session_start();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/login', 'login');
    $r->addRoute('POST', '/login', 'login');
    $r->addRoute('GET', '/admin1', 'admin1');
    $r->addRoute('POST', '/admin1', 'admin1');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

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
        $vars = $routeInfo[2];

        if (in_array($handler, ['login', 'join'])) {
            $namespace = 'front';
        }
        if (in_array($handler, ['admin1', 'admin2','logout'])) {
            $namespace = 'admin';
        }
        $data         = [
            'action' => $handler,
        ];
        $templatePath = "{$namespace}/{$handler}" . ".twig";
        $namespace    = ucfirst($namespace);
        $handler       = ucfirst($handler);

        $modelName = "\\{$namespace}\\{$handler}";
        $model     = new $modelName();

        if ($httpMethod === 'GET') {
            $data            = array_merge($model->get(), $data);
            $data['message'] = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $model->post();
        }

        $loader = new Twig_Loader_Filesystem('./templates');
        $twig   = new Twig_Environment($loader);

        echo $twig->render($templatePath, $data);

        break;
}

