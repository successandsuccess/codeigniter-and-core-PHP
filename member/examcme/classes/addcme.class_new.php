<?php
class AddCMEObject
{
    // database connection and table name
    private $conn;
    private $link;
    private $table_name = "tbl_add_cme";
    private $table_payment = "action_history_cme";
    public function __construct()
    {
        global $db;
        $this->conn = $db;
        global $con;
        $this->link = $con;
    }
    //add cme
    public function insert_cme($data)
    {
        $cme_cycle = $this->readCMECycle();
        $submit_day = getdate();
        //file upload start
        $target_dir = "examcme/uploads/";
        $filename = $_FILES["upload_file"]["name"];
        // print_r($_FILES["upload_file"]); exit;
        $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
        $file_ext = substr($filename, strripos($filename, '.')); // get file name
        $filesize = $_FILES["upload_file"]["size"];
        $allowed_file_types = array(
            '.doc',
            '.docx',
            '.rtf',
            '.pdf',
            '.gif',
            '.jpg',
            '.png',
            '.jpeg'
        );
        if (in_array($file_ext, $allowed_file_types))
        {
            // Rename file
            //$newfilename = md5($file_basename) . $file_ext;
            $newfilename = "cme_" . $submit_day[0] . $file_ext;
            if (file_exists($target_dir . $newfilename))
            {
                // file already exists error
                echo "You have already uploaded this file.";
            }
            else
            {
                move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_dir . $newfilename);
                //echo "File uploaded successfully.";
                
            }
        }
        elseif (empty($file_basename))
        {
            // file selection error
            echo "Please select a file to upload.";
        }
        else
        {
            // file type error
            echo "Only these file typs are allowed for upload: " . implode(', ', $allowed_file_types);
            unlink($_FILES["upload_file"]["tmp_name"]);
        }
        //Both checkbox make sure
        if ($data['cme_check1'] == "on" && $data['cme_check2'] == "on")
        {
            $acknowledgements = 1;
        }
        else
        {
            $acknowledgements = 0;
        }
        ///
        $add_credit_both = 0;
        ///
        if (empty($data['anesthesia_credits']) == false)
        {
            $cme_type = 1;
            // print_r($data); exit;
            $cme_hours = $data['anesthesia_credits'];
            // print_r($cme_hours); exit;
            $cme_hours_parts = explode(" ", $cme_hours);
            if (isset($cme_hours_parts[1]))
            {
                if ($cme_hours_parts[1] == '1/4')
                {
                    $cme_hours_parts[1] = 0.25;
                }
                else if ($cme_hours_parts[1] == '1/2')
                {
                    $cme_hours_parts[1] = 0.5;
                }
                else if ($cme_hours_parts[1] == '3/4')
                {
                    $cme_hours_parts[1] = 0.75;
                }
                $cme_hours = $cme_hours_parts[0] + $cme_hours_parts[1];
            }
            else
            {
                if ($cme_hours == '1/4')
                {
                    $cme_hours = 0.25;
                }
                else if ($cme_hours == '1/2')
                {
                    $cme_hours = 0.5;
                }
                else if ($cme_hours == '3/4')
                {
                    $cme_hours = 0.75;
                }
            }
            // print_r($cme_hours); exit;
            $uploaded_file_name = mysqli_real_escape_string($this->link, $data['file_name']);
            // print_r($uploaded_file_name); exit;
            $query_add1 = "INSERT INTO " . $this->table_name . " (user_id, date_submitted, cme_type, cme_hours, cme_doc, cme_provider, acknowledgements, cme_cycle_start, file_name) VALUES ('" . $_SESSION['user_id'] . "', '" . $submit_day[0] . "', '" . $cme_type . "', '" . $cme_hours . "', '" . $target_dir . $newfilename . "', '" . $data['cme_provider'] . "', '" . $acknowledgements . "', '" . $cme_cycle . "', '" . $uploaded_file_name . "') ";
            if ($this
                ->conn
                ->execute($query_add1))
            {
                $add_credit_both = 1;
            }
        }
        if (empty($data['other_credits']) == false)
        {
            $cme_type = 2;
            $cme_hours = $data['other_credits'];
            $cme_hours_parts = explode(" ", $cme_hours);
            if (isset($cme_hours_parts[1]))
            {
                if ($cme_hours_parts[1] == '1/4')
                {
                    $cme_hours_parts[1] = 0.25;
                }
                else if ($cme_hours_parts[1] == '1/2')
                {
                    $cme_hours_parts[1] = 0.5;
                }
                else if ($cme_hours_parts[1] == '3/4')
                {
                    $cme_hours_parts[1] = 0.75;
                }
                $cme_hours = $cme_hours_parts[0] + $cme_hours_parts[1];
            }
            else
            {
                if ($cme_hours == '1/4')
                {
                    $cme_hours = 0.25;
                }
                else if ($cme_hours == '1/2')
                {
                    $cme_hours = 0.5;
                }
                else if ($cme_hours == '3/4')
                {
                    $cme_hours = 0.75;
                }
            }
            $uploaded_file_name = mysqli_real_escape_string($this->link, $data['file_name']);
            $query_add2 = "INSERT INTO " . $this->table_name . " (user_id, date_submitted, cme_type, cme_hours, cme_doc, cme_provider, acknowledgements, cme_cycle_start, file_name) VALUES ('" . $_SESSION['user_id'] . "', '" . $submit_day[0] . "', '" . $cme_type . "', '" . $cme_hours . "', '" . $target_dir . $newfilename . "', '" . $data['cme_provider'] . "', '" . $acknowledgements . "', '" . $cme_cycle . "', '" . $uploaded_file_name . "') ";
            if ($this
                ->conn
                ->execute($query_add2))
            {
                $add_credit_both = 1;
            }
        }
        if (empty($data['anesthesia_credits']) == true && empty($data['other_credits']) == true)
        {
            // $query_add3 = "INSERT INTO " . $this->table_name . " (user_id, date_submitted, cme_type, cme_hours, cme_doc, cme_provider, acknowledgements, cme_cycle_start) VALUES ('". $_SESSION['user_id'] ."', '". $submit_day[0] ."', '', '', '". $target_dir . $newfilename ."', '". $data['cme_provider'] ."', '". $acknowledgements ."', '". $cme_cycle ."') ";
            // if($this->conn->execute($query_add3)){
            // $add_credit_both = 1;
            // }
            echo "<script>location.href='?content=content/cmeadd';</script>";
        }
        if ($add_credit_both == 1)
        {
            echo "<script>location.href='?content=content/cmehistory';</script>";
        }
        else if ($add_credit_both == 0)
        {
            echo "<script>alert('There was an error adding')</script>";
        }
    }
    //update CME
    public function update_cme($data)
    {
        $cme_cycle = $this->readCMECycle();
        $submit_day = getdate();
        //file upload start
        $target_dir = "examcme/uploads/";
        $filename = $_FILES["upload_file"]["name"];
        // print_r($_FILES["upload_file"]); exit;
        $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
        $file_ext = substr($filename, strripos($filename, '.')); // get file name
        $filesize = $_FILES["upload_file"]["size"];
        $allowed_file_types = array(
            '.doc',
            '.docx',
            '.rtf',
            '.pdf',
            '.gif',
            '.jpg',
            '.png',
            '.jpeg'
        );
        if (in_array($file_ext, $allowed_file_types))
        {
            // Rename file
            //$newfilename = md5($file_basename) . $file_ext;
            $newfilename = "cme_" . $submit_day[0] . $file_ext;
            if (file_exists($target_dir . $newfilename))
            {
                // file already exists error
                echo "You have already uploaded this file.";
            }
            else
            {
                move_uploaded_file($_FILES["upload_file"]["tmp_name"], $target_dir . $newfilename);
                //echo "File uploaded successfully.";
                
            }
        }
        elseif (empty($file_basename))
        {
            // file selection error
            echo "Please select a file to upload.";
        }
        else
        {
            // file type error
            echo "Only these file typs are allowed for upload: " . implode(', ', $allowed_file_types);
            unlink($_FILES["upload_file"]["tmp_name"]);
        }
        //Both checkbox make sure
        if ($data['cme_check1'] == "on" && $data['cme_check2'] == "on")
        {
            $acknowledgements = 1;
        }
        else
        {
            $acknowledgements = 0;
        }
        ///
        $add_credit_both = 0;
        if (empty($data['anesthesia_credits']) == false)
        {
            $cme_type = 1;
            // print_r($data); exit;
            $cme_hours = $data['anesthesia_credits'];
            // print_r($cme_hours); exit;
            $cme_hours_parts = explode(" ", $cme_hours);
            if (isset($cme_hours_parts[1]))
            {
                if ($cme_hours_parts[1] == '1/4')
                {
                    $cme_hours_parts[1] = 0.25;
                }
                else if ($cme_hours_parts[1] == '1/2')
                {
                    $cme_hours_parts[1] = 0.5;
                }
                else if ($cme_hours_parts[1] == '3/4')
                {
                    $cme_hours_parts[1] = 0.75;
                }
                $cme_hours = $cme_hours_parts[0] + $cme_hours_parts[1];
            }
            else
            {
                if ($cme_hours == '1/4')
                {
                    $cme_hours = 0.25;
                }
                else if ($cme_hours == '1/2')
                {
                    $cme_hours = 0.5;
                }
                else if ($cme_hours == '3/4')
                {
                    $cme_hours = 0.75;
                }
            }
            $uploaded_file_name = mysqli_real_escape_string($this->link, $data['file_name']);
            $query_add1 = "UPDATE " . $this->table_name . " SET date_submitted='" . $submit_day[0] . "', cme_type='" . $cme_type . "', cme_hours='" . $cme_hours . "', cme_doc='" . $target_dir . $newfilename . "', acknowledgements='" . $acknowledgements . "', cme_provider='" . $data['cme_provider'] . "', file_name='" . $uploaded_file_name . "' WHERE id=" . $data['id'];
            if ($this
                ->conn
                ->execute($query_add1))
            {
                $add_credit_both = 1;
            }
        }
        if (empty($data['other_credits']) == false)
        {
            $cme_type = 2;
            $cme_hours = $data['other_credits'];
            $cme_hours_parts = explode(" ", $cme_hours);
            if (isset($cme_hours_parts[1]))
            {
                if ($cme_hours_parts[1] == '1/4')
                {
                    $cme_hours_parts[1] = 0.25;
                }
                else if ($cme_hours_parts[1] == '1/2')
                {
                    $cme_hours_parts[1] = 0.5;
                }
                else if ($cme_hours_parts[1] == '3/4')
                {
                    $cme_hours_parts[1] = 0.75;
                }
                $cme_hours = $cme_hours_parts[0] + $cme_hours_parts[1];
            }
            else
            {
                if ($cme_hours == '1/4')
                {
                    $cme_hours = 0.25;
                }
                else if ($cme_hours == '1/2')
                {
                    $cme_hours = 0.5;
                }
                else if ($cme_hours == '3/4')
                {
                    $cme_hours = 0.75;
                }
            }
            $uploaded_file_name = mysqli_real_escape_string($this->link, $data['file_name']);
            $query_add2 = "UPDATE " . $this->table_name . " SET date_submitted='" . $submit_day[0] . "', cme_type='" . $cme_type . "', cme_hours='" . $cme_hours . "', cme_doc='" . $target_dir . $newfilename . "', acknowledgements='" . $acknowledgements . "', cme_provider='" . $data['cme_provider'] . "', file_name='" . $uploaded_file_name . "' WHERE id=" . $data['id'];
            if ($this
                ->conn
                ->execute($query_add2))
            {
                $add_credit_both = 1;
            }
        }
        if (empty($data['anesthesia_credits']) == true && empty($data['other_credits']) == true)
        {
            echo "<script>location.href='?content=content/cmeEdit&&id=" . $data['id'] . "';</script>";
        }
        if ($add_credit_both == 1)
        {
            echo "<script>location.href='?content=content/cmehistory';</script>";
        }
        else if ($add_credit_both == 0)
        {
            echo "<script>alert('There was an error editing')</script>";
        }
    }
    //delete cme record by id
    public function delete_cme_byId($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=" . $id;
        if ($this
            ->conn
            ->execute($query))
        {
            echo "<script>location.href='?content=content/cmehistory';</script>";
        }
        else
        {
            echo "<script>alert('There was an error deleting')</script>";
        }
    }
    // get rows count
    public function countAll($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = " . $id;
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
        $query = "SELECT * FROM " . $this->table_name;
        //print "query:$query<br>\n";
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt;
    }
    // read data by id
    public function readAllById($id, $cme_cycle)
    {
        if ($id != "") $this->id = $id;
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = " . $this->id . " AND cme_cycle_start = " . $cme_cycle . " ORDER BY id DESC";
        //print_r($query);exit;
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt;
    }
    //read data by id of added cme
    public function readByCmeId($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id =" . $id;
        $stmt = $this
            ->conn
            ->getData($query);
        return $stmt;
    }
    //read CME category or type
    public function readCMEType($num)
    {
        $cme_type = array(
            "",
            "Anesthesia",
            "Other"
        );
        return $cme_type[$num];
    }
    //read CME provider
    public function readCMEProvider($num)
    {
        $cme_provider = array(
            "Select",
            "AMA",
            "ACCME",
            "AAPA",
            "AHA – include note “ACLS or PALS instruction only"
        );
        return $cme_provider[$num];
    }
    public function readCreditsCompleted($id, $cme_cycle)
    {
        $total_credits = "";
        $query = "SELECT SUM(cme_hours) as credits_completed FROM " . $this->table_name . " WHERE user_id = " . $id . " AND cme_cycle_start = " . $cme_cycle;
        $stmt = $this
            ->conn
            ->getData($query);
        $credits = $stmt[0]['credits_completed'];
        $int_float = explode('.', $credits);
        if (count($int_float) > 1)
        {
            $credit_int = $int_float[0];
            $credit_float = $int_float[1];
            if ($credit_float == '25')
            {
                $credit_float = "<sup>1</sup>&frasl;<sub>4</sub>";
            }
            else if ($credit_float == '5')
            {
                $credit_float = "<sup>1</sup>&frasl;<sub>2</sub>";
            }
            else if ($credit_float == '75')
            {
                $credit_float = "<sup>3</sup>&frasl;<sub>4</sub>";
            }
            if ($credit_int == 0)
            {
                $total_credits = $credit_float;
            }
            else
            {
                $total_credits = $credit_int . "&nbsp" . $credit_float;
            }
        }
        else
        {
            if (empty($credits))
            {
                $total_credits = 0;
            }
            else
            {
                $total_credits = $credits;
            }
        }
        return $total_credits;
    }
    public function readCreditNum($id, $num, $cme_cycle)
    {

        // this is for 50 credit.
        $today_time_50 = getdate();
        $add_abailable_time_50 = mktime(0, 0, 0, 6, 1, 2020);
        if(  ($today_time_50[0] > $add_abailable_time_50) && ($cme_cycle != 2018 && $cme_cycle != 2019) )
        {
            $query1 = "SELECT SUM(cme_hours) as credits_completed FROM " . $this->table_name . " WHERE user_id = " . $id . " AND cme_type = '1' AND cme_cycle_start = " . $cme_cycle;
            $stmt1 = $this
                ->conn
                ->getData($query1);
            $sum1 = $stmt1[0]['credits_completed'];
            $query2 = "SELECT SUM(cme_hours) as credits_completed FROM " . $this->table_name . " WHERE user_id = " . $id . " AND cme_type = '2' AND cme_cycle_start = " . $cme_cycle;
            $stmt2 = $this
                ->conn
                ->getData($query2);
            $sum2 = $stmt2[0]['credits_completed'];
            $credits = 0;
            if ($num == 1)
            {
                if ($sum1 < 40)
                {
                    $credits = 50 - $sum1;
                }
                else if ($sum1 >= 40 && $sum1 < 50)
                {
                    if ($sum1 + $sum2 <= 50)
                    {
                        $credits = 50 - ($sum1 + $sum2);
                    }
                    else
                    {
                        $credits = 0;
                    }
                }
                else if ($sum1 >= 50)
                {
                    $credits = 0;
                }
            }
            if ($num == 2)
            {
                $credits = 0 - $sum2;
            }
            return $credits;
        }
        else
        {
            $query1 = "SELECT SUM(cme_hours) as credits_completed FROM " . $this->table_name . " WHERE user_id = " . $id . " AND cme_type = '1' AND cme_cycle_start = " . $cme_cycle;
            $stmt1 = $this
                ->conn
                ->getData($query1);
            $sum1 = $stmt1[0]['credits_completed'];
            $query2 = "SELECT SUM(cme_hours) as credits_completed FROM " . $this->table_name . " WHERE user_id = " . $id . " AND cme_type = '2' AND cme_cycle_start = " . $cme_cycle;
            $stmt2 = $this
                ->conn
                ->getData($query2);
            $sum2 = $stmt2[0]['credits_completed'];
            $credits = 0;
            if ($num == 1)
            {
                if ($sum1 < 30)
                {
                    $credits = 40 - $sum1;
                }
                else if ($sum1 >= 30 && $sum1 < 40)
                {
                    if ($sum1 + $sum2 <= 40)
                    {
                        $credits = 40 - ($sum1 + $sum2);
                    }
                    else
                    {
                        $credits = 0;
                    }
                    // if($sum2 < 10){
                    // 	$credits = 40 - ($sum1 + $sum2);
                    // }
                    // else if($sum2 >= 10)
                    // {
                    // 	$credits = 0;
                    // }
                    
                }
                else if ($sum1 >= 40)
                {
                    $credits = 0;
                }
            }
            if ($num == 2)
            {
                $credits = 0 - $sum2;
            }
            return $credits;
        }
    }
    public function readCreditsNeeded($id, $cme_cycle)
    {
        $rest_credits = "";
        $credits = 0;
        $credits = $this->readCreditNum($id, 1, $cme_cycle);
        // print_r($credits); exit;
        if ($credits < 0)
        {
            return 0;
        }
        else
        {
            $int_float = explode('.', $credits);
            if (count($int_float) > 1)
            {
                $credit_int = $int_float[0];
                $credit_float = $int_float[1];
                if ($credit_float == '25')
                {
                    $credit_float = "<sup>1</sup>&frasl;<sub>4</sub>";
                }
                else if ($credit_float == '5')
                {
                    $credit_float = "<sup>1</sup>&frasl;<sub>2</sub>";
                }
                else if ($credit_float == '75')
                {
                    $credit_float = "<sup>3</sup>&frasl;<sub>4</sub>";
                }
                if ($credit_int == 0)
                {
                    $rest_credits = $credit_float;
                }
                else
                {
                    $rest_credits = $credit_int . "&nbsp" . $credit_float;
                }
            }
            else
            {
                if ($credits == 0)
                {
                    $rest_credits = 0;
                }
                else
                {
                    $rest_credits = $credits;
                    if ($rest_credits < 0)
                    {
                        $rest_credits = 0;
                    }
                }
            }
            return $rest_credits;
        }
        $int_float = explode('.', $credits);
        if (count($int_float) > 1)
        {
            $credit_int = $int_float[0];
            $credit_float = $int_float[1];
            if ($credit_float == '25')
            {
                $credit_float = "<sup>1</sup>&frasl;<sub>4</sub>";
            }
            else if ($credit_float == '5')
            {
                $credit_float = "<sup>1</sup>&frasl;<sub>2</sub>";
            }
            else if ($credit_float == '75')
            {
                $credit_float = "<sup>3</sup>&frasl;<sub>4</sub>";
            }
            if ($credit_int == 0)
            {
                $rest_credits = $credit_float;
            }
            else
            {
                $rest_credits = $credit_int . "&nbsp" . $credit_float;
            }
        }
        else
        {
            if ($credits == 0)
            {
                $rest_credits = 0;
            }
            else
            {
                $rest_credits = $credits;
                if ($rest_credits < 0)
                {
                    $rest_credits = 0;
                }
            }
        }
        return $rest_credits;
    }
    public function readCreditsType($id, $num, $cme_cycle)
    {
        $rest_credits = "";
        $credits = $this->readCreditNum($id, $num, $cme_cycle);
        $int_float = explode('.', $credits);
        if (count($int_float) > 1)
        {
            $credit_int = $int_float[0];
            $credit_float = $int_float[1];
            if ($credit_float == '25')
            {
                $credit_float = "<sup>1</sup>&frasl;<sub>4</sub>";
            }
            else if ($credit_float == '5')
            {
                $credit_float = "<sup>1</sup>&frasl;<sub>2</sub>";
            }
            else if ($credit_float == '75')
            {
                $credit_float = "<sup>3</sup>&frasl;<sub>4</sub>";
            }
            if ($credit_int == 0)
            {
                $rest_credits = $credit_float;
            }
            else if ($credit_int < 0)
            {
                $rest_credits = 0;
            }
            else
            {
                $rest_credits = $credit_int . "&nbsp" . $credit_float;
            }
        }
        else
        {
            if (empty($credits))
            {
                $rest_credits = 0;
            }
            else
            {
                $rest_credits = $credits;
            }
        }
        return $rest_credits;
    }
    //get current CME cycle
    public function readCMECycle()
    {
        // echo 444; exit;
        global $userObject;
        // print_r($userObject); exit;
        $cme_cycle_start = date('Y', strtotime($userObject->vitals["cme_due"]));
        $cme_cycle_start = ($cme_cycle_start - 2);
        return $cme_cycle_start;
    }
    public function selectCMECycle($id)
    {
        $query = "SELECT DISTINCT cme_cycle_start FROM " . $this->table_name . " WHERE user_id = " . $id . " ORDER BY cme_cycle_start DESC";
        $stmt = $this
            ->conn
            ->getData($query);
        $cycle = $this->readCMECycle();
        //$credit = $this->readCreditsCompleted($id, $cycle);
        //$select_val = array(($cycle + 2));
        $select_val = array(
            $cycle
        );
        foreach ($stmt as $val)
        {
            if ($select_val[0] != $val['cme_cycle_start'])
            {
                array_push($select_val, $val['cme_cycle_start']);
            }
        }
        return $select_val;
    }
    //get current CME cycle exactly. This is for pay_now button.
    public function readCMECyclePayButton()
    {
        global $userObject;
        $cme_cycle_start = date('Y', strtotime($userObject->vitals["cme_due"]));
        return $cme_cycle_start;
    }
    public function readCMEPaymentVerify($id, $cycle)
    {
        $query = "SELECT * FROM " . $this->table_payment . " where user_id = " . $id . " AND cme_cycle_start = " . $cycle;
        $stmt = $this
            ->conn
            ->getCount($query);
        return $stmt;
    }
}
?>
