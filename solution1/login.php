<?php
require_once('auth.php');


class Login extends Auth
{
    public function getAction()
    {
        return ['moduleName' => 'login'];
    }

    public function postAction()
    {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            return 'index.php?action=login';
        }

        $connection = new \PDO('mysql:host=localhost:3306;dbname=solution;charset=utf8', 'solution', 'qwer1234');
        $statement  = $connection->prepare('SELECT email, password FROM users WHERE email = :email ');
        $statement->execute([
            'email' => $email,
        ]);
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        if (empty($results['email'])) {
            return 'index.php?action=login';
        }
        if (!\password_verify($password, $results['password'])) {
            return 'index.php?action=login';
        }
        $_SESSION['email'] = $email;
        return 'index.php?action=admin';

    }
}

return Login;
