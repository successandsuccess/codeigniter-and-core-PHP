<?php
session_start();
include ("./config.php");
if (isset($_POST['other_membership_submit']))
{
    if ($_POST['national'] || $_POST['StateLevel_Assistants'] || $_POST['national1'] || $_POST['StateLevel_Anesthesiologists'])
    {
    }
    else
    {
    }
}
if (!isset($_POST['teach_or_environment']))
{
    $_POST['teach_or_environment'] = "No";
}
if (!isset($_POST['teach_healthcare_or']))
{
    $_POST['teach_healthcare_or'] = "No";
}
$key_array = array(
    "",
    "password",
    "username",
    "useremail",
    "img_data"
);
if (isset($_POST['id_crm']))
{
    $sqlf = "select * from final_generalinform where user_id=" . $_SESSION['user_id'];
    $resultf = mysqli_query($con, $sqlf);
    $infof = mysqli_fetch_object($resultf);
    $sql4_uf = "select * from users where id=" . $_SESSION['user_id'];
    $result4_uf = mysqli_query($con, $sql4_uf);
    $user_informationf = mysqli_fetch_object($result4_uf);
    $from = $user_informationf->email;
    $to1 = 'cynthiarc422@gmail.com';
    $to2 = 'contact@nccaa.org';
    $to3 = 'jimfletcher@email.com';
    $subject = "Name/Email change";
    $headers = "From:" . $from;
	$message = "Admin,\nThe following user has made changes to their personal info \n\n\n";
    if ($_POST['f_name'] != $infof->f_name || $_POST['m_name'] != $infof->m_name || $_POST['l_name'] != $infof->l_name || $_POST['useremail'] != $user_informationf->email)
    {
		$message .= "User ID: ". $infof->user_id . "\n";
        if ($_POST['f_name'] != $infof->f_name)
        {
            $message .= "First Name (" . $_POST['f_name'] . ") \n";
        }
        else
        {
            $message .= "First Name \n";
        }
        if ($_POST['m_name'] != $infof->m_name)
        {
            $message .= "Middle Name (" . $_POST['m_name'] . ") \n";
        }
        else
        {
            $message .= "Middle Name \n";
        }
        if ($_POST['l_name'] != $infof->l_name)
        {
            $message .= "Last Name (" . $_POST['l_name'] . ") \n";
        }
        else
        {
            $message .= "Last Name \n";
        }
        if ($_POST['useremail'] != $user_informationf->email)
        {
            $message .= "Email (" . $_POST['useremail'] . ") \n";
        }
        else
        {
            $message .= "Email \n";
        }
        mail($to1, $subject, $message, $headers);
        mail($to2, $subject, $message, $headers);
        mail($to3, $subject, $message, $headers);
    }
}
foreach ($_POST as $key => $value)
{
    if ($key == "password")
    {
        $_SESSION['pass'] = $value;
        $update = mysqli_query($con, "UPDATE users SET password = '" . $value . "' WHERE id = '" . $_SESSION['user_id'] . "'");
    }
    if ($key == "username")
    {
        $update = mysqli_query($con, "UPDATE users SET user = '$value' WHERE id = '" . $_SESSION['user_id'] . "'");
    }
    if ($key == "useremail")
    {
        $update = mysqli_query($con, "UPDATE users SET email = '$value' WHERE id = '" . $_SESSION['user_id'] . "'");
    }
    if ($key == "alma_mater")
    {
        $update = mysqli_query($con, "UPDATE final_program_university_info SET university_id = '$value', university = (SELECT University_Name FROM tbl_university WHERE id = '$value') WHERE user_id = '" . $_SESSION['user_id'] . "'");
    }
    if (!empty($_FILES['university_photo']['name']))
    {
        $total = count($_FILES['university_photo']['name']);
        for ($i = 0;$i < $total;$i++)
        {
            $tmpFilePath = $_FILES['university_photo']['tmp_name'][$i];
            if ($tmpFilePath != "")
            {
                $newFilePath = __DIR__ . '/../upload/university_photo/' . $_FILES['university_photo']['name'][$i];
                if (move_uploaded_file($tmpFilePath, $newFilePath))
                {
                    $key = 'university_photo';
                    $value = implode(',', $_FILES["university_photo"]['name']);
                }
            }
        }
        if (move_uploaded_file($_FILES['university_photo']['tmp_name'], __DIR__ . '/../upload/university_photo/' . $_FILES["university_photo"]['name']))
        {
        }
    }
    if (isset($_POST['img_data']) && $_POST['img_data'] == 0)
    {
        $value = '';
        $key = 'university_photo';
    }
    if (!empty($_FILES['univeristy_photo1']))
    {
        if (move_uploaded_file($_FILES['univeristy_photo1']['tmp_name'], __DIR__ . '/../upload/univeristy_photo1/' . $_FILES["univeristy_photo1"]['name']))
        {
            $key = 'univeristy_photo1';
            $value = $_FILES["univeristy_photo1"]['name'];
        }
    }
    if (!empty($_FILES['univeristy_photo2']))
    {
        if (move_uploaded_file($_FILES['univeristy_photo2']['tmp_name'], __DIR__ . '/../upload/univeristy_photo2/' . $_FILES["univeristy_photo2"]['name']))
        {
            $key = 'univeristy_photo2';
            $value = $_FILES["univeristy_photo2"]['name'];
        }
    }
    if ($key == 'employer_offer_benefit' || $key == 'type_setting_1' || $key == 'type_setting_2' || $key == 'retirement_setup_plan' || $key == 'all_specialities_techniques' || $key == 'StateLevel_Anesthesiologists' || $key == 'StateLevel_Assistants')
    {
        if (!empty($value))
        {
            $value = implode(',', $value);
        }
    }
    if (!array_search($key, $key_array))
    {
        $query = "SELECT DISTINCT TABLE_NAME 



				  FROM INFORMATION_SCHEMA.COLUMNS



				  WHERE COLUMN_NAME IN ('$key')



				  AND TABLE_SCHEMA='$db'";
        $run_qry = mysqli_query($con, $query);
        for ($t = 0;$t < $run_qry->num_rows;$t++)
        {
            $table = "";
            $table = mysqli_fetch_array($run_qry);
            if (count(explode("final_", $table[0])) > 1)
            {
                $table[0] = $table[0];
                $sql = "SHOW FULL FIELDS FROM " . $table[0] . " WHERE FIELD = 'user_id'";
                $run_qry = mysqli_query($con, $sql);
                $table1 = mysqli_num_rows($run_qry);
                if (!empty($table1))
                {
                    $table = $table[0];
                    $q = 'DESCRIBE ' . $table . ';';
                    $run_q = mysqli_query($con, $q);
                    while ($row = mysqli_fetch_array($run_q))
                    {
                        if ($row['Field'] == $key)
                        {
                            if (($row['Type'] == 'date') || ($row['Type'] == 'datetime'))
                            {
                                $value = date("Y-m-d H:i:s", strtotime($value));
                            }
                        }
                    }
                    $chk = mysqli_query($con, "SELECT user_id FROM $table WHERE user_id = '" . $_SESSION['user_id'] . "'") or die(mysqli_error($con));
                    $count = mysqli_num_rows($chk);
                    if (!empty($count))
                    {
                        if (empty($value) == true || $value == "")
                        {
                        }
                        $update = mysqli_query($con, "UPDATE $table SET $key = '$value' WHERE user_id = '" . $_SESSION['user_id'] . "'") or die(mysqli_error($con));
                    }
                    else
                    {
                        $stmt = mysqli_prepare($con, "INSERT INTO $table SET $key = ?,user_id =  ?");
                        mysqli_stmt_bind_param($stmt, 'si', $value, $_SESSION['user_id']);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                    }
                }
            }
        }
    }
}
$tab = $_GET['tab'];
if (mysqli_affected_rows($con) > 0)
{
    header('Location: ../form.php?tab=' . $tab);
}
else
{
    header('Location: ../form.php?tab=' . $tab);
}
?>
