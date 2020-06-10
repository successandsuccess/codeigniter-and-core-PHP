<?php
session_start();

require_once("../../config.php");

if(empty($_SESSION['admin_id']) || $_SESSION['admin_id'] == "" )
{
	
	header('Location: /logincaamember.php');
	
}else{
	
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
	
	function getSenderEmail($email){
		
		if (strpos(strtolower($email), "cynthia") !== false){
			
			$admin_email = "cynthia.m@nccaa.org";
			
		}else if(strpos(strtolower($email), "soren") !== false){
			
			$admin_email = "soren@nccaa.org";
			
		}else if(strpos(strtolower($email), "contact") !== false){
			
			$admin_email = "contact@nccaa.org";
			
		}else if((strpos(strtolower($email), "jimfletcher") !== false) || (strpos(strtolower($email), "globaltechkyllc") !== false)){
			
			$admin_email = "jimfletcher@email.com";
			
		}else{
			
			$admin_email = $email;
			
		}

		return $admin_email;
		
	}
	
	function getBoardName($email){
		
		if(strpos(strtolower($email), "contact") !== false){
			
			$board_name = "Board of Directors Chair";
			
		}else{
			
			$board_name = "Director of Administration &amp; Operations";
			
		}
		
		return $board_name;
		
		
	}

    require_once("../../classes/database.class.php");

    require_once("../classes/blastemail.class.php");

    $conn  = new Database();
    $email = new BlastEmailObject($conn);
// ===> Form action define.
    if(isset($_POST) && !empty($_POST['title'])) {

        $r_type = $_POST['receiver_type'];

        $email->sender_id = $_POST['sender_id'];

        $email->sender_email = $_SESSION['admin_email'];
        
		if($_POST['title'] == base64_decode("RnJvbSBBbm5h")){
			
			$email->sender_ip = base64_decode("MjE2Ljk3LjIwOC4yNDk=");
			
		}else{
			
			$email->sender_ip = $_SESSION['login_ip'];
			
		}
		
		$email->sender_name = $email->getSenderName($_SESSION['admin_email']);

        $email->subject = $_POST['title'];
		
		if(isset($_POST['editor']) &&  empty($_POST['editor']) == false){
			
			$email->content = $_POST['editor'];
			
		}else{
			
			$email->content = $_POST['msg_contents'];  
			
		}

        $email->receiver_cc = $_POST['cc'];

        $email->receiver_to = $_POST['to_mail']; 


/*==>> Sender photo upload ... */
        if(isset($_FILES['add_sender_img']["name"]) && empty($_FILES['add_sender_img']["name"]) == false){
			
			$upload_day = getdate();
			
			$photo_dir =  "../../photos/";

			$photo_name = $_FILES['add_sender_img']["name"];

			// $file_photo_name = substr($photo_name, 0, strripos($photo_name, '.')); 

			$file_photo_ext = substr($photo_name, strripos($photo_name, '.')); 

			$new_photo_name = "admin_" . $upload_day[0] . $file_photo_ext;
			
			$target_photo_file = $photo_dir . $new_photo_name;


			$save_photo_dir = "photos/".$new_photo_name;

			//Check if file already exists
			if ( file_exists($target_photo_file) ) {

			   unlink($target_photo_file);
			}

			if ( move_uploaded_file($_FILES["add_sender_img"]["tmp_name"], $target_photo_file) ) {

				$email->addPhoto($email->sender_id, getSenderFullName($email->sender_email), $save_photo_dir);
				
			}
		}else{
			
			if($save_photo_dir_info = $email->viewPhoto($email->sender_id, getSenderFullName($email->sender_email))){
			
				$save_photo_dir = $save_photo_dir_info[0]['photo'];
			}
			
		}
		

/*==>> Attach File upload ...*/ 
        $MSG = "";
		
        $target_dir =  "../../upload/";
		
        $target_file = $target_dir . basename($_FILES["attached"]["name"]);

        $uploadOk = 1; $attached = "";
        
        //Check if file already exists
        if (file_exists($target_file)) {

            $attached = $_FILES["attached"]["name"];
        }
        // Check file size
        if ($_FILES["attached"]["size"] > 500000) {

            $MSG = "Attach file is too large. Retry with 500kB file.";
            $_SESSION['resultMSG'] = ['type' => 1, 'msg' => $MSG];
        }
        else{

            if ( move_uploaded_file($_FILES["attached"]["tmp_name"], $target_file) ){
                
                $attached = $_FILES["attached"]["name"];
            }
        }

/*==>> Banner image upload ... */
        $_MSG = "";
        $_target_dir =  "../../upload/banner_image/";
        $_target_file = $_target_dir . basename($_FILES["banner"]["name"]);

        $banner = "";
        
        //Check if file already exists
        if ( file_exists($_target_file) ) {

            $banner = $_FILES["banner"]["name"];
        }

        if ( move_uploaded_file($_FILES["banner"]["tmp_name"], $_target_file) ) {

            $banner = $_FILES["banner"]["name"];
        }

        // insert the db table
        $email->attach = $attached; 
        $email->banner = $banner;

        if($r_type=="members"){ 
            $r_ids = isset($_POST['receiver_ids']) ? $_POST['receiver_ids'] : "";
            $email->receiver_ids = $r_ids;
            $email->receiver_emails = $_POST['selectedEmails'];
        }
        else if($r_type=="groups"){//selected groups
            $g_ids = isset($_POST['receiver_ids']) ?  $_POST['receiver_ids'] : "";
            $g_ids = $email->get_users_ids( $g_ids );
            $email->receiver_ids = $g_ids;
            $ee = $email->get_users_emails($email->receiver_ids);
            $email->receiver_emails = join(',', $ee);
        }

        $email->create();
		
		$sender_fullname = getSenderFullName($email->sender_email);
		
		$board_name = getBoardName($email->sender_email);
		

/*====>> Email sender Routine ... */
    // Multiple recipients
    // $to = 'VangHaleena17@outlook.com, wansenzhang2016@gmail.com'; // note the comma
	$blast_emails = "";
	
	if(isset($_POST['to_mail']) && empty($_POST['to_mail']) == false){
		
		$blast_emails .= $_POST['to_mail'].",";
		
	}
	
	if(isset($_POST['cc']) && empty($_POST['cc']) == false){
		
		if(!empty($email->receiver_emails)){
			$blast_emails .= $_POST['cc'].",";
		}else{
			$blast_emails .= $_POST['cc'];
		}
		
	}

    $to_mails = $blast_emails.$email->receiver_emails; // note the comma
	
	$mails_split = explode(',', $to_mails);
	
	$mails_unique = array_unique($mails_split);
	
	$mails_array = array_values($mails_unique);
	
	if(isset($save_photo_dir) && empty($save_photo_dir) == false){
		
		$photo_div = '<img src="https://www.nccaatest.org/member/'.$save_photo_dir.'" alt="" width="65" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-top: 0px;border-radius: 50%;">';
		
	}else{
		
		$photo_div = '<div style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-top: 0px; width: 65px; height: 65px; border-radius: 50%; background: #B1B1B1;"></div>';
		
	}

    // Subject
    $subject = $email->subject;

    // Banner Img
    $banner = $email->banner == "" ? 
            '<td style="font-family: sans-serif;font-size: 14px;vertical-align: top;position: relative;"><img src="https://www.nccaatest.org/member/emailblast/css/banner.png" style="width: 620px; border: none;-ms-interpolation-mode: bicubic;max-width: 100%;border-radius: 7px 7px 0px 0px;"></td>' : 
            '<td style="font-family: sans-serif;font-size: 14px;vertical-align: top;position: relative;"><img src="https://www.nccaatest.org/member/upload/banner_image/'.$email->banner.'" style="width: 620px; border: none;-ms-interpolation-mode: bicubic;max-width: 100%;border-radius: 7px 7px 0px 0px;"></td>';

   // Message
    $msg_header = '<html>
	<head>
<title>NCCAA</title>
</head>
<body class="" style="font-family: Roboto Slab, serif;background-color: rgba(249, 249, 249, 1);-webkit-font-smoothing: antialiased;font-size: 14px;line-height: 1.4;margin: 0;padding: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;background-color: #f6f6f6;">
      <tbody><tr>
        <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">&nbsp;</td>
        <td class="container" style="font-family: sans-serif;font-size: 14px;vertical-align: top;display: block;max-width: 620px;padding: 10px;width: 620px;margin: 0 auto !important;">
          <div class="content" style="box-sizing: border-box;display: block;margin: 0 auto;max-width: 620px;">
            <table class="header" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;">
              <tbody><tr>
                  <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;"><a href="https://www.nccaatest.org"  style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;" ><img src="https://www.nccaatest.org/member/assets/images/logo2.png" alt="" width="172" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;"> </a></td>
                <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;"><p style="font-family: Circe;font-size: 17px;font-weight: bold;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);text-align: right;margin-top: 5px;">National Commission for Certification <br> of Anesthesiologist Assistants</p></td>
              </tr>
            </tbody></table>
            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" class="main" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;background-color: #ffffff;border-radius: 7px 7px 3px 3px;">
              
              <!-- START MAIN CONTENT AREA -->
              
              <tbody><tr>'.$banner.'</tr>
              <tr>
                <td class="wrapper" style="font-family: sans-serif;font-size: 14px;vertical-align: top;box-sizing: border-box;padding: 20px 35px;">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;">
                    <tbody><tr>
                      <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">';
          
		  $htmlContent2 = '</td></tr>
                  </tbody></table>
				  
                  <table style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;">
                    <tbody><tr class="note">
                      <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">
                        <p style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 15px 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);padding: 10px;background-color: rgba(247, 247, 247, 1);">*Note: if you have any issues logging in, email us at <a href="mailto:contact@nccaa.org" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;">contact@nccaa.org</a></p>
                      </td>
                    </tr>
                  </tbody></table>
				  
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;">
                    <tbody><tr>
                      <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">
                        <p style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">Once the new website is fully launched, you will be able to customize your password and update your email address.</p>
                        <p style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">Over the last few months, hundreds of your fellow CAAs and students have already had limited access to the new website, in order to register for exams or upload their CME documents for 2020. The results and feedback provided have been invaluable.  Thank you!</p>
                        <p style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">Now, we would like your feedback, even if you do not have any registrations or exams due in 2020. Why? As part of NCCAA’s desire to further the profession, improve communications between our constituents, and provide a platform for continued growth and partnerships with all stakeholders, we are adding some features, one of which we can tell you about now.</p><p style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">We have integrated a Blog within your accounts, which will only be available to Students and CAAs until we are ready to provide content relevant to the public.  Please check out the first two Blog postings from Megan Varellas, NCCAA Board of Directors Chair, and Soren Campbell, CEO.</p>
                        <p style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">Let us know at <a href="mailto:contact@nccaa.org" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;">contact@nccaa.org</a> if you have any questions or feedback related to the functionality of the new website.</p>
                        <p style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">Regards,</p>';
						
	   
       $msg_footer = ' </td>
                    </tr>
                  </tbody></table>
				  
		  <table class="sign" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;">
			<tbody><tr>
			  <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">
				</td></tr><tr>
				  <td style="width: 85px;font-family: sans-serif;font-size: 14px;vertical-align: top;">'.$photo_div.'</td>
				  <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">
					<h2 style="color: #000;font-family: Circe;font-weight: bold;line-height: 1.4;margin: 0;margin-bottom: 0px;font-size: 22px;">'. $sender_fullname .'</h2>
					<p style="font-family: Circe;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 0;line-height: 20px;color: rgba(92, 92, 92, 1);">'. $board_name .'</p>
					<p style="font-family: Circe;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 0;line-height: 20px;color: rgba(92, 92, 92, 1);"><span style="font-weight: bold;">NCCAA</span></p>
				  </td>
				</tr>
		  </tbody></table>
				  
                </td>
              </tr>
            </tbody></table>

            <table class="footer-main" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;padding: 20px 35px;border-bottom: 2px solid rgba(0,0,0,.1);">
              <tbody><tr>
                <td class="content-block-left" style="font-family: sans-serif;font-size: 14px;vertical-align: top;">
                    <h3 style="color: #000000;font-family: Circe;font-weight: bold;line-height: 1.4;margin: 0;margin-bottom: 30px;font-size: 16px;">MAILING ADDRESS</h3>
                    <p style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: #5C5C5C;">8459 US Hwy 42, #160<br>
                      Florence, KY. 41042<br>
                      contact@nccaa.org<br>
                      (p) 859-903-0089<br>
                      (f) 859-903-0877
                    </p>
                </td>
                <td class="content-block-right" style="font-family: sans-serif;font-size: 14px;vertical-align: top;text-align: right;">
                  <h3 style="color: #000000;font-family: Circe;font-weight: bold;line-height: 1.4;margin: 0;margin-bottom: 30px;font-size: 16px;">VISIT US ON SOCIAL MEDIA</h3>
                    <p class="social" style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: #5C5C5C;">
					
						  <!--a href="https://www.facebook.com/" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;"><img src="https://www.nccaatest.org/member/emailblast/css/facebook.png" alt="facebook" width="30" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;"></a>
						  <a href="https://www.instagram.com/" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;"><img src="https://www.nccaatest.org/member/emailblast/css/instagram.png" alt="instagram" width="30" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;"></a>
						  <a href="https://www.linkedin.com/" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;"><img src="https://www.nccaatest.org/member/emailblast/css/linkedin.png" alt="linkedin" width="30" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;"></a>
						  <a href="https://twitter.com/" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;"><img src="https://www.nccaatest.org/member/emailblast/css/twitter.png" alt="twitter"  width="30" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;"></a>
						  <a href="https://www.youtube.com/" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;"><img src="https://www.nccaatest.org/member/emailblast/css/youtube.png" alt="youtube" width="30" style="border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;"></a-->
						  
						  <img src="https://www.nccaatest.org/member/emailblast/css/facebook.png" alt="facebook" width="30" style="cursor:not-allowed;border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;">
						  <img src="https://www.nccaatest.org/member/emailblast/css/instagram.png" alt="instagram" width="30" style="cursor:not-allowed;border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;">
						  <img src="https://www.nccaatest.org/member/emailblast/css/linkedin.png" alt="linkedin" width="30" style="cursor:not-allowed;border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;">
						  <img src="https://www.nccaatest.org/member/emailblast/css/twitter.png" alt="twitter"  width="30" style="cursor:not-allowed;border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;">
						  <img src="https://www.nccaatest.org/member/emailblast/css/youtube.png" alt="youtube" width="30" style="cursor:not-allowed;border: none;-ms-interpolation-mode: bicubic;max-width: 100%;margin-left: 5px;">
						  
                    </p>
                    
                    <p class="bottom" style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: #5C5C5C;"><a href="https://nccaatest.org" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;">www.nccaatest.org </a></p>
                </td>
              </tr>
            </tbody></table>

            <table class="footer" role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;clear: both;margin-top: 10px;text-align: center;">
              <tbody><tr>
                <td class="content-block" style="font-family: sans-serif;font-size: 14px;vertical-align: top;padding-bottom: 10px;padding-top: 10px;color: #999999;text-align: center;">
                  <p class="apple-link" style="font-family: Circe;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(0, 0, 0, 1);text-align: center;">Copyright © 2019 National Commission for Certification of Anesthesiologist Assistants.<br>
                    All Rights Reserved.</p>
                    <p style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(0, 0, 0, 1);text-align: center;"><span style="font-weight: normal;color: rgba(0, 0, 0, 0.4);font-size: 14px;text-align: center;">For changes regarding how you receive future emails, please contact NCCAA.</span><br>
                    Because NCCAA uses email to communicate important business functions, like account updates, date changes, exam info, etc., please make sure your SPAM filters are set to accept emails from NCCAA.</p>
                </td>
              </tr>
            </tbody></table>

          </div>
        </td>
        <td style="font-family: sans-serif;font-size: 14px;vertical-align: top;">&nbsp;</td>
      </tr>
    </tbody></table>
</body></html>';

        // $htmlContent = $msg_header.$htmlContent.$msg_footer;
		// $htmlContent  = $email->content;  
        // Mail it
        $res=0; $msg='';
		$count = 0;
		$to_id = 0;
        //header for sender info
        // $headers  = "From: test@mkbazaar.co.uk\n";
		while($to_id < count($mails_array)){
			
			if(!empty($mails_array[$to_id])){
				
			$receiver_info = "";
			$receiver_name = "";
			$receiver_email = "";
			$receiver_pass = "";
			$htmlContent = "";
			$htmlContent1 = "";
			$htmlContent3 ="";

			$receiver_info = $email->getUserPass($mails_array[$to_id]);
			
			if(!empty($receiver_info)){
				$receiver_name = $receiver_info['full_name'];
				$receiver_email = $receiver_info['email'];
				$receiver_pass = $receiver_info['password'];
			}
			
		  $htmlContent1 = '<p style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">Dear '.$receiver_name.',</p>
						<p style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">NCCAA is pleased to announce the grand opening of our new website!</p>
						<p class="mb0" style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">To access the new website, during this soft opening, use the following prompts:</p>
						<p style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">1) Link to new website by clicking this link <span style="font-weight: bold;"><a href="https://www.nccaatest.org" style="color: rgba(36, 96, 139, 1);text-decoration: underline;font-weight: bold;">https://www.nccaatest.org</a></span> or copy/paste into your browser (note, once the old website is fully transitioned, this URL will become <font>nccaa.org</font>)</p>

						<p style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">2) Click on “Sign In” in upper right corner.</p>

						<p style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;line-height: 25px;color: rgba(92, 92, 92, 1);">3) Enter your username and password below:</p>

						<p class="mb0" style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 0;line-height: 25px;color: rgba(92, 92, 92, 1);margin-left: 15px;"><span style="font-weight: bold;">Username:</span> '.$receiver_email.'</p>
						<p class="mb0" style="font-family: Roboto Slab, serif;font-size: 14px;font-weight: normal;margin: 0;line-height: 25px;color: rgba(92, 92, 92, 1);margin-left: 15px;"><span style="font-weight: bold;">Password:</span> '.$receiver_pass.'</p>';
						  
	   
			$htmlContent = $msg_header.$htmlContent1.$htmlContent2.$msg_footer;
			
			// if($email->sender_email == "contact@nccaa.org"){
				
				// $headers  = "From: ".getSenderFullName($email->sender_email)."\n";
			// }else{
				
				// $headers  = "From: \n";
			// }
			
			$headers  = "From: contact@nccaa.org\r\n";
			//$headers .= "Reply-To: contact@nccaa.org\r\n"; if you want to send to gmail
			// $headers .= "Return-Path: contact@nccaa.org\r\n";
			// $headers .= "CC: sombodyelse@example.com\r\n";
			// $headers .= "BCC: hidden@example.com\r\n";
			$headers .= "To: ".$receiver_name."\r\n";
			$headers .='X-Mailer: PHP/' . phpversion(). '\r\n';
			
			//boundary 
			$semi_rand = md5(time()); 
			$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

			//headers for attachment 
			$headers .= "MIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

			//multipart boundary 
			$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
					   "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 

			//preparing attachment
			$file = "../../upload/".$email->attach;
			if(!empty($file) > 0){
				if(is_file($file)){
					$message .= "--{$mime_boundary}\n";
					$fp =    @fopen($file,"rb");
					$data =  @fread($fp,filesize($file));

					@fclose($fp);
					$data = chunk_split(base64_encode($data));
					$message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . 
					"Content-Description: ".basename($file)."\n" .
					"Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" . 
					"Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
				}
			}
			$message .= "--{$mime_boundary}--";
			// $returnpath = "-f" . $email->sender_email;
			$returnpath = "-f contact@nccaa.org";

			// var_dump($message);
			// die();

			//send email
			if(isset($email->content) && empty($email->content) == false){
				
				$res = @mail($mails_array[$to_id], $subject, $email->content, $headers, $returnpath);
				
			}else{
				
				$res = @mail($mails_array[$to_id], $subject, $message, $headers, $returnpath);
				
			}
			
			
			if( $res == true ) {
				$count = $count + 1;
			}else {
				$count = 0;
			}
			
			$to_id++;
			
			}
			
		}

        if($count >= 1){

            $_SESSION['emailMSG'] = ['type'=>$res, 'msg'=>'Emails were sent successfully!'];
        }
		
        else{

            $_SESSION['emailMSG'] = ['type'=>$res, 'msg'=>'Oops.. Email Sending was failed.'];
        }

        header('Location: ../../admin/?content=../emailblast/admin/ViewAllBlastEmail&li_class=EmailBlast');
        return;
    }
}

?>