<?php
namespace Admin;

class Admin1 extends Base
{
    public function get()
    {
        return ['email' => $_SESSION['email']];
    }

}
