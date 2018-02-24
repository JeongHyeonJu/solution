<?php
require_once './AdminAuth.php';

class Admin2 extends AdminAuth
{
    public function get()
    {
        return ['email' => $_SESSION['email']];
    }

}

