<?php

/**
 * Created by PhpStorm.
 * User: hyeon
 * Date: 2018. 2. 24.
 * Time: PM 7:03
 */
class Logout
{
    public function get()
    {
        session_destroy();
        header('Location: http://localhost:8080/index.php?action=login');
    }
}