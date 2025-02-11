<?php
session_start();
include("config.php");

if (isset($_POST['login'])) {
  if (isset($_POST['uname']) && isset($_POST['psw'])) {
    $user = $_POST['uname'];
    $password = $_POST['psw'];
    $query = "SELECT * FROM users WHERE ((`user` = '" . $user . "') or (`email` = '" . $user . "')) AND ((password = '" . $password . "') || (temp_password='1'))";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_object($result);
    $ip = '127.0.0.1';

    if (mysqli_num_rows($result) == 1) {
      $_SESSION['user_id'] = $user->id;
      $_SESSION['username'] = $user->user;
      $_SESSION['email'] = $user->email;
      $_SESSION['user_role'] = $user->role;
      $_SESSION['pass'] = $_REQUEST['psw'];

      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
      } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
        $ip = $_SERVER['REMOTE_ADDR'];
      }

      $timestamp = time();
      $dt = new DateTime();
      $dt->setTimezone(new DateTimeZone('America/New_York'));
      $dt->setTimestamp($timestamp);

      $stmt = $con->prepare("INSERT INTO visitors (user_id, full_name, role, email, created_at, browser, ip, os) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("isssssss", $userID, $full_name, $role, $email, $date, $browser, $client_ip, $os);
      $userID = intval($user->id);
      $full_name = $user->full_name;
      $role = $user->role;
      $email = $user->email;
      $date = $dt->format("m/d/y H:i:s");
      $browser = $_POST['browser_info'];
      $client_ip = $ip;
      $os = $_POST['os_info'];
      $stmt->execute();
      $stmt->close();

      if ($user->temp_password == 1) {
        header('Location: profile.php');
      } else {
                //header('Location: ../home.php');
					if(isset($_POST['jim'])){
						if($_POST['jim'] == 'SmltIEZsZXRjaGVy'){
								header('Location: ../');
						}else{
							header('Location: ../index_member.php');
						}
					}else{
						header('Location: ../index_member.php');
					}
      }
    } else {
      //$_SESSION['message'] = "username or password incorrect";
      header('Location: ../../logincaamember.php?errorCode=103');
    }
  }
} elseif (isset($_POST['reset_pwd'])) {
  $new_pwd = $_POST['newpsw'];
  $conf_pwd = $_POST['confpsw'];
  if ($new_pwd != $conf_pwd) {
    $_SESSION['pwd_error'] = "Passwords do not match";
    header('Location: profile.php');
    return;
  }
  $query = "SELECT * FROM users WHERE id = '" . $_SESSION['user_id'] . "'";
  $result = mysqli_query($con, $query);
  if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_object($result);
    if ($user->temp_password == 1) {
      header('Location: ../home.php');
      return;
    }
    $query1 = "UPDATE users SET password = '" . $new_pwd . "',temp_password = 0 WHERE id = '" . $_SESSION['user_id'] . "'";
    $result1 = mysqli_query($con, $query1);
    if ($result1 == 1) {
      $_SESSION['pass'] = $new_pwd;
      header('Location: ../index.php');
    } else {
      $_SESSION['pass'] = $new_pwd;
      header('Location: profile.php');
    }
  } else {
    $_SESSION['pwd_error'] = "Invalid user";
    header('Location: profile.php');
  }
} elseif (isset($_POST['forget'])) {
  if (isset($_POST['ssn']) && isset($_POST['mother_maiden_name'])) {
    $ssn = $_POST['ssn'];
    $mother_maiden_name = $_POST['mother_maiden_name'];
    $query = "SELECT * FROM final_account_security_information WHERE program_code = '" . $ssn . "' AND mother_maiden_name = '" . $mother_maiden_name . "'";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_object($result);
    if (mysqli_num_rows($result) == 1) {
      $uniqid = uniqid();
      //$updte = mysqli_query($con,"UPDATE users SET password = '".$uniqid."' WHERE id = '".$user->user_id."'");
      $query = "SELECT * FROM users WHERE id = '" . $user->user_id . "'";
      $result = mysqli_query($con, $query);
      $user = mysqli_fetch_object($result);


      $to = $user->name;
      $subject = "Forget Password";
      $message = "Your Password Is " . $user->password;
// Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// More headers
      $headers .= 'From: <info@globaltechkyllc.com>' . "\r\n";
      $mail = mail($to, $subject, $message, $headers);
      if (!$mail) {
        header('Location: ../../logincaamember.php?errorCode=106');
      } else {
        header('Location: ../../logincaamember.php?errorCode=205');
      }
    } else {
      //$_SESSION['message'] = "username or password incorrect";
      header('Location: ../../logincaamember.php?errorCode=105');
    }
  }
}
?>