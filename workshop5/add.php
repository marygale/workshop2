<?php
session_start();
include_once('config.php');
if ( ! isset($_SESSION['email']) ) {
    die('Not logged in');
}elseif (isset($_POST["action"])  && $_POST["action"]  == "Add"){
    $make = clean($_POST['make']);
    $year = clean($_POST['year']);
    $mileage = clean($_POST['mileage']);
    if(strlen($make) < 1) {
        $_SESSION['error'] = "Make is required";
    }elseif(empty($mileage) || empty($year)){
        $_SESSION['error'] = "Mileage and year must not be empty";
    }elseif((!is_numeric($mileage)) || (!is_numeric($year))){
        $_SESSION['error'] = "Mileage and year must be numeric";
    }else{
        try{
            $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $sql = "INSERT into autos (make,year,mileage) VALUES (:Smake, :Iyear, :Imileage)";
            $stmt = $con->prepare( $sql );
            $stmt->bindParam(':Smake', $make, PDO::PARAM_STR);
            $stmt->bindParam(':Iyear', $year, PDO::PARAM_INT);
            $stmt->bindParam(':Imileage', $mileage, PDO::PARAM_INT);
            $bSave = $stmt->execute() > 0 ? TRUE : FALSE;
            $_SESSION['success'] = "Record inserted";
            header("Location: view.php");
            return;
        }catch (PDOException $e) {
            print_r($stmt->errorInfo());
            print_r('<script>alert("Error '.$stmt->errorCode().' has occurred. Please contact support@gale.com and try again later.")</script>');
        }
    }
}

function clean($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlentities($data);
    return $data;
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

<div class="container box">
    <div class="row">
        <div class="col-sm-12">
            <h3>Tracking Autos for <?php echo $_SESSION['email'];?></h3>
            <?php if(isset($bSave) && $bSave == TRUE) : ?>
                <div class="response-sucess">
                    Record inserted
                </div>
            <?php endif;?>
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="response-error">
                    <?php echo $_SESSION['error']; ?>
                </div>
            <?php endif ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="webform">
                <div class="well">
                    <div class="form-group row">
                        <label for="make" class="col-sm-2 col-form-label col-form-label-sm">Make</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="make" name="make" placeholder="Make">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="year" class="col-sm-2 col-form-label col-form-label-sm">Year</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="year" name="year" placeholder="Year">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mileage" class="col-sm-2 col-form-label col-form-label-sm">Mileage</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="mileage" name="mileage" placeholder="Mileage">
                        </div>
                    </div>

                    <input type="submit" name="action" value="Add">
                </div>
            </form>

        </div>
    </div>
</div>
</body>

