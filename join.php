<?php
$base = require_once('base.php');
Class Join extends Base{
    public function __construct(){
        if(!empty($_SESSION['email'])) {
            header('Location: /index.php?action=admin');
            exit();
        }

        if($this->isGetReq){

            $twigFile = self::TEMPLATES_PATH . $this->action . '.twig';
            if(file_exists($twigFile)){
                echo $this->twig->render($this->action . '.twig');
            }

        }else {

            $email = $_POST['email'];
            $password = $_POST['password'];

            if(empty($email) || empty($password)){
                header('Location: /index.php?action=join');
                exit();
            }
            // $checkedEmail=filter_var($email, FILTER_VALIDATE_EMAIL);
            // if(!$checkedEmail){
            //     header('Location: /join.php');
            //     echo "잘못된 이메일 형식입니다. ";
            //     exit();
            // }
            // @TODO 비밀번호 규칙 추가 하기


            // 이메일 중복체크 확인하기 

            $connection = new PDO('mysql:host=localhost:3306;dbname=solution;charset=utf8', 'solution', 'qwer1234');
            $statement = $connection->prepare('INSERT INTO users (email, password) values (:email , :password)');
            $results = $statement->execute([
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ]);
            if($results){
                header('Location: /index.php?action=login');
                exit();
            }
            header('Location: /index.php?action=join');
            exit();
        }

    }
}
return Join;