<?php
class Database{
    private $host = 'localhost';  
    private $dbname = 'agrify';  
    private $username = 'root';  
    private $password = '';  

    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_EXCEPTION => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->dbh = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query($sql){
        $this->stmt= $this->dbh->prepare($sql);
    }

    public function bind($params, $value, $type, $null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type == PDO::PARAM_TRUE;
                    break;
                case is_bool($value):
                    $type == PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type == PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($params, $value, $type);
    }

    public function execute(){
        return $this->stmt->execute();
    }

    public function resutlSet(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }
}
?>