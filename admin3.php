<?php
$base      = require_once('base.php');
$adminAuth = require_once('admin_auth.php');

class Admin3 extends Base
{

    public function get()
    {
        $check = (new AdminAuth)->check();
        return !empty($check) ? $check : [];
    }

    public function post()
    {
        return '';
    }
}

return Admin3;
