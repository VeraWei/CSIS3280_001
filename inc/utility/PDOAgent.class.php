<?php

class PDOAgent  {

    //Connection Details
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $dbname = DB_NAME;
    private $port = DB_PORT;

    private $dsn;
    private $className;
    private $error;
    private $stmt;
    private $pdo;

    // make the connection
    public function __construct(string $className){
        $this->className = $className;

        $this->dsn  = 'mysql:host=' . $this->host;
        $this->dsn .= ';dbname=' . $this->dbname;
        $this->dsn .= ';port=' . $this->port;

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try{
            $this->pdo = new PDO($this->dsn, $this->user, $this->password, $options);
        }
        catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }

    }
    

    //Prepare the statement for execution
    public function query(string $query)    {
        $this->stmt  = $this->pdo->prepare($query);
    }

    //Bind the values, select the appropriate type
    public function bind($param, $value, $type = null){  
        if (is_null($type)) {  

            switch (true) {  
                case is_int($value):  
                $type = PDO::PARAM_INT;  
                break;  
                case is_bool($value):  
                $type = PDO::PARAM_BOOL;  
                break;  
                case is_null($value):  
                $type = PDO::PARAM_NULL;  
                break;  
                default:  
                $type = PDO::PARAM_STR;  
                }  
        }  
        $this->stmt->bindValue($param, $value, $type);  
    }  

    //Execute the statement
    public function execute($data = null)   {
        if (is_null($data)) {
            return $this->stmt->execute();
        } else {
            return $this->stmt->execute($data);
        }
    }

    //Return a single result
    public function singleResult()  {
        
        //Set the fetch mode
        $this->stmt->setFetchMode(PDO::FETCH_CLASS, $this->className);
        //Return the result
        return $this->stmt->fetch(PDO::FETCH_CLASS);
    }

    //Return multiple results
    public function getResultSet()  {

        return $this->stmt->fetchAll(PDO::FETCH_CLASS, $this->className);
    }

    public function rowCount() : int {
        return $this->stmt->rowCount();
    }

    public function lastInsertedId() : int {
        return $this->pdo->lastInsertedId();
    }
    
}

?>