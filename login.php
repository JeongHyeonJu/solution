<?php
$base = require_once('base.php');
class Login extends Base{
    public function __construct() {
        parent::__construct();

        if($_SESSION['email']) {
            header('Location: /index.php?action=admin');
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
                header('Location: /index.php?action=login');
                exit();
            }

            $connection = new PDO('mysql:host=localhost:3306;dbname=solution;charset=utf8', 'solution', 'qwer1234');
            $statement = $connection->prepare('SELECT email, password FROM users WHERE email = :email ');
            $statement->execute([
                'email' => $email,
            ]);
            $results = $statement->fetch(PDO::FETCH_ASSOC);
            if(empty($results['email'])){
                header('Location: /index.php?action=login');
                exit();
            }
            if(!password_verify($password, $results['password'])){
                header('Location: /index.php?action=login');
                exit();
            }
            $_SESSION['email'] = $email;
            header('Location: /index.php?action=admin');

        }

    }

}
return Login;

?>