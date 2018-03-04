<?php

namespace Front\Membership;

class Base
{
    public function __construct()
    {
        if (!empty($_SESSION['email'])) {
            header('Location: /admin1');

        }
    }
}
