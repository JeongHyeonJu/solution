<?php
session_start();
if (empty($_SESSION['email'])) {
    header('Location: http://localhost:8080/index.php?action=login');
    exit();
}
?>
admin1


<a href="/index.php?action=admin2">admin2</a>
<a href="/index.php?action=login">login</a>
<a href="/index.php?action=join">join</a>

