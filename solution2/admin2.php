<?php
session_start();
if (empty($_SESSION['email'])) {
    header('Location: http://localhost:8080/index.php?action=login');
    exit();
}
?>
admin2
<a href="/index.php?action=admin1">admin1</a>
<a href="/index.php?action=login">login</a>
<a href="/index.php?action=join">join</a>
