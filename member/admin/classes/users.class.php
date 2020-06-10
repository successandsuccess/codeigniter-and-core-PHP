<?php

class UsersObject {
 
    private $conn;
	
    private $table_user = "users";
    // object properties
    public $id;
 
    public function __construct($db){
    	
    	// global $db;
        //$db = Database::getInstance();
        $this->conn = $db;
    }
 
    // read all users
    public function readAll(){
		
		$query = "SELECT `id`, `full_name`, `email`, `role` FROM ".$this->table_user." where `role`!='admin' ORDER BY id";

        // $usersLists = $this->conn->getDataArray( $query );
        $usersLists = $this->conn->getDataArrayEmail( $query );
        		
		if(empty($usersLists) == false){
            return $usersLists;		    
		}
    }

    // read users by ids
    public function readByIds($where){
        
        $query = "SELECT `id`, `full_name`, `email`, `role` FROM `".$this->table_user."` ".$where;
        $usersLists = $this->conn->getDataArray($query);
        
        if(empty($usersLists) == false){
            return $usersLists;
        }
    }

	
}
?>