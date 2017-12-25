<?php
if(empty($_SESSION['email'])){
    header('Location: /index.php?action=login');
    exit();
}

if($isGetReq){

    $twigFile = $action . '.twig';
    if(file_exists($templatesPath. $twigFile)){
        echo $twig->render($twigFile, $_GET);
    }

}else {
}