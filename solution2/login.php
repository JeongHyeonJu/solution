<?php if ($_SERVER['REQUEST_METHOD'] === 'GET') { ?>
    <!doctype html>
    <html>
    <head>
        <title>login</title>
        <meta charset="utf-8"/>
    </head>
    <body>
    <form method="post" action="/login.php">
        <input type="text" name="email" value=""/>
        <input type="password" name="password" value=""/>
        <button type="submit">LOGIN</button>
    </form>
    </body>
    </html>
<?php } else { ?>
    <?php

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

        $connection = new PDO('mysql:host=localhost:3306;dbname=solution;charset=utf8', 'solution', 'qwer1234');
        $statement  = $connection->prepare('SELECT id, email, password FROM users WHERE email = :email');
        $statement->execute([':email' => $email]);
        $users = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($users)) {
            echo '회원가입해주세요';
            exit();
        }

        if (password_verify($password, $users['password'])) {
            echo $email . ' 안녕하세요';
            exit();
        }

        echo '비밀번호가 틀렸습니다';

    } catch (Exception $e) {
        echo var_export($e);
    }

    ?>

<?php } ?>
