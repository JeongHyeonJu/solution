<?php

class Auth
{
    public function check()
    {
        if ($_SESSION['email']) {
            return 'index.php?action=admin';
        }
        return '';
    }
}