<?php
namespace Front\Dashboard;

class Base
{
    public function __construct()
    {
        if (empty($_SESSION['email'])) {
            header('Location: /login');
        }
    }
}
