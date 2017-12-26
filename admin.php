<?php
$base = require_once('base.php');

class Admin extends Base
{

    public function get()
    {
        if (!$_SESSION['email']) {
            return 'index.php?action=login';
        }
        return [];

    }

    public function post()
    {
        return '';
    }
}

return Admin;