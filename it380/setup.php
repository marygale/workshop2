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
        echo loadData();
    }
} catch (Exception $e) {
    //run mysql script to migrate data
    //echo $e->getMessage() .'</br> Creating table please wait';
    if($e->getCode() == "42S02"){
        echo loadData();
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
    return $msg;
}
?>
