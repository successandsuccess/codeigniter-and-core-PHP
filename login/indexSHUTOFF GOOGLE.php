<?php
session_start();
if (empty( $_SESSION['user_id'] ) ) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>NCCAA</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
  
<body>
<div id="wrapper">
  <header id="header">
    <div class="container">
           <div class="logo"><a href="#"><img src="images/logo.png" alt=""/></a></div>
             <h2>National Commission for Certification of Anesthesiologist Assistants</h2>
        </div> 
  </header><!--close header--> 
  
  <div id="content">
  	   <div class="content-inner">
       	    <h1>CAA PROFILE</h1>
    
    <?php if(!empty($_REQUEST['email'])){ echo "<h5>NCCAA member's user name email and temporary password has automatically been populated in the fields below. After the Login button has been selected, you will be asked to create a permanent password. Please keep this new password handy and in a safe place</h5>"; } ?>
    <form class="modal-content animate" action="user/login-process.php" method="POST">
            <div class="form-sec">
              <div id="login-sec">
            	 <div class="form-row">
                     <label>Email/Username</label>
                     <input type="email" class="form-input" name="uname" "soren.campbell@nccaa.com" value="<?php if(!empty($_REQUEST['email'])){ echo $_REQUEST['email']; } ?>">
                     <?php if(isset($_GET['errorCode']) && $_GET['errorCode'] == 103){ ?>
                     <span class="error-msg">Please enter valid email and password</span>
                   <?php  } ?>
                 </div>
                 <div class="form-row">
                     <label>Password</label>
                     <input type="password" class="form-input" name="psw" "***********" value="" >
                 </div>
                 </div>
                 <div class="form-row">
                     <a class="forgot-btn" id="forgot_btn" href="#">Forgot Your Password?</a>
                 </div>
                   <?php if(isset($_GET['errorCode']) && $_GET['errorCode'] == 205) {?>
                     <h4 class="success-msg">E-mail sent successfully.</h4>
                   <?php } ?>
                 <div class="forgot-pass" id="forgot_pass">
                 	  <div class="form-row">
                         <label>Last 4 Numbers of SSN</label>
                         <input type="text" class="form-input" "3376" name="ssn" value="">
                         <?php if(isset($_GET['errorCode']) && $_GET['errorCode'] == 105){ ?>
                     <span class="error-msg">Please enter valid SSN and Mother's Maiden Name</span>
                   <?php  }  else if(isset($_GET['errorCode']) && $_GET['errorCode'] == 106) {?>
                     <span class="error-msg">Unable to send E-mail. Please try again</span>
                   <?php } ?>
                      </div>
                      <div class="form-row">
                         <label>Mother's Maiden Name</label>
                         <input type="text" class="form-input" "Barnswallow" name="mother_maiden_name" value="">
                      </div>
                      <div class="send-row">
                          <input type="submit" class="form-submit" name="forget" value="Send me my password to email below">
                      </div>
                 </div>
                 
                 <div class="submit-row" id="signin_btn">
                     <input type="submit" class="form-submit" name="login" value="Sign in to your account">
                 </div>
            </div>
            </form>
            <div class="footer">
            	 <ul>
                 	<li><a href="#">Conditions of Use</a></li>
                    <li><a href="#">Privacy Notice</a></li>
                    <li><a href="#">Help</a></li>
                 </ul>
            </div>
       </div>
  </div><!--close content--> 
  
  
  
</div><!--close wrapper--> 

<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<?php if(isset($_GET['errorCode']) && $_GET['errorCode'] == 105 || isset($_GET['errorCode']) && $_GET['errorCode'] == 106 || isset($_GET['errorCode']) && $_GET['errorCode'] == 205) { ?>
<script>
  jQuery(document).ready(function(e) {
    
    
      jQuery('#signin_btn').toggleClass('hideme');
      jQuery('#forgot_btn').toggleClass('active');
        jQuery('#forgot_btn').click(function(e) {
      e.preventDefault();
            jQuery('#forgot_pass').slideToggle('fast');
      jQuery('#signin_btn').toggleClass('hideme');
      jQuery('#forgot_btn').toggleClass('active');
        });
    });
</script>  
  <?php } else { ?>
<script>
	jQuery(document).ready(function(e) {
		jQuery('#forgot_pass').hide();
        jQuery('#forgot_btn').click(function(e) {
			e.preventDefault();
            jQuery('#forgot_pass').slideToggle('fast');
			jQuery('#signin_btn').toggleClass('hideme');
			jQuery('#forgot_btn').toggleClass('active');
      jQuery('#login-sec').toggleClass('hideme');
        });
    });
</script>
	<?php } ?>
  <script type="text/javascript">
    $(document).keypress(
  function(event){
    if (event.which == '13') {
      event.preventDefault();
    }
});
  </script>
</body>
</html>
<?php }else{
header("location: user/profile.php");
}?>