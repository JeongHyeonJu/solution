<?php
namespace Front;

class join extends Base
{
    public function get()
    {
        return ['time' => time()];
    }

    public function post()
    {
        $email    = trim($_POST['email']);
        $password = trim($_POST['password']);

        if (empty($email)) {
            echo '이메일을 입력해 주세요';
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

            $connection  = new PDO('mysql:host=localhost:3306;dbname=solution;charset=utf8', 'solution', 'qwer1234');
            $statement   = $connection->prepare('insert into users (email, password) values (:email, :password)');
            $affectedRow = $statement->execute([
                ':email'    => $email,
                ':password' => password_hash($password, PASSWORD_DEFAULT)
            ]);

            if ($affectedRow > 0) {
                echo $email . ' 가입을 축하드립니다';
                exit();
            }

            echo '가입에 실패했습니다. 다시 시도해 주세요';

        } catch (Exception $e) {
            echo var_export($e);
        }
    }
}
