<?php

class Database{
    private $host   = DB_HOST;
    private $user   = DB_USER;
    private $pass   = DB_PASS;
    private $dbName = DB_NAME;

    private $dbh;
    private $error;
    private $statement;


    public function __construct(){
        $dsn = 'mysql:host='. $this->host . ';dbName=' . $this->dbName;

        $options = array(
            PDO::ATTR_PERSISTENT =>TRUE,
            PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
        );

        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    public function query($query){
        $this->statement = $this->dbh->prepare($query);
    }
    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int ($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool ($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null ($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }
        $this->statement->bindValue($param, $value, $type);
    }

    public function execute(){
        return $this->statement->execute();
    }

    public function resultSet(){
        $this->execute();
        return $this->statement->fetchALL(PDO::FETCH_OBJ);
    }

    public function single(){
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }
    
}


?>