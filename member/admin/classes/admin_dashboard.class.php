<?php
class adminDashboardObject
{
    // database connection and table name
    private $conn;
    private $table_history = "action_history";
    private $table_history_cdq = "action_history_cdq";
    private $table_history_cme = "action_history_cme";
    private $table_history_certification = "action_history_certification";
    private $table_users = "users";
    private $table_personal = "final_personal_information";
    private $table_university = "final_program_university_info";
    private $table_class = "tbl_class";
    private $table_expected_date = "tbl_expected_dates";
    private $table_program = "tbl_program_director";
    private $table_class_of_2020 = 'tbl_class_of_2020';
    public function __construct()
    {
        global $db;
        $this->conn = $db;
    }
    //start ITE Registration category
    //get total CAAs
    public function get_totalCAAs()
    {
        $query = "SELECT * FROM " . $this->table_users . " WHERE role = 'CAA' AND is_certified = 1";
        $stmt = $this
            ->conn
            ->getCount($query);
        return $stmt;
    }
    // every year total student
    public function get_total_student_2020($year)
    {
        $query = "SELECT * FROM " . $this->table_class . " WHERE class_of = " . $year;
        $stmt = $this
            ->conn
            ->getCount($query);
        return $stmt;
    }
    //every year selected student
    public function get_selected_student_2020($year)
    {
        $query = "SELECT * FROM " . $this->table_class . " WHERE class_of = " . $year . " AND ITE_exam_active = 1";
        $stmt = $this
            ->conn
            ->getCount($query);
        return $stmt;
    }
    //get total student from 2020
    public function get_total_student_new()
    {
        $query = "SELECT * FROM " . $this->table_class . " WHERE class_of > 2019";
        $stmt = $this
            ->conn
            ->getCount($query);
        return $stmt;
    }
    //get every years student
    public function get_student_classOf_new($year)
    {
        $query = "SELECT * FROM " . $this->table_class . " WHERE class_of = " . $year;
        $stmt = $this
            ->conn
            ->getCount($query);
        return $stmt;
    }
    //get Decertified CAAs
    public function get_decertifiedCAAs()
    {
        $query = "SELECT * FROM " . $this->table_users . " WHERE role = 'CAA' AND is_certified = 0";
        $stmt = $this
            ->conn
            ->getCount($query);
        return number_format($stmt);
    }
    //get women persent from total CAAs
    public function get_women_persent()
    {
        $query = "SELECT U.* FROM " . $this->table_users . " AS U INNER JOIN " . $this->table_personal . " AS P ON U.role = 'CAA' AND U.id = P.user_id AND P.gender = 'Female'";
        $stmt = $this
            ->conn
            ->getCount($query);
        $persent = (int)(($stmt * 100) / $this->get_totalCAAs());
        return $persent;
    }
    //get men persent from total CAAs
    public function get_men_persent()
    {
        $query = "SELECT U.* FROM " . $this->table_users . " AS U INNER JOIN " . $this->table_personal . " AS P ON U.role = 'CAA' AND U.id = P.user_id AND P.gender = 'Male'";
        $stmt = $this
            ->conn
            ->getCount($query);
        $persent = (int)(($stmt * 100) / $this->get_totalCAAs());
        return $persent;
    }
    //get total students
    public function get_total_student()
    {
        $query = "SELECT * FROM " . $this->table_users . " WHERE role = 'Student'";
        $stmt = $this
            ->conn
            ->getCount($query);
        return number_format($stmt);
    }
    //get student class of $year
    public function get_student_classOf($year)
    {
        $query = "SELECT U.* FROM " . $this->table_users . " AS U INNER JOIN " . $this->table_class . " AS C ON U.role = 'Student' AND U.id = C.user_id AND C.class_of = '" . $year . "'";
        $stmt = $this
            ->conn
            ->getCount($query);
        return number_format($stmt);
    }
    //start Cert Registration category
    //get student expected(due) in class of $year
    public function expected_students_count($exam_type, $year)
    {
        if ($exam_type == 'Cert')
        {
            $query = "SELECT U.* FROM " . $this->table_users . " AS U 



					  INNER JOIN " . $this->table_class . " AS C ON U.role = 'Student' AND U.id = C.user_id AND C.Cert_exam_active = 1  



					  INNER JOIN " . $this->table_expected_date . " AS E ON C.University_id = E.University_Id AND RIGHT(E.Expected_Cert_Exam, 4) = '" . $year . "' GROUP BY U.id";
        }
        else if ($exam_type == 'CDQ')
        {
            $query = "SELECT * FROM " . $this->table_history_cdq . " WHERE action_num > 2 AND (exam_year = '" . $year . "' OR exam_year = '" . ($year - 6) . "')";
        }
        else if ($exam_type == 'CME')
        {
            $query = "SELECT * FROM " . $this->table_history_cme . " WHERE action_num > 2 AND (cme_cycle_start = '" . ($year - 2) . "' OR cme_cycle_start = '" . ($year - 4) . "')";
        }
        $stmt = $this
            ->conn
            ->getCount($query);
        return number_format($stmt);
    }
    public function expected_students_count_new($exam_type, $year)
    {
        if ($exam_type == 'CME')
        {
            $query = "SELECT * FROM temp_stats WHERE (cme_student <> 1 OR cme_student IS NULL) AND (YEAR(cme_due) = " . $year . " OR YEAR(cme_due) = " . ($year + 2). ")";
            // echo '<pre>'; print_r($query); exit;
        }
        else if ($exam_type == 'CDQ')
        {
            $query = "SELECT * FROM temp_stats WHERE YEAR(cdq_due) = " . $year . " OR YEAR(cdq_due) = " . ($year + 6);
        }
        else
        {
            $query = "SELECT * FROM " . $this->table_class . " WHERE class_of = " . $year;
        }
        $stmt = $this
            ->conn
            ->getCount($query);
        return number_format($stmt);
    }

    public function expected_students_for_export($exam_type, $year, $exam_type1, $exam_year1, $month1)
    {
        //total cycle
        if ($exam_type == 'CME')
        {
            $query = "SELECT * FROM temp_stats WHERE (cme_student <> 1 OR cme_student IS NULL) AND (YEAR(cme_due) = " . $year . " OR YEAR(cme_due) = " . ($year + 2).")";
        }
        else if ($exam_type == 'CDQ')
        {
            $query = "SELECT * FROM temp_stats WHERE YEAR(cdq_due) = " . $year . " OR YEAR(cdq_due) = " . ($year + 6);
        }
        else
        {
            $query = "SELECT * FROM " . $this->table_class . " WHERE class_of = " . $year;
        }
        $stmt = $this
            ->conn
            ->getData($query);


//paid cme
        if ($exam_type1 == 'CME')
        {
            $query1 = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND cme_cycle_start = '" . ($exam_year1 - 2) . "' AND exam_type = '" . $exam_type1 . "' ORDER BY action_date DESC";
        }
        else
        {
            if ($month1 == '0')
            {
                $query1 = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND exam_year = " . $exam_year1 . " AND exam_type = '" . $exam_type1 . "' ORDER BY action_date DESC";
            }
            else
            {
                $query1 = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND exam_year = " . $exam_year1 . " AND exam_mon = '" . $month1 . "' AND exam_type = '" . $exam_type1 . "' ORDER BY action_date DESC";
            }
        }
        $stmt1 = $this
            ->conn
            ->getData($query1);
        
// substract
        $users_id = [];
        foreach($stmt as $st)
        {
            array_push($users_id, $st['user_id']);
        }
        // print_r($users_id);
        $users_id1 = [];
        foreach($stmt1 as $st1)
        {
            array_push($users_id1, $st1['user_id']);
        }
        // print_r($users_id1);
        // $users_id_dif = array_merge(array_diff($users_id, $users_id1), array_diff($users_id1, $users_id));
        $users_id_dif = array_diff($users_id, $users_id1);
        // print_r($users_id_dif); 
        $results_remaining = [];
        foreach($users_id_dif as $item)
        {
            //CME and Month = 0 CASE
            $sql_remaining = 
            "SELECT users.*, temp_stats.*  
            FROM users LEFT JOIN temp_stats 
            ON users.id = temp_stats.user_id 
            WHERE users.id = '". $item ."' ";
            // "AND ( YEAR(temp_stats.cme_due) = ". $year ." OR YEAR(temp_stats.cme_due) = ". ($year+2). " )";
            $result_remaining = $this->conn->getData($sql_remaining);
            array_push($results_remaining, $result_remaining);
        }

        // print_r($results_remaining); exit;
        return $results_remaining;
    }

    public function expected_students_count_new_number_format($exam_type, $year)
    {
        if ($exam_type == 'CME')
        {
            $query = "SELECT * FROM temp_stats WHERE (cme_student <> 1 OR cme_student IS NULL) AND (YEAR(cme_due) = " . $year . " OR YEAR(cme_due) = " . ($year + 2).")";
        }
        else if ($exam_type == 'CDQ')
        {
            $query = "SELECT * FROM temp_stats WHERE YEAR(cdq_due) = " . $year . " OR YEAR(cdq_due) = " . ($year + 6);
        }
        else
        {
            $query = "SELECT * FROM " . $this->table_class . " WHERE class_of = " . $year;
        }
        $stmt = $this
            ->conn
            ->getCount($query);
        return $stmt;
    }
    // CME total started year
    public function expected_students_count_cme($exam_type, $year)
    {
        $query = "SELECT user_id, COUNT(user_id) FROM tbl_add_cme WHERE cme_cycle_start = " . ($year - 2) . " GROUP BY user_id HAVING COUNT(user_id) > 1";
        $stmt = $this
            ->conn
            ->getCount($query);
        return number_format($stmt);
    }
    //get Total exam Registered student
    public function get_registered_student($exam_type, $exam_year, $month)
    {
        if ($exam_type == 'CME')
        {
            $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND cme_cycle_start = '" . ($exam_year - 2) . "' AND exam_type = '" . $exam_type . "' ORDER BY action_date DESC";
        }
        else
        {
            if ($month == '0')
            {
                $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND exam_year = " . $exam_year . " AND exam_type = '" . $exam_type . "' ORDER BY action_date DESC";
                // print_r($query); exit;
                
            }
            else
            {
                $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND exam_year = " . $exam_year . " AND exam_mon = '" . $month . "' AND exam_type = '" . $exam_type . "' ORDER BY action_date DESC";
            }
        }
        $stmt = $this
            ->conn
            ->getCount($query);
        return number_format($stmt);
    }
    public function get_registered_student_number_format($exam_type, $exam_year, $month)
    {
        if ($exam_type == 'CME')
        {
            $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND cme_cycle_start = '" . ($exam_year - 2) . "' AND exam_type = '" . $exam_type . "' ORDER BY action_date DESC";
        }
        else
        {
            if ($month == '0')
            {
                $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND exam_year = " . $exam_year . " AND exam_type = '" . $exam_type . "' ORDER BY action_date DESC";
            }
            else
            {
                $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND exam_year = " . $exam_year . " AND exam_mon = '" . $month . "' AND exam_type = '" . $exam_type . "' ORDER BY action_date DESC";
            }
        }
        $stmt = $this
            ->conn
            ->getCount($query);
        return $stmt;
    }
    public function get_registered_student_new($exam_type, $exam_year, $month)
    {
        $year = $exam_year;
        $term_data = $month;
        $type = $exam_type;
        $filter_date = $this->get_all_term_new($year, $term_data);
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
        // $stmt = $this->conn->getData($query);
        $stmt = $this
            ->conn
            ->getCount($query);
        return number_format($stmt);
    }
    public function get_registered_student_new_month($exam_type, $exam_year, $month)
    {
        if ($month == 0)
        {
            $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND exam_type = '" . $exam_type . "' AND exam_year = '" . $exam_year . "' ORDER BY action_date DESC";
        }
        else
        {
            $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND exam_type = '" . $exam_type . "' AND exam_mon = '" . $month . "' AND exam_year = '" . $exam_year . "' ORDER BY action_date DESC";
        }
        // print_r($query); exit;
        $stmt = $this
            ->conn
            ->getCount($query);
        return number_format($stmt);
    }
    public function get_all_term_new($year, $term)
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
    //Get Income category data
    //get first day of current quarter
    public function get_all_term($term)
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
        $week = strtotime("Monday");
        $month = strtotime(date('Y-m-01'));
        $quarter = $start_date;
        if ($term == 'null')
        {
            $result = 'null';
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
            $last_year_start = ('01/01/' . ($current_year - 1));
            $last_year_end = ('01/01/' . $current_year);
            $result = array(
                "",
                $last_year_start,
                $last_year_end
            );
        }
        else
        {
            $month_start = strtotime('1-' . $term . '-' . $current_year);
            $month_end = strtotime(date('Y-m-t', $month_start));
            $result = array(
                "",
                $month_start,
                $month_end
            );
        }
        return $result;
    }
    public function total_count_type_new($exam_type, $term_data)
    {
        $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND receipt_title = '" . $exam_type . "' ORDER BY action_date DESC";
        $stmt = $this
            ->conn
            ->getData($query);
        $sum = 0;
        for ($i = 0;$i < count($stmt);$i++)
        {
            if ($stmt[$i]['exam_type'] == 'Admin')
            {
                $paid_funds = $stmt[$i]['amount_num'];
            }
            $sum = $sum + $paid_funds;
        }
        return number_format($sum);
    }
    //total count by Exam Type
    public function total_count_type($exam_type, $term_data)
    {
        $term = $this->get_all_term($term_data);
        if ($exam_type == 'All')
        {
            $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND action_date > " . $term . " ORDER BY action_date DESC";
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
                $paid_funds = (float)$paid_funds;
                $sum = $sum + $paid_funds;
            }
            return number_format($sum);
        }
        else
        {
            $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND action_date > " . $term . " AND exam_type = '" . $exam_type . "' ORDER BY action_date DESC";
            $stmt = $this
                ->conn
                ->getData($query);
            $sum['CDQ'] = 0;
            $sum['CME'] = 0;
            $sum['Certification'] = 0;
            $sum['Admin'] = 0;
            $sum['ITE'] = 0;
            $sum['Interest'] = 0;
            $sum['Other'] = 0;
            $paid_funds = 0;
            for ($i = 0;$i < count($stmt);$i++)
            {
                if ($stmt[$i]['exam_type'] == 'CDQ')
                {
                    $paid_funds = $this->readCDQAmountNum($stmt[$i]['amount_num']);
                    $sum['CDQ'] = $sum['CDQ'] + $paid_funds;
                }
                if ($stmt[$i]['exam_type'] == 'CME')
                {
                    $paid_funds = $this->readCMEAmountNum($stmt[$i]['amount_num']);
                    $paid_funds = (float)$paid_funds;
                    $sum['CME'] = $sum['CME'] + $paid_funds;
                }
                if ($stmt[$i]['exam_type'] == 'Certification')
                {
                    $paid_funds = $this->readCertAmountNum($stmt[$i]['amount_num']);
                    $sum['Certification'] = $sum['Certification'] + $paid_funds;
                }
                if ($stmt[$i]['exam_type'] == 'ITE')
                {
                    $paid_funds = $stmt[$i]['amount_num'];
                    $sum['ITE'] = $sum['ITE'] + $paid_funds;
                }
                if ($stmt[$i]['exam_type'] == 'Admin')
                {
                    $paid_funds = $stmt[$i]['amount_num'];
                    $sum['Admin'] = $sum['Admin'] + $paid_funds;
                }
                if ($stmt[$i]['exam_type'] == 'Interest')
                {
                    $paid_funds = $stmt[$i]['amount_num'];
                    $sum['Interest'] = $sum['Interest'] + $paid_funds;
                }
                if ($stmt[$i]['exam_type'] == 'Other')
                {
                    $paid_funds = $stmt[$i]['amount_num'];
                    $sum['Other'] = $sum['Other'] + $paid_funds;
                }
            }
            return number_format($sum[$exam_type]);
        }
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
    // read all Certification Financial
    public function readAllCertFinancial()
    {
        $this_year = strtotime('01/01/' . date('Y'));
        $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND action_date >= " . $this_year . " AND exam_type = 'Certification' ORDER BY action_date DESC";
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
        $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND action_date >= " . $this_year . " AND user_id = " . $user_id . " ORDER BY action_date DESC";
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt;
    }
    // read Financial by Exam Type
    public function readFinancialByExamType($data)
    {
        $exam_type = $data;
        $this_year = strtotime('01/01/' . date('Y'));
        $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND action_date >= " . $this_year . " AND exam_type = '" . $exam_type . "' ORDER BY action_date DESC";
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
            "75", //3
            "75"
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
        $d = getdate($num);
        $stmt = $d['mon'] . "/" . $d['mday'] . "/" . substr($d['year'], -2);
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
        $price = explode("$", $data['add_amount']);
        if (count($price) == 1)
        {
            $amount_num = doubleval(str_replace(",", "", $price[0]));
        }
        else if (count($price) == 2)
        {
            $amount_num = doubleval(str_replace(",", "", $price[1]));
        }
        $query = "INSERT INTO " . $this->table_history . " (user_id, first_name, last_name, action_date, action_num, amount_num, exam_mon, exam_year, show_allow, receipt_title, detail_title, cme_cycle_start, exam_type) VALUES ('" . $_SESSION['admin_id'] . "', '" . $data['add_name'] . "', ' ', '" . $d . "', '5', '" . $amount_num . "', '0', '0', '0', '" . $data['add_category'] . "', '0','0','Admin') ";
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
        $price = explode("$", $data['edit_amount']);
        if (count($price) == 1)
        {
            $amount_num = doubleval(str_replace(",", "", $price[0]));
        }
        else if (count($price) == 2)
        {
            $amount_num = doubleval(str_replace(",", "", $price[1]));
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
        $query = "SELECT * FROM " . $this->table_history . " WHERE action_num > 2 AND action_date > " . $this_year . " AND user_id = " . $user_id . " ORDER BY action_date DESC";
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
}
?>
