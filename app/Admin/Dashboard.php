<?php
namespace Admin;

class Dashboard extends Base
{
    public function getAdmin1()
    {
        return [];
    }

    public function getAdmin2()
    {
        return [];
    }

    public function getLogout()
    {
        unset($_SESSION['email']);
        header('Location: /login');
    }

}
