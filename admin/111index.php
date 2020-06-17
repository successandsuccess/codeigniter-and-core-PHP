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
             <h2 class="center-align">National Commission for Certification of Anesthesiologist Assistants</h2>
             <a href="#" class="signout">Sign In</a>
        </div> 
  </header><!--close header--> 
  
  <div id="content">
  	   <div class="content-inner">
       	    <h1>ADMIN SIGN IN</h1>
            <div class="admin-msg">This is Sign In page just for Administration. <br>If you are a regular member, please <a href="#">Sign In here</a>.</div>
            <div class="form-sec">
            	 <div class="form-row">
                     <label>Username</label>
                     <input type="email" class="form-input" placeholder="Type your username">
                 </div>
                 <div class="form-row pass-row">
                     <label>Password</label>
                     <input type="password" class="form-input" placeholder="Type your password">
                 </div>
                 
                 <div class="form-row remebder-row">
                     <div class="remeber"><input class="checkbox" type="checkbox">Remember Me</div><a class="forgot-btn" id="forgot_btn" href="#">Forgot Your Password?</a>
                 </div>
                 
                 <div class="forgot-pass" id="forgot_pass">
                 	  <div class="form-row">
                         <label>Last 4 Numbers of SSN</label>
                         <input type="text" class="form-input" placeholder="3376">
                      </div>
                      <div class="form-row">
                         <label>Mother's Maiden Name</label>
                         <input type="text" class="form-input" placeholder="Barnswallow">
                      </div>
                      <div class="send-row">
                          <input type="submit" class="form-submit" value="Send me my password to email below">
                      </div>
                 </div>
                 
                 <div class="submit-row" id="signin_btn">
                     <input type="submit" class="form-submit" value="Sign in to your account">
                 </div>
            </div>
            
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
<script>
	jQuery(document).ready(function(e) {
		jQuery('#forgot_pass').hide();
        jQuery('#forgot_btn').click(function(e) {
			e.preventDefault();
            jQuery('#forgot_pass').slideToggle('fast');
			jQuery('#signin_btn').toggleClass('hideme');
			jQuery('#forgot_btn').toggleClass('active');
        });
    });
</script>
	
</body>
</html>