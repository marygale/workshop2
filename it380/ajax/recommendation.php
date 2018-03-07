<?php
include_once('../config.php');

try{
    $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}catch (PDOException $e){
    echo 'Connection failed: ' . $e->getMessage();
}

$id = isset($_GET['song_id']) ? $_GET['song_id'] : '';
$query = "SELECT * FROM jam_rule2 WHERE lhs LIKE :search ORDER BY confidence LIMIT 10;";//SELECT * FROM jam_rule2 ORDER BY confidence, `desc` LIMIT 10
$stmt = $con->prepare($query);
$stmt->bindValue(':search', '%' . $id . '%');
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $jam_result = $stmt->fetchAll();
    //echo json_encode($jam_result);
}

if ($stmt->rowCount() < 10) {
    $filler = 10 - ($stmt->rowCount());
    $query = "SELECT * FROM jam_rule2 ORDER BY support LIMIT ".$filler;
    $stmt = $con->prepare($query);
    $stmt->execute();
    $top_songs = $stmt->fetchAll();
    $jam_result = array_merge($jam_result, $top_songs);
}
$result = [];
foreach ($jam_result as $row){
    $stmt = $con->prepare("SELECT * FROM songs WHERE song_id = :rhs");
    $stmt->bindValue(':rhs', $row['rhs']);
    $stmt->execute();
    foreach($stmt->fetchAll() as $r){
        $row['song_name'] = $r['artist'] . ' - ' . $r['title'];
    }
    array_push($result, $row);
}
echo json_encode($result);
