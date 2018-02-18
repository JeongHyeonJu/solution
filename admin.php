<?php
require_once('admin_auth.php');

class Admin extends AdminAuth
{
    public function getAction()
    {
        return [];
    }

    public function postAction()
    {
        return '';
    }
}

return Admin;