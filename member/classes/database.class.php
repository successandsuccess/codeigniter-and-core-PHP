<?php





error_reporting( E_ALL );





/*





* Mysql database class - only one connection alowed





*/





class Database {





	private $_connection;





	private static $_instance; //The single instance





	private $_host = "localhost";





	private $_username = "demouser1nccaa";

	

	private $_password = "bMkJ03A77777";

	

    private $_database = "demotest1nccaa";

    

//     private $_username = "root";

	

// 	private $_password = "";

	

// 	private $_database = "nccaadbxyz123";











	/*





	Get an instance of the Database





	@return Instance





	*/





	public static function getInstance() {





		if(!self::$_instance) { // If no instance then make one





			self::$_instance = new self();





		}





		return self::$_instance;





	}











	// Constructor





	public function __construct() {





		global $con;





		$this->_connection = $con;





		//$this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);





	}











	// Magic method clone is empty to prevent duplication of connection





	private function __clone() { }











	// Get mysqli connection





	public function getConnection() {





		return $this->_connection;





	}





    public function getQuery($query)

    {        

        $result = $this->_connection->query($query);



        if ($result == false) {



            return false;



        } 



        return $result;



    }







	public function getData($query)

    {        

        $result = $this->_connection->query($query);





        if ($result == false) {





            return false;





        } 





        $rows = array();





        while ($row = $result->fetch_assoc()) {





            $rows[] = $row;





        }





        





        return $rows;





    }



    /* Get users tables Data */

    public function getDataArraySendingEmail($query){

        $result = $this->_connection->query($query);



        

        

        if($result == false){

            return false;

        }



        // return $result->sender_id; exit;



        $rows = array(); $ii = 0;

        while ($row = $result->fetch_array()) {

            // print_r($row['sender_id']); exit;

            $query_sender_email = "SELECT email,full_name FROM `users` WHERE `id` =".$row['sender_id'];

            $query_receiver_email = "SELECT email,full_name FROM `users` WHERE `id` =".$row['receiver_id'];

            $result_sender_email = $this->_connection->query($query_sender_email)->fetch_array();

            $result_receiver_email = $this->_connection->query($query_receiver_email)->fetch_array();

            // print_r($result_sender_email['email']); exit;

            array_push($rows, [ 

            $ii++, 

            $row['id'], 

            $result_sender_email['email'], 

            $result_receiver_email['email'], 

            $row['content'], 

            $row['subject'], 

            $row['regdate'], 

            $result_sender_email['full_name'],

            $result_receiver_email['full_name'],

            $row['attach'],

            $row['read'],

            $row['opendate'],

            $row['is_del'],

            $row['p_id'],

            $row['sender_id'],

            $row['receiver_id'],





             ]);

        }    

        return $rows;

    }





    /* Get users tables Data */

    public function getDataArray($query){

        $result = $this->_connection->query($query);

        

        if($result == false){

            return false;

        }



        $rows = array(); $ii = 0;

        while ($row = $result->fetch_array()) {

            array_push($rows, [ $ii++, $row['id'], $row['full_name'], $row['email'] ]);

        }    

        return $rows;

    }



    public function getDataArrayEmail($query){

        $result = $this->_connection->query($query);

        

        if($result == false){

            return false;

        }



        $rows = array(); $ii = 0;

        while ($row = $result->fetch_array()) {

            array_push($rows, [ $ii++, $row['id'], $row['full_name'], $row['email'], $row['role'] ]);

        }    

        return $rows;

    }

    

    /* Get group tables Data */

    public function getGroupDataArray($query){



        $result = $this->_connection->query($query);

        

        if($result == false){

            return false;

        }



        $rows = array(); $ii = 0;

		

        while ($row = $result->fetch_array()) {



            $edit_gp = "<a href='javascript:void(0)' title='Group Edit' gname='".$row['group_name']."' userdata='".$row['users_id']."' name='group_member$ii'><span class='glyphicon glyphicon-edit'></span></a>";



            $del_gp = '<a href="javascript:void(0)" title="Group Delete" class="delGroupID" gid="'.$row['id'].'"><span class="glyphicon glyphicon-trash"></span></a>';



            array_push($rows, [ $ii++, $row['id'], $row['group_name'], $edit_gp."|".$del_gp, $row['users_id'] ]);

        }    

		

        return $rows;

    }





    public function getCount($query)





    {        





        $result = $this->_connection->query($query);





        





        if ($result == false) {





            return false;





        } 





                





        $numRows = mysqli_num_rows($result);





            





        return $numRows;





    }





        





    public function execute($query) 





    {





        $result = $this->_connection->query($query);





        





        if ($result == false) {





            echo 'Error: cannot execute the command';





            return false;





        } else {





            return true;





        }        





    }



    public function delete_error($id, $table)

    {

        $query = "DELETE FROM $table WHERE error_id = $id";

        $result = $this->_connection->query($query);

        if ($result == false) {

            echo 'Error: cannot delete error_id ' . $id . ' from table ' . $table;

            return false;

        } else {

            return true;

        }

    }

    





    public function delete($id, $table) 





    { 





        $query = "DELETE FROM $table WHERE id = $id";





        





        $result = $this->_connection->query($query);





    





        if ($result == false) {





            echo 'Error: cannot delete id ' . $id . ' from table ' . $table;





            return false;





        } else {





            return true;





        }





    }





 





    public function escape_string($value)





    {





        return $this->_connection->real_escape_string($value);





	}





	





}





?>