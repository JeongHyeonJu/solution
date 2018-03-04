<?php

namespace Admin;

class Logout extends Base
{
    public function get()
    {
        unset($_SESSION['email']);
        header('Location: /login');
    }
}
