<?php
class Base
{
    public $action = null;
    public $isGetReq = null;
    public $twig = null;
    const TEMPLATES_PATH = './templates/';

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(self::TEMPLATES_PATH);
        $this->twig = new Twig_Environment($loader, array());

        $this->action = $_GET['action'];
        $this->isGetReq = $_SERVER['REQUEST_METHOD'] === 'GET';
    }
}