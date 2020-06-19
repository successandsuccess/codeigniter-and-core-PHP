<?php
class PaymentHistoryCdq
{
    // database connection and table name
    private $conn;
    private $userInfo;
    private $table_name = "tbl_cdqhistory";
    private $table_payment = "tbl_payment";
    private $table_user = "users";
    private $table_cdq = "incomecdq";
    private $table_action = "action_history_cdq";
    private $table_history = "action_history";
    public function __construct()
    {
        global $db;
        $this->conn = $db;
        global $userObject;
        $this->userInfo = $userObject;
    }
    // create blog
    public function create($detail)
    {
        $query = "INSERT INTO " . $this->table_name . " (payment_id, user_id, incomecdq_id, created_at) VALUES ('" . $detail['payment_id'] . "','" . $detail['user_id'] . "','" . $detail['incomecdq_id'] . "','" . date("Y-m-d H:i:s") . "') ";
        if ($this
            ->conn
            ->execute($query))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    // get rows count
    public function countAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this
            ->conn
            ->getCount($query);
        return $stmt;
    }
    public function readPaging($from_record_num, $records_per_page)
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created ASC LIMIT {$from_record_num}, {$records_per_page}";
        //    		print "query:$query<br>\n";
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt;
    }
    // read all datas
    public function readAll()
    {
        $query = "SELECT p.*, cd.exam, u.* FROM " . $this->table_name . " ch 


        INNER JOIN " . $this->table_payment . " p ON ch.payment_id=p.id 


        INNER JOIN " . $this->table_cdq . " cd ON ch.incomecdq_id=cd.id


        INNER JOIN " . $this->table_user . " u ON ch.user_id=u.id ORDER BY ch.id DESC";
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt;
    }
    // read datas with where
    public function readWithWhere($where)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE " . $where;
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt;
    }
    public function readById($id)
    {
        if ($id != "") $this->id = $id;
        $query = "SELECT " . $this->table_payment . ".*, " . $this->table_user . ".full_name FROM " . $this->table_payment . " INNER JOIN " . $this->table_user . " ON " . $this->table_payment . ".user_id=" . $this->table_user . ".id WHERE " . $this->table_payment . ".id=" . $id;
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt[0];
    }
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET created = '" . ($this->created) . "', author = '" . ($this->author) . "', title = '" . ($this->title) . "', contents = '" . ($this->contents) . "', publish = '" . ($this->publish) . "' WHERE id = " . $this->id;
        if ($this
            ->conn
            ->execute($query))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function PaymentError()
    {
        return "


            <script type=\"text/javascript\">


            $(document).ready(function() {


                $('#paymentContentModal').modal('show');


             });


            </script>


        ";
    }
    public function PaymentSuccess()
    {
        return "


            <script type=\"text/javascript\">


            $(document).ready(function() {


                $('#receiptmodal_body').css({'display':'block'});


                $('#receiptContentModal').modal('show');


             });


            </script>


        ";
    }
    //read all data of action_history_cdq
    public function readAllAction($id)
    {
        $query = "SELECT * FROM " . $this->table_action . " WHERE user_id = " . $id . " ORDER BY id DESC";
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt;
    }
    // split full name into first name and last name
    // previous code
    // public function split_name($name) {
    // 	$name = trim($name);
    // 	$last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
    // 	$first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
    // 	return array($first_name, $last_name);
    // }
    // new name split function
    public function splitName($name)
    {
        $name = trim($name);
        if (substr($name, -3) == 'Jr.')
        {
            $splitedNameArray = explode(" ", $name);
            $last_name = $splitedNameArray[count($splitedNameArray) - 2] . " " . $splitedNameArray[count($splitedNameArray) - 1];
            $first_name = str_replace($last_name, '', $name);
            return array(
                $first_name,
                $last_name
            );
        }
        else
        {
            $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
            $first_name = trim(preg_replace('#' . $last_name . '#', '', $name));
            return array(
                $first_name,
                $last_name
            );
        }
    }
    //read action-content array. This is indexof for action_num.
    public function readActionContent($id, $year)
    {
        $content = array(
            //amdin 6
            "Became an ", //******************************0
            "Results: Passed", //*************************1
            "Waiting for CDQ Exam Results", //************2
            "Results: Failed", //*************************3
            "Failed to Register(2 Exams Remaining)", //***4
            "Failed to Show(2 Exams Remaining)", //*******5
            //member 6
            "Registered " . $this->expectedExamDate(2, $year, 'full') , //************************6
            "Registered " . $this->expectedExamDate(2, $year, 'full') , //************************7(late fee)
            "Registered " . $this->expectedExamDate(6, $year, 'full') , //***********************8
            "Registered " . $this->expectedExamDate(6, $year, 'full') , //***********************9(late fee)
            "Retake #1 for " . $this->expectedExamDate(2, $year, 'full') , //*********************10
            "Retake #2 for " . $this->expectedExamDate(2, $year, 'full') , //*********************11
            "Retake #1 for " . $this->expectedExamDate(6, $year, 'full') , //*********************12
            "Retake #2 for " . $this->expectedExamDate(6, $year, 'full') //*********************13
            
        );
        $stmt = $content[$id];
        return $stmt;
    }
    //read action_mon
    public function readActionExamMon($id)
    {
        if ($id == 2)
        {
            $exam_mon = "Feb";
        }
        if ($id == 6)
        {
            $exam_mon = "June";
        }
        $stmt = $exam_mon;
        return $stmt;
    }
    //read action_amount
    public function readActionAmount($id)
    {
        $content = array(
            "",
            "1,000.00", //1
            "1,327.50", //2
            "150.00", //3
            "150.00"
            //4
            
        );
        $stmt = $content[$id];
        return $stmt;
    }
    //return action_amount_key
    public function returnAmountKey($data)
    {
        $content = array(
            "",
            "1,000.00", //1
            "1,327.50", //2
            "150.00", //3
            "150.00"
            //4
            
        );
        $key = array_search($data, $content);
        $stmt = $key;
        return $stmt;
    }
    //create title from action_history_cdq
    public function pay_title($id, $cdq_month)
    {
        $query = "SELECT * FROM " . $this->table_action . " WHERE user_id = " . $id . " ORDER BY id DESC";
        $stmt = $this
            ->conn
            ->getData($query);
        $n_date = getdate(date("U"));
        $cdq_exam_year = date("Y", strtotime($this
            ->userInfo
            ->vitals["cdq_due"]));
        //make time for 1.15 next year
        $mkJan1 = mktime(0, 0, 0, 1, 1, ($n_date['year']));
        $mkJan15 = mktime(0, 0, 0, 1, 15, ($n_date['year']));
        $title = "";
        if ($cdq_month == 2)
        {
            if (empty($stmt[0]['action_num']) == true)
            {
                //Aug.1 - Sept.30(main)
                if (($n_date['mon'] == 8) || ($n_date['mon'] == 9))
                {
                    $title = "CDQ Exam (Main " . $cdq_exam_year . ")";
                }
                //Oct.1 - Jan.30(late)
                if ($n_date['mon'] > 9)
                {
                    $title = "CDQ Exam (Late " . $cdq_exam_year . ")";
                }
                else if ($n_date['mon'] < 2)
                {
                    $title = "CDQ Exam (Late " . $cdq_exam_year . ")";
                }
            }
            else if (empty($stmt[0]['action_num']) == false)
            {
                if (($stmt[0]['action_num'] == 0) || ($stmt[0]['action_num'] == 1))
                {
                    //make time for 1.15 in 6 year
                    $mkPer6 = mktime(0, 0, 0, 1, 15, ($stmt[0]['exam_year'] + 6));
                    //Aug.1 - Sept.30(main)
                    if (($n_date['mon'] == 8) || ($n_date['mon'] == 9))
                    {
                        $title = "CDQ Exam (Main " . ($stmt[0]['exam_year'] + 6) . ")";
                    }
                    //Oct.1 - Jan.30(late)
                    if (($n_date['mon'] > 9) || ($n_date['mon'] < 2))
                    {
                        $title = "CDQ Exam (Late " . ($stmt[0]['exam_year'] + 6) . ")";
                    }
                }
                //Retake #1
                if ($stmt[0]['amount_num'] < 3)
                {
                    if (($stmt[0]['action_num'] > 2) && ($stmt[0]['exam_mon'] == 2))
                    {
                        $title = "CDQ Exam Retake #1 (" . $stmt[0]['exam_year'] . ")";
                    }
                    else if (($stmt[0]['action_num'] > 2) && ($stmt[0]['exam_mon'] == 6))
                    {
                        $title = "CDQ Exam Retake #1 (" . ($stmt[0]['exam_year'] + 1) . ")";
                    }
                    //Retake #2
                    
                }
                else if ($stmt[0]['amount_num'] >= 3)
                {
                    if (($stmt[0]['action_num'] > 2) && ($stmt[0]['exam_mon'] == 2))
                    {
                        $title = "CDQ Exam Retake #2 (" . $stmt[0]['exam_year'] . ")";
                    }
                    else if (($stmt[0]['action_num'] > 2) && ($stmt[0]['exam_mon'] == 6))
                    {
                        $title = "CDQ Exam Retake #2 (" . ($stmt[0]['exam_year'] + 1) . ")";
                    }
                }
            }
        }
        else if ($cdq_month == 6)
        {
            if (empty($stmt[0]['action_num']) == true)
            {
                //Nov.1 - Jan.15(main)
                if ($n_date['mon'] > 10)
                {
                    $title = "CDQ Exam (Main " . $cdq_exam_year . ")";
                }
                else if (($n_date[0] >= $mkJan1) && ($n_date[0] < $mkJan15))
                {
                    $title = "CDQ Exam (Main " . $cdq_exam_year . ")";
                }
				//Jan.15 - May.30(late)
                if (($n_date[0] > $mkJan15) && ($n_date['mon'] < 6))
                {
                    $title = "CDQ Exam (Late " . $cdq_exam_year . ")";
				}
				
				$late_CDQ_covid_users = [56, 222, 1873, 2018, 1334, 1828, 2303, 1382, 1361, 2284, 689];
				if( in_array($_SESSION['user_id'], $late_CDQ_covid_users ) && $n_date['year'] == 2020 )
				{
					$title = "CDQ Exam (Late " . $cdq_exam_year . ")";
				}
            }
            else if (empty($stmt[0]['action_num']) == false)
            {
                if (($stmt[0]['action_num'] == 0) || ($stmt[0]['action_num'] == 1))
                {
                    //make time for 1.15 in 6 year
                    $mkPer6 = mktime(0, 0, 0, 1, 15, ($stmt[0]['exam_year'] + 6));
                    //Nov.1 - Jan.15(main)
                    if (($n_date['mon'] > 10) && ($n_date[0] < $mkPer6))
                    {
                        $title = "CDQ Exam (Main " . ($stmt[0]['exam_year'] + 6) . ")";
                    }
                    //Jan.15 - May.30(late)
                    if (($n_date[0] > $mkPer6) && ($n_date['mon'] < 6))
                    {
                        $title = "CDQ Exam (Late " . ($stmt[0]['exam_year'] + 6) . ")";
                    }
                }
                //Retake #1
                if ($stmt[0]['amount_num'] < 3)
                {
                    if (($stmt[0]['action_num'] > 2) && ($stmt[0]['exam_mon'] == 2))
                    {
                        $title = "CDQ Exam Retake #1 (" . $stmt[0]['exam_year'] . ")";
                    }
                    else if (($stmt[0]['action_num'] > 2) && ($stmt[0]['exam_mon'] == 6))
                    {
                        $title = "CDQ Exam Retake #1 (" . ($stmt[0]['exam_year'] + 1) . ")";
                    }
                    //Retake #2
                    
                }
                else if ($stmt[0]['amount_num'] >= 3)
                {
                    if (($stmt[0]['action_num'] > 2) && ($stmt[0]['exam_mon'] == 2))
                    {
                        $title = "CDQ Exam Retake #2 (" . $stmt[0]['exam_year'] . ")";
                    }
                    else if (($stmt[0]['action_num'] > 2) && ($stmt[0]['exam_mon'] == 6))
                    {
                        $title = "CDQ Exam Retake #2 (" . ($stmt[0]['exam_year'] + 1) . ")";
                    }
                }
            }
        }
        return $title;
    }
    //get exam type
    public function get_CDQExamType($action_title)
    {
        $arr1 = explode("Main", $action_title);
        $arr2 = explode("Late", $action_title);
        $arr3 = explode("#1", $action_title);
        $arr4 = explode("#2", $action_title);
        $pay_num = '0';
        if (count($arr1) > 1)
        {
            $pay_num = 1;
        }
        if (count($arr2) > 1)
        {
            $pay_num = 2;
        }
        if (count($arr3) > 1)
        {
            $pay_num = 3;
        }
        if (count($arr4) > 1)
        {
            $pay_num = 4;
        }
        return $pay_num;
    }
    //insert action_history_cdq
    public function insert_CDQActionHistory($data)
    {
        //defalt
        $action_num = 6;
        //main_exam
        if ($data['pay_num'] == 1)
        {
            if ($data['exam_val'] == 2)
            {
                $action_num = 6;
            }
            if ($data['exam_val'] == 6)
            {
                $action_num = 8;
            }
        }
        //Lete Fee
        if ($data['pay_num'] == 2)
        {
            if ($data['exam_val'] == 2)
            {
                $action_num = 7;
            }
            if ($data['exam_val'] == 6)
            {
                $action_num = 9;
            }
        }
        //Retake #1
        if ($data['pay_num'] == 3)
        {
            if ($data['exam_val'] == 2)
            {
                $action_num = 10;
            }
            if ($data['exam_val'] == 6)
            {
                $action_num = 12;
            }
        }
        //Retake #2
        if ($data['pay_num'] == 4)
        {
            if ($data['exam_val'] == 2)
            {
                $action_num = 11;
            }
            if ($data['exam_val'] == 6)
            {
                $action_num = 13;
            }
        }
        //first_name and last_name
        $first_name = $this->split_name($data['exam_name']) [0];
        $last_name = $this->split_name($data['exam_name']) [1];
        $final_card_num = substr($data['number'], -4);
        //getdate
        $n_date = getdate(date("U"));
        //register check
        $query_registered = "SELECT * FROM " . $this->table_action . " WHERE user_id='" . $_SESSION['user_id'] . "' AND action_num='2' AND amount_num='" . $data['amount_num'] . "' AND exam_mon='" . $data['exam_val'] . "' AND exam_year='" . $data['exam_year'] . "' AND receipt_title='" . $data['action_title'] . "'";
        $check_registered = $this
            ->conn
            ->getCount($query_registered);
        if ($check_registered > 0)
        {
            return false;
        }
        else
        {
            $query_action = "INSERT INTO " . $this->table_action . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title) VALUES ('" . $_SESSION['user_id'] . "', '" . $first_name . "', '" . $last_name . "', '" . $final_card_num . "', '" . $n_date[0] . "', '" . $action_num . "', '" . $data['amount_num'] . "', '" . $data['exam_val'] . "', '" . $data['exam_year'] . "', '0', '" . $data['action_title'] . "') ";
            //save history
            $query_history = "INSERT INTO " . $this->table_history . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title, cme_cycle_start, exam_type) VALUES ('" . $_SESSION['user_id'] . "', '" . $first_name . "', '" . $last_name . "', '" . $final_card_num . "', '" . $n_date[0] . "', '" . $action_num . "', '" . $data['amount_num'] . "', '" . $data['exam_val'] . "', '" . $data['exam_year'] . "', '0', '" . $data['action_title'] . "', '', '', 'CDQ') ";
            //Waiting
            $query_wait = "INSERT INTO " . $this->table_action . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title) VALUES ('" . $_SESSION['user_id'] . "', '" . $first_name . "', '" . $last_name . "', '" . $final_card_num . "', '" . $n_date[0] . "', '2', '" . $data['amount_num'] . "', '" . $data['exam_val'] . "', '" . $data['exam_year'] . "', '0', '" . $data['action_title'] . "') ";
            //save history
            $query_wait_history = "INSERT INTO " . $this->table_history . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title, cme_cycle_start, exam_type) VALUES ('" . $_SESSION['user_id'] . "', '" . $first_name . "', '" . $last_name . "', '" . $final_card_num . "', '" . $n_date[0] . "', '2', '" . $data['amount_num'] . "', '" . $data['exam_val'] . "', '" . $data['exam_year'] . "', '0', '" . $data['action_title'] . "', '', '', 'CDQ') ";
            $this
                ->conn
                ->execute($query_history);
            $this
                ->conn
                ->execute($query_wait_history);
            $this
                ->conn
                ->execute($query_action);
            if ($this
                ->conn
                ->execute($query_wait))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
    public function readAllReceipt($data)
    {
        $query = "SELECT * FROM " . $this->table_action . " where id = (select max(id) from " . $this->table_action . " WHERE user_id=" . $data . ") AND user_id=" . $data;
        if (empty($this
            ->conn
            ->getData($query)) == false)
        {
            $stmt = $this
                ->conn
                ->getData($query);
            return $stmt[0];
        }
    }
    public function readByReceiptId($data)
    {
        $query = "SELECT * FROM " . $this->table_action . " where id = " . $data;
        if (empty($this
            ->conn
            ->getData($query)) == false)
        {
            $stmt = $this
                ->conn
                ->getData($query);
            return $stmt[0];
        }
    }
    public function readReceiptHistory($data)
    {
        $query = "SELECT * FROM " . $this->table_history . " where id = " . $data;
        if (empty($this
            ->conn
            ->getData($query)) == false)
        {
            $stmt = $this
                ->conn
                ->getData($query);
            return $stmt[0];
        }
    }
    public function expectedExamDate($month, $year, $type)
    {
        if ($month == 2)
        {
            $master_month = "February";
        }
        else
        {
            $master_month = "June";
        }
        if ($type == 'day')
        {
            return date('j', strtotime('second saturday of ' . $master_month . ' ' . $year));
        }
        else if ($type == 'full')
        {
            return date('F j, Y', strtotime('second saturday of ' . $master_month . ' ' . $year));
        }
        else if ($type == 'due')
        {
            return date('n/j/Y', strtotime('second saturday of ' . $master_month . ' ' . $year));
        }
        else if ($type == 'retake_due')
        {
            return date('n/j/Y', (strtotime('second saturday of ' . $master_month . ' ' . $year) - 24 * 3600));
        }
    }
    public function retake_info($user_id, $cdq_month)
    {
        $action_title = $this->pay_title($user_id, $cdq_month);
        $arr1 = explode("#1", $action_title);
        $arr2 = explode("#2", $action_title);
        $exam_year = substr($action_title, -5, -1);
        if ($cdq_month == 2)
        {
            $retake_month = 6;
        }
        else
        {
            $retake_month = 2;
        }
        $exam_date = $this->expectedExamDate($retake_month, $exam_year, 'full');
        if (count($arr1) > 1)
        {
            $exam_title = "Retake #1";
        }
        if (count($arr2) > 1)
        {
            $exam_title = "Retake #2";
        }
        $retake_info = array(
            "title" => $exam_title,
            "due" => $exam_date
        );
        return $retake_info;
    }
}
?>
