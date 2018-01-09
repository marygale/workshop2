<?php
//set off all error for security purposes
error_reporting(E_ALL);

//define some constant local development configuration
/*define( "DB_DSN", "mysql:host=localhost;port=3306;dbname=misc" );
define( "DB_HOST", "localhost" );
define( "DB_USERNAME", "gale" );
define( "DB_PASSWORD", "_Ripe1234" );
define( "DB_TABLE", "misc" );*/

define( "DB_DSN", "mysql:host=ec2-23-21-246-25.compute-1.amazonaws.com;port=5432;dbname=d6pfqph9c5dtm3" );
/*define( "DB_DSN", "mysql:host=localhost;dbname=misc" );*/
define( "DB_HOST", "ec2-23-21-246-25.compute-1.amazonaws.com" );
define( "DB_USERNAME", "vrkubbilkqvggv" );
define( "DB_PASSWORD", "35150b836bb1988331211b64fedcda4bd3444d81d65e1dc076bc1effb9b1124a" );
define( "DB_TABLE", "autos" );
