<?php
global $incomecertification;

include_once "examcertification/classes/historycertification.class.php";

$certificationhistory = new PaymentHistoryCertification();

$expected_date = $certificationhistory->readExpectedDate($_SESSION['user_id']);

$main_month = "";

if(empty($expected_date) == false){
	
	if(substr($expected_date[0]['Expected_Cert_Exam'],0,1) == 0){
		
		$main_month = substr($expected_date[0]['Expected_Cert_Exam'],1,1);
		
	}else{
		
		$main_month = substr($expected_date[0]['Expected_Cert_Exam'],0,2);
		
	}
}

$info = $certificationhistory->payment_info($_SESSION['user_id'], $main_month);

$action_title = $info['title'];
$arr1 = explode("Main", $action_title);$arr2 = explode("Late", $action_title);$arr3 = explode("#1", $action_title);$arr4 = explode("#2", $action_title);$arr5 = explode("#3", $action_title);$arr6 = explode("#4", $action_title);$arr7 = explode("#5", $action_title);if(count($arr1) > 1){		$main_title = "Certification Initial Exam";}if(count($arr2) > 1){		$main_title = "Certification Initial Exam (Late Fee)";}if(count($arr3) > 1){		$main_title = "Certification Retake #1 Exam";}if(count($arr4) > 1){		$main_title = "Certification Retake #2 Exam";}if(count($arr5) > 1){		$main_title = "Certification Retake #3 Exam";}if(count($arr6) > 1){		$main_title = "Certification Retake #4 Exam";}if(count($arr7) > 1){		$main_title = "Certification Retake #5 Exam";}
$pay_num = '0';

$pay_amount = '0';

$main_amount = '0';

$late_amount = '0';

$retake1_amount = '0';

$retake2_amount = '0';

$retake3_amount = '0';

$retake4_amount = '0';

$retake5_amount = '0';

$exam_year = substr($action_title,-5,-1);

$get_due_date = getdate($info['due_date']);

$due_date = $get_due_date['mon'] . "/" . $get_due_date['mday'] . "/" .$exam_year;

if(empty($info['pay_amount_key']) == false){
	
	$pay_amount = $certificationhistory->readActionAmount($info['pay_amount_key']);

	$main_amount = $certificationhistory->readActionAmount($info['pay_amount_key']);

}

$pay_num = $info['pay_amount_key'];

$receipt_amount = "";

if (empty($_POST['certification_Payment']) == false){
	if(empty($_SESSION['user_id']) == false){		$_POST['user_id'] = $_SESSION['user_id'];		$result_cert = $payment->process($_POST);		}else{				header('Location: /logincaamember.php');			}	}

if(!empty($result_cert) && $result_cert['code'] == 'error') {
    $error = $result_cert['msg'];
    echo $certificationhistory->PaymentError();	
}

if(!empty($result_cert) && $result_cert['code'] == 'success') {	
	$incomecertification->insert_income($_POST);		$certificationhistory->insert_CertificationActionHistory($_POST);		$receipt_certification = $certificationhistory->readAllReceipt($_SESSION['user_id']);    	if(empty($receipt_certification) == false){				$receipt_date = getdate($receipt_certification['action_date']);				$receipt_amount = $certificationhistory->readActionAmount($receipt_certification['amount_num']);						$receipt_title = $receipt_certification['receipt_title'];		$re_arr1 = explode("Main", $receipt_title);		$re_arr2 = explode("Late", $receipt_title);		$re_arr3 = explode("#1", $receipt_title);		$re_arr4 = explode("#2", $receipt_title);		$re_arr5 = explode("#3", $receipt_title);		$re_arr6 = explode("#4", $receipt_title);		$re_arr7 = explode("#5", $receipt_title);		if(count($re_arr1) > 1){						$main_receipt_title = "Certification Initial Exam";		}		if(count($re_arr2) > 1){						$main_receipt_title = "Certification Initial Exam (Late Fee)";		}		if(count($re_arr3) > 1){						$main_receipt_title = "Certification Retake #1 Exam";		}		if(count($re_arr4) > 1){						$main_receipt_title = "Certification Retake #2 Exam";		}		if(count($re_arr5) > 1){						$main_receipt_title = "Certification Retake #3 Exam";		}		if(count($re_arr6) > 1){						$main_receipt_title = "Certification Retake #4 Exam";		}		if(count($re_arr7) > 1){						$main_receipt_title = "Certification Retake #5 Exam";		}	}	echo $certificationhistory->PaymentSuccess();
}
?>
<link href="examcertification/css/script.css" rel="stylesheet" type="text/css">
<div class="modal fade" id="paymentContentModal_certification"  role="dialog" style="display:none;">
    <input type="hidden" id="hiddencontainer_certification" name="hiddencontainer_certification" value="1"/>
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content paymentContent">
            <div class="row top_body" style="margin: 0">
                <img src="examcertification/image/logo.png" width="80" height="80">
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
					
                        <?php echo $main_title; ?>
						
                    </h5>
					
                    <p><?php echo $info['detail_title'];?></p>
					
				</div>
				
				<div class="col-md-6">
				
                    <ul>
                        <li><a>Student Name: <span><?php echo $userObject->data["login"]['full_name'];?></span></a></li>
						
                        <li><a>Amount due: <span>$<?php echo $pay_amount; ?></span></a></li>
						
                        <li><a>Due date: <span><?php echo $due_date;?></span></a></li>
						
                        <li><a>Date paid: <span><?php echo date('m/d/Y') ?></span></a></li>
						
                        <li><a>Amount paid: <span>$0 (still due)</span></a></li>
						
                        <li><a>Amount due: <span>$<?php echo $pay_amount; ?> (pay below)</span></a></li>
                    </ul>
                </div>
				
				<div class="col-md-6"></div>
				
            </div>
            <div class="deadline"></div>

            <div class="section2">
			
                <form id="frmStripePaymentcertification" action="./" method="post">
				
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
									
                                    <input class="form-input" id="card-number-certification" type="text" name="number" placeholder="Enter card number" autocomplete="off" required autofocus /><span class="errorContainer"></span>
                                </div>
                                <div class="col-md-6">

                                        <label>Expiration Date</label>
                                        <input class="form-input" id="card-expiry-element-certification" type="text" name="expire_date" placeholder="MM/YY"/>

                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label>Security Code</label>
                                    <input class="form-input" id="code-certification" type="text" name="code" autocomplete="off" placeholder="Enter cvv"/>
                                </div>
                            </div>

                            <div class="deadline2"></div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Name on Card</label>
                                    <input class="form-input" id="name-certification" type="text" name="name" autocomplete="off" placeholder="Enter name"/>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label>Street Address</label>
                                    <input class="form-input" id="address-certification" type="text" name="address" autocomplete="off" placeholder="Enter street address"/>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label>City</label>
                                    <input class="form-input" id="city-certification" type="text" name="city" autocomplete="off" placeholder="Enter city"/>
                                </div>
                                <div class="col-md-6">

									<label>State</label>
									<input class="form-input" id="state-certification" type="text" name="state" autocomplete="off" placeholder="Enter state"/>

                                </div>
                            </div>
                            <div class="row form-group" style="margin-bottom: 0 !important;">
                                <div class="col-md-6">
                                    <label>Zip</label>
                                    <input id="zip-certification" class="form-input" type="text" name="zip" autocomplete="off" placeholder="Enter zip"/>
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
                                    Note: We do not save or keep credit card information for future payments of certifications or Exams
                                </div>
                                <div id="submit-btn">
									<input type="submit" class="form-submit" name="certification_Payment" id="certification_Payment" value="Pay Now"/>
                                </div>
                                <div id="loader" style="margin-top: 30px">
                                    <img alt="loader" src="examcertification/image/LoaderIcon.gif" style="width: 67px;height: 50px;">
                                </div>
                                <div class="section3">
                                    <li><a onclick="certification_privacy_fun()" style="cursor:pointer;">Privacy</a></li>
                                    <li><a onclick="certification_terms_fun()" style="cursor:pointer;">Terms and Conditions</a></li>
                                </div>
                            </div>
							<input type="hidden" id="certification_name" name="certification_name" value="<?php echo $userObject->data["login"]['full_name']; ?>"/>
							
							<input type="hidden" id="certification_date" name="certification_date" value="<?php echo $get_due_date[0] ?>"/>
							
							<input type="hidden" id="amount" name="amount" value="<?php echo $main_amount; ?>"/>
							
							<input type="hidden" id="late_amount" name="late_amount" value="<?php echo $late_amount; ?>"/>
							
							<input type="hidden" id="retake1_amount" name="retake1_amount" value="<?php echo $info['retake1_amount']; ?>"/>
							
							<input type="hidden" id="retake2_amount" name="retake2_amount" value="<?php echo $info['retake2_amount']; ?>"/>
							
							<input type="hidden" id="retake3_amount" name="retake3_amount" value="<?php echo $info['retake3_amount']; ?>"/>
							
							<input type="hidden" id="retake4_amount" name="retake4_amount" value="<?php echo $info['retake4_amount']; ?>"/>
							
							<input type="hidden" id="retake5_amount" name="retake5_amount" value="<?php echo $info['retake5_amount']; ?>"/>
							
							<input type="hidden" id="action_title" name="action_title" value="<?php echo $action_title?>"/>
							
							<input type="hidden" id="detail_title" name="detail_title" value="<?php echo $info['detail_title'];?>"/>
							
							<input type="hidden" id="pay_num" name="pay_num" value="<?php echo $pay_num?>"/>
							
							<input type="hidden" id="certification_year" name="certification_year" value="<?php echo $get_due_date['year'];?>"/>
							
							<input type="hidden" id="certification_month" name="certification_month" value="<?php echo $get_due_date['mon'];?>"/>
							
							<input type='hidden' name='type' value='certification'>
							
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


<!--certification Receipt-->
<div id="certification_receipt_print" >
	<div class="modal fade" id="receiptContentModal_certification"  role="dialog" style="display:none;">

		<div class="modal-dialog modal-lg" role="document">

			<div id="receiptmodal_body_certification" class="modal-content paymentContent" style="min-height: auto;">

				<div class="row top_body" style="margin: 0">
					<img src="examcertification/image/logo.png" width="80" height="80">

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
							<?php echo $main_receipt_title; ?>
						</h5>
						<p><?php echo $receipt_certification['detail_title'];?></p>												<div class="row">														<div class="col-md-5">
																<ul>
									<li><a>Student name: <span><?php echo $userObject->data["login"]['full_name'];?></span></a></li>
									
									<li><a>Amount due: <span><?php echo '$'.$certificationhistory->readActionAmount($receipt_certification['amount_num']); ?></span></a></li>
									
									<li><a>Due date: <span>
									<?php 
										echo $certificationhistory->expectedExamDate($receipt_certification['exam_mon'], $receipt_certification['exam_year'], 'due');
																		?>
									</span></a></li>
									
									<li><a>Date paid: <span><?php echo $receipt_date['mon']."/".$receipt_date['mday']."/".$receipt_date['year'] ?></span></a></li>
									
									<li><a>Amount paid: <span><?php echo '$'.$certificationhistory->readActionAmount($receipt_certification['amount_num']); ?></span></a></li>
									
									<li><a>Amount due: <span>$0</span></a></li>
								</ul>							</div>														<div class="col-md-6" style="border-style: solid; border-width: 2px;border-color: #e5e5e5; padding:0px; color:rgb(112, 112, 112);">															<div class="col-md-12"  align="left" style="margin-top:15px;">									Last 4 digits of credit card used for payment:<font id="final_digits" style="color: #28a745; font-size: 14px;"> <?php if($receipt_certification['card_num4']){										echo $receipt_certification['card_num4'];									}else{										echo "N/A";									}?></font>								</div>								<div class="col-md-12" align="left">									Employer questions regarding verification may be directed to NCCAA:								</div>																<div class="col-md-12" align="center" style="margin-top: 15px">									Cynthia Maraugha								</div>																<div class="col-md-12" align="center">									<i>Director of Operations</i>								</div>																<div class="col-md-12" align="center">									<i class="fa fa-phone"></i> 859-903-0089								</div>																<div class="col-md-12" align="center">									<i class="fa fa-envelope"></i> cynthia.m@nccaa.org								</div>																<div class="col-md-12" align="center" style="margin-top: 15px"></div>															</div>							<div class="col-md-1"></div>						</div>
					</div>

				</div>
				<div class="deadline"></div>

				<div class="row receipt_body">

					<div class="col-md-12">
					<p>Instructions for obtaining your scheduling permit will be released following the close of the registration period and processing by NBME. Do NOT contact Prometric to schedule your exam until permit is received, as the information required for reserving your seat is contained within the scheduling permit.</p>
					</div>
				</div>

				<div class="receipt_bottom">
					<a href="?content=content/history"><i class="fas fa-arrow-left"></i>Back to Certification History</a>
					<a href="" onclick="javascript:receipt_print_certification(document.getElementById('certification_receipt_print'));"><i class="fa fa-print" aria-hidden="true"></i>Print</a>
					<a href="mailto:cynthia.m@nccaa.org"><i class="fas fa-envelope"></i>Email</a>
				</div>
			</div>
		</div>     
	</div>
</div>

<div id="select_error" class="modal fade" role="dialog" style="display:none">
  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			  <div class="modal-header">
			     <img src="examcertification/image/1.svg" width="25" height="25" style="padding-top:0px">&nbsp;&nbsp;
				 <h4 class="modal-title">Warning</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				
			  </div>

			  <div class="modal-body" >
					<div class="row" >
					
						<div class="col-md-12">
						
							<p>Your program takes the Certification exam in <?php 
							if(empty($_GET['main_month']) == false){
								
								if($_GET['main_month'] == 2){
									
									echo "August";
									
								}else if($_GET['main_month'] == 6){
									
									echo "November";
									
								}else if($_GET['main_month'] == 10){
									
									echo "March";
									
								}
							}
								
							?>, therefore, you are not permitted to take the Certification exam on another date</p>
							
						</div>
					</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-blue" data-dismiss="modal">Close</button>
			  </div>
		</div>

   </div>
</div>														
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="examcertification/js/script.js"></script>
