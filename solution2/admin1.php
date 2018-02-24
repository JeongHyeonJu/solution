<?php

class Admin1
{
    public function get()
    {
        return ['email' => $_SESSION['email']];
    }

}
