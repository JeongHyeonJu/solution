<?php

class Base
{
    public $templatesPath = '';
    public $result = null;

    const TEMPLATES_PATH = './templates/';

    public static function bootstrap()
    {
        $loader = new Twig_Loader_Filesystem(self::TEMPLATES_PATH);
        $twig = new Twig_Environment($loader, array());

        $actionFile = $_GET['action'] . '.php';
        $twigFile = self::TEMPLATES_PATH . $_GET['action'] . '.twig';

        if (!file_exists($actionFile)) {
            echo $twig->render('404.twig');
            return;
        }

        $module = require_once($actionFile);
        $k = new $module();
        $result = $k->_request();

        if (gettype($result) === 'string') {
            header('Location: /' . $result);
        }

        if (!file_exists($twigFile)) {
            echo 'twig not found error';
            // error
            return;
        }

        echo $twig->render($_GET['action'] . '.twig', $result);
    }

    public function __construct()
    {
    }

    public function _request()
    {
        return $this->{strtolower($_SERVER['REQUEST_METHOD'])}();
    }

}
