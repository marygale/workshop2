<?php

$bCorrect = false;
if (!isset($_GET["guess"])) {
	$msg = "Guess a number from 1 to 5";
}else{
	$iNumber = rand(1, 5);
if($_GET['guess'] > $iNumber){
	$msg = "The number you entered is greater than the guess number";
}elseif($_GET['guess'] < $iNumber){
	$msg = "The number you entered is less than the guess number";
}elseif($_GET['guess'] == $iNumber){
	$bCorrect = true;
	$msg = "Your guess is correct : ". $iNumber;
}else{
	$msg = "The guess number is : ". $iNumber . "<br/> Your guess is : " . $_GET['guess'];
	}
}



?>

<!DOCTYPE html>
<html>
<head>
<title>Guessing Game</title>
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
border: 3px solid red;
padding: 10px;
word-wrap: break-word;
}

</style>
</head>
<body>

<h3>Guessing Game</h3>
<form action="guess.php" method="GET" class="webform">
<?php if (isset($iNumber)) : ?>
<div class="response" <?php if($bCorrect) : ?> style="border: 3px solid green" <?php endif ;?> > 
<?php echo $msg; ?>
</div>
<?php else : ?>
<h4><?php echo $msg; ?></h4>
<?php endif;?> 
<input type="text" name="guess" value="">
<input type="submit" id="submit-btn" value="Guess">
</form>


