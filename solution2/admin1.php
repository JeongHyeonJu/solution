<?php
require_once './AdminAuth.php';

class Admin1 extends AdminAuth
{
    public function get()
    {
        return ['email' => $_SESSION['email']];
    }

}
