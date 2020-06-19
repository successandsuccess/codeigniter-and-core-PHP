<?php
class ExamObject {
    // database connection and table name
    private $conn;
    private $table_action = "action_history_cdq";
    private $table_history = "action_history";
    private $table_temp = "temp_stats";
    private $table_user = "users";
    // object properties
    public $id;
    public function __construct() {
        global $db;
        $this->conn = $db;
    }
    //read action_mon
    public function readActionExamMon($id) {
        if ($id == 2) {
            $exam_mon = "Feb";
        }
        if ($id == 6) {
            $exam_mon = "June";
        }
        $stmt = $exam_mon;
        return $stmt;
    }
    //read action_amount
    public function readActionAmount($id) {
        $content = array("", "1,000.00", //1
        "1,327.50", //2
        "150.00", //3
        "150.00"
        //4
        );
        $stmt = $content[$id];
        return $stmt;
    }


    // read all datas
    public function readAll($date) {

        $covid_extended_users_id = [
            9
            ,21
            ,46
            ,52
            ,56
            ,87
            ,88
            ,90
            ,92
            ,100
            ,128
            ,180
            ,217
            ,222
            ,230
            ,258
            ,266
            ,287
            ,290
            ,291
            ,295
            ,311
            ,346
            ,360
            ,406
            ,443
            ,448
            ,468
            ,484
            ,486
            ,490
            ,519
            ,522
            ,559
            ,569
            ,597
            ,598
            ,601
            ,611
            ,665
            ,668
            ,687
            ,689
            ,690
            ,778
            ,787
            ,788
            ,855
            ,881
            ,908
            ,928
            ,944
            ,965
            ,979
            ,1005
            ,1010
            ,1015
            ,1028
            ,1044
            ,1054
            ,1060
            ,1066
            ,1084
            ,1094
            ,1095
            ,1112
            ,1129
            ,1145
            ,1149
            ,1174
            ,1202
            ,1219
            ,1284
            ,1291
            ,1292
            ,1294
            ,1296
            ,1302
            ,1334
            ,1342
            ,1360
            ,1361
            ,1366
            ,1367
            ,1382
            ,1388
            ,1439
            ,1441
            ,1480
            ,1482
            ,1490
            ,1503
            ,1562
            ,1584
            ,1589
            ,1602
            ,1615
            ,1629
            ,1637
            ,1646
            ,1655
            ,1682
            ,1690
            ,1703
            ,1778
            ,1797
            ,1817
            ,1828
            ,1830
            ,1865
            ,1873
            ,1901
            ,1905
            ,1926
            ,1927
            ,1934
            ,1945
            ,1961
            ,2000
            ,2014
            ,2018
            ,2067
            ,2103
            ,2118
            ,2136
            ,2162
            ,2175
            ,2194
            ,2200
            ,2202
            ,2230
            ,2236
            ,2274
            ,2275
            ,2284
            ,2297
            ,2298
            ,2303
            ,2344
            ,2390
            ,2402
            ,2426
            ,2435
            ,2445
            ,2475
            ,2530
            ,2539
            ,2546
            ,2553
            ,2563
            ,2569
            ,2586
            ,3045
            ,3054
            ,3103
            ,3112
            ,3113
            ,3114
            ]; 


        $select_exam_date = getdate(strtotime('2019-01-01'));
        $users = "SELECT id FROM " . $this->table_user;
        $users_id = $this->conn->getData($users);
        foreach ($users_id as $member) {
            if (empty($date) == true) {
                $query = "SELECT * FROM " . $this->table_action . " where action_num < 6 AND id=(select max(id) from " . $this->table_action . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'];
            }
            if (empty($date) == false && $date == 21) {
                $query = "SELECT * FROM " . $this->table_action . " where action_num < 6 AND id=(select max(id) from " . $this->table_action . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=2 AND exam_year=" . ($select_exam_date['year'] + 1);
            }
            if (empty($date) == false && $date == 61) {
                if ( in_array($member['id'], $covid_extended_users_id) )
                {
                    $query = "SELECT * FROM " . $this->table_action . " where action_num < 6 AND id=(select max(id) from " . $this->table_action . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=2 AND exam_year=" . ($select_exam_date['year'] + 2);
                }
                else
                {
                    $query = "SELECT * FROM " . $this->table_action . " where action_num < 6 AND id=(select max(id) from " . $this->table_action . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=6 AND exam_year=" . ($select_exam_date['year'] + 1);
                }
            }
            if (empty($date) == false && $date == 22) {

                if ( in_array($member['id'], $covid_extended_users_id) )
                {
                    $query = "SELECT * FROM " . $this->table_action . " where action_num < 6 AND id=(select max(id) from " . $this->table_action . " WHERE user_id=" . $member['id'] . ") AND user_id=999999 AND exam_mon=2 AND exam_year=" . ($select_exam_date['year'] + 2);
                }
                else
                {
                    $query = "SELECT * FROM " . $this->table_action . " where action_num < 6 AND id=(select max(id) from " . $this->table_action . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=2 AND exam_year=" . ($select_exam_date['year'] + 2);
                }
            }
            if (empty($date) == false && $date == 62) {
                $query = "SELECT * FROM " . $this->table_action . " where action_num < 6 AND id=(select max(id) from " . $this->table_action . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=6 AND exam_year=" . ($select_exam_date['year'] + 2);
            }
            if (empty($date) == false && $date == 23) {
                $query = "SELECT * FROM " . $this->table_action . " where action_num < 6 AND id=(select max(id) from " . $this->table_action . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=2 AND exam_year=" . ($select_exam_date['year'] + 3);
            }
            if (empty($date) == false && $date == 63) {
                $query = "SELECT * FROM " . $this->table_action . " where action_num < 6 AND id=(select max(id) from " . $this->table_action . " WHERE user_id=" . $member['id'] . ") AND user_id=" . $member['id'] . " AND exam_mon=6 AND exam_year=" . ($select_exam_date['year'] + 3);
            }
      
            if (empty($this->conn->getData($query)) == false && $query != "" ) {
                $stmt[$member['id']] = $this->conn->getData($query);
            }
         
        }
        if (empty($stmt) == false) {
            return $stmt;
        }
    }
    //update action_num
    public function updateActionNum($data) {
        $max_sql = "SELECT max(id), exam_year FROM " . $this->table_action . " WHERE user_id = " . $data['id'];
        $max_id = $this->conn->getData($max_sql);
        $max_sql_history = "SELECT max(id) FROM " . $this->table_history . " WHERE exam_type = 'CDQ' AND user_id = " . $data['id'];
        $max_id_history = $this->conn->getData($max_sql_history);
        //select(default value)
        if ($data['select_id'] == 0) {
            $query = "UPDATE " . $this->table_action . " SET action_num = 2 WHERE user_id = " . $data['id'] . " AND id = " . $max_id[0]['max(id)'];
            $query_history = "UPDATE " . $this->table_history . " SET action_num = 2 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = " . $max_id_history[0]['max(id)'];
        }
        //pass
        if ($data['select_id'] == 1) {
            $query = "UPDATE " . $this->table_action . " SET action_num = 1 WHERE user_id = " . $data['id'] . " AND id = " . $max_id[0]['max(id)'];
            $query_history = "UPDATE " . $this->table_history . " SET action_num = 1 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = " . $max_id_history[0]['max(id)'];
            // $query_temp = "UPDATE " . $this->table_temp . " SET cdq_due = '" . ($max_id[0]['exam_year'] + 6) . "-06-01' WHERE user_id = " . $data['id'];
            $query_temp = "UPDATE " . $this->table_temp . " SET cdq_due = '" . ($max_id[0]['exam_year'] + 10) . "-06-01' WHERE user_id = " . $data['id'];
        }
        //fail
        if ($data['select_id'] == 2) {
            $query = "UPDATE " . $this->table_action . " SET action_num = 3 WHERE user_id = " . $data['id'] . " AND id = " . $max_id[0]['max(id)'];
            $query_history = "UPDATE " . $this->table_history . " SET action_num = 3 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = " . $max_id_history[0]['max(id)'];
            $query_temp = "UPDATE " . $this->table_temp . " SET cdq_due = '" . $max_id[0]['exam_year'] . "-06-01' WHERE user_id = " . $data['id'];
        }
        $this->conn->execute($query_history);
        $this->conn->execute($query_temp);
        if ($this->conn->execute($query)) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }
    //update show_allow
    public function updateShowAllow($data) {
        //get admin-label
        $max_admin_sql = "SELECT max(id) FROM " . $this->table_action . " WHERE user_id = " . $data['id'];
        $max_admin_id = $this->conn->getData($max_admin_sql);
        //get member label
        $max_member_sql = "SELECT max(id) FROM " . $this->table_action . " WHERE user_id = " . $data['id'] . " AND action_num > 5";
        $max_member_id = $this->conn->getData($max_member_sql);
        //get admin-label_history
        $admin_sql_history = "SELECT max(id) FROM " . $this->table_history . " WHERE exam_type = 'CDQ' AND user_id = " . $data['id'];
        $admin_history = $this->conn->getData($admin_sql_history);
        //get member label_history
        $member_sql_history = "SELECT max(id) FROM " . $this->table_history . " WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND action_num > 5";
        $member_history = $this->conn->getData($member_sql_history);
        //Select(default value)
        if ($data['show_id'] == 0) {
            $admin_query = "UPDATE " . $this->table_action . " SET show_allow = 0 WHERE user_id = " . $data['id'] . " AND id = " . $max_admin_id[0]['max(id)'];
            $member_query = "UPDATE " . $this->table_action . " SET show_allow = 0 WHERE user_id = " . $data['id'] . " AND id = " . $max_member_id[0]['max(id)'];
            $admin_query_history = "UPDATE " . $this->table_history . " SET show_allow = 0 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = " . $admin_history[0]['max(id)'];
            $member_query_history = "UPDATE " . $this->table_history . " SET show_allow = 0 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = " . $member_history[0]['max(id)'];
        }
        //show
        if ($data['show_id'] == 1) {
            $admin_query = "UPDATE " . $this->table_action . " SET show_allow = 1 WHERE user_id = " . $data['id'] . " AND id = " . $max_admin_id[0]['max(id)'];
            $member_query = "UPDATE " . $this->table_action . " SET show_allow = 1 WHERE user_id = " . $data['id'] . " AND id = " . $max_member_id[0]['max(id)'];
            $admin_query_history = "UPDATE " . $this->table_history . " SET show_allow = 1 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = " . $admin_history[0]['max(id)'];
            $member_query_history = "UPDATE " . $this->table_history . " SET show_allow = 1 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = " . $member_history[0]['max(id)'];
        }
        //No show(default value)
        if ($data['show_id'] == 2) {
            $admin_query = "UPDATE " . $this->table_action . " SET show_allow = 2, action_num = 5 WHERE user_id = " . $data['id'] . " AND id = " . $max_admin_id[0]['max(id)'];
            $member_query = "UPDATE " . $this->table_action . " SET show_allow = 2 WHERE user_id = " . $data['id'] . " AND id = " . $max_member_id[0]['max(id)'];
            $admin_query_history = "UPDATE " . $this->table_history . " SET show_allow = 2 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = " . $admin_history[0]['max(id)'];
            $member_query_history = "UPDATE " . $this->table_history . " SET show_allow = 2 WHERE exam_type = 'CDQ' AND user_id = " . $data['id'] . " AND id = " . $member_history[0]['max(id)'];
        }
        $this->conn->execute($admin_query_history);
        $this->conn->execute($member_query_history);
        $this->conn->execute($admin_query);
        if ($this->conn->execute($member_query)) {
            return true;
        } else {
            return false;
        }
    }
    public function expectedExamDate($month, $year, $type) {
        if ($month == 2) {
            $master_month = "February";
        } else {
            $master_month = "June";
		}
		//past version
        if ($type == 'day') {
            return date('j', strtotime('second saturday of ' . $master_month . ' ' . $year));
        } else if ($type == 'full') {
            return date('F j, Y', strtotime('second saturday of ' . $master_month . ' ' . $year));
        } else if ($type == 'due') {
            return date('n/j/Y', strtotime('second saturday of ' . $master_month . ' ' . $year));
        } else if ($type == 'retake_due') {
            return date('n/j/Y', (strtotime('second saturday of ' . $master_month . ' ' . $year) - 24 * 3600));
		}
		
		// if ($type == 'day') {
        //     return date('j', strtotime('first day of ' . $master_month . ' ' . $year));
        // } else if ($type == 'full') {
        //     return date('F j, Y', strtotime('first day of ' . $master_month . ' ' . $year));
        // } else if ($type == 'due') {
        //     return date('n/j/Y', strtotime('first day of ' . $master_month . ' ' . $year));
        // } else if ($type == 'retake_due') {
        //     return date('n/j/Y', (strtotime('first day of ' . $master_month . ' ' . $year) - 24 * 3600));
        // }
    }
    public function expectedExamDateForCME($month, $year, $type) {
        if ($month == 2) {
            $master_month = "February";
        } else {
            $master_month = "June";
		}

		if ($type == 'day') {
            return date('j', strtotime('first day of ' . $master_month . ' ' . $year));
        } else if ($type == 'full') {
            return date('F j, Y', strtotime('first day of ' . $master_month . ' ' . $year));
        } else if ($type == 'due') {
            return date('n/j/Y', strtotime('first day of ' . $master_month . ' ' . $year));
        } else if ($type == 'retake_due') {
            return date('n/j/Y', (strtotime('first day of ' . $master_month . ' ' . $year) - 24 * 3600));
        }
    }
}
?>