<?php

include_once('config.php');
echo "DELETE FROM AUTOS TABLE";

try {
    //$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    // set the PDO error mode to exception
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE * FROM autos";
    // use exec() because no results are returned
    //$conn->exec($sql);
    //echo "Record deleted successfully";

    $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql = "DELETE * FROM autos";
    $query = $con->prepare( $sql );
    $query->execute();
    echo "Record deleted successfully";


}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;