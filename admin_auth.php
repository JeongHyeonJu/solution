<?php

class AdminAuth
{
    public function check()
    {
        if (!$_SESSION['email']) {
            return 'index.php?action=login';
        }
        return '';

    }

}
