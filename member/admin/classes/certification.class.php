<?php
class CertificationExamObject
{
    // database connection and table name
    private $conn;
    private $action_table = "action_history";
    private $action_table_name = "action_history_certification";
    private $table_class = "tbl_class";
    private $table_user = "users";
    private $table_temp_stats = "temp_stats";
    private $table_university_info = "final_program_university_info";
    // object properties
    public $id;
    public function __construct()
    {
        global $db;
        //$db = Database::getInstance();
        $this->conn = $db;
        //$db = new Database;
        //exit(0);
        
    }
    //read action_mon
    public function readActionExamMon($id)
    {
        if ($id == 2)
        {
            $exam_mon = "February";
        }
        if ($id == 6)
        {
            $exam_mon = "June";
        }
        if ($id == 10)
        {
            $exam_mon = "October";
        }
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
            "150.00"
            //7
            
        );
        $stmt = $content[$id];
        return $stmt;
    }
    // read all datas
    public function readAll($date)
    {
        $select_exam_date = getdate(strtotime('2019-01-01'));
        $users = "SELECT id FROM " . $this->table_user;
        $users_id = $this
            ->conn
            ->getData($users);
        foreach ($users_id as $member)
        {
            if (empty($date) == true)
            {
                $query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'];
            }
            if (empty($date) == false && $date == 21)
            {
                $query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=2 AND exam_year=" . ($select_exam_date['year'] + 1);
            }
            if (empty($date) == false && $date == 61)
            {
                $query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=6 AND exam_year=" . ($select_exam_date['year'] + 1);
            }
            if (empty($date) == false && $date == 101)
            {
                $query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=10 AND exam_year=" . ($select_exam_date['year'] + 1);
            }
            if (empty($date) == false && $date == 22)
            {
                $query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=2 AND exam_year=" . ($select_exam_date['year'] + 2);
            }
            if (empty($date) == false && $date == 62)
            {
                $query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=6 AND exam_year=" . ($select_exam_date['year'] + 2);
            }
            if (empty($date) == false && $date == 102)
            {
                $query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=10 AND exam_year=" . ($select_exam_date['year'] + 2);
            }
            if (empty($date) == false && $date == 23)
            {
                $query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=2 AND exam_year=" . ($select_exam_date['year'] + 3);
            }
            if (empty($date) == false && $date == 63)
            {
                $query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=6 AND exam_year=" . ($select_exam_date['year'] + 3);
            }
            if (empty($date) == false && $date == 103)
            {
                $query = "SELECT * FROM " . $this->action_table_name . " where action_num < 6 AND id=(select max(id) from " . $this->action_table_name . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=10 AND exam_year=" . ($select_exam_date['year'] + 3);
            }
            if (empty($this
                ->conn
                ->getData($query)) == false)
            {
                $stmt[$member['id']] = $this
                    ->conn
                    ->getData($query);
            }
        }
        if (empty($stmt) == false)
        {
            return $stmt;
        }
    }
    public function check_cert_score($id)
    {
        $check_sql = "SELECT * FROM " . $this->table_class . " WHERE user_id = '" . $id . "' AND Cert_exam_active = '1' AND Certification_score = '1'";
        if ($this
            ->conn
            ->getCount($check_sql))
        {
            $check_row = $this
                ->conn
                ->getCount($check_sql);
            return $check_row;
        }
        else
        {
            $check_row = 0;
            return $check_row;
        }
    }
    //update action_num
    public function updateActionNum($data)
    {
        $max_sql1 = "SELECT max(id) FROM " . $this->action_table . " WHERE user_id = " . $data['student_id'];
        $max_id1 = $this
            ->conn
            ->getData($max_sql1);
        $max_sql2 = "SELECT max(id) FROM " . $this->action_table_name . " WHERE user_id = " . $data['student_id'];
        $max_id2 = $this
            ->conn
            ->getData($max_sql2);
        $temp_check_query = "SELECT * FROM " . $this->table_temp_stats . " WHERE user_id = '" . $data['student_id'] . "'";
        $temp_check = $this
            ->conn
            ->getCount($temp_check_query);
        //select(default value)
        if ($data['admin_certification_id'] == 0)
        {
            $query1 = "UPDATE " . $this->action_table . " SET action_num = 2 WHERE user_id = " . $data['student_id'] . " AND id = " . $max_id1[0]['max(id)'];
            $query2 = "UPDATE " . $this->action_table_name . " SET action_num = 2 WHERE user_id = " . $data['student_id'] . " AND id = " . $max_id2[0]['max(id)'];
        }
        //pass
        if ($data['admin_certification_id'] == 1)
        {
            if ($temp_check < 1)
            {
                $new_crm_query = "SELECT (MAX(id_crm) + 1) FROM " . $this->table_temp_stats;
                $new_crm_result = $this
                    ->conn
                    ->getData($new_crm_query);
                $new_crm = $new_crm_result[0]['(MAX(id_crm) + 1)'];
                $new_cert_query = "SELECT (MAX(id_certificate) + 1) FROM " . $this->table_temp_stats;
                $new_cert_result = $this
                    ->conn
                    ->getData($new_cert_query);
                $new_cert = $new_cert_result[0]['(MAX(id_certificate) + 1)'];
                $cert_query = "INSERT INTO " . $this->table_temp_stats . " (user_id, id_crm, id_certificate, first_year, certification_date, cdq_due, cme_due, cme_student) VALUES ('" . $data['student_id'] . "', '" . $new_crm . "', '" . $new_cert . "','" . date("Y") . "', '" . (date("Y") + 2) . "-06-01', '" . (date("Y") + 6) . "-06-14', '" . (date("Y") + 2) . "-06-01', '1')";
                $this
                    ->conn
                    ->execute($cert_query);
                $university_query = "SELECT University_id FROM tbl_class WHERE user_id = " . $data['student_id'];
                $university_id_result = $this
                    ->conn
                    ->getData($university_query);
                $university_id = $university_id_result[0]['University_id'];
                $university_info_add = "INSERT INTO " . $this->table_university_info . " 
						(user_id,
						 university_id, 
						 university,
						 university_apt,
						 univerisity_code,
						 university_address,
						 university_state,
						 university_city,
						 university_zip_code,
						 university_phone,
						 univeristy_program_director,
						 univeristy_program_director_last_name,
						 univeristy_program_director_designation,
						 university_phone2,
						 university_school,
						 matric_date,
						 expected_graduation_date,
						 actual_graduation_date,
						 program_length,
						 clinical_length,
						 specialities_training,
						 
						 degree_type1,
						 degree_type2,
						 years_certified,
						 designation,
						 certificate,
						 other_specialities,
						 active,
						 university_photo,
						 one_year_certified,
						 university_email,
						 university_email_conf,
						 university_url,
						 univeristy_program_director_phone,
						 univeristy_program_director_email,
						 univeristy_program_director1,
						 univeristy_program_director_last_name1,
						 univeristy_program_director_designation1,
						 univeristy_program_title1,
						 univeristy_program_director_phone1,
						 univeristy_program_director_email1,
						 univeristy_program_director2,
						 univeristy_program_director_designation2,
						 univeristy_assistant_phone,
						 univeristy_assistant_email,
						 univeristy_photo1,
						 univeristy_photo2,
						 actual_grad_year,
						 university_actual_grad_day,
						 university_actual_grad_year,
						 university_country
						 ) value
						 ('" . $data['student_id'] . "',
						 (SELECT University_id FROM tbl_class WHERE user_id = '" . $data['student_id'] . "'),
						 (SELECT University_Name FROM tbl_university WHERE id = '" . $university_id . "'), 
						 '100',
						 'Provided by admin',
						 (SELECT Program_Address_First FROM tbl_university WHERE id = '" . $university_id . "'),
						 (SELECT Program_State FROM tbl_university WHERE id = '" . $university_id . "'),
						 (SELECT Program_City FROM tbl_university WHERE id = '" . $university_id . "'),
						 (SELECT Program_Zip FROM tbl_university WHERE id = '" . $university_id . "'),
						 '0',
						 '0',
						 '0',
						 '0',
						 '0',
						 '0',
						 '0',
						 '0',
						 '0',
						 '24',
						 '0',
						 '0',
						 'Masters',
						 '0',
						 '0',
						 'MMSc',
						 '0',
						 '0',
						 '1',
						 '0',
						 '0',
						 '0',
						 '0',
						 '0',
						 (SELECT Program_Bus_Phone FROM tbl_university WHERE id = '" . $university_id . "'),
						 '0',
						 '0',
						 '0',
						 'MD',
						 'Medical Director',
						 (SELECT Program_Other_Phone FROM tbl_university WHERE id = '" . $university_id . "'),
						 '0',
						 '0',
						 '0',
						 '0',
						 '0',
						 'Attach in Email',
						 'Attach in Email',
						 '0',
						 '0',
						 '0',
						 'United States'	 
						 )
						 ";
                $this
                    ->conn
                    ->execute($university_info_add);
            }
            $query1 = "UPDATE " . $this->action_table . " SET action_num = 1 WHERE user_id = " . $data['student_id'] . " AND id = " . $max_id1[0]['max(id)'];
            $query2 = "UPDATE " . $this->action_table_name . " SET action_num = 1 WHERE user_id = " . $data['student_id'] . " AND id = " . $max_id2[0]['max(id)'];
            if ($this->check_cert_score($data['student_id']) > 0)
            {
                $certification_query = "UPDATE " . $this->table_user . " SET role = 'CAA' WHERE id = " . $data['student_id'];
            }
            else
            {
                $certification_query = "UPDATE " . $this->table_user . " SET role = 'Student' WHERE id = " . $data['student_id'];
            }
        }
        //fail
        if ($data['admin_certification_id'] == 2)
        {
            if ($temp_check > 0)
            {
                $temp_del_query = "DELETE FROM " . $this->table_temp_stats . " WHERE user_id = '" . $data['student_id'] . "'";
                $this
                    ->conn
                    ->execute($temp_del_query);
                $university_del_query = "DELETE FROM " . $this->table_university_info . " WHERE user_id = '" . $data['student_id'] . "'";
                $this
                    ->conn
                    ->execute($university_del_query);
            }
            $query1 = "UPDATE " . $this->action_table . " SET action_num = 3 WHERE user_id = " . $data['student_id'] . " AND id = " . $max_id1[0]['max(id)'];
            $query2 = "UPDATE " . $this->action_table_name . " SET action_num = 3 WHERE user_id = " . $data['student_id'] . " AND id = " . $max_id2[0]['max(id)'];
            $certification_query = "UPDATE " . $this->table_user . " SET role = 'Student' WHERE id = " . $data['student_id'];
        }
        $this
            ->conn
            ->execute($certification_query);
        $this
            ->conn
            ->execute($query1);
        if ($this
            ->conn
            ->execute($query2))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    //update show_allow
    public function updateShowAllow($data)
    {
        //get admin-label
        $max_admin_sql = "SELECT max(id) FROM " . $this->action_table_name . " WHERE user_id = " . $data['student_id'];
        $max_admin_id = $this
            ->conn
            ->getData($max_admin_sql);
        //get member label
        $max_member_sql = "SELECT max(id) FROM " . $this->action_table_name . " WHERE user_id = " . $data['student_id'] . " AND action_num > 13";
        $max_member_id = $this
            ->conn
            ->getData($max_member_sql);
        //Select(default value)
        if ($data['show_certification_id'] == 0)
        {
            $admin_query = "UPDATE " . $this->action_table_name . " SET show_allow = 0 WHERE user_id = " . $data['student_id'] . " AND id = " . $max_admin_id[0]['max(id)'];
            $member_query = "UPDATE " . $this->action_table_name . " SET show_allow = 0 WHERE user_id = " . $data['student_id'] . " AND id = " . $max_member_id[0]['max(id)'];
        }
        //show
        if ($data['show_certification_id'] == 1)
        {
            $admin_query = "UPDATE " . $this->action_table_name . " SET show_allow = 1 WHERE user_id = " . $data['student_id'] . " AND id = " . $max_admin_id[0]['max(id)'];
            $member_query = "UPDATE " . $this->action_table_name . " SET show_allow = 1 WHERE user_id = " . $data['student_id'] . " AND id = " . $max_member_id[0]['max(id)'];
        }
        //No show(default value)
        if ($data['show_certification_id'] == 2)
        {
            $admin_query = "UPDATE " . $this->action_table_name . " SET show_allow = 2, action_num = 5 WHERE user_id = " . $data['student_id'] . " AND id = " . $max_admin_id[0]['max(id)'];
            $member_query = "UPDATE " . $this->action_table_name . " SET show_allow = 2 WHERE user_id = " . $data['student_id'] . " AND id = " . $max_member_id[0]['max(id)'];
        }
        //print_r($member_query);exit;
        $this
            ->conn
            ->execute($admin_query);
        if ($this
            ->conn
            ->execute($member_query))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
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
}
?>
