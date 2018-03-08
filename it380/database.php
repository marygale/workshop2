<?php
include_once('config.php');
class database{

    private $con = '';
    public function __construct()
    {
        try{
            $this->con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_LOCAL_INFILE => true));
            $this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }catch (PDOException $e){
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function check_table_exist()
    {
        $exist = false;
        try{
            $sql = "SELECT * FROM songs LIMIT 1";
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $exist = true;
            }
        } catch (Exception $e) {
            if($e->getCode() == "42S02"){
                $exist =  false;
            }
        }
        return $exist;
    }

    public function load_data($file)
    {
        $sql = file_get_contents($file);
        return $this->con->exec($sql);
    }
}