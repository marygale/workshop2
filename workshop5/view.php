<?php
session_start();
include_once('config.php');
$results = getAutoList();
if ( ! isset($_SESSION['email']) ) {
    die('Not logged in');
}
if (isset($_POST["action"])  && $_POST["action"]  == "Add"){
    $make = clean($_POST['make']);
    $year = clean($_POST['year']);
    $mileage = clean($_POST['mileage']);
    if(strlen($make) < 1) {
        $error = "Make is required";
    }elseif(empty($mileage) || empty($year)){
        $error = "Mileage and year must not be empty";
    }elseif((!is_numeric($mileage)) || (!is_numeric($year))){
        $error = "Mileage and year must be numeric";
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
            $results = getAutoList();
        }catch (PDOException $e) {
            print_r($stmt->errorInfo());
            print_r('<script>alert("Error '.$stmt->errorCode().' has occurred. Please contact support@gale.com and try again later.")</script>');
        }
    }
}
function getAutoList(){

    $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "Select * FROM autos";
    $query = $con->prepare( $sql );
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
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
            <?php if(isset($_SESSION['success'])) : ?>
                <div class="response-sucess">
                    Record inserted
                </div>
            <?php unset($_SESSION['success']); endif;?>
            <?php if(count($results) > 0): ?>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Make </th>
                        <th>Year</th>
                        <th>Mileage</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($results as $row){
                        echo "<tr>";
                        echo "<td>". ucwords($row['make']) ."</td>";
                        echo "<td>". $row['year'] ."</td>";
                        echo "<td>". $row['mileage'] ."</td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            <?php endif;?>
            <div class="menu"> <a href="add.php">Add New</a> | <a href="logout.php">Logout</a></div>

        </div>
    </div>
</div>
</body>

