<?php
require_once('auth.php');

class Join extends Auth
{

    public function get()
    {
        return ['actionName' => 'join'];
    }

    public function post()
    {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            return 'index.php?action=join';
        }

        $connection = new PDO('mysql:host=localhost:3306;dbname=solution;charset=utf8', 'solution', 'qwer1234');
        $statement  = $connection->prepare('INSERT INTO users (email, password) values (:email , :password)');
        $results    = $statement->execute([
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
        if ($results) {
            return 'index.php?action=login';
        }
        return 'index.php?action=join';
    }
}

return Join;