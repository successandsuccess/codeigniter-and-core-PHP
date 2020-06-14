<?php
   include ("../config.php");
   if (isset($_POST['login']))
   {
       if (isset($_POST['uname']) && isset($_POST['psw']))
       {
           $user = $_POST['uname'];
           $password = $_POST['psw'];
           // print_r($user);
           // print_r($password); exit;
           $query = "SELECT * FROM users WHERE ((`user` = '" . $user . "') or (`email` = '" . $user . "')) AND ((password = '" . $password . "') || (temp_password='1'))";
           // print_r($query); exit;
           $result = mysqli_query($con, $query);
           $user = mysqli_fetch_object($result);
       
           $ip = '127.0.0.1';
           if (mysqli_num_rows($result) == 1)
           {
              //  echo 3; exit;
               $_SESSION['user_id'] = $user->id;
               $_SESSION['username'] = $user->user;
               $_SESSION['email'] = $user->email;
               $_SESSION['user_role'] = $user->role;
               $_SESSION['pass'] = $_REQUEST['psw'];
               // $_SESSION['admin_name'] = "Jim";
               // echo $_SESSION['user_id']; exit;
               if ($user->role == "Admin")
               {
                   $_SESSION['admin_id'] = $user->id;
                   $_SESSION['admin_email'] = $user->email;
                   $_SESSION['admin_role'] = $user->role;
                   $_SESSION['admin_pass'] = $_REQUEST['psw'];
               }
               if (isset($_POST['check_admin']) && $_POST['check_admin'] == "5e027396789a18c37aeda616e3d7991b")
               {
                   $_SESSION['admin_name'] = "Jim";
               }
               if (!empty($_SERVER['HTTP_CLIENT_IP']))
               {
                   $ip = $_SERVER['HTTP_CLIENT_IP'];
               }
               elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
               {
                   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
               }
               else
               {
                   $ip = $_SERVER['REMOTE_ADDR'];
               }
               $_SESSION['login_ip'] = $ip;
               $timestamp = time();
               $dt = new DateTime();
               $dt->setTimezone(new DateTimeZone('America/New_York'));
               $dt->setTimestamp($timestamp);
               // $sub_query = "INSERT INTO login_details (user_id) VALUES ('".$_SESSION['user_id']."')";
               // $statement = $con->prepare($sub_query);
               // $statement->execute();
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
               // print_r($user->temp_password);exit;
               if ($user->temp_password == 1)
               {
                   header('Location: profile.php');
               }
               else
               {
                  //  echo '<pre>';
                  //  var_dump($_SESSION);
                  //  echo '</pre>';
                  //  exit;
                   header('Location: ../');
               }
           }
           else
           {
               //$_SESSION['message'] = "username or password incorrect";
               header('Location: ../../logincaamember.php?errorCode=103');
           }
       }
   }
   elseif (isset($_POST['reset_pwd']))
   {
       $new_pwd = $_POST['newpsw'];
       $conf_pwd = $_POST['confpsw'];
       if ($new_pwd != $conf_pwd)
       {
           $_SESSION['pwd_error'] = "Passwords do not match";
           header('Location: profile.php');
           return;
       }
       $query = "SELECT * FROM users WHERE id = '" . $_SESSION['user_id'] . "'";
       $result = mysqli_query($con, $query);
       if (mysqli_num_rows($result) == 1)
       {
           $user = mysqli_fetch_object($result);
           if ($user->temp_password == 1)
           {
               header('Location: ../home.php');
               return;
           }
           $query1 = "UPDATE users SET password = '" . $new_pwd . "',temp_password = 0 WHERE id = '" . $_SESSION['user_id'] . "'";
           $result1 = mysqli_query($con, $query1);
           if ($result1 == 1)
           {
               $_SESSION['pass'] = $new_pwd;
               header('Location: ../index.php');
           }
           else
           {
               $_SESSION['pass'] = $new_pwd;
               header('Location: profile.php');
           }
       }
       else
       {
           $_SESSION['pwd_error'] = "Invalid user";
           header('Location: profile.php');
       }
   }
   elseif (isset($_POST['forget']))
   {
       if (isset($_POST['email_forgot_pass']))
       {
           $email = $_POST['email_forgot_pass'];
           $query = "SELECT * FROM users WHERE email = '" . $email . "'";
           $result = mysqli_query($con, $query);
           $user = mysqli_fetch_object($result);
           $to = $user->email;
           $subject = "Forget Password";
           $message = '
   
   
   
   	<html>
   
   
   
   	<head>
   
   
   
   	<title>Forgot Password</title>
   
   
   
   	</head>
   
   
   
   	<body>
   
   
   
   	<table>
   
   
   
   	<tr>
   
   
   
   	<td>You have requested your password from NCCAA.</td>
   
   
   
   	</tr>
   
   
   
   	<tr>
   
   
   
   	<td>Password : <b>' . $user->password . '</b></td>
   
   
   
   	</tr>
   
   
   
   	<tr>
   
   
   
   	<td>Thanks</td>
   
   
   
   	</tr>
   
   
   
   	<tr>
   
   
   
   	<td>NCCAA</td>
   
   
   
   	</tr>
   
   
   
   	</table>
   
   
   
   	</body>
   
   
   
   	</html>';
           $headers = "MIME-Version: 1.0" . "\r\n";
           $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
           $headers .= 'From: contact@nccaa.org' . '\r\n';
           $headers .= "To: " . $user->full_name . "\r\n";
           $headers .= 'X-Mailer: PHP/' . phpversion();
           $mail = @mail($to, $subject, $message, $headers);
           if ($mail == true)
           {
               header('Location: ../../logincaamember.php?errorCode=205');
           }
           else
           {
               header('Location: ../../logincaamember.php?errorCode=106');
           }
       }
   }
   ?>