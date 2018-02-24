<?php

class Login
{
    public function get()
    {
        return ['b' => $_REQUEST['a']];
    }

    public function post()
    {
        $email    = trim($_POST['email']);
        $password = trim($_POST['password']);

        if (empty($email)) {
            $_SESSION['message'] = '이메일을 입력해 주세요';
            header('Location: http://localhost:8080/index.php?action=login');
            exit();
        }

        if (empty($password)) {
            echo '비밀번호를 입력해 주세요';
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '올바른 이메일 형식이 아닙니다';
            exit();
        }

        try {

            $connection = new PDO('mysql:host=localhost:3306;dbname=solution;charset=utf8', 'solution', 'qwer1234');
            $statement  = $connection->prepare('SELECT id, email, password FROM users WHERE email = :email');
            $statement->execute([':email' => $email]);
            $users = $statement->fetch(PDO::FETCH_ASSOC);

            if (empty($users)) {
                echo '회원가입해주세요';
                exit();
            }

            if (password_verify($password, $users['password'])) {
                $_SESSION['email'] = $email;
                header('Location: http://localhost:8080/index.php?action=admin1');
                exit();
            }

            echo '비밀번호가 틀렸습니다';

        } catch (Exception $e) {
            echo var_export($e);
        }
        return ['a' => '123'];
    }
}
