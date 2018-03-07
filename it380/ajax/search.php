<?php
include_once('../config.php');

try{
    $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
    echo 'Connection failed: ' . $e->getMessage();
}

$artist = isset($_GET['artist']) ? $_GET['artist'] : '';
$query = "SELECT * FROM songs WHERE artist LIKE :search OR title LIKE :search LIMIT 10";
$stmt = $con->prepare($query);
$stmt->bindValue(':search', '%' . $artist . '%');
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $result = $stmt->fetchAll();
    echo json_encode($result);
}

