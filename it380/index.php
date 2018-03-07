<?php
/**
 * Created by PhpStorm.
 * User: Gale
 * Date: 3/7/2018
 * Time: 11:07 AM
 */
include_once('config.php');

//Check if database in not empty
try{
    $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_LOCAL_INFILE => true));
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}catch (PDOException $e){
    echo 'Connection failed: ' . $e->getMessage();
}
$msg = "";

try{
    $query = "SELECT * FROM songs LIMIT 1";
    $stmt = $con->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        header("Location: home.php");
    }else{
        echo 'Running Migration';
        loadData();
    }
} catch (Exception $e) {
    //run mysql script to migrate data
    //echo $e->getMessage() .'</br> Creating table please wait';
    if($e->getCode() == "42S02"){
        loadData();
    }

}

function loadData(){
    $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_LOCAL_INFILE => true));
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //create song table
    $song_table = file_get_contents('script/create_song_table.sql');
    $song = $con->exec($song_table);
    if(count($song) > 0){
        $msg = 'Song table successfully created </br>';
    }
    $jam_table  = file_get_contents('script/create_jam_rule_table.sql');
    $jam = $con->exec($jam_table);
    if($jam){
        $msg .= 'jam_rule2 table successfully created </br>';
    }
    $song_data = file_get_contents('script/migrate_song_data.sql');
    $run_song = $con->exec($song_data);
    $jam_data = file_get_contents('script/migrate_jam_rule_data.sql');
    $run_jam = $con->exec($jam_data);
    if($run_song && $run_jam){
        $msg .= 'Data Migrated successfully </br>';
        header("Location: home.php");
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Association Rule - Home</title>

</head>
<body>

<div class="container">
    <div style="margin-top:80px;"></div>
    <div class="load-wrapp">
        <div class="load-10">
            <p>Creating and migrating data this may take awhile please wait ...<br/><?php echo $msg;?></p>
            <div class="bar"></div>
        </div>
    </div>

</div>

<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<script>

</script>
</body>
</html>


