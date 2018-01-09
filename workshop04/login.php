<?php

session_start();
if (isset($_SESSION['username'])) {
    header("Location: autos.php?name=".urlencode($_SESSION['username']));
}else if (isset($_POST["action"])  && $_POST["action"]  == "Login") {
    $bLogin = false;
    if(empty($_POST['username']) || empty($_POST['password'])) {
        $error = 'User name and password are required';
    }elseif(!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);
        $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
        $salt = 'XyZzy12*_';
        $keyin_password = hash('md5',$salt . $password);
        //check if valid email address
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $error = 'Email must have an at-sign (@)';
        }elseif($stored_hash != $keyin_password){
            $error = 'Incorrect password';
        }else{
            $_SESSION['username'] = $_POST['username'];
            $bLogin = true; echo 'login';

        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Jabagat, Mary Gale</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

</head>
<body>

<h3>Login <?php echo $bLogin; ?></h3>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php if(isset($bLogin) && $bLogin == true) : ?>
                <div class="response-sucess">
                    Login was successfull redirecting to autos page in just a moment ...
                </div>
             <?php
               /* sleep(20);
                header("Location: autos.php?name=".urlencode($_SESSION['username']));*/
             endif;?>
            <?php if (isset($error)) : ?>
                <div class="response-error">
                    <?php echo $error; ?>
                </div>
            <?php endif ?>
            <form action="" method="POST" class="webform">
                <div class="form-login">
                    <h4>Welcome back!</h4>
                    <input type="text" id="userName" class="form-control input-sm chat-input" name="username" placeholder="username"/></br>
                    <input type="password" id="userPassword" class="form-control input-sm chat-input" name="password" placeholder="password"/></br>
                    <div class="wrapper">
                            <span class="group-btn">
                                <input type="submit" class="btn btn-primary btn-md" value="Login" name="action" />
                            </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
