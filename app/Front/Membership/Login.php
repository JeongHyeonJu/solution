<?php

namespace Front\Membership;

class Login extends Base
{
    public function get()
    {
        return [];
    }

    public function post()
    {
        $email    = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        if (empty($email)) {
            $_SESSION['message'] = '이메일을 입력해 주세요';
            header('Location: /login');
            exit();
        }

        if (empty($password)) {
            $_SESSION['message'] = '비밀번호를 입력해 주세요';
            header('Location: /login');
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = '올바른 이메일을 입력해 주세요';
            header('Location: /login');
            exit();
        }

        try {
            $connection = new \PDO('mysql:host=localhost:3306;dbname=solution;charset=utf8', 'solution', 'qwer1234');
            $statement  = $connection->prepare('select email, password from users where email = :email;');
            $statement->execute([':email' => $email]);
            $user = $statement->fetch(\PDO::FETCH_ASSOC);

        } catch (\ErrorException $e) {
            echo var_export($e);
        }

        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $email;
            header('Location: /admin1');
            exit();
        }

        $_SESSION['message'] = '비밀번호가 틀렸습니다';
        header('Location: /login');

    }
}

