<?php

	$cdq_historys = $cdqhistory->readAllAction($_SESSION['user_id']);
	
?>
                      
                      <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="cdq-history" role="tabpanel" aria-labelledby="cdq-history-tab">

                          <div class="add-cme-form block-border ncca-right-padding">

							   <div class="midium-title title-bottom-border">
								   <div class="row">
									   <div class="col-sm-6">
											<p>CDQ EXAM HISTORY</p>
									   </div>
									   <div class="col-sm-6 text-right">
											<p style="display:none"><a href="?content=content/cdqhelp">Help</a></p>
									   </div>
									   <div class="clearfix">
									   </div>
								   </div>
							   </div>
                            <div class="cme-content-block">
<?php
	if(empty($cdq_historys) == false)
	{
		if (count($cdq_historys) > 0) {
			
			if($cdq_historys[0]['action_num'] == 2){
?>
							<div class="row" style="text-align:center !important; border: 1px solid #e5e5e5; color: #656565; margin:0px;">
							
								<div class="col-md-12" style="margin-top:15px; color:#000">
								
									<b style="font-size:15px;">Payment has been made!</b>
									
								</div>
								
								<div class="col-md-12" style="margin-top:15px;">
									<p>
<?php
		
	echo "You are registered to take the ". $cdqhistory->expectedExamDate($cdq_historys[0]['exam_mon'], $cdq_historys[0]['exam_year'], 'full') ." CDQ Exam";

?></p>
								</div>
								
								<div class="col-md-12" style="margin-top:15px;">
									<p>View your receipt below for further info</p>
								</div>
								
								<div class="col-md-12" style="margin-top:15px;">
									<p>Scheduling permits to be released after registration closes</p>
								</div>
								
								<div class="col-md-12" style="margin-top:25px;">
								</div>
								
							</div>
							

<?php				
				
			}else if($cdq_historys[0]['action_num'] > 2){
				
?>
							<div class="row" style="text-align:center !important; border: 1px solid #e5e5e5; color: #656565; margin:0px;">
							
								<div class="col-md-12" style="margin-top:15px; color:#000">
								
									<b style="font-size:15px;"><?=$cdqhistory->retake_info($_SESSION['user_id'], $cdq_historys[0]['exam_mon'])['title']?></b>
									
								</div>
								
								<div class="col-md-12" style="margin-top:15px;">
									<p>There are a total of two retakes allowed to pass the CDQ exam</p>
								</div>
								
								<div class="col-md-12" style="margin-top:15px;">
									<p>You are required to take the next CDQ exam on <font style="color:red"><?=$cdqhistory->retake_info($_SESSION['user_id'], $cdq_historys[0]['exam_mon'])['due']?></font></p>
								</div>
								
								<div class="col-md-12" style="margin-top:15px;">
									<p>Watch your email for Scheduling Permit info over the next weeks</p>
								</div>
								
								<div class="col-md-12" style="margin-top:15px;">
									<p>The Retake fee is $150.00</p>
								</div>
								
								<div class="col-md-12" style="margin-top:20px;">
								</div>
								
							</div>
							
							<div class="row"  style="margin-top:20px;">
							
								<div class="col-md-12 text-center">
									<input type="button" class="btn btn-success" onclick="cdq_retake_pay('<?=$cdq_historys[0]['exam_mon']?>')" style="width:30%" value="Pay Now"  />
								</div>
							
							</div>
							

<?php				
				
			}else{
				
				include_once "content/cdqDateTable.php";
				
			}
			
		}else{
				
				include_once "content/cdqDateTable.php";
				
		}
		
	}else{
				
		include_once "content/cdqDateTable.php";
				
	}
	?>

								<br>

								<strong style="font-size:15px;font-weight:600;color:#000">CDQ Examination</strong><br><p>The Examination for Continued Demonstration of Qualifications of Anesthesiologist Assistants (CDQ Examination) is one component of the ongoing certification process for anesthesiologist assistants in the United States. The CDQ Examination is designed to test the cognitive and deductive skills of the practicing certified anesthesiologist assistant who has successfully entered and continues to participate in the certification process for anesthesiologist assistants administered by NCCAA.</p>

								<br>
								<p><strong style="font-size:15px;font-weight:600;color:#000">Eligibility for CDQ Examination</strong><br>To be eligible to apply for the CDQ Examination, a candidate must be currently certified as an anesthesiologist assistant by the National Commission for Certification of Anesthesiologist Assistants, where current means at the time of application.</p>
								
								<br>
								<p><strong style="font-size:15px;font-weight:600;color:#000">Scheduling an Examination</strong><br>Within 30 days after closing the of the registration period, scheduling permits will be released via email by the National Board of Medical Examiners. The candidate should follow the instructions on the scheduling permit to reserve a seat at a Prometric testing center. Prometric is solely responsible for scheduling and rescheduling examinations.</p>
								
                                <div style="height:30px"></div>

								<p><strong style="font-size:15px;font-weight:600;color:#000">Previous CDQ Exams</strong></p>

								<div class="row">

									<div class="col-sm-12 align-self-center">

										<table class="credit table" style="color:#656565;">
											
											<thead>

												<tr>

													<th scope="col">Date</th>

													<th scope="col">Amount</th>

													<th scope="col">Action</th>

													<th scope="col">Document</th>

												</tr>

											</thead>
											
											<tbody style='font-size:14px;font-weight:600;'>
											<?php
											
											if(empty($cdq_historys) == true)
											{
												$out = "<tr style=\"background-color:#e2efd9; text-align:center;\">
												<td colspan='4'>There is no history data available until the next CDQ payment is made.</td>
												</tr>";
												echo $out;
											}
											
											if(empty($cdq_historys) == false)
											{
												if (count($cdq_historys) > 0) {
													
													for ($i = 0;$i<count($cdq_historys);$i++){
														
														$get_date = getdate($cdq_historys[$i]['action_date']);
														
														$action_number[$i] = $cdqhistory->readActionContent($cdq_historys[$i]['action_num'], $cdq_historys[$i]['exam_year']);

															if($cdq_historys[$i]['action_num'] == 0){
																
																	$out = "<tr style=\"text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>

																	</tr>";
																	
															}else if($cdq_historys[$i]['action_num'] == 1){
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>

																	</tr>";
																	
															}else if($cdq_historys[$i]['action_num'] == 2){
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\"><i>" . $action_number[$i]	. "</i></td>
																		
																		<td></td>

																	</tr>";
																	
															}else if($cdq_historys[$i]['action_num'] == 3){
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>

																	</tr>";
																	
															}else if($cdq_historys[$i]['action_num'] == 4){
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>
																	</tr>";
																	
															}else if($cdq_historys[$i]['action_num'] == 5){
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		
																		<td></td>
																		
																		<td scope=\"row\">" . $action_number[$i] . "</td>
																		
																		<td></td>
																		
																	</tr>";
																	
															}else if($cdq_historys[$i]['action_num'] == 6){
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $cdqhistory->readActionAmount($cdq_historys[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i] . " CDQ Exam</td>

																		<td scope=\"row\"><a href=\"receipt/cdq.php?&receipt_id=". $cdq_historys[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
																	
															}else if($cdq_historys[$i]['action_num'] == 7){
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $cdqhistory->readActionAmount($cdq_historys[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i] . " CDQ Exam(LATE FEE)</td>

																		<td scope=\"row\"><a href=\"receipt/cdq.php?&receipt_id=". $cdq_historys[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
																	
															}else if($cdq_historys[$i]['action_num'] == 8){
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $cdqhistory->readActionAmount($cdq_historys[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i] . " CDQ Exam</td>

																		<td scope=\"row\"><a href=\"receipt/cdq.php?&receipt_id=". $cdq_historys[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
																	
															}else if($cdq_historys[$i]['action_num'] == 9){
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $cdqhistory->readActionAmount($cdq_historys[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i] . " CDQ Exam(LATE FEE)</td>

																		<td scope=\"row\"><a href=\"receipt/cdq.php?&receipt_id=". $cdq_historys[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
																	
															}else if($cdq_historys[$i]['action_num'] > 9){
																
																	$out = "<tr style=\"background-color:#e2efd9; text-align:left;\">

																		<td scope=\"row\">". $get_date['mon']. "/" . $get_date['mday'] . "/" .$get_date['year']."</td>
																		<td scope=\"row\">$" . $cdqhistory->readActionAmount($cdq_historys[$i]['amount_num']) . "</td>

																		<td scope=\"row\">" . $action_number[$i] . " CDQ Exam</td>

																		<td scope=\"row\"><a href=\"receipt/cdq.php?&receipt_id=". $cdq_historys[$i]['id'] ."\">View Receipt</a></td>

																	</tr>";
															}
														
														echo $out;
													}
												}
											}

                                            ?>


											</tbody>

										</table>

									</div>

								</div>

							</div>

                          </div>                        

                        </div>

                      </div>

<script>

function select_cdq_date1(){
	
	location.href="?content=content/cdqhistory&cdq_month=2";
	
}

function select_cdq_date2(){
	
	location.href="?content=content/cdqhistory&cdq_month=6";
	
}

$(window).scroll(function() {
	
  sessionStorage.scrollTop = $(this).scrollTop();
  
});

$(document).ready(function() {
	
  if (sessionStorage.scrollTop != "undefined") {
	  
    $(window).scrollTop(sessionStorage.scrollTop);
	
  }
  
});

</script>