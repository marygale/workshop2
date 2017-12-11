<?php
$bCorrect = false;
session_start();
$msg = '';
$iGuess = isset($_GET['guess']) ? $_GET['guess'] : '';	
if (!isset($_GET["guess"])) {
	$_SESSION['num'] = $iNumber = rand(1, 5);
    $_SESSION['count'] = 3;
}else{
	$bCorrect = false;
	//$iGuess = isset($_GET['guess']) ? $_GET['guess'] : '';	
    if(empty($iGuess)) {
        $msg = "Missing guess parameter";
    }elseif(!is_numeric($iGuess)){
        $msg = "Your guess is not a number";
    }elseif($iGuess < $_SESSION['num']){
        $msg = "Your guess is too low";
    }elseif($iGuess > $_SESSION['num']){
        $msg = "Your guess is too high";
    }elseif($iGuess == $_SESSION['num']){
        $bCorrect = true;
        $msg = "Congratulations - You are right";
    }
    if(!$bCorrect){
        $_SESSION['count'] -= 1;
    }
}



?>

<!DOCTYPE html>
<html>
<head>
<title>Mary Gale Jabagat</title>
<style>
body {

margin:50px 0; 
padding:0;
text-align:center;
}
.waiting{
display: none;
}
.response{
margin: 25px auto;
width: 25%;
padding: 10px;
word-wrap: break-word;
}

</style>
</head>
<body>

<h3>Guessing Game</h3>
<p>Guess a number from 1 to 5</p>
<form action="guess.php" method="GET" class="webform">
   
<div class="response" <?php if($bCorrect) : ?> style="border: 3px solid green" 
<?php elseif($_SESSION['count'] < 3 && $bCorrect == false) : ?> style="border: 3px solid red"<?php endif ;?> >
<?php echo $msg; ?>
</div>
<?php if($_SESSION['count'] > 0) :?>
<input type="text" name="guess" value="">
<input type="submit" id="submit-btn" value="Guess">
<?php else :?>
<p><a href="guess.php"> GUESS AGAIN ?</a></p>
<?php endif ;?>
</form>


