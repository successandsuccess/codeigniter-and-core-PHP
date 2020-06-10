<?php 
    
    session_start();
    require_once("../../config.php");
    if(empty($_SESSION['admin_id']) || $_SESSION['admin_id'] == "" || empty($_GET['id'])){
        header('Location: /logincaamember.php');
    }

    require_once("../../classes/database.class.php");

    require_once("../classes/blastemail.class.php");

    $conn  = new Database();
	
    $blastemail = new BlastEmailObject($conn);

    $row = $blastemail->getById($_GET['id']);
	
	function getSenderFullName($email){
		
		if (strpos(strtolower($email), "cynthia") !== false){
			
			$admin_fullname = "Cynthia Maraugha";
			
		}else if(strpos(strtolower($email), "soren") !== false){
			
			$admin_fullname = "Soren Campbell";
			
		}else if(strpos(strtolower($email), "contact") !== false){
			
			$admin_fullname = "Megan Varellas";
			
		}else if((strpos(strtolower($email), "jimfletcher") !== false) || (strpos(strtolower($email), "globaltechkyllc") !== false)){
			
			$admin_fullname = "Jim Fletcher";
			
		}else{
			
			$admin_fullname = $email;
			
		}

		return $admin_fullname;
		
	}
	
	function getBoardName($email){
		
		if(strpos(strtolower($email), "contact") !== false){
			
			$board_name = "Board of Directors Chair";
			
		}else{
			
			$board_name = "Director of Administration &amp; Operations";
			
		}
		
		return $board_name;
		
		
	}
	
		
	$photo_name = $blastemail->viewPhoto($row['sender_id'], getSenderFullName($row['sender_email']));
	
?>
<!DOCTYPE html>
<html data-lt-installed="true">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width">
<title>Simple Transactional Email</title>
</head>
 <body class="" style="font-family: 'Roboto Slab', serif;background-color: rgba(249, 249, 249, 1);-webkit-font-smoothing: antialiased;font-size: 14px;line-height: 1.4;margin: 0;padding: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;background-color: #f6f6f6;">
      <tbody><tr>
        <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">&nbsp;</td>
        <td class="container" style="font-family: sans-serif;font-size: 14px;vertical-align: top;display: block;max-width: 620px;padding: 10px;width: 620px;margin: 0 auto !important;">
          <div class="content" style="box-sizing: border-box;display: block;margin: 0 auto;max-width: 620px;">
            <table class="header" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;">
              <tbody><tr>
                  <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;"><a href="http://www.nccaatest.org"  style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;" ><img src="../../assets/images/logo2.png" alt="" width="172" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;"> </a></td>
                <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;"><p style="font-family: 'Circe';font-size: 17px;font-weight: bold;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);text-align: right;margin-top: 5px;">National Commission for Certification <br> of Anesthesiologist Assistants</p></td>
              </tr>
            </tbody></table>
            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;background-color: #ffffff;border-radius: 7px 7px 3px 3px;">
              
              <!-- START MAIN CONTENT AREA -->
              
              <tbody><tr>
<?php if(empty($row['banner_img'])){?> 			  
                <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;position: relative;"><img src="../css/banner.png" style="width: 620px; border: none;-ms-interpolation-mode: bicubic;max-width: 100%;border-radius: 7px 7px 0px 0px;"></td>
                                  
<?php }else{ ?>
	<td style="font-family: sans-serif;font-size: 14px;vertical-align: top;position: relative;"><img src="../../upload/banner_image/<?= $row['banner_img'] ?>" style="width: 620px; border: none;-ms-interpolation-mode: bicubic;max-width: 100%;border-radius: 7px 7px 0px 0px;"></td>
<?php } ?>
              </tr>
              <tr>
                <td class="wrapper" style="font-family: sans-serif;font-size: 14px;vertical-align: top;box-sizing: border-box;padding: 20px 35px;">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;">
                    <tbody><tr>
                      <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">
						<p style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">Dear [dynamic name goes here],</p>
						<p style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">NCCAA is pleased to announce the grand opening of our new website!</p>
						<p class="mb0" style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">To access the new website, during this soft opening, use the following prompts:</p>
						<p style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">1) Link to new website by clicking this link <span style="font-weight: bold;"><a href="https://www.nccaatest.org" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;">https://www.nccaatest.org</a></span> or copy/paste into your browser (note, once the old website is fully transitioned, this URL will become <font>nccaa.org</font>)</p>

						<p style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">2) Click on “Sign In” in upper right corner.</p>

						<p style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">3) Enter your username and password below:</p>

						<p class="mb0" style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 0;line-height: 25px;color: rgba(92, 92, 92, 1);margin-left: 15px;"><span style="font-weight: bold;">Username:</span> [dynamic email goes here]</p>
						<p class="mb0" style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;line-height: 25px;color: rgba(92, 92, 92, 1);margin-left: 15px;"><span style="font-weight: bold;">Password:</span> [dynamic password goes here]</p>
                      </td>
                    </tr>
                  </tbody></table>
                  
                  <table style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;">
                    <tbody><tr class="note">
                      <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">
                        <p style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 15px 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);padding: 10px;background-color: rgba(247, 247, 247, 1);">*Note: if you have any issues logging in, email us at <a href="mailto:contact@nccaa.org" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;">contact@nccaa.org</a></p>
                      </td>
                    </tr>
                  </tbody></table>
				  
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;">
                    <tbody><tr>
                      <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">
                        <p style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">Once the new website is fully launched, you will be able to customize your password and update your email address.</p>
                        <p style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">Over the last few months, hundreds of your fellow CAAs and students have already had limited access to the new website, in order to register for exams or upload their CME documents for 2020. The results and feedback provided have been invaluable.  Thank you!</p>
                        <p style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">Now, we would like your feedback, even if you do not have any registrations or exams due in 2020. Why? As part of NCCAA’s desire to further the profession, improve communications between our constituents, and provide a platform for continued growth and partnerships with all stakeholders, we are adding some features, one of which we can tell you about now.</p><p style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">We have integrated a Blog within your accounts, which will only be available to Students and CAAs until we are ready to provide content relevant to the public.  Please check out the first two Blog postings from Megan Varellas, NCCAA Board of Directors Chair, and Soren Campbell, CEO.</p>
                        <p style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">Let us know at <a href="mailto:contact@nccaa.org" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;">contact@nccaa.org</a> if you have any questions or feedback related to the functionality of the new website.</p>
                        <p style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">Regards,</p>
						
						 <?php //echo $row['content'];?>
                      </td>
                    </tr>
                  </tbody></table>
				  
                  <table class="sign" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;">
                    <tbody><tr>
                      <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">
                        </td></tr><tr>
                          <td style="width: 85px;font-family: sans-serif;font-size: 14px;vertical-align: top;">
<?php
	if(empty($photo_name) == false){
		
		if(empty($photo_name[0]['photo']) == false){
			
			echo '<img src="../../'.$photo_name[0]["photo"].'" alt="" width="65" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-top: 0px;border-radius: 50%;">';
		
		}else{
			
			echo '<div style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-top: 0px; width: 65px; height: 65px; border-radius: 50%; background: #B1B1B1;"></div>';
			
		}
	} 
	else echo'<div style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-top: 0px; width: 65px; height: 65px; border-radius: 50%; background: #B1B1B1;"></div>';
?>
                          </td>
                          <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">
                            <h2 style="color: #000;font-family: 'Circe';font-weight: bold;line-height: 1.4;margin: 0;margin-bottom: 0px;font-size: 22px;"><?= getSenderFullName($row['sender_email'])?></h2>
                            <p style="font-family: 'Circe';font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 0;line-height: 20px;color: rgba(92, 92, 92, 1);"><?=getBoardName($row['sender_email'])?></p>
                            <p style="font-family: 'Circe';font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 0;line-height: 20px;color: rgba(92, 92, 92, 1);"><span style="font-weight: bold;">NCCAA</span></p>
                          </td>
                        </tr>
                      
                    
                  </tbody></table>
				  
                </td>
              </tr>

            </tbody></table>

            <table class="footer-main" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;padding: 20px 35px;border-bottom: 2px solid rgba(0,0,0,.1);">
              <tbody><tr>
                <td class="content-block-left" style="font-family: sans-serif;font-size: 14px;vertical-align: top;">
                    <h3 style="color: #000000;font-family: 'Circe';font-weight: bold;line-height: 1.4;margin: 0;margin-bottom: 30px;font-size: 16px;">MAILING ADDRESS</h3>
                    <p style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: #5C5C5C;">8459 US Hwy 42, #160<br>
                      Florence, KY. 41042<br>
                      contact@nccaa.org<br>
                      (p) 859-903-0089<br>
                      (f) 859-903-0877
                    </p>
                </td>
                <td class="content-block-right" style="font-family: sans-serif;font-size: 14px;vertical-align: top;text-align: right;">
                  <h3 style="color: #000000;font-family: 'Circe';font-weight: bold;line-height: 1.4;margin: 0;margin-bottom: 30px;font-size: 16px;">VISIT US ON SOCIAL MEDIA</h3>
                    <p class="social" style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: #5C5C5C;">
					
						  <!--a href="https://www.facebook.com/" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;"><img src="../css/facebook.png" alt="facebook" width="30" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;"></a>
						  <a href="https://www.instagram.com/" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;"><img src="../css/instagram.png" alt="instagram" width="30" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;"></a>
						  <a href="https://www.linkedin.com/" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;"><img src="../css/linkedin.png" alt="linkedin" width="30" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;"></a>
						  <a href="https://twitter.com/" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;"><img src="../css/twitter.png" alt="twitter"  width="30" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;"></a>
						  <a href="https://www.youtube.com/" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;"><img src="../css/youtube.png" alt="youtube" width="30" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;"></a-->
						  
						  <img src="../css/facebook.png" alt="facebook" width="30" style="cursor:not-allowed;border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;">
						  <img src="../css/instagram.png" alt="instagram" width="30" style="cursor:not-allowed;border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;">
						  <img src="../css/linkedin.png" alt="linkedin" width="30" style="cursor:not-allowed;border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;">
						  <img src="../css/twitter.png" alt="twitter"  width="30" style="cursor:not-allowed;border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;">
						  <img src="../css/youtube.png" alt="youtube" width="30" style="cursor:not-allowed;border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;">
						  
                    </p>
                    
                    <p class="bottom" style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: #5C5C5C;"><a href="https://nccaatest.org" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;">www.nccaatest.org </a></p>
                </td>
              </tr>
            </tbody></table>

            <table class="footer" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;clear: both;margin-top: 10px;text-align: center;">
              <tbody><tr>
                <td class="content-block" style="font-family: sans-serif;font-size: 14px;vertical-align: top;padding-bottom: 10px;padding-top: 10px;color: #999999;text-align: center;">
                  <p class="apple-link" style="font-family: 'Circe';font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(0, 0, 0, 1);text-align: center;">Copyright © 2019 National Commission for Certification of Anesthesiologist Assistants.<br>
                    All Rights Reserved.</p>
                    <p style="font-family: 'Roboto Slab', serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(0, 0, 0, 1);text-align: center;"><span style="font-weight: normal;color: rgba(0, 0, 0, 0.4);font-size: 14px;text-align: center;">For changes regarding how you receive future emails, please contact NCCAA.</span><br>
                    Because NCCAA uses email to communicate important business functions, like account updates, date changes, exam info, etc., please make sure your SPAM filters are set to accept emails from NCCAA.</p>
                </td>
              </tr>
            </tbody></table>

          </div>
        </td>
        <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">&nbsp;</td>
      </tr>
    </tbody></table>
</body>
</html>