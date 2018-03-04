<?php

namespace Front\Dashboard;

class Logout extends Base
{
    public function get()
    {
        unset($_SESSION['email']);
        header('Location: /login');
    }
}
