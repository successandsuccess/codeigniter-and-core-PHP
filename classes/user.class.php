<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
class userObject
{
    public $roles = array(
        'Student',
        'CAA',
        'Director',
        'Employer',
        'Amin'
    );
    public $fields = array();
    public $data = array();
    public $vitals = array();
    public $payment_history = array();
    public $CME_history = array();
    public $CDQ_history = array();
    public $CDQ_income = array();
    public function __construct()
    {
    }
    public function init($user_id = "")
    {
        $this->util = new utilObject;
        $this
            ->util
            ->init();
        $completed_count = 0;
        $profile_count = 12;
        if ($user_id != "")
        {
            $sql = "SELECT * FROM " . $this
                ->util->userTable_login . " WHERE `id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                $this->data["login"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->userTable_account_security_information . " WHERE `user_id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                ++$completed_count;
                $this->data["account_security_information"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->userTable_address_contact_information . " WHERE `user_id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                ++$completed_count;
                $this->data["address_contact_information"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->userTable_add_another_address . " WHERE `user_id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                foreach ($results AS $address)
                {
                    $this->data["additional_address_info"][] = $address;
                }
            }
            $sql = "SELECT * FROM " . $this
                ->util->userTable_employee_skills . " WHERE `user_id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                ++$completed_count;
                $this->data["employee_skills"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->userTable_employer_benefits . " WHERE `user_id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                ++$completed_count;
                $this->data["employer_benefits"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->userTable_employer_compensation . " WHERE `user_id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                ++$completed_count;
                $this->data["employer_compensation"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->userTable_employer_retirement . " WHERE `user_id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                ++$completed_count;
                $this->data["employer_retirement"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->userTable_employment_info . " WHERE `user_id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                ++$completed_count;
                $this->data["employment_info"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->userTable_exam_certification_info . " WHERE `user_id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                $this->data["exam_certification_info"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->userTable_generalinfo . " WHERE `user_id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                ++$completed_count;
                $this->data["generalinfo"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->userTable_other_memberships . " WHERE `user_id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                ++$completed_count;
                $this->data["other_memberships"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->userTable_personal_information . " WHERE `user_id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                ++$completed_count;
                $this->data["personal_information"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->userTable_program_university_info . " WHERE `user_id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                ++$completed_count;
                $this->data["university_info"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->expected_table_dates . " WHERE University_Id=(SELECT University_id FROM " . $this
                ->util->all_table_class . " WHERE user_id=" . $user_id . ") AND class_of_year=(SELECT class_of FROM " . $this
                ->util->all_table_class . " WHERE user_id=" . $user_id . ")";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                ++$completed_count;
                $this->data["university_expected_date"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->student_university . " WHERE id=(SELECT University_id FROM " . $this
                ->util->all_table_class . " WHERE user_id=" . $user_id . ")";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                $this->data["student_university"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->student_university . " WHERE id=(SELECT university_id FROM " . $this
                ->util->userTable_program_university_info . " WHERE user_id=" . $user_id . ")";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                $this->data["caa_university"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->userTable_retirements_previous_employers . " WHERE `user_id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                ++$completed_count;
                $this->data["retirements_previous_employers"] = $results[0];
            }
            $sql = "SELECT * FROM " . $this
                ->util->userTable_psuedo_vitals . " WHERE `user_id`='" . $user_id . "';";
            $results = $this
                ->util
                ->sqlquery($sql);
            if (is_array($results))
            {
                $this->vitals = $results[0];
            }
            $this->status = $this->calculate_status();
            $this->status["profile_completion"] = $completion_percent = sprintf("%02d%%", (($profile_count / $completed_count) * 100));
        }
    }
    public function update($data, $key = "")
    {
        if (($key == "") || ($key == "0"))
        {
            $sql = "INSERT INTO " . $this
                ->util->peopleTable . " ";
            $fieldlist = "";
            $valuelist = "";
            foreach ($data AS $name => $value)
            {
                if ($fieldlist != "") $fieldlist .= ", ";
                $fieldlist .= " `" . $name . "` ";
                if ($valuelist != "") $valuelist .= ", ";
                $valuelist .= " '" . $value . "' ";
                do_trigger($this
                    ->util->peopleTable, $name, 0, $value);
            }
            $sql .= "( " . $fieldlist . " ) VALUES ( " . $valuelist . " );";
        }
        else
        {
            $sql = "UPDATE " . $this
                ->util->peopleTable . " SET ";
            $fieldlist = "";
            foreach ($data AS $name => $value)
            {
                if ($fieldlist != "") $fieldlist .= ", ";
                $fieldlist .= " `" . $name . "`='" . $value . "' ";
                do_trigger($this
                    ->util->peopleTable, $name, $key, $value);
            }
            $sql .= $fieldlist . " WHERE `id`='" . $key . "';";
        }
        $result = $this
            ->util
            ->sqlquery($sql);
        return ($sql);
    }
    public function delete($key)
    {
        do_trigger($this
            ->util->peopleTable, 'status', $key, 'deleted');
        $sql = "UPDATE " . $this
            ->util->peopleTable . " SET `status`='deleted' WHERE `id`='" . $key . "';";
        $result = $this
            ->util
            ->sqlquery($sql);
        do_action('people_delete', $key);
        return ("people delete ( " . $key . " ), sql:" . $sql);
    }
    public function calculate_status()
    {
        $status = array();
        $id_certificate = $this->vitals["id_certificate"];
        if ($id_certificate == "") $id_certificate = "COMING SOON!";
        $status["status"] = $this->data["login"]["role"];
        $status["certificate_status"] = "valid";
        $status["certificate"] = $id_certificate;
        $status["certification_year"] = $this->vitals["first_year"];
        $status["certification_date"] = $this->vitals["certification_date"];
        if (($status["certification_date"] == "") || ($status["certification_date"] == "0000-00-00"))
        {
            $status["certification_date"] = "06/01/" . $status["certification_year"];
        }
        else
        {
            $status["certification_year"] = date("Y", strtotime($status["certification_date"]));
        }
        // if ( strtotime($this->vitals["cme_due"]) < strtotime($this->vitals["cdq_due"]) ) {
        $status["certification_end"] = date("m/d/Y", strtotime($this->vitals["cme_due"]));
        // } else {
        // $status["certification_end"]=date("m/d/Y",strtotime($this->vitals["cdq_due"]));
        // }
        return ($status);
    }
}
?>
