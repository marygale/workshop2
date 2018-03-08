<?php
//set off all error for security purposes
error_reporting(E_ALL);
define( "DB_DSN", "mysql:host=localhost;port=3306;dbname=test" );
define( "DB_HOST", "localhost" );
define( "DB_USERNAME", "gale" );
define( "DB_PASSWORD", "_Ripe1234" );
define( "DB_TABLE", "test" );

try{
    $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_LOCAL_INFILE => true));
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}catch (PDOException $e){
    echo 'Connection failed: ' . $e->getMessage();
}