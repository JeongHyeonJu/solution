<?php

$action = $_REQUEST['action'];
if (file_exists($action . '.php')) {
    require_once $action . '.php';
}

