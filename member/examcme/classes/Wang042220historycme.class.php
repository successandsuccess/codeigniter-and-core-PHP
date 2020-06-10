<?php
class PaymentHistoryCME
{

    // database connection and table name
    private $conn;
    private $table_name = "tbl_cmehistory";
    private $table_payment = "tbl_payment";
    private $table_user = "users";
    private $table_cme = "incomecme";
	private $table_action = "action_history_cme";
	private $table_history = "action_history";
	private $table_temp = "temp_stats";
    public function __construct()
    {
        global $db;

        $this->conn = $db;

    }

    // create blog
    public function create($detail)
    {
        $query = "INSERT INTO " . $this->table_name . " (payment_id, user_id, incomecdq_id, created_at) VALUES ('" . $detail['payment_id'] ."','". $detail['user_id'] . "','".$detail['incomecdq_id'] . "','". date("Y-m-d H:i:s") ."') ";

        if ($this->conn->execute($query)) {
            return true;
        } else {
            return false;
        }
    }

    // get rows count
    public function countAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->getCount($query);

        return $stmt;
    }

    public function readPaging($from_record_num, $records_per_page)
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created ASC LIMIT {$from_record_num}, {$records_per_page}";
//    		print "query:$query<br>\n";
        $stmt = $this->conn->getData($query);

        return $stmt;
    }

    // read all datas
    public function readAll()
    {
        $query = "SELECT p.*, cd.exam, u.* FROM " . $this->table_name . " ch 
        INNER JOIN " . $this->table_payment ." p ON ch.payment_id=p.id 
        INNER JOIN ". $this->table_cme ." cd ON ch.incomecme_id=cd.id
        INNER JOIN ". $this->table_user ." u ON ch.user_id=u.id ORDER BY ch.id DESC";
        
		$stmt = $this->conn->getData($query);
 
        return $stmt;
    }

    // read datas with where
    public function readWithWhere($where)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE " . $where;
        $stmt = $this->conn->getData($query);

        return $stmt;
    }

    public function readById($id)
    {
        if ($id != "") $this->id = $id;

        $query = "SELECT " . $this->table_payment . ".*, ".$this->table_user.".full_name FROM " . $this->table_payment . " INNER JOIN " . $this->table_user ." ON ".$this->table_payment.".user_id=".$this->table_user.".id WHERE ".$this->table_payment.".id=". $id;
        $stmt = $this->conn->getData($query);

        return $stmt[0];
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET created = '" . ($this->created) . "', author = '" . ($this->author) . "', title = '" . ($this->title) . "', contents = '" . ($this->contents) . "', publish = '" . ($this->publish) . "' WHERE id = " . $this->id;

        if ($this->conn->execute($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function PaymentError(){
        return "
            <script type=\"text/javascript\">
            $(document).ready(function() {
                $('#paymentContentModal_cme').modal('show');
             });
            </script>
        ";
    }

    public function PaymentSuccess(){

        return "
            <script type=\"text/javascript\">
            $(document).ready(function() {
                $('#receiptmodal_body_cme').css({'display':'block'});
                $('#receiptContentModal_cme').modal('show');
             });
            </script>
        ";
    }
	
	//read all data of action_history
    public function readAllAction($id)
    {
		
        $query = "SELECT * FROM " . $this->table_action . " WHERE user_id = " . $id . " ORDER BY id DESC";
		
        $stmt = $this->conn->getData($query);
		
        return $stmt;
 
    }
	
	// split full name into first name and last name 
	public function split_name($name) {
		
		$name = trim($name);
		
		$last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
		
		$first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
		
		return array($first_name, $last_name);
	}	
	
	//read action-content array. This is indexof for action_num.
    public function readActionContent($id)
    {
		
        $content = array(
		
	        //amdin 4
			" ", //*********************************************0

			"CME Payment Received Receipt", //******************1 e.g. 5/15/20
			
			"CME Late Payment Received Receipt", //*************2  e.g.(late fee)6/17/20
			
			
		);
        $stmt = $content[$id];

        return $stmt;
 
    }
	
	//read action_amount
    public function readActionAmount($id)
    {
        $content = array(
		    "",
			"235.00", //1
			"735.00" //2
		);
		
		$stmt = $content[$id];
		
		return $stmt;
    }
	
	//return action_amount_key
    public function returnAmountKey($data)
    {
		
        $content = array(
		    "",
			"235.00", //1
			"735.00" //2
		);
		
		$key = array_search($data, $content);
		
        $stmt = $key;

        return $stmt;
 
    }

	//create title from action_history
    public function pay_title($id){
		
		$n_date = getdate(date("U"));

		//make time for 6/1/year
		$mkJune1 = mktime(0,0,0,6,1,$n_date['year']);
		
		//make time for 8/1/year
		$mkAug1 = mktime(0,0,0,8,1,$n_date['year']);
		
		$pay_cycle = $this->readCMECycle();
		
		$make_sure_cycle = $n_date['year'] - $pay_cycle;
		
        $query = "SELECT * FROM " . $this->table_action . " WHERE user_id = " . $id . " AND cme_cycle_start = ". $pay_cycle ." ORDER BY id DESC";
		
        $stmt = $this->conn->getData($query);
		
		if(empty($stmt) == true){
			
			if($make_sure_cycle == 2){
				
				if($n_date[0] < $mkJune1){
					
					$cme_title = "CME Payment";
					
				}else if(($n_date[0] > $mkJune1) && ($n_date[0] < $mkAug1)){
					
					$cme_title = "CME Late Payment";
					
				}else{
					

					$cme_title = "Certificate is Pending";
					
				}
				
			}else{
				
				$cme_title = "CME Payment";
					
			}
			
			
		}else if(empty($stmt) == false){
			
			$cme_title = "<font style='color:red;'>You have already paid for (". $pay_cycle . "-" . ($pay_cycle + 2) .") cycle.</font>";
			
		}
        
		return $cme_title;
    }
	
	//insert action_history
    public function insert_CMEActionHistory($data)
	{
		//getdate
		$n_date = getdate(date("U"));
		
		//defalt
		$action_num = 3;

		//main_payment
        if($data['pay_num'] == 1)
		{
				$cme_cycle_start = $n_date;
		}
		
		//Late payment
        if($data['pay_num'] == 2)
		{
				$cme_cycle_start = $n_date - 2;
		}
        
		//first_name and last_name 
		$first_name = $this->split_name($data['cme_name'])[0];

		$last_name = $this->split_name($data['cme_name'])[1];				$final_card_num = substr($data['number'], -4);		
		$query_cme_paid = "SELECT * FROM " . $this->table_action . " WHERE user_id='". $_SESSION['user_id'] ."' AND action_num='". $action_num ."' AND amount_num='". $data['pay_num'] ."' AND cme_cycle_start='". $data['cme_year'] ."' AND receipt_title='". $data['action_title'] ."'";		$check_cme_paid = $this->conn->getCount($query_cme_paid);				if($check_cme_paid > 0){						return false;					}else{						$query_action = "INSERT INTO " . $this->table_action . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, cme_cycle_start, issues_text, receipt_title) VALUES ('". $_SESSION['user_id'] ."', '". $first_name ."', '". $last_name ."', '". $final_card_num ."', '". $n_date[0] ."', '". $action_num ."', '". $data['pay_num'] ."', '". $data['cme_year'] ."', '', '". $data['action_title'] ."') ";			//save history			$query_history = "INSERT INTO " . $this->table_history . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title, cme_cycle_start, exam_type) VALUES ('". $_SESSION['user_id'] ."', '". $first_name ."', '". $last_name ."', '". $final_card_num ."', '". $n_date[0] ."', '". $action_num ."', '". $data['pay_num'] ."', '6', '', '', '". $data['action_title'] ."', '', '". $data['cme_year'] ."', 'CME') ";		    			$query_temp  = "UPDATE " . $this->table_temp . " SET cme_due = '". ($data['cme_year'] + 4) ."-06-01' WHERE user_id = " . $_SESSION['user_id'];			$this->conn->execute($query_history);									$this->conn->execute($query_temp);						if($this->conn->execute($query_action)){								return true;							}else{								return false;							}					}
    }
	
    public function readAllReceipt($data)
	{
		
		$query = "SELECT * FROM " . $this->table_action . " where id = (select max(id) from " . $this->table_action ." WHERE user_id=". $data .") AND user_id=". $data;
		
		if(empty($this->conn->getData( $query )) == false){
			
			$stmt = $this->conn->getData( $query );
			
			return $stmt[0];
			
		}
		
	}

    public function readByReceiptId($data)
	{
		
		$query = "SELECT * FROM " . $this->table_action . " where id = ". $data;
		
		if(empty($this->conn->getData( $query )) == false){
			
			$stmt = $this->conn->getData( $query );
			
			return $stmt[0];
			
		}
		
	}
	
    public function readReceiptHistory($data)
	{
		
		$query = "SELECT * FROM " . $this->table_history . " where id = ". $data;
		
		if(empty($this->conn->getData( $query )) == false){
			
			$stmt = $this->conn->getData( $query );
			
			return $stmt[0];
			
		}
		
	}
	
	//get current CME cycle 
	public function readCMECycle(){

		global $userObject;				$cme_cycle_start = date('Y', strtotime($userObject->vitals["cme_due"]));				$cme_cycle_start = ($cme_cycle_start - 2);		return $cme_cycle_start;
		
	}

}

?>