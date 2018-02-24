<?php

class Admin2
{
    public function get()
    {
        return ['email' => $_SESSION['email']];
    }

}

