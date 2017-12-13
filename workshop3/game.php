<?php
session_start();
$sResult = '';
if (!isset($_SESSION['username'])) {
    die("Name parameter missing");
}else{
    /**User is still login process code here **/
    if (isset($_POST["action"])  && $_POST["action"]  == "Play") {
        $human = $_POST['choice'];
        $choices = ['Rock', 'Paper', 'Scissors'];
        $computer = $choices[array_rand($choices)];
        $result = check($computer, $human);
        /*var_dump($computer);
        $sResult = check($computer, $human);*/
        /*for($c=0;$c<3;$c++) {
            for($h=0;$h<3;$h++) {
                $r = check($c, $h);
                $sResult .= "Human=$choices[$h] Computer=$choices[$c] Result=$r\n";
            }
        }*/
        $sResult .= "Human = $human Computer=$computer Result=$result\n";
    }

}
function check($computer, $human){
    if($computer == $human) {
        return 'Tie!';
    }else if($human === "Rock"){
            if($computer === "Scissors") {
                return 'You Win';
            } else {
                return 'You Lose';
            }
        }
        else if($human === "Paper") {
            if($computer === "Rock") {
                return 'You wins';
            }else {
                if($computer === "Scissors") {
                    return 'You Lose';
                }
            }
        }
        else if($human === "Scissors") {
            if($computer === "Rock") {
                return 'You Lose';
            } else {
                if($computer === "Paper") {
                    return 'You wins';
                }
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

<h3>Rock Paper Scissors</h3>
<div id="games" class="container">
    <div class="row">
        <form action="" method="POST" class="webform">
            <div class="col-sm-12">
                <div class="dropdown">
                    <select name="choice">
                        <option value="Rock">Rock</option>
                        <option value="Paper">Paper</option>
                        <option value="Scissors">Scissors</option>
                    </select>
                    <input type="submit" class="btn btn-primary btn-xs" value="Play" name="action" />
                    <a href="login.php?action=logout" class="btn btn-primary btn-xs">Logout</a>
                 <!-- <button type="button" class="btn btn-primary btn-xs" name="action">Play</button>
                    <button type="button" class="btn btn-primary btn-xs">Logout</button>-->

                </div>
                <div class="well">
                    <?php if (isset($sResult)) {
                         echo $sResult;
                    } ?>
                </div>
            </div>
        </form>
    </div>
</div>


