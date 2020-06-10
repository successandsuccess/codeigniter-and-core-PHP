<?php
session_start();
include("../config.php");

if (isset($_POST['errorsubmission'])) 
{
  if (isset($_POST['uname']) && isset($_POST['email']) &&  isset($_POST['date']) && isset($_POST['issue']) && isset($_POST['hardware']) && isset($_POST['browser'])) 
  {
    $uname = $_POST['uname'];
    $date = $_POST['date'];
    $issue = $_POST['issue'];
    $email = $_POST['email'];
    //file upload start
    if(isset($_FILES["upload_file"]))
    {
        $submit_day = getdate();
        $target_dir = "upload/error/";
        $filename = $_FILES["upload_file"]["name"];
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
            $newfilename = "error_" . $submit_day[0] . $file_ext;
            if (file_exists($target_dir . $newfilename))
            {
                // file already exists error
                echo "You have already uploaded this file.";
            }
            else
            {
                if(move_uploaded_file($_FILES["upload_file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']. "/"."member/" .$target_dir . $newfilename)){
                    $file = $target_dir . $newfilename;
                }
                else {
                  echo "Not uploaded because of error :# ".$_FILES["upload_file"]["error"]; exit;
                }
            }
        }
        elseif (empty($file_basename))
        {
            $file = '';
        }
        else
        {
            // file type error
            echo "Only these file typs are allowed for upload: " . implode(', ', $allowed_file_types);
            unlink($_FILES["upload_file"]["tmp_name"]);
        }

    }
    //end file upload
    $hardware = $_POST['hardware'];
    $browser = $_POST['browser'];
    $browser_version = '';
    if(isset($_POST['browser_version']))
    {
        $browser_version = $_POST['browser_version'];
    }
    $platform = '';
    if(isset($_POST['platform']))
    {
        $platform = $_POST['platform'];
    }
    $connection = '';
    if(isset($_POST['connection']))
    {
        $connection = $_POST['connection'];
    }
    $screen_size = '';
    if(isset($_POST['screen_size']))
    {
        $screen_size = $_POST['screen_size'];
    }
    
    $query = "SELECT * FROM errorsubmission WHERE uname='".$uname. "' AND email='". $email ."' AND addeddate='".$date."' AND issue='".$issue."' AND attachedfile='".$file."' AND hardware='".$hardware."' AND browser='".$browser."' AND browser_version='".$browser_version."' AND platform='".$platform."' AND connection='".$connection."' AND screen_size='".$screen_size."'";
    $result = mysqli_query($con, $query);
    $errorlog = mysqli_fetch_object($result);
    if(mysqli_num_rows($result) == 1) 
    {
        header('Location: ../../errorsubmission.php?errorCode=104');
    } 
      $stmt = $con->prepare("INSERT INTO errorsubmission (uname, email, addeddate, issue, attachedfile, hardware, browser, browser_version, platform, connection, screen_size) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("sssssssssss", $uname, $email, $date, $issue, $file, $hardware, $browser, $browser_version, $platform, $connection, $screen_size);
      $stmt->execute();
      $stmt->close();

      header('Location: ../../errorsubmission.php?successCode=102');
  }
  else 
  {
    header('Location: ../../errorsubmission.php?errorCode=103');
  }
} 
elseif (isset($_POST['reset_pwd'])) 
{
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
} 
elseif (isset($_POST['forget'])) 
{
  if (isset($_POST['email_forgot_pass'])) {
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
	<td>Password : <b>'. $user->password .'</b></td>
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
	$headers .= "To: ".$user->full_name."\r\n";
	$headers .='X-Mailer: PHP/' . phpversion();
	$mail = @mail($to, $subject, $message, $headers);
	if ($mail == true) {
        header('Location: ../../logincaamember.php?errorCode=205');
      } else {
        header('Location: ../../logincaamember.php?errorCode=106');
      }
  }
}
?>