<?php
class Core {
    private $conn = null;
    // private $stmt = null;

    public function __construct($DATABASE_HOST = "localhost", $DATABASE_USER = "root", $DATABASE_PASSWORD = "", $DATABASE_NAME = "exampledb") {
        try {
            $this->conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASSWORD, $DATABASE_NAME);

            if (mysqli_connect_errno()) {
                throw New Exception("Failed to connect to MySQL: " . mysqli_connect_error());
            }
        }

        catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function __destruct() {
        if ($this->conn) { $this->conn->close(); }
    }

    private function execute_statement($query, $params=null) {
        try {
            $stmt = $this->conn->prepare($query);

            if(!$stmt) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }

            $stmt->execute($params);
            return $stmt;
        }
        
        catch (Exception $e) {
            echo "Message : " . $e->getMessage();
        }
    }

    public function get_result($query, $params=null) {
        try {
            $stmt = $this->execute_statement($query, $params);
            $results = $stmt->get_result();
            $stmt->close();
            
            if (!$results) {
                throw New Exception("No results for: " . $params);
            }

            return $results;
        } 
        
        catch (Exception $e) {
            echo "Message : " . $e->getMessage();
        }
    }
}
?>

// public function Insert($query = "" , $params = []){
    //     try {
    //         $this->stmt = $this->executeStatement( $query , $params );
    //         return $this->connection->insert_id;
		
    //     }catch(Exception $e){
    //         throw New Exception( $e->getMessage() );
    //     }
	
    //     return false;
    // }

    // function fetchAll($query, $params=null) {
    //     $this->execute_statement($query, $params);
    //     return $this->stmt->fetchAll();
    // }
class DatabaseClass{	
	
    private $connection = null;

    // this function is called everytime this class is instantiated		
    public function __construct( $dbhost = "localhost", $dbname = "myDataBaseName", $username = "root", $password    = ""){

        try{
	
            $this->connection = new mysqli($dbhost, $username, $password, $dbname);
		
            if( mysqli_connect_errno() ){
                throw new Exception("Could not connect to database.");   
            }
		
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }			
	
    }

    // Insert a row/s in a Database Table
    public function Insert( $query = "" , $params = [] ){
	
        try{
		
        $stmt = $this->executeStatement( $query , $params );
            $stmt->close();
		
            return $this->connection->insert_id;
		
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
	
        return false;
	
    }

    // Select a row/s in a Database Table
    public function Select( $query = "" , $params = [] ){
	
        try{
		
            $stmt = $this->executeStatement( $query , $params );
		
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);				
            $stmt->close();
		
            return $result;
		
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
	
        return false;
    }

    // Update a row/s in a Database Table
    public function Update( $query = "" , $params = [] ){
        try{
		
            $this->executeStatement( $query , $params )->close();
		
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
	
        return false;
    }		

    // Remove a row/s in a Database Table
    public function Remove( $query = "" , $params = [] ){
        try{
		
            $this->executeStatement( $query , $params )->close();
		
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
	
        return false;
    }		

    // execute statement
    private function executeStatement( $query = "" , $params = [] ){
	
        try{
		
            $stmt = $this->connection->prepare( $query );
		
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
		
            if( $params ){
                call_user_func_array(array($stmt, 'bind_param'), $params );				
            }
		
            $stmt->execute();
		
            return $stmt;
		
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
	
    }
		
}