<?php

namespace Admin;

class Admin2 extends Base
{
    public function get()
    {
        return ['email' => $_SESSION['email']];
    }

}

