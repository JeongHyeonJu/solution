<?php
require_once('base.php');

class AdminAuth extends Base
{
    protected function invokeMethod()
    {
        if (!$_SESSION['email']) {
            return 'index.php?action=login';
        }
        $method = strtolower($_SERVER['REQUEST_METHOD']) . 'Action';
        return $this->{$method}();
    }
}
