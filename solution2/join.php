<?php if ($_SERVER['REQUEST_METHOD'] === 'GET') { ?>
    <!doctype html>
    <html>
    <head>
        <title>join</title>
        <meta charset="utf-8"/>
    </head>
    <body>
    <form method="post" action="/join.php">
        <input type="text" name="email" value=""/>
        <input type="password" name="password" value=""/>
        <button type="submit">JOIN</button>
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

    ?>

<?php } ?>
