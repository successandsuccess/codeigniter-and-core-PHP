<?php

global $incomecdq;
include_once "../incomecdq/classes/historycdq.class.php";
$cdqhistory = new PaymentHistoryCdq();
if(isset($_GET["cdq_month"]) && $_GET["cdq_month"]){
	$cdq_month = $_GET['cdq_month'];
}else{
	$cdq_exam_month = $cdqhistory->readAllAction($_SESSION['user_id']);
	if(empty($cdq_exam_month) == false){
		if($cdq_exam_month[0]['exam_mon'] == 2){
			$cdq_month = 6;
		}else{
			$cdq_month = 2;
		}
	}else{
		$cdq_month = 2;
	}
}

$action_title = $cdqhistory->pay_title($_SESSION['user_id'], $cdq_month);

$arr1 = explode("Main", $action_title);

$arr2 = explode("Late", $action_title);

$arr3 = explode("#1", $action_title);

$arr4 = explode("#2", $action_title);

$pay_num = '0';

$pay_amount = '0';

$amount = '0';

$main_amount = '0';

$late_amount = '0';

$retake1_amount = '0';

$retake2_amount = '0';

$exam_year = substr($action_title,-5,-1);

$exam_title = "";

if(count($arr1) > 1){
	
	$pay_amount = $cdqhistory->readActionAmount('1');
	
	$main_amount = $cdqhistory->readActionAmount('1');
	
	$amount = $main_amount;
	
	$pay_num = 1;
	
	$exam_title = "CDQ Initial Exam";
	
}

if(count($arr2) > 1){
	
	$pay_amount = $cdqhistory->readActionAmount('2');
	
	$late_amount = $cdqhistory->readActionAmount('2');
	
	$amount = $late_amount;
	
	$pay_num = 2;
	
	$exam_title = "CDQ Initial Exam (Late Fee)";
	
}

if(count($arr3) > 1){
	
	$pay_amount = $cdqhistory->readActionAmount('3');
	
	$retake1_amount = $cdqhistory->readActionAmount('3');
	
	$amount = $retake1_amount;
	
	$pay_num = 3;
	
	$exam_title = "CDQ Retake #1 Exam";
	
}

if(count($arr4) > 1){
	
	$pay_amount = $cdqhistory->readActionAmount('4');
	
	$retake2_amount = $cdqhistory->readActionAmount('4');
	
	$amount = $retake2_amount;
	
	$pay_num = 4;
	
	$exam_title = "CDQ Retake #2 Exam";
	
}

if (empty($_POST['paymentSubmitCDQ']) == false){

	// $incomecdq->insert_income($_POST);

	// $cdqhistory->insert_CDQActionHistory($_POST);
	
	// $success_msg = $result_cdq['msg'];
	
	// $receipt_cdq = $cdqhistory->readAllReceipt($_SESSION['user_id']);

	// $receipt_date = getdate($receipt_cdq['action_date']);
	
	// echo $cdqhistory->PaymentSuccess();
	
	// $re_arr1 = explode("Main", $receipt_cdq['receipt_title']);

	// $re_arr2 = explode("Late", $receipt_cdq['receipt_title']);

	// $re_arr3 = explode("#1", $receipt_cdq['receipt_title']);

	// $re_arr4 = explode("#2", $receipt_cdq['receipt_title']);

	// if(count($re_arr1) > 1){
		
	// 	$receipt_title = "CDQ Initial Exam";
		
	// }

	// if(count($re_arr2) > 1){
		
	// 	$receipt_title = "CDQ Initial Exam";
		
	// }

	// if(count($re_arr3) > 1){
		
	// 	$receipt_title = "CDQ Exam";
		
	// }

	// if(count($re_arr4) > 1){
		
	// 	$receipt_title = "CDQ Exam";
		
	// }




	if(empty($_SESSION['user_id']) == false){
		$_POST['user_id'] = $_SESSION['user_id'];
		$result_cdq = $payment->process($_POST);
	}else{
		header('Location: /logincaamember.php');
	}
}

if(!empty($result_cdq) && $result_cdq['code'] == 'error') {

    $error = $result_cdq['msg'];

    echo $cdqhistory->PaymentError();

}

$success_msg = '';

if(!empty($result_cdq) && $result_cdq['code'] == 'success') {


	$incomecdq->insert_income($_POST);

	$cdqhistory->insert_CDQActionHistory($_POST);
	
	$success_msg = $result_cdq['msg'];
	
	$receipt_cdq = $cdqhistory->readAllReceipt($_SESSION['user_id']);

	$receipt_date = getdate($receipt_cdq['action_date']);
	
	echo $cdqhistory->PaymentSuccess();
	
	$re_arr1 = explode("Main", $receipt_cdq['receipt_title']);

	$re_arr2 = explode("Late", $receipt_cdq['receipt_title']);

	$re_arr3 = explode("#1", $receipt_cdq['receipt_title']);

	$re_arr4 = explode("#2", $receipt_cdq['receipt_title']);

	if(count($re_arr1) > 1){
		
		$receipt_title = "CDQ Initial Exam";
		
	}

	if(count($re_arr2) > 1){
		
		$receipt_title = "CDQ Initial Exam";
		
	}

	if(count($re_arr3) > 1){
		
		$receipt_title = "CDQ Exam";
		
	}

	if(count($re_arr4) > 1){
		
		$receipt_title = "CDQ Exam";
		
	}

}
  $cdq_historys = $cdqhistory->readAll();

  $cdq = $incomecdq->readById($_SESSION['user_id']);

?>

<link href="../incomecdq/css/script.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../incomecdq/js/cleave.min.js"></script>

<style>
.policy-title{
	
	font-size:19px !important; 
	font-weight 600 !important;
	font-weight: bold !important;
}

.policy-content{
	
	font-size:14px !important;
	font-weight 400 !important;
	font-weight: Normal !important;
	text-align: justify !important;
}

</style>

<style type="text/css" media="print">
    @page 
    {
        size:  auto; 
        margin: 50mm 15mm 10mm 15mm !important; 
    }
    
    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  
    }

    body
    {
        
        margin: 50mm 15mm 10mm 15mm !important; 
        
    }
	
	.paymentContent .top_body{

		background: #F7F7F7 !important;


	}
	
</style>

<div class="modal fade" id="paymentContentModal"  role="dialog" style="display:none;">
    <input type="hidden" id="hiddencontainer" name="hiddencontainer" value="1"/>
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content paymentContent">
            <div class="row top_body" style="margin: 0">
                <img src="../incomecdq/image/logo.png" width="80" height="80">
                <div class="logo_title">
                    National Commission for Certification <br> of Anesthesiologist Assistants
                </div>
				
                <div class="today_date">
				
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					
                        <span aria-hidden="true">&times;</span>
						
                    </button>
					
                    <p><?php echo date('m/d/Y') ?></p>
					
                </div>
            </div>
            <div class="row section1">
                <div class="col-md-12">
                    <h5>
					
                        <?php echo $exam_title; ?>
						
                    </h5>
					
                    <p id="p_feb" style="display:none;">For <?php echo $cdqhistory->expectedExamDate(2, $exam_year, 'full');?> CDQ Exam</p>
					
                    <p id="p_june" style="display:none;">For <?php echo $cdqhistory->expectedExamDate(6, $exam_year, 'full');?> CDQ Exam</p>
					
				</div>
				
				<div class="col-md-6">
				
                    <ul>
                        <li><a>CAA Name: <span><?php echo $userObject->data["login"]['full_name'];?></span></a></li>
						
                        <li><a>Amount due: <span>$<?php echo $pay_amount; ?></span></a></li>
						
                        <li><a>Due date: 
							<span id="due_date_feb" style="display:none;"><?php echo $cdqhistory->expectedExamDate(2, $exam_year, 'due');?></span>
							<span id="due_date_june" style="display:none;"><?php echo $cdqhistory->expectedExamDate(6, $exam_year, 'due');?></span>
						</a></li>
						
                        <li><a>Date paid: <span><?php echo date('m/d/Y') ?></span></a></li>
						
                        <li><a>Amount paid: <span>$0 (still due)</span></a></li>
						
                        <li><a>Amount due: <span>$<?php echo $pay_amount; ?> (pay below)</span></a></li>
                    </ul>
                </div>
				
				<div class="col-md-6">
				
				</div>

            </div>
            <div class="deadline"></div>

            <div class="section2">
			
                <form id="frmStripePaymentCDQ" action="" method="post">
				
                    <div class="row">
					
                        <div class="col-md-7">
						
                            <div id="error-message">
							
                                <?php
                                    if(!empty($error)){
                                        echo $error;
                                    }
                                ?>
                            </div>
							
                            <div class="row form-group">
							
                                <div class="col-md-6">
								
                                    <label>Card Number</label>
									
                                    <input class="form-input" id="card-number" type="text" name="number" placeholder="Enter card number" autocomplete="off" /><span class="errorContainer"></span>
                                </div>
                                <div class="col-md-6">

                                        <label>Expiration Date</label>
                                        <input class="form-input" id="card-expiry-element" type="text" name="expire_date" placeholder="MM/YY"/>

                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label>Security Code</label>
                                    <input class="form-input" id="code" type="text" name="code" placeholder="Enter cvv" autocomplete="off" />
                                </div>
                            </div>

                            <div class="deadline2"></div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Name on Card</label>
                                    <input class="form-input" id="name" type="text" name="name" placeholder="Enter name"  autocomplete="off" />
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Street Address</label>
                                    <input class="form-input" id="address" type="text" name="address" placeholder="Enter street address"  autocomplete="off" />
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label>City</label>
                                    <input class="form-input" id="city" type="text" name="city" placeholder="Enter city"  autocomplete="off" />
                                </div>
                                <div class="col-md-6">

                                        <label>State</label>
                                        <input class="form-input" id="state" type="text" name="state" placeholder="Enter state"  autocomplete="off" />

                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 0 !important;">
                                <div class="col-md-6">
                                    <label>Zip</label>
                                    <input id="zip" class="form-input" type="text" name="zip" placeholder="Enter zip"  autocomplete="off" />
                                </div>
                            </div>

                        </div>
                        <div class="col-md-5">
                            
							<div class="pay_title">
                                <h5>PAY NOW</h5>
                                <div class="deadline2" style="border-color: rgb(240,240,240);"></div>
                                <p>Total: </p>
                                <h2>$<?php echo $pay_amount; ?></h2>
                            </div>
                            
							<div class="form-bottom">
                                <div style="color: rgb(112, 112, 112)">
                                    Note: We do not save or keep credit card information for future payments of CMEs or Exams
                                </div>
                                <div id="submit-btn">
								
                                    <input type="submit" class="form-submit" name="paymentSubmitCDQ" id="payment_now" value="Pay Now"/>
                                    
                                </div>
                                <div id="loader" style="margin-top: 30px">
                                    <img alt="loader" src="../incomecdq/image/LoaderIcon.gif" style="width: 67px;height: 50px;">
                                </div>
                                <div class="section3">
                                    <li><a onclick="privacy_fun()" style="cursor:pointer;">Privacy</a></li>
                                    <li><a onclick="terms_fun()" style="cursor:pointer;">Terms and Conditions</a></li>
                                </div>
                            </div>
							
							<input type="hidden" id="exam_name" name="exam_name" value="<?php echo $userObject->data["login"]['full_name']; ?>"/>
							
							<input type="hidden" id="exam_date" name="exam_date" value="<?php echo $cdq['due_date'] ?>"/>
							
							<input type="hidden" id="main_amount" name="main_amount" value="<?php echo $main_amount; ?>"/>
							
							<input type="hidden" id="due_date" name="due_date" value="<?php echo $cdq['due_date'] ?>"/>
							
							<input type="hidden" id="late_date" name="late_date" value="<?php echo $cdq['due_date'] ?>"/>
							
							<input type="hidden" id="late_amount" name="late_amount" value="<?php echo $late_amount; ?>"/>
							
							<input type="hidden" id="retake1_date" name="retake1_date" value="<?php echo $cdq['due_date'] ?>"/>
							
							<input type="hidden" id="retake1_amount" name="retake1_amount" value="<?php echo $retake1_amount; ?>"/>
							
							<input type="hidden" id="retake2_date" name="retake2_date" value="<?php echo $cdq['due_date'] ?>"/>
							
							<input type="hidden" id="retake2_amount" name="retake2_amount" value="<?php echo $retake2_amount; ?>"/>
							
							<input type="hidden" id="amount" name="amount" value="<?php echo $amount; ?>"/>
							
							<input type="hidden" id="exam_val" name="exam_val" value="<?=$cdq_month?>" />
							
							<input type="hidden" id="action_title" name="action_title" value="<?php echo $action_title?>"/>
							
							<input type="hidden" id="pay_num" name="pay_num" value="<?php echo $pay_num?>"/>
							
							<input type="hidden" id="exam_year" name="exam_year" value="<?php echo $exam_year;?>"/>
							
							<input type="hidden" id="amount_num" name="amount_num" value="<?php echo $cdqhistory->returnAmountKey($pay_amount);?>"/>
                            
							<input type='hidden' name='type' value='cdq'>
							
                            <input type='hidden' name='currency_code' value='USD'>
							
                            <input type='hidden' name='item_name' value='Test Product'>
							
                            <input type='hidden' name='item_number' value='PHPPOTEG#1'>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

</div>

<div id="receipt_print">
	<div class="modal fade" id="receiptContentModal"  role="dialog" style="display:none;">

		<div class="modal-dialog modal-lg" role="document">

			<div id="receiptmodal_body" class="modal-content paymentContent" style="min-height: auto;">

				<div class="row top_body" style="margin: 0">
					<img src="../incomecdq/image/logo.png" width="80" height="80">

					<div class="logo_title">
						National Commission for Certification <br> of Anesthesiologist Assistants
					</div>

					<div class="today_date">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<p><?php echo date('m/d/Y') ?></p>
					</div>
				</div>

				<div class="row section1" style="padding: 20px 15px 45px 15px">
					<div class="col-md-12">
						<div class="receipt_head">
							<h6>RECEIPT</h6>
							<p>Payment Successful</p>
						</div>
						<h5>
							<?php echo $receipt_title; ?>
						</h5>
						<p>
						
						<?php 
							
							$receipt_title_day = $cdqhistory->expectedExamDate($receipt_cdq['exam_mon'], $receipt_cdq['exam_year'], 'full');
							
							$receipt_due_date = $cdqhistory->expectedExamDate($receipt_cdq['exam_mon'], $receipt_cdq['exam_year'], 'due');
							
							echo "For ".$receipt_title_day." CDQ Exam";
							
						?>
						
						</p>
						
						<div class="row">
						
							<div class="col-md-5">
							
								<ul>
									
									<li><a>CAA name: <span><?php echo $userObject->data["login"]['full_name'];?></span></a></li>
									
									<li><a>Amount due: <span><?php echo '$'.$cdqhistory->readActionAmount($receipt_cdq['amount_num']); ?>
									
									</span></a></li>
									
									<li><a>Exam date: <span><?php echo $receipt_due_date;?></span></a></li>
									
									<li><a>Date paid: <span><?php echo $receipt_date['mon']."/".$receipt_date['mday']."/".$receipt_date['year']; ?></span></a></li>
									
									<li><a>Amount paid: <span><?php echo '$'.$cdqhistory->readActionAmount($receipt_cdq['amount_num']); ?></span></a></li>
									
									<li><a>Amount due: <span>$0</span></a></li>
									
								</ul>
								
							</div>
							
							<div class="col-md-6" style="border-style: solid; border-width: 2px;border-color: #e5e5e5; padding:0px; color:rgb(112, 112, 112);">
							
								<div class="col-md-12"  align="left" style="margin-top:15px;">
									Last 4 digits of credit card used for payment:<font id="final_digits" style="color: #28a745; font-size: 14px;"> <?php if($receipt_cdq['card_num4']){
										echo $receipt_cdq['card_num4'];
									}else{
										echo "N/A";
									}?></font>
								</div>
								<div class="col-md-12" align="left">
									Employer questions regarding verification may be directed to NCCAA:
								</div>
								
								<div class="col-md-12" align="center" style="margin-top: 15px">
									Cynthia Maraugha
								</div>
								
								<div class="col-md-12" align="center">
									<i>Director of Operations</i>
								</div>
								
								<div class="col-md-12" align="center">
									<i class="fa fa-phone"></i> 859-903-0089
								</div>
								
								<div class="col-md-12" align="center">
									<i class="fa fa-envelope"></i> cynthia.m@nccaa.org
								</div>
								
								<div class="col-md-12" align="center" style="margin-top: 15px"></div>
								
							</div>
							<div class="col-md-1"></div>
						
						</div>
						
					</div>

				</div>
				<div class="deadline"></div>

				<div class="row receipt_body">
					<div class="col-md-3">
						<p style="margin-bottom: 15px">Next CDQ Exam (upon passing score):	</p>
						<h5>Feb, <?php echo ($receipt_cdq['exam_year'] + 10);?></h5>
						<p>or</p>
						<h5>June, <?php echo ($receipt_cdq['exam_year'] + 10);?></h5>
					</div>
					<div class="col-md-9">
						<p class="policy-content">Your CDQ registration has been accepted. Scheduling permits will be released via email within 30 days of registration closing. Until the 10-year CDQ plan has been developed, your next CDQ exam will occur in six years, regardless of how many retakes to pass the CDQ exam.  We will update your account to the new CDQ date once we learn the results of the new 10-year plan. Check your account for score results within 8-10 weeks following the exam, per NBME processing time frame. Any CAA who fails the CDQ Exam is required to take the next consecutive CDQ Exam available, until the CAA passes – up to two more times for a total of three exams.</p>
					</div>
				</div>

				<div class="receipt_bottom">
					<a href="?content=content/cdqhistory"><i class="fas fa-arrow-left"></i>Back to CDQ History</a>
					<a href="" onclick="javascript:receipt_print(document.getElementById('receipt_print'));"><i class="fa fa-print" aria-hidden="true"></i>Print</a>
					<a href="mailto:cynthia.m@nccaa.org"><i class="fas fa-envelope"></i>Email</a>
				</div>
			</div>
		</div>     
	</div>

</div>


<div class="modal fade" id="privacy_modal"  role="dialog" style="display:none;">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content paymentContent">
            <div class="row top_body" style="margin: 0px">
                <img src="../incomecdq/image/logo.png" width="80" height="80">

                <div class="nomal_title">
                  Privacy Policy
                </div>

                <div class="today_date">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p><?php echo date('m/d/Y') ?></p>
                </div>
            </div>
			
			<div class="row">
			
				<div class="col-md-12" style="color: blue; padding-top:10px; padding-left:30px; font-size:15px">
					<a onclick="cdq_privacy_back()" id="cdq_privacy_back" style="cursor:pointer; display:none;">< Back</a>
					<a onclick="cme_privacy_back()" id="cme_privacy_back" style="cursor:pointer; display:none;">< Back</a>
					<a onclick="certification_privacy_back()" id="certification_privacy_back" style="cursor:pointer; display:none;">< Back</a>
				</div>

			</div>
			
			<div style="overflow-y:auto; height:780px; margin-top:15px;">
			
				<div class="row section1">
					<div class="col-md-12" style="padding-left:50px;padding-right:50px">
						<p class="policy-title" style="font-size:24px !important;">PRIVACY POLICY</p>
						<p class="policy-content" style="font-style: italic !important;">Last Updated: June 1, 2016</p>

						<p class="policy-content">This Privacy Policy discloses the privacy practices for the NCCAA website located at  www.nccaa.org (the “Site”). In this Privacy Policy, the terms “we,” “us,” or “our” refer to NCCAA, and the terms “you” and “your” refer to you as a visitor to the Site.</p><br>

						<p class="policy-content">This Privacy Policy governs our collection of information from you through your use of this Site. It does not apply to any information you may provide to us, or that we may collect, offline and/or through other means (for example, information gathered via mail or telephone). By visiting and using this Site, you agree that your use of this Site, and any disputes over our online privacy practices, will be governed by this Privacy Policy and or Terms of Use.</p><br>

						<p class="policy-title">TYPES OF INFORMATION NCCAA COLLECTS</p>
						<p class="policy-content">The types of information collected on our Site are described below. This information may be collected directly by us, or it may be collected by our third party website hosting provider, or another service provider, on our behalf. No personally identifiable information (such as your name, address, email address, or telephone number) is automatically collected via our Site; personally identifiable information about Site users is collected only when it is knowingly and voluntarily submitted by Site visitors.</p><br>

						<p class="policy-title">INFORMATION YOU VOLUNTARILY PROVIDE</p>
						<p class="policy-content">We may collect and store information, personal or otherwise, that you voluntarily supply to us while on our Site. Some examples of this type of information include information that you submit electronically when you contact us with questions or request email updates or RSS feeds, and information you post on public posting areas on our Site (such as the comment feature for news articles and updates). We may also ask for information (including a credit or debit card number) from those who pay for an NCCAA membership, pay NCCAA Certification fees, or conduct other transactions on our Site.</p><br>

						<p class="policy-content">This category of information also includes information that you electronically submit when you submit an NCCAA membership application, or an NCCAA Certification application, via our Site. All information voluntarily supplied by you via our Site as part of the NCCAA membership application process and/or the NCCAA Certification process will be collected and stored by us in accordance with the terms of this Privacy Policy.</p><br>

						<p class="policy-content">While some areas of our Site are available to the public, many of the features and services that are available on the Site are made available only to NCCAA members (the “Restricted Access Areas”). If you (or your institution, agency or organization) are not an NCCAA member but would like to join, you can request membership by visiting the “Join NCCAA” section of the Site and completing the membership application for the category of membership you seek. The NCCAA membership form will require you to submit certain personally identifying information, such as billing information and general contact information. As part of the membership application process, you also will be asked to create a username and password for access to the Restricted Access Areas of the Site. When you log in to the Restricted Access Areas, you will have the option of providing additional information to complete your (or your institution’s, agency’s or organization’s) member profile. We may also give you the option of making your member profile visible to other registered NCCAA members. The more information you provide, the more valuable your member profile will be to other members who wish to know more about you as an NCCAA member.</p><br>

						<p class="policy-title">INFORMATION THAT IS AUTOMATICALLY COLLECTED</p>
						<p class="policy-content">We also may collect and store non-personally identifiable information that is generated automatically as you navigate through our Site. For example, our Site’s servers may automatically collect limited information about your computer's connection to the Internet, including your computer’s IP address. The IP address is a number that lets computers attached to the Internet know where to send data - such as the web pages users view. Your IP address does not tell us who you are. We use this information to deliver the Site’s content to you upon request and to measure traffic within the Site. Our Site’s servers also may log information such as the type of web browser software you use to access the Site, the operating system running on your computer, and the speed of your computer’s CPU, for purposes of measuring traffic patterns on the Site and the usage of Site services and features and optimizing the Site to accommodate our users. This information is not correlated with any personally identifying information you may provide.</p><br>

						<p class="policy-content">We may at times also use a standard feature found in browser software called a "cookie" to enhance your experience with the Site. Cookies are small files that your web browser places on your hard drive for record-keeping purposes. By showing how and when visitors and members use the Site, cookies help us identify how many unique users visit us and track user interests, trends and patterns. They also prevent you from having to re-enter your preferences on certain areas of the site where you may have entered preference information before. For example, if you are an NCCAA member, and you select the “Remember Me” option when you log in to the Member Areas, we can use cookies to recognize you so you won’t need to reenter your username and password the next time you visit the Site). Of course, you are free to set your web browser not to accept cookies; however, doing so may render your computer unable to take advantage of certain features enjoyed by other users of our Site.</p><br>

						<p class="policy-title">HOW NCCAA USES COLLECTED INFORMATION</p>
						<p class="policy-content">We may use the information that we collect from you in a variety of ways, including, but not limited to, for purposes of processing your membership request or application for NCCAA Certification, offering you more personalized features, providing you with communications and services you have requested, sending you RSS feeds and email notifications you have requested, notifying you of important changes or additions to our Site, our Site policies, or the features and services offered via our Site, sending you email updates, administrative notices and other communications that we believe may be of interest to you, delivering our Site content to you, measuring Site traffic and improving the Site and the services and features offered via the Site. By using our Site, you agree that we may use any information submitted by or collected from you via the Site for any of the foregoing purposes, and for any other purpose related to the Site and the NCCAA membership and Certification processes.</p><br>

						<p class="policy-content">We also may provide your information, personal or otherwise, to our third-party service providers, agents, contractors and External Reviewers for purposes related to Site administration and operation and to the processing and/or evaluation of NCCAA membership and Certification applications. For example, if you submit an application for NCCAA Certification, the information you submit will be shared with one of our External Reviewers who will evaluate your application and report to NCCAA the results of the evaluation. Also, if you use a credit or debit card to complete a transaction on our site, we may share your personal information and credit card number with a credit card processing and/or a fulfillment company in order to complete your transaction, or such service provider(s) may collect that information from you directly, on our behalf. Our third-party service providers, agents, contractors and External Reviewers have agreed not to share your information with others or to use it for purposes other than those for which we provide it to them.</p><br>

						<p class="policy-content">We do not sell or rent any personal information about our members or Site visitors to telemarketers, mailing list brokers, or any other companies.</p>

						<p class="policy-content">Please be aware that we may occasionally release information about our Site visitors and registered members if required to so by law or if, in our business judgment, such disclosure is reasonably necessary; (a) to comply with legal process; (b) to enforce our  Terms of Use ; or (c) to protect the rights, property, or personal safety of our Site, us, our Site visitors and/or NCCAA members.</p><br>

						<p class="policy-content">Please also keep in mind that whenever you voluntarily make your personal information or other private information available for viewing by other Site visitors, NCCAA members or third parties online – for example, by using the “Post a Comment” tool that is available in certain areas of our Site – that information can be seen, collected and used by others besides us. We cannot be responsible for any unauthorized third party use of such information.</p><br>

						<p class="policy-title">INTERNATIONAL USE</p>
						<p class="policy-content">When you use the Site or submit your information (including personal data) to us via the Site, you expressly consent to NCCAA collection, disclosure and transfer of your information (including personal data) for the purposes identified in the section of the policy entitled “How NCCAA Uses Collected Information.” If you reside outside the United States, please be aware that (i) NCCAA's databases are stored on servers and storage devices located in the United States, (ii) your information (including personal data) may be transferred to the United States for processing and storage, and (iii) the United States, and the localities within the United States where NCCAA's databases are located, may not guarantee the same level of protection for personal data as the locality or country in which you reside. By using our Site, you consent to the transfer of such information outside of your country.</p><br>

						<p class="policy-title">STORAGE OF INFORMATION</p>
						<p class="policy-content">All information gathered on our Site is stored within a database to which only we and our service providers are provided access. However, as effective as the reasonable security measures implemented by us may be, no security system is impenetrable. We cannot guarantee the security of our servers or our database, nor can we guarantee that the information you supply will not be intercepted while being transmitted to us over the Internet.</p><br>

						<p class="policy-title">LINKS TO THIRD-PARTY SITES</p>
						<p class="policy-content">Our Site may include links to third party websites whose privacy policies we do not control. Once you leave our Site, any information you provide at another site will be governed by the privacy policy of the operator of the site you are visiting. The privacy policies of third party websites may differ from that of our Site.</p><br>

						<p class="policy-title">MODIFYING YOUR MEMBER PROFILE AND INFORMATION</p>
						<p class="policy-content">If you are an NCCAA member, you can make changes to your account information by logging in to the Restricted Access Areas of our Site and clicking on “Update Your Details/Change Password.” When you update your account or profile information, we may keep a copy of the prior version for our records.</p>

						<p class="policy-content">If at any point you decide that you would no longer like to receive information from us, please use the contact information set forth below in the “Contact Us” section of this policy to contact us to request that we remove your information from our database.</p><br>

						<p class="policy-title">CHILDREN’S PRIVACY</p>
						<p class="policy-content">This Site is not directed to children under the age of 13 and we do not knowingly collect personally identifiable information from children under the age of 13. If we become aware that we have inadvertently received personally identifiable information from a user under the age of 13, we will delete such information from our records. Because we do not collect any personally identifiable information from children under the age of 13, we also do not knowingly distribute any such information to third parties. We do not knowingly allow children under the age of 13 to publicly post or otherwise distribute personally identifiable contact information.</p><br>

						<p class="policy-title">CHANGES TO THIS PRIVACY POLICY</p>
						<p class="policy-content">If we need to change this Privacy Policy in the future, we will post the modified Privacy Policy on the Site and update the “Last Updated” date of the policy to reflect the date of the changes. By continuing to use the Site after we post any such changes, you accept the Privacy Policy as modified.</p><br>

						<p class="policy-title">CONTACT US</p>
						<p class="policy-content">If you have any questions about this policy or our privacy practices, please click on the “Contact NCCAA” link on our website and complete the online form to submit your question or inquiry.</p>
						
						<div class="row" style="height:250px;"></div>
						
					</div>

				</div>
				</div>
				<div class="deadline"></div>
        </div>
    </div>
</div>	

<div class="modal fade" id="terms_modal"  role="dialog" style="display:none;">

	<div class="modal-dialog modal-lg" role="document">

		<div class="modal-content paymentContent">
			<div class="row top_body" style="margin: 0">
				<img src="../incomecdq/image/logo.png" width="80" height="80">

				<div class="nomal_title">
				  Terms and Conditions
				</div>

				<div class="today_date">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none">
						<span aria-hidden="true">&times;</span>
					</button>
					<p><?php echo date('m/d/Y') ?></p>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12" style="color: blue; padding-top:10px; padding-left:30px; font-size:15px">
					<a onclick="cdq_terms_back()" id="cdq_terms_back" style="cursor:pointer; display:none;">< Back</a>
					<a onclick="cme_terms_back()" id="cme_terms_back" style="cursor:pointer; display:none;">< Back</a>
					<a onclick="certification_terms_back()" id="certification_terms_back" style="cursor:pointer; display:none;">< Back</a>
				</div>

			</div>
			
			<div style="overflow-y:auto; height:780px; margin-top:15px;">
			
				<div class="row section1">
					<div class="col-md-12" style="padding-left:50px;padding-right:50px">
						<p class="policy-title" style="font-size: 24px !important;">TERMS OF USE</p>
						<p class="policy-content" style="font-style: italic !important;">Last Updated: June 1, 2016</p>

						<p class="policy-content">Welcome to the NCCAA website located at www.nccaa.org (the “Site”). In these Terms of Use, the terms “we,” “us,” or “our” refer to NCCAA, and the terms “you” and “your” refer to you as a visitor to the Site.</p><br>

						<p class="policy-content">These Terms of Use constitute a binding legal contract between you and us and set forth the terms that govern your access to and use of the Site. When using the Site, you may be subject to other posted guidelines, rules or agreements applicable to certain features or areas of the Site, or to certain application processes that may be initiated via our site (such as membership and certification applications). All such guidelines, rules and agreements are part of these Terms of Use. Accessing the Site in any manner, even through automated means, constitutes your use of the Site and your agreement to be bound by these Terms of Use.</p><br>

						<p class="policy-content">We reserve the right to modify these Terms of Use in the future as we deem necessary. If we do modify these Terms of Use, we will post the updated Terms of Use on this Site and change the “Last Updated” date above to reflect the date of the changes. By continuing to use the Site after we post any such changes, you accept the Terms of Use as modified.</p><br>

						<p class="policy-title">PRIVACY</p>
						<p class="policy-content">We respect the privacy of the users of our Site. Please take a moment to review our Privacy Policy</p><br>

						<p class="policy-title">RIGHTS AND RESTRICTIONS RELATING TO SITE CONTENT</p>
						<p class="policy-content">License Grant. We may provide via the Site information, data, text, images and other materials created by us or our licensors or uploaded to the Site by our members, other users and/or third party partners (the “Content”). The Content available through this Site is our property or the property of our members, other users, third party partners and/or licensors, and is protected by state, national and international copyright, trademark and other intellectual property laws. Unless otherwise specified or authorized by us, the Site is intended for your personal, noncommercial use only. You may not modify, copy, reproduce, republish, upload, post, transmit or distribute in any way any Content from the Site without our authorization. If you download material from the Site for your personal, non-commercial use, you must keep intact all copyright and other proprietary notices. You may not otherwise reproduce or distribute any of the Content of the Site without our prior authorization. Of course, you’re free to encourage others to access the information themselves on our Site and to tell them how to find it.</p><br>

						<p class="policy-content">Trademarks. The NCCAA trademarks and service marks that appear on the Site are the property of NCCAA. You agree not to display or use in any manner any such marks or names without our prior permission.</p><br>

						<p class="policy-content">Linking and Framing. You may establish a hypertext link to this Site, including display of Site RSS feeds, so long as the link does not state or imply any sponsorship of, or affiliation with, your site by us. However, you may not, without our prior permission, frame any of the content of the Site, or incorporate into another website or other service any material or content belonging to us or any of our licensors.</p><br>

						<p class="policy-title">NCCAA MEMBERSHIP/RESTRICTED ACCESS AREA</p>
						<p class="policy-content">While some areas of our Site are available to the public, many of the features and services that are available on the Site are made available only to NCCAA members (the “Restricted Access Areas”). If you (or your institution, agency or organization) are not an NCCAA member but would like to join, you can request membership by visiting the “Join NCCAA” section of the Site and completing the membership application for the category of membership you seek. The NCCAA membership form will require you to submit certain personally identifying information, such as billing information and general contact information. Your membership application may be reviewed by us before access to the Restricted Access Areas is granted.</p><br>

						<p class="policy-content">You agree to provide true, accurate, current and complete information about yourself (and/or your institution, agency, or organization) as prompted by the applicable application form. If we suspect that any information you have submitted is untrue, inaccurate or incomplete, we reserve the right to suspend or terminate your membership and to refuse any and all current or future use of the Site (or any portion thereof). Our use of any personally identifiable information you provide to us as part of the application process is governed by the terms of our Privacy Policy.</p><br>

						<p class="policy-content">As part of the membership application process, you also will be asked to create a username and password for access to the Restricted Access Areas of the Site. We reserve the right to reject or terminate the use of any username that we deem offensive or inappropriate. You will have the opportunity to change your password by logging in to the Restricted Access Areas of our Site and clicking on “Update Your Details/Change Password.” You are responsible for maintaining the confidentiality of your username and password, and are responsible for all activities (whether by you or by others) that occur under your member account. You agree to notify us immediately of any unauthorized use of your username, password or account or any other breach of security relating to our Site, and to ensure that you log out from your member account at the end of each browsing session.</p><br>

						<p class="policy-title">RESPONSIBILITY FOR USER-SUBMITTED CONTENT</p>
						<p class="policy-content">Our Site may include interactive features, such as discussion groups, comment fields, and other features that allow NCCAA members and other Site users to post content and materials for display on the Site. You will be solely responsible for any and all content and materials of whatever nature that you post on, transmit to or link to from the Site. You agree to indemnify and hold NCCAA and its agents, representatives, directors, officers, employees and licensors, harmless from any liability of any nature arising out of or related to any content or materials submitted to or displayed on the Site by you or by others accessing your member account.</p><br>

						<p class="policy-content">By submitting material to the Site, you represent that you are the owner of the material, or are making your submission with the express consent of the owner, and you grant us, our partners, agents, representatives, and service providers, the worldwide, royalty free, perpetual, irrevocable, non-exclusive and fully sublicensable right and license to use, reproduce, modify, disclose, distribute, adapt, broadcast, translate, create derivative works from, perform and publish such material (in whole or in part) on the Site, or otherwise, and/or to incorporate it into other works in any form, media or technology now known or later developed. You also agree that we may identify you as the author of any of your postings by name, email address or username as we deem appropriate.</p><br>

						<p class="policy-content">You agree not to use any portion of this Site to post or otherwise make available any content or material or, as applicable, to engage in any conduct or activity:</p>
						<ul class="policy-content">
						<li style="color: rgb(112, 112, 112) !important;">that is profane, sexually explicit, tortious, vulgar, obscene, libelous, abusive, or unlawful, or infringes the rights of others or interferes with the ability of others to access or use the Site;</li>
						<li style="color: rgb(112, 112, 112) !important;">that harasses, degrades, intimidates or is hateful toward an individual or group of individuals on the basis of religion, gender, sexual orientation, race, ethnicity, age, or disability;</li>
						<li style="color: rgb(112, 112, 112) !important;">that impersonates any person or entity, including, but not limited to, a Site administrator or another member or user, or that falsely states or otherwise misrepresents your affiliation with a person or entity;</li>
						<li style="color: rgb(112, 112, 112) !important;">that includes personal or identifying information about another person without that person’s explicit consent;</li>
						<li style="color: rgb(112, 112, 112) !important;">that is false, deceptive, misleading, or deceitful;</li>
						<li style="color: rgb(112, 112, 112) !important;">that infringes any copyright, patent, trademark, trade secret or other rights of any party;</li>
						<li style="color: rgb(112, 112, 112) !important;">that you do not have a right to make available under any law or under contractual or fiduciary relationships (such as inside information, proprietary and confidential information learned or disclosed as part of employment relationships or under nondisclosure agreements);</li>
						<li style="color: rgb(112, 112, 112) !important;">that constitutes or includes unsolicited or unauthorized advertising, promotional materials, “spam,” “chain letters,” “pyramid schemes,” or any other form of solicitation; or</li>
						<li style="color: rgb(112, 112, 112) !important;">that interferes with or disrupts the Site or servers or networks connected to the Site, or disobeys any requirements, procedures, policies or regulations of networks connected to the Site.</li>
						
						</ul><br>
						
						<p class="policy-content">We have the right (but not the obligation), in our sole discretion, to screen content and materials submitted by Site users and to edit, move, delete, and/or refuse to accept any materials that in our judgment violate these Terms of Use or are otherwise unacceptable or inappropriate, whether for legal or other reasons. You acknowledge and agree that we may preserve content and materials submitted by you, and may also disclose such content and materials if required to do so by law or if, in our business judgment, such preservation or disclosure is reasonably necessary: (a) to comply with legal process; (b) to enforce these Terms of Use; (c) to respond to claims that any content or materials submitted by you violate the rights of third parties; or (d) to protect the rights, property, or personal safety of our Site, our Site visitors, NCCAA members, us, our officers, directors, staff, representatives, and/or the public.</p><br>

						<p class="policy-title">FINANCIAL TRANSACTIONS</p>
						<p class="policy-content">This Site may (now or in the future) offer the ability for you to submit payment for membership fees, NCCAA Certification fees, or other services or features offered by NCCAA. You (and the institution, agency or organization on whose behalf you are acting) agree to be financially responsible for all purchases made by you or someone acting on your behalf through the Site. You agree to only to make purchases for yourself or for a person, institution, agency, or organization on whose behalf you are legally permitted to do so. If you make a purchase for a third party that requires you to submit such party’s personal information to us, you represent that you have obtained the express consent of such party to provide that personal information.</p><br>

						<p class="policy-title">SUSPENSION AND TERMINATION OF ACCESS</p>
						<p class="policy-content">You agree that, in our sole discretion, we may suspend or terminate your password, account (or any part thereof) or use of the Site, and remove and discard any materials that you submit to the Site, for any reason, including, without limitation, if we believe that you have violated or acted inconsistently with the letter or spirit of these Terms of Use. You agree that we will not be liable to you or any third-party for any suspension or termination of your password, account or use of the Site, or any removal of any materials that you have submitted. In the event that we suspend or terminate your access to and/or use of the Site, you will continue to be bound by the Terms of Use that were in effect as of the date of your suspension or termination.</p><br>

						<p class="policy-title">LINKS TO THIRD-PARTY SITES</p>
						<p class="policy-content">Our Site may include links to websites offered or maintained by third parties. Linking to such third-party sites does not imply an endorsement or sponsorship of such sites, or the information, products or services offered on or through the sites. Because we have no control over such websites, you acknowledge and agree that we are not responsible for the availability of such external websites, and are not responsible or liable for any content, including, without limitation, advertising, products, or other materials, on or available from such sites.</p><br>

						<p class="policy-title">USE OF CONTACT INFORMATION</p>
						<p class="policy-content">Any and all contact information that is displayed on the Site, including the information contained in any member directories or other directories that may be provided on the Site, is provided for informational purposes only and is not to be used for marketing, telemarketing or solicitation purposes, regardless of whether such marketing, telemarketing or solicitation is commercial, non-commercial, charitable or political in nature.</p><br>

						<p class="policy-title">DISCLAIMERS AND LIMITATIONS OF LIABILITY</p>
						<p class="policy-content"><font style="color:#000">No Warranties</font>. YOUR USE OF THE SITE IS AT YOUR SOLE RISK. THIS SITE AND ALL MATERIALS, INFORMATION AND SERVICES AVAILABLE THROUGH IT ARE PROVIDED ON AN “AS IS” AND “AS AVAILABLE” BASIS. WE, OUR AGENTS, REPRESENTATIVES, DIRECTORS, OFFICERS, EMPLOYEES AND LICENSORS CANNOT AND DO NOT WARRANT THE ACCURACY, COMPLETENESS, CURRENTNESS, NONINFRINGEMENT, MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE OF THE MATERIALS, INFORMATION AND SERVICES AVAILABLE THROUGH THE SITE, NOR DO WE GUARANTEE THAT THE MATERIALS, INFORMATION OR SERVICES WILL BE ERROR-FREE, SECURE OR CONTINUOUSLY AVAILABLE, OR FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS. WE MAKE NO WARRANTY THAT (I) THE SITE WILL MEET YOUR REQUIREMENTS, (II) THE RESULTS THAT MAY BE OBTAINED FROM THE USE OF THE SITE WILL BE ACCURATE OR RELIABLE, (III) THE QUALITY OF ANY PRODUCTS, SERVICES, INFORMATION, OR OTHER MATERIAL PURCHASED OR OBTAINED BY YOU THROUGH THE SITE WILL MEET YOUR EXPECTATIONS, OR (IV) ANY ERRORS IN THE SITE WILL BE CORRECTED. IF YOU DOWNLOAD OR OTHERWISE OBTAIN ANY MATERIAL(S) THROUGH THE SITE YOU DO SO AT YOUR OWN DISCRETION AND RISK AND YOU WILL BE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR LOSS OF DATA THAT MAY RESULT. Finally, we are not responsible for the conduct, whether online or offline, of any user of the Site.</p><br>

						<p class="policy-content"><font style="color:#000">Indemnity.</font> You agree to indemnify and hold NCCAA and its agents, representatives, directors, officers, employees and licensors, harmless from any claim or demand, including reasonable attorneys’ fees related to such claim or demand, made by any third party due to or arising out of your use of the Site, your violation of our Terms of Use, or your violation of any rights of another.</p><br>

						<p class="policy-content"><font style="color:#000">Limitation of Liability.</font> UNDER NO CIRCUMSTANCES WILL WE OR OUR AGENTS, REPRESENTATIVES, DIRECTORS, OFFICERS, EMPLOYEES OR LICENSORS BE LIABLE TO YOU OR ANYONE ELSE FOR ANY DAMAGES, INCLUDING, WITHOUT LIMITATION, LIABILITY FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL OR EXEMPLARY DAMAGES, INCLUDING BUT NOT LIMITED TO, DAMAGES FOR LOSS OF PROFITS, GOODWILL, USE, DATA OR OTHER INTANGIBLE LOSSES, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES, RESULTING FROM (A) YOUR USE OF, OR INABILITY TO USE, THE SITE, OR (B) ANY MATERIALS, INFORMATION AND SERVICES AVAILABLE THROUGH THE SITE. (BECAUSE SOME STATES DO NOT ALLOW THE EXCLUSION OR LIMITATION OF CERTAIN CATEGORIES OF DAMAGES, THE ABOVE LIMITATION MAY NOT APPLY TO YOU. IN WHICH CASE OUR LIABILITY AND THE LIABILITY OF OUR AGENTS, REPRESENTATIVES, DIRECTORS, OFFICERS, EMPLOYEES AND LICENSORS IS LIMITED TO THE FULLEST EXTENT PERMITTED BY SUCH STATE LAW.)</p><br>

						<p class="policy-content">Your interactions with companies, organizations and/or individuals found on or through our Site are solely between you and such companies, organizations and/or individuals. We will not be responsible or liable for any loss or damage of any sort incurred as the result of any such dealings and, if there is a dispute between users, or between a user and a third party, we are not obligated to become involved.</p><br>

						<p class="policy-title">MISCELLANEOUS</p>
						<p class="policy-content">We reserve the right at any time and from time to time to modify or discontinue, temporarily or permanently, the Site (or any part thereof) with or without notice. These Terms of Use will be governed by and construed in accordance with the laws of the District of Columbia, United States, without regard to its conflict of laws provisions. By using this Site, you agree to submit to the personal and exclusive jurisdiction of the courts located within the District of Columbia in all disputes or proceedings arising out of or relating to these Terms of Use or your use of the Site. Our failure to exercise or enforce any right or provision of these Terms of Use will not constitute a waiver of such right or provision. If any provision of these Terms of Use is found by a court of competent jurisdiction to be invalid, the parties agree that the court should endeavor to give effect to the parties’ intentions as reflected in the provision, and the other provisions of the Terms of Use will remain in full force and effect. These Terms of Use are not intended to benefit any third party, and may only be invoked or enforced by you or us. This agreement is personal to you and you may not assign it to anyone. You agree that regardless of any statute or law to the contrary, any claim or cause of action arising out of or related to use of the Site or these Terms of Use must be filed within one year after such claim or cause of action arose or be forever barred.</p>	
                        
						<div class="row" style="height:250px;"></div>
						
					</div>
				</div>
				<div class="deadline"></div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script src="../incomecdq/js/script.js"></script>
