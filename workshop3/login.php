<?php
session_start();
//var_dump($_SESSION);
if (isset($_GET["action"])  && $_GET["action"]  == "logout") {
  session_destroy();
}
if (isset($_SESSION['username'])) {
    header("Location: game.php?name=".urlencode($_SESSION['username']));
} else if (isset($_POST["action"])  && $_POST["action"]  == "Login") {
    if(empty($_POST['username']) || empty($_POST['password'])){
        $error = 'User name and password are required';
    }elseif(!empty($_POST['password'])){
        $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
        $salt = 'XyZzy12*_';
        $keyin_password = hash('md5',$salt . $_POST['password']);
        if($stored_hash != $keyin_password){
            $error = 'Incorrect password';
        }else{
            $_SESSION['username'] = $_POST['username'];
            header("Location: game.php?name=".urlencode($_POST['username']));
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Mary Gale Jabagat</title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

</head>
<body>

<h3>Login</h3>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php if (isset($error)) : ?>
                <div class="response">
                    <?php echo $error; ?>
                </div>
            <?php endif ?>
            <form action="" method="POST" class="webform">
                <div class="form-login">
                        <h4>Welcome back.</h4>
                        <input type="text" id="userName" class="form-control input-sm chat-input" name="username" placeholder="username"/></br>
                        <input type="password" id="userPassword" class="form-control input-sm chat-input" name="password" placeholder="password"/></br>
                        <div class="wrapper">
                            <span class="group-btn">
                               <!-- <button class="btn btn-primary btn-md" name="login">login <i class="fa fa-sign-in"></i></button>-->
                                <input type="submit" class="btn btn-primary btn-md" value="Login" name="action" />
                            </span>
                        </div>
                 </div>
            </form>
        </div>
    </div>
</div>

