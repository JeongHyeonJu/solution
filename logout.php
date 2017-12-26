<?php

$base = require_once('base.php');

class Logout extends Base
{
    public function get()
    {
        return [];
    }

    public function post()
    {
        session_destroy();
        return 'index.php?action=login';

    }
}

return Logout;