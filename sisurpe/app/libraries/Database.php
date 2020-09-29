<?php
/**
 * PDO Database Class
 * Connect to database
 * Create prepared statemants
 * Bind values
 * Retun rows and results
 */

 class Database { 
    protected $host = DB_HOST;
    protected $user = DB_USER;
    protected $pass = DB_PASS;
    protected $dbname = DB_NAME;
    protected $options;

    //toda vez que preparamos um a sql vamos usar o dbh
    protected $dbh;
    protected $stmt;
    protected $error; 
    protected $dsn;  

    public function __construct() {
        
        // Set DSN DATABASE SERVER NAME       
        $this->$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;             
        $options = array(
            // persistent connections increase performance checking the connection to the database
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
    
        // Ceate PDO instance
        try{
            $this->dbh = new PDO($this->$dsn, $this->user, $this->pass, $options);
            $this->dbh->exec('SET NAMES "utf8"'); 
        } catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Prepare statement with query
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    //Bind values
     public function bind($param, $value, $type = null) {
        if(is_null($type)){
            switch(true){
                case is_int($value);
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value);
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value);
                    $type = PDO::PARAM_NULL;
                    break;
                default;
                    $type = PDO::PARAM_STR;                                 
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    //Execute the prepared statemant
    public function execute(){
        return $this->stmt->execute();
    }

    //Get result set as array of objects $dados->nome
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    
    public function resultSetArray(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    //Get a single record as object $dados->nome
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get row count
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}