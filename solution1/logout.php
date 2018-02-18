<?php
require_once('admin_auth.php');

class Logout extends AdminAuth
{
    public function getAction()
    {
        return [];
    }

    public function postAction()
    {
        session_destroy();
        return 'index.php?action=login';

    }
}

return Logout;