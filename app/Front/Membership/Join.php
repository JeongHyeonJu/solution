<?php

namespace Front\Membership;

class Join extends Base
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
            header('Location: /join');
            exit();
        }

        if (empty($password)) {
            $_SESSION['message'] = '비밀번호를 입력해 주세요';
            header('Location: /join');
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = '올바른 이메일을 입력해 주세요';
            header('Location: /join');
            exit();
        }

        try {
            $connection  = new \PDO('mysql:host=localhost:3306;dbname=solution;charset=utf8', 'solution', 'qwer1234');
            $statement   = $connection->prepare('insert into users values (email, password)');
            $affectedRow = $statement->execute([':email' => $email, ':password' => password_hash($password)]);

        } catch (\ErrorException $e) {
            echo var_export($e);
        }

        if ($affectedRow > 0) {
            header('Location: /login');
            exit();
        }

        $_SESSION['message'] = '가입에 실패했습니다. 다시 시도해 주세요';
        header('Location: /join');


    }
}

