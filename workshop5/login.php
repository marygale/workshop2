<?php


session_start();
$bLogin = false;

if (isset($_SESSION['email'])) {
    header("Location: view.php");
}else if (isset($_POST["action"])  && $_POST["action"]  == "Login") {
    if(empty($_POST['email']) || empty($_POST['password'])) {
        $_SESSION['error'] = 'User name and password are required';
    }elseif(!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
        $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
        $salt = 'XyZzy12*_';
        $keyin_password = hash('md5',$salt . $password);
        //check if valid email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Email must have an at-sign (@)';
        }elseif($stored_hash != $keyin_password){
            $_SESSION['error'] = 'Incorrect password';
        }else{
            $_SESSION['email'] = $_POST['email'];
            $bLogin = true;
            header( "refresh:5;url=view.php");
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

<h3>Login</h3>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php if(isset($bLogin) && $bLogin == true) : ?>
                <div class="load-wrapp">
                    <div class="load-10">
                        <p>Login was successfull redirecting to view page in just a moment ...</p>
                        <div class="bar"></div>
                    </div>
                </div>
            <?php endif;?>
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="response-error">
                    <?php echo $_SESSION['error']; ?>
                </div>
            <?php unset($_SESSION['error']); endif ?>

            <?php if($bLogin == false) : ?>
            <form action="" method="POST" class="webform">
                <div class="form-login">
                    <h4>Welcome back!</h4>
                    <input type="text" id="userName" class="form-control input-sm chat-input" name="email" placeholder="email"/></br>
                    <input type="password" id="userPassword" class="form-control input-sm chat-input" name="password" placeholder="password"/></br>
                    <div class="wrapper">
                            <span class="group-btn">
                                <input type="submit" class="btn btn-primary btn-md" value="Login" name="action"/>
                            </span>
                    </div>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>
