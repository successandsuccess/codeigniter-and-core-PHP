<?php
class PaymentHistoryCertification
{

    // database connection and table name
    private $conn;
    private $table_name = "tbl_certificationhistory";
    private $table_payment = "tbl_payment";
    private $table_user = "users";
    private $table_certification = "incomecertification";
	private $table_action = "action_history_certification";
	private $table_history = "action_history";
	private $table_class = "tbl_class";
	private $table_dates = "tbl_expected_dates";	    public function __construct()
    {
        global $db;

        $this->conn = $db;

    }

    // create blog
    public function create($detail)
    {
        $query = "INSERT INTO " . $this->table_name . " (payment_id, user_id, incomecertification_id, created_at) VALUES ('" . $detail['payment_id'] ."','". $detail['user_id'] . "','".$detail['incomecertification_id'] . "','". date("Y-m-d H:i:s") ."') ";

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
        INNER JOIN ". $this->table_certification ." cd ON ch.incomecertification_id=cd.id
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
                $('#paymentContentModal_certification').modal('show');
             });
            </script>
        ";
    }

    public function PaymentSuccess(){

        return "
            <script type=\"text/javascript\">
            $(document).ready(function() {
                $('#receiptmodal_body_certification').css({'display':'block'});
                $('#receiptContentModal_certification').modal('show');
             });
            </script>
        ";
    }
	
	//read all data 
    public function readAllAction($id)
    {
		
        $query = "SELECT * FROM " . $this->table_action . " WHERE user_id = " . $id . " ORDER BY id DESC";
		
        $stmt = $this->conn->getData($query);
		
        return $stmt;
 
    }
	
	//read all data of action_history
    public function readAllHistory($id)
    {
		
        $query = "SELECT * FROM " . $this->table_history . " WHERE user_id = " . $id . " ORDER BY id DESC";
		
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
		
	        //amdin 13
			" ", //******************************0
			
			"Results: Passed ", //*************************1
			
			"Waiting for Certification Exam Results ", //**2
			
			"Results: Failed ", //*************************3
			
			"Failed to Register (5 Exams Remaining) ", //***4
			
			"Failed to Show (5 Exams Remaining) ", //*******5
			
			"Failed to Register (4 Exams Remaining) ", //***6
			
			"Failed to Show (4 Exams Remaining) ", //*******7
			
			"Failed to Register (3 Exams Remaining) ", //***8
			
			"Failed to Show (3 Exams Remaining) ", //*******9
			
			"Failed to Register (2 Exams Remaining) ", //***10
			
			"Failed to Show (2 Exams Remaining) ", //*******11
			
			"Failed to Register (1 Exams Remaining) ", //***12
			
			"Failed to Show (1 Exams Remaining) ", //*******13
			

		   //member 11
			"Registered Feb. ", //************************14
			
			"Registered Feb. ", //************************15(late fee)
			
			"Registered June. ", //***********************16
			
			"Registered June. ", //***********************17(late fee)
			
			"Registered Oct. ", //************************18
			
			"Registered Oct. ", //************************19(late fee)
			
			"Retake #1 ", //**************************20
			
			"Retake #2 ", //**************************21
			
			"Retake #3 ", //**************************22
			
			"Retake #4 ", //**************************23
			
			"Retake #5 " //***************************24
		);
        $stmt = $content[$id];

        return $stmt;
 
    }
	
	//read action_mon
    public function readActionExamMon($id)
    {
		
		if($id == 2){$exam_mon = "Feb";}
		
		if($id == 6){$exam_mon = "June";}
		
		if($id == 10){$exam_mon = "Oct";}
        
        $stmt = $exam_mon;

        return $stmt;
 
    }
	
	//read action_amount
    public function readActionAmount($id)
    {
        $content = array(
		    "",
			"1,327.50", //1
			"1,593.00", //2
			"150.00", //3
			"150.00", //4
			"150.00", //5
			"150.00", //6
			"150.00" //7
		);
		
		$stmt = $content[$id];
		
		return $stmt;
    }
	
	//return action_amount_key
    public function returnAmountKey($data)
    {
		
        $content = array(
		    "",
			"1,327.50", //1
			"1,593.00", //2
			"150.00", //3
			"150.00", //4
			"150.00", //5
			"150.00", //6
			"150.00" //7
		);
		
		$key = array_search($data, $content);
		
        $stmt = $key;

        return $stmt;
 
    }

	//create title from action_history
    public function payment_info($id, $main_month){
		
		$query1 = "SELECT * FROM " . $this->table_action . " WHERE user_id = " . $id . " AND action_num = '3'";
		$stmt1 = $this->conn->getCount($query1);				if($stmt1 > 0){						$init_query = "SELECT * FROM " . $this->table_action . " WHERE user_id = " . $id . " AND action_num = '3'";						$query = "SELECT * FROM " . $this->table_action . " WHERE user_id = " . $id . " AND action_num = '3' ORDER BY id DESC";						$init_stmt = $this->conn->getData($init_query);					}else{						$query = "SELECT * FROM " . $this->table_action . " WHERE user_id = " . $id . " ORDER BY id DESC";					}
		$stmt = $this->conn->getData($query);
		$now_date = getdate();
				$expected_day2 = $this->expectedExamDate(2, $now_date['year'], 'day');						$expected_day6 = $this->expectedExamDate(6, $now_date['year'], 'day');						$expected_day10 = $this->expectedExamDate(10, $now_date['year'], 'day');						$expected_day2_next = $this->expectedExamDate(2, ($now_date['year'] + 1), 'day');						$expected_day6_next = $this->expectedExamDate(6, ($now_date['year'] + 1), 'day');						$expected_day10_next = $this->expectedExamDate(10, ($now_date['year'] + 1), 'day');
				$dateJan1 = mktime(0,0,0,1,1,($now_date['year']));
		
		$dateFeb = mktime(0,0,0,2,$expected_day2,($now_date['year']));
		
		$dateJune = mktime(0,0,0,6,$expected_day6,($now_date['year']));
		
		$dateOct = mktime(0,0,0,10,$expected_day10,($now_date['year']));
		
		$title = "";
		
		$detail_title = "";
		
		$pay_amount_key = "";
		
		$exam_year = "";
		
		$due_date = $dateFeb;
		
		$main_amount = '0';

		$late_amount = '0';

		$retake1_amount = '0';

		$retake2_amount = '0';

		$retake3_amount = '0';

		$retake4_amount = '0';

		$retake5_amount = '0';

		if(empty($stmt[0]['exam_year']) == false && empty($stmt[0]['exam_mon']) == false && $stmt[0]['action_num'] > 2){						$registered_make_time = mktime(0,0,0,$stmt[0]['exam_mon'],$this->expectedExamDate($stmt[0]['exam_mon'], $stmt[0]['exam_year'], 'day'), $stmt[0]['exam_year']);						if($now_date[0] <= $registered_make_time){								$retake_make_time = ($registered_make_time + 120*24*3600);								$retake_time = getdate($retake_make_time);								$retake_year = $retake_time['year'];								$retake_month = $retake_time['mon'];								$diff_month = (($retake_year - $init_stmt[0]['exam_year']) * 12) + ($retake_month - $init_stmt[0]['exam_mon']);								$retake_num = $diff_month/4;								$title = "Certification Exam Retake #". $retake_num ." (". $retake_year .")";				$detail_title = "For ". $this->expectedExamDate($retake_month, $retake_year, 'full') ." Exam";				$pay_amount_key = $retake_num + 2;				$due_date = mktime(0,0,0,$retake_month,$this->expectedExamDate($retake_month, $retake_year, 'day'),$retake_year);							}else{								$due_make_time = mktime(0,0,0,$now_date['mon'],$this->expectedExamDate($now_date['mon'], $now_date['year'], 'day'), $now_date['year']);								$diff_month = (($now_date['year'] - $init_stmt[0]['exam_year']) * 12) + ($now_date['mon'] - $init_stmt[0]['exam_mon']);								$retake_num = $diff_month/4;								if(($diff_month % 4) == 0){										if($now_date[0] >= $due_make_time){												$retake_make_time = ($due_make_time + 120*24*3600);												$retake_time = getdate($retake_make_time);												$retake_year = $retake_time['year'];												$retake_month = $retake_time['mon'];												$retake_num = $retake_num + 1;												$title = "Certification Exam Retake #". $retake_num ." (". $retake_year .")";						$detail_title = "For ". $this->expectedExamDate($retake_month, $retake_year, 'full') ." Exam";						$pay_amount_key = $retake_num + 2;						$due_date = mktime(0,0,0,$retake_month,$this->expectedExamDate($retake_month, $retake_year, 'day'),$retake_year);													}else{												$title = "Certification Exam Retake #". $retake_num ." (". $now_date['year'] .")";						$detail_title = "For ". $this->expectedExamDate($now_date['mon'], $now_date['year'], 'full') ." Exam";						$pay_amount_key = $retake_num + 2;						$due_date = mktime(0,0,0,$now_date['mon'],$this->expectedExamDate($now_date['mon'], $now_date['year'], 'day'),$now_date['year']);											} 									}else{										if($retake_num < 1){										$retake_make_time = ($registered_make_time + 120*24*3600);												$retake_time = getdate($retake_make_time);												$retake_year = $retake_time['year'];												$retake_month = $retake_time['mon'];												$title = "Certification Exam Retake #1 (". $retake_year .")";						$detail_title = "For ". $this->expectedExamDate($retake_month, $retake_year, 'full') ." Exam";						$pay_amount_key = 3;						$due_date = mktime(0,0,0,$retake_month,$this->expectedExamDate($retake_month, $retake_year, 'day'),$retake_year);											}else if($retake_num > 1 && $retake_num < 2){										$retake_make_time = ($registered_make_time + 120*24*3600*2);												$retake_time = getdate($retake_make_time);												$retake_year = $retake_time['year'];												$retake_month = $retake_time['mon'];												$title = "Certification Exam Retake #2 (". $retake_year .")";						$detail_title = "For ". $this->expectedExamDate($retake_month, $retake_year, 'full') ." Exam";						$pay_amount_key = 4;						$due_date = mktime(0,0,0,$retake_month,$this->expectedExamDate($retake_month, $retake_year, 'day'),$retake_year);											}else if($retake_num > 2 && $retake_num < 3){										$retake_make_time = ($registered_make_time + 120*24*3600*3);												$retake_time = getdate($retake_make_time);												$retake_year = $retake_time['year'];												$retake_month = $retake_time['mon'];												$title = "Certification Exam Retake #3 (". $retake_year .")";						$detail_title = "For ". $this->expectedExamDate($retake_month, $retake_year, 'full') ." Exam";						$pay_amount_key = 5;						$due_date = mktime(0,0,0,$retake_month,$this->expectedExamDate($retake_month, $retake_year, 'day'),$retake_year);											}else if($retake_num > 3 && $retake_num < 4){										$retake_make_time = ($registered_make_time + 120*24*3600*4);												$retake_time = getdate($retake_make_time);												$retake_year = $retake_time['year'];												$retake_month = $retake_time['mon'];												$title = "Certification Exam Retake #4 (". $retake_year .")";						$detail_title = "For ". $this->expectedExamDate($retake_month, $retake_year, 'full') ." Exam";						$pay_amount_key = 6;						$due_date = mktime(0,0,0,$retake_month,$this->expectedExamDate($retake_month, $retake_year, 'day'),$retake_year);											}else if($retake_num > 4 && $retake_num < 5){										$retake_make_time = ($registered_make_time + 120*24*3600*5);												$retake_time = getdate($retake_make_time);												$retake_year = $retake_time['year'];												$retake_month = $retake_time['mon'];												$title = "Certification Exam Retake #5 (". $retake_year .")";						$detail_title = "For ". $this->expectedExamDate($retake_month, $retake_year, 'full') ." Exam";						$pay_amount_key = 7;												$due_date = mktime(0,0,0,$retake_month,$this->expectedExamDate($retake_month, $retake_year, 'day'),$retake_year);											}else if($retake_num > 5){										$retake_make_time = ($registered_make_time + 120*24*3600*6);												$retake_time = getdate($retake_make_time);												$retake_year = $retake_time['year'];												$retake_month = $retake_time['mon'];												$title = "Certification Exam Retake #6 (". $retake_year .")";						$detail_title = "For ". $this->expectedExamDate($retake_month, $retake_year, 'full') ." Exam";						$pay_amount_key = 8;												$due_date = mktime(0,0,0,$retake_month,$this->expectedExamDate($retake_month, $retake_year, 'day'),$retake_year);											}									}							}					}else if(empty($stmt[0]['exam_year']) == false && empty($stmt[0]['exam_mon']) == false && $stmt[0]['action_num'] < 3){						$title = "";			$detail_title = "";			$pay_amount_key = 0;						$due_date = 0;				}else{	
	 /*Category 1: February 8
		Case Western Reserve University, DC	
		Case Western Reserve University, Houston
		Case Western Reserve University, Cleveland
		Univ. of Missouri, Kansas City
		
		(2019.8.1 - 9.30) 1327.50

		(2019.10.1. - 2020.2.7.)1593.00

		#1: 6/13/2020

		#2: 10/10/2020

		#3: 2/8/2021

		#4: 6/13/2021

		#5: 10/10/2021*/
		// $dateAug = mktime(0,0,0,8,1,($now_date['year']));
		// $dateSep30 = mktime(0,0,0,9,30,($now_date['year']));
		// $dateOct = mktime(0,0,0,10,1,($now_date['year']));
			$dateFeb = mktime(0,0,0,2,$expected_day2,($now_date['year']));
			if($main_month == 2){
				
				if(empty($stmt[0]['action_num']) == true)
				{
					//Aug.1 - Sept.30(main)
					if(($now_date['mon'] == 8) || ($now_date['mon'] == 9))
					{
						$title = "Certification Exam (Main ". ($now_date['year'] + 1) .")";
						
						$detail_title = "For February ".$expected_day2_next.", ". ($now_date['year'] + 1) ." Exam";
						
						$pay_amount_key = 1;
						
						$due_date = mktime(0,0,0,2,$expected_day2_next,($now_date['year'] + 1));
						
					}
					
					//Oct.1 - Feb.7(late)
					if($now_date['mon'] > 9)
					{
						$title = "Certification Exam (Late ". ($now_date['year'] + 1) .")";
						
						$detail_title = "For February ".$expected_day2_next.", ". ($now_date['year'] + 1) ." Exam";
						
						$pay_amount_key = 2;
						
						$due_date = mktime(0,0,0,2,$expected_day2_next,($now_date['year'] + 1));
						
					}else if(($now_date[0] >= $dateJan1) && ($now_date[0] <= $dateFeb))
					{
						$title = "Certification Exam (Late ". ($now_date['year']) .")";
						
						$detail_title = "For February ".$expected_day2.", ". ($now_date['year']) ." Exam";
						
						$pay_amount_key = 2;
						
						$due_date = mktime(0,0,0,2,$expected_day2,($now_date['year']));
						
					}
				
				}

			}

		 /*Category 2: June 13
			Nova Southeastern University, Ft Lauderdale
			Nova Southeastern University, Tampa	
			Emory University, Atlanta
			Quinnipiac, Hamden, CT
			South University, Savannah, GA

			(2019.11.1 - 2020.1.15) 1327.50
			(2020.1.16. - 2020.6.13.)1593.00

			#1: 10/10/2020

			#2: 2/8/2021

			#3: 6/13/2021

			#4: 10/10/2021

			#5: 2/8/2022*/
			$dateNov = mktime(0,0,0,11,1,($now_date['year']));
			$dateJan15 = mktime(0,0,0,1,15,($now_date['year']));
			if($main_month == 6){
				
				if(empty($stmt[0]['action_num']) == true)
				{
					//Nov.1 - Jan.15(main)
					if($now_date['mon'] > 10)
					{
						$title = "Certification Exam (Main ". ($now_date['year'] + 1) .")";
						
						$detail_title = "For June ".$expected_day6_next.", ". ($now_date['year'] + 1) ." Exam";
						
						$pay_amount_key = 1;
						
						$due_date = mktime(0,0,0,6,$expected_day6_next,($now_date['year'] + 1));
						
					}else if(($now_date[0] >= $dateJan1) && ($now_date[0] <= $dateJan15))
					{
						$title = "Certification Exam (Main ". ($now_date['year']) .")";
						
						$detail_title = "For June ".$expected_day6.", ". ($now_date['year']) ." Exam";
						
						$pay_amount_key = 1;
						
						$due_date = mktime(0,0,0,6,$expected_day6,($now_date['year']));
						
					}
					
					//Jan.16 - June.13(late)
					if(($now_date[0] > $dateJan15) && ($now_date[0] <= $dateJune))
					{
						$title = "Certification Exam (Late ". ($now_date['year']) .")";
						
						$detail_title = "For June ".$expected_day6.", ". ($now_date['year']) ." Exam";
						
						$pay_amount_key = 2;
						
						$due_date = mktime(0,0,0,6,$expected_day6,($now_date['year']));
						
					}
				}
			}

		 /*Category 3: October 10
			Indiana University, Indianapolis
			Medical College of Wisconsin, Milwaukee
			Univ. of Colorado School of Medicine, Denver
			
			(2020.3.15 - 2020.5.15) 1327.50
			(2020.5.16. - 2020.10.10.)1593.00
			  
			   #1: 2/8/2021      
			   
			   #2: 6/13/2021
			   
			   #3: 10/10/2021
			   
			   #4: 2/8/2022
			   
			   #5: 6/13/2022*/
			$dateMarch15 = mktime(0,0,0,3,15,($now_date['year']));
			$dateMay15 = mktime(0,0,0,5,15,($now_date['year']));
			if($main_month == 10){
				
				if(empty($stmt[0]['action_num']) == true)
				{
					//March.15 - May.15(main)
					if(($now_date[0] > $dateMarch15) && ($now_date[0] <= $dateMay15))
					{
						$title = "Certification Exam (Main ". ($now_date['year']) .")";
						
						$detail_title = "For October ".$expected_day10.", ". ($now_date['year']) ." Exam";
						
						$pay_amount_key = 1;
						
						$due_date = mktime(0,0,0,10,$expected_day10,($now_date['year']));
						
					}
					
					//May.16 - Oct.10(late)
					if(($now_date[0] > $dateMay15) && ($now_date[0] <= $dateOct))
					{
						$title = "Certification Exam (Late ". ($now_date['year']) .")";
						
						$detail_title = "For October ".$expected_day10.", ". ($now_date['year']) ." Exam";
						
						$pay_amount_key = 2;
						
						$due_date = mktime(0,0,0,10,$expected_day10,($now_date['year']));
						
					}
				
				}				
			}
		}
		if($pay_amount_key == 1){
			
			$main_amount = $this->readActionAmount(1);
			
		}else if($pay_amount_key == 2){
			
			$late_amount = $this->readActionAmount(2);
			
		}else if($pay_amount_key == 3){
			
			$retake1_amount = $this->readActionAmount(3);
			
		}else if($pay_amount_key == 4){
			
			$retake2_amount = $this->readActionAmount(4);
			
		}else if($pay_amount_key == 5){
			
			$retake3_amount = $this->readActionAmount(5);
			
		}else if($pay_amount_key == 6){
			
			$retake4_amount = $this->readActionAmount(6);
			
		}else if($pay_amount_key == 7){
			
			$retake5_amount = $this->readActionAmount(7);
			
		}

		$pay_info = array("title" => $title, "detail_title" => $detail_title, "due_date" => $due_date, "pay_amount_key" => $pay_amount_key, "main_amount" => $main_amount, "late_amount" => $late_amount, "retake1_amount" => $retake1_amount, "retake2_amount" => $retake2_amount, "retake3_amount" => $retake3_amount, "retake4_amount" => $retake4_amount, "retake5_amount" => $retake5_amount);
		
		return $pay_info;
    }		public function title_info($user_id, $cert_month){				$action_title = $this->payment_info($user_id, $cert_month);		$arr1 = explode("Main", $action_title['title']);		$arr2 = explode("Late", $action_title['title']);		$arr3 = explode("#1", $action_title['title']);		$arr4 = explode("#2", $action_title['title']);		$arr5 = explode("#3", $action_title['title']);		$arr6 = explode("#4", $action_title['title']);		$arr7 = explode("#5", $action_title['title']);		$exam_title = "";				if(count($arr1) > 1){						$exam_title = "main";		}		if(count($arr2) > 1){						$exam_title = "late";		}		if(count($arr3) > 1){						$exam_title = "Retake #1";		}		if(count($arr4) > 1){						$exam_title = "Retake #2";		}		if(count($arr5) > 1){						$exam_title = "Retake #3";		}		if(count($arr6) > 1){						$exam_title = "Retake #4";		}		if(count($arr7) > 1){						$exam_title = "Retake #5";		}				$exam_time = getdate($action_title['due_date']);				$exam_date = $this->expectedExamDate($exam_time['mon'], $exam_time['year'], 'full');				$retake_info = array("title"=>$exam_title, "due"=>$exam_date);				return $retake_info;			}	
	//insert action_history
    public function insert_CertificationActionHistory($data)
	{
		//defalt
		$action_num = 14;
		
		//main_exam
        if($data['pay_num'] == 1)
		{
			if($data['certification_month'] == 2)
			{
				$action_num = 14;
			}
			
			if($data['certification_month'] == 6)
			{
				$action_num = 16;
			}
			
			if($data['certification_month'] == 10)
			{
				$action_num = 18;
			}
		}
		
		//Lete Fee
        if($data['pay_num'] == 2)
		{
			if($data['certification_month'] == 2)
			{
				$action_num = 15;
			}
			
			if($data['certification_month'] == 6)
			{
				$action_num = 17;
			}
			
			if($data['certification_month'] == 10)
			{
				$action_num = 19;
			}
		}
        
		//Retake #1
		if($data['pay_num'] == 3)
		{
			$action_num = 20;
		}

		//Retake #2
		if($data['pay_num'] == 4)
		{
			$action_num = 21;
		}

		//Retake #3
		if($data['pay_num'] == 5)
		{
			$action_num = 22;
		}

		//Retake #4
		if($data['pay_num'] == 6)
		{
			$action_num = 23;
		}

		//Retake #5
		if($data['pay_num'] == 7)
		{
			$action_num = 24;
		}
		
		//first_name and last_name 
		$first_name = $this->split_name($data['certification_name'])[0];
		
		$last_name = $this->split_name($data['certification_name'])[1];
				$final_card_num = substr($data['number'], -4);				//getdate
		$now_date = getdate(date("U"));
		$query_registered = "SELECT * FROM " . $this->table_action . " WHERE user_id='". $_SESSION['user_id'] ."' AND action_num='".$action_num."' AND amount_num='". $data['pay_num'] ."' AND exam_mon='". $data['certification_month'] ."' AND exam_year='". $data['certification_year'] ."' AND receipt_title='". $data['action_title'] ."' AND detail_title='".$data['detail_title']."'";				$check_registered = $this->conn->getCount($query_registered);				if($check_registered > 0){						return false;					}else{						if(empty($_SESSION['user_id']) == false && empty($first_name) == false && $data['certification_month'] != 0){				
				$query_action = "INSERT INTO " . $this->table_action . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title) VALUES ('". $_SESSION['user_id'] ."', '". $first_name ."', '". $last_name ."', '". $final_card_num ."', '". $now_date[0] ."', '". $action_num ."', '". $data['pay_num'] ."', '". $data['certification_month'] ."', '". $data['certification_year'] ."', '0', '". $data['action_title'] ."', '" . $data['detail_title'] . "') ";
				
				//save history
				$query_history = "INSERT INTO " . $this->table_history . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title, cme_cycle_start, exam_type) VALUES ('". $_SESSION['user_id'] ."', '". $first_name ."', '". $last_name ."', '". $final_card_num ."', '". $now_date[0] ."', '". $action_num ."', '". $data['pay_num'] ."', '". $data['certification_month'] ."', '". $data['certification_year'] ."', '0', '". $data['action_title'] ."', '" . $data['detail_title'] . "', '', 'Certification') ";
				
				//Waiting
				$query_wait = "INSERT INTO " . $this->table_action . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title) VALUES ('". $_SESSION['user_id'] ."', '". $first_name ."', '". $last_name ."', '". $final_card_num ."', '". $now_date[0] ."', '2', '". $data['pay_num'] ."', '". $data['certification_month'] ."', '". $data['certification_year'] ."', '0', '". $data['action_title'] ."', '" . $data['detail_title'] . "') ";
				
				//save history
				$query_wait_history = "INSERT INTO " . $this->table_history . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title, cme_cycle_start, exam_type) VALUES ('". $_SESSION['user_id'] ."', '". $first_name ."', '". $last_name ."', '". $final_card_num ."', '". $now_date[0] ."', '2', '". $data['pay_num'] ."', '". $data['certification_month'] ."', '". $data['certification_year'] ."', '0', '". $data['action_title'] ."', '" . $data['detail_title'] . "', '', 'Certification') ";				

				$this->conn->execute($query_history);
				
				$this->conn->execute($query_wait_history);
				
				$this->conn->execute($query_action);								
				if($this->conn->execute($query_wait)){
					
					return true;
					
				}else{
					
					return false;
					
				}							}else{								return false;							}				}
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

	// read datas with where
    public function readExpectedDate($id)
    {
        $query = "SELECT * FROM " . $this->table_dates . " WHERE University_Id=(SELECT University_id FROM ". $this->table_class ." WHERE user_id=". $id .") AND class_of_year=(SELECT class_of FROM ". $this->table_class ." WHERE user_id=". $id .")";
		
        $stmt = $this->conn->getData($query);

        return $stmt;
    }
	
	// check certification from tbl_class
    public function readCheckCertification($id)
    {
        $query = "SELECT * FROM " . $this->table_class . " WHERE user_id=". $id ." AND Cert_exam_active='1'";
		
        $stmt = $this->conn->getCount($query);

        return $stmt;
    }		public function expectedExamDate($month, $year, $type)		{		if($month == 2){						$master_month = "February";					}else if($month == 6){						$master_month = "June";					}else{						$master_month = "October";					}				if($type == 'day'){						return date('j', strtotime('second saturday of '. $master_month .' '.$year));					}else if($type == 'full'){						return date('F j, Y', strtotime('second saturday of '. $master_month .' '.$year));					}else if($type == 'due'){						return date('n/j/Y', strtotime('second saturday of '. $master_month .' '.$year));					}else if($type == 'retake_due'){						return date('n/j/Y', (strtotime('second saturday of '. $master_month .' '.$year) - 24*3600));					}			}	
}
?>