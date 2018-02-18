<?php
require_once('base.php');

class Auth extends Base
{
    protected function invokeMethod()
    {
        if ($_SESSION['email']) {
            return 'index.php?action=admin';
        }
        $method = strtolower($_SERVER['REQUEST_METHOD']) . 'Action';
        return $this->{$method}();
    }
}
