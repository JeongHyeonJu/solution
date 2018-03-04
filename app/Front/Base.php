<?php

namespace Front;

class Base
{
    public function __construct()
    {
        if (!empty($_SESSION['email'])) {
            header('Location: /admin1');

        }
    }
}
