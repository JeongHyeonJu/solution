<?php

/**
 * Created by PhpStorm.
 * User: hyeon
 * Date: 2018. 2. 24.
 * Time: PM 7:00
 */
class AdminAuth
{

    /**
     * AdminAuth constructor.
     */
    public function __construct()
    {
        if (empty($_SESSION['email'])) {
            header('Location: http://localhost:8080/index.php?action=login');
            exit();
        }
    }
}