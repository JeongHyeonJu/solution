<?php
namespace Admin;

class Base
{
    public function __construct()
    {
        if (empty($_SESSION['email'])) {
            header('Location: http://localhost:8080/index.php?action=login');
            exit();
        }
    }
}