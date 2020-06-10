<?php

class IncomeCDQObject {
 
    // database connection and table name
    private $conn;
    private $table_name = "incomecdq";

    public function __construct(){

        global $db;

        $this->conn = $db;

    }

    // create blog
    public function create(){
        $query = "INSERT INTO " . $this->table_name . " (created, author, title, contents, publish) VALUES ('" . $this->created . "', '" . $this->author . "','" . $this->title . "','" . $this->contents . "','" . $this->publish . "') ";

        if($this->conn->execute($query)){
            return true;
        }else{
            return false;
        }
    }

    public function insert_income($data){
		$exam_val = "";
		if($data['exam_val']==2){
			$exam_val = "Feb. 1. ".$data['exam_year'];
		}
		if($data['exam_val']==6){
			$exam_val = "June. 1. ".$data['exam_year'];
		}
		$query_income = "INSERT INTO " . $this->table_name . " (exam_date, amount, due_date, late_due_date, late_fee_amount, retake1_due_date, retake1_amount, retake2_due_date, retake2_amount, user_id, exam) VALUES ('". date('Y-m-d') ."', '". $data['main_amount'] . "', '". date('Y-m-d') ."', '". date('Y-m-d') ."', '". $data['late_amount'] ."', '". date('Y-m-d') ."', '". $data['retake1_amount'] ."', '". date('Y-m-d') ."', '". $data['retake2_amount'] ."', '". $_SESSION['user_id'] ."', '". $exam_val ."') ";
        if($this->conn->execute($query_income)){
            return true;
        }else{
            return false;
        }
    }

    // get rows count
    public function countAll(){
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->getCount( $query );

        return $stmt;
    }

    public function readPaging($from_record_num, $records_per_page){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created ASC LIMIT {$from_record_num}, {$records_per_page}";
//    		print "query:$query<br>\n";
        $stmt = $this->conn->getData( $query );

        return $stmt;
    }

    // read all datas
    public function readAll(){
        $query = "SELECT * FROM " . $this->table_name;
        //print "query:$query<br>\n";
        $stmt = $this->conn->getData( $query );

        return $stmt;
    }

    // read datas with where
    public function readWithWhere($where){
        $query = "SELECT * FROM " . $this->table_name . " WHERE " . $where;
        $stmt = $this->conn->getData( $query );

        return $stmt;
    }

    // read data by id
    public function readById($id) {
		
        if ( $id!="" ) $this->id=$id;
		
		$query = "SELECT * FROM " . $this->table_name . " where id = (select max(id) from " . $this->table_name ." WHERE user_id=". $this->id .") AND user_id=". $this->id;
		
		if(empty($this->conn->getData( $query )) == false){
			
			$stmt = $this->conn->getData( $query );
			
			return $stmt[0];
			
		}
		
    }


    public function update(){
        $query = "UPDATE " . $this->table_name . " SET created = '" . ($this->created) . "', author = '" . ($this->author) . "', title = '" . ($this->title) . "', contents = '" . ($this->contents) . "', publish = '" . ($this->publish) . "' WHERE id = " . $this->id;

        if($this->conn->execute($query)){
            return true;
        }else{
            return false;
        }
    }

}
?>