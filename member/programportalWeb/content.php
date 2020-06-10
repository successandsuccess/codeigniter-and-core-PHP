					<div class="row">
					
						<div class="col-md-12">
							<div class="col-md-7"></div>
							<div class="col-md-3" align="right">

								<input type="button" class="btn btn-primary" id="setting" value="Settings" style="width:83px;"/>

							</div>
							<div class="col-md-2" align="right">

								<input  type="button" class="btn btn-primary" id="add_new" value="Add New" style="width:83px;" />

							</div>
						</div>
						<div class="loading-modal"></div>
						
<!---overview start--------------->
                        <div id="overview_section" style="display:none;">
						
							<div class="col-md-4">

								<div class="yeardetialblock">

									<ul>

										<li><p># Students <span id="count_student"></span></p></li>

										<li><p>Matriculation <span><?php echo $matriculation_date;?></span></p></li>

										<li><p>Expected ITE Exam <span><?php echo $ite_exam_date;?></span></p></li>

										<li><p>Expected Cert Exam <span><?php echo $cert_date;?></span></p></li>

										<li><p>Expected Graduation<span><?php echo $graduation_date;?></span></p></li><br>
							
									</ul>
									<p>Step 1 – click on the graduating year and then the button above “Settings” to add important milestone dates for that particular class.<br><br>Step 2 – click on the graduation year and then the button above “Add New” to add students to that graduating year. To delete a student, please contact NCCAA or add comments below.</p><br>
									<p>Add Comments (<a class="add_comment">click here</a>)</p>

								</div>

							</div>

							<div class="col-md-8 padding-l-0">

								<table id="overviewTable" class="table ntable table-striped table-bordered nowrap whiteheading" style="width:100%;">

									<thead>

										<tr>

											<th></th>

											<th onclick="javascript:sort_overview_firstname()">First Name</th>

											<th onclick="javascript:sort_overview_lastname()">Last Name</th>

											<th onclick="javascript:sort_overview_class()">Class</th>

											<th onclick="javascript:sort_overview_email()">Email</th>
											

									</thead>

									<tbody id="load_overview_data">
									
									</tbody>

								</table>

								<div class="form-group tablebtn whitesubmit">
								
									<input type="hidden" id="name_click_num" name="name_click_num" value="0" />
									
									<input type="hidden" id="class_click_num" name="class_click_num" value="0" />
									
									<input type="hidden" id="email_click_num" name="email_click_num" value="0" />
									
									<input type="hidden" id="ite_score_click" name="ite_score_click" value="0" />
									
									<input type="hidden" id="cert_score_click" name="cert_score_click" value="0" />
									
									<input type="hidden" id="graduation_score_click" name="graduation_score_click" value="0" />

									<input type="button" value="Submit" class="btn btn-primary" onclick="javascript:check_submit()" />

								</div>

							</div>
							
						</div>
						
<!---overview end----------------->


<!---ITE exam start--------------->
                        <div id="ite_section" style="display:none;">

							<div class="col-md-4">

								<div class="yeardetialblock greyblock">

									<h3>ITE Exam</h3>

									<ul>

										<li><p>Expected ITE Exam <span><?php echo $ite_exam_date;?></span></p></li>

										<li><p>Registration begins <span><?php echo $ite_begins_date;?></span></p></li>
										
										<li><p>Registration ends <span><?php echo $ite_ends_date;?></span></p></li>

									</ul><br>

									<p>For NCCAA to coordinate with NBME, during the registration period, please check the box to the left of the student name for those students who will be taking the ITE exam and select the “Submit” button. If a student will not be taking the ITE exam, please use the “Comments” link below to provide specific information (ie, dropped out of program, not taking ITE but will take CERT exam, etc.).  NCCAA Admin will complete the process by selecting pass/fail on the far right for each student upon release of scores.</p><br>
									<p>Add Comments (<a class="add_comment">click here</a>)</p>

								</div>

							</div>

							<div class="col-md-8 padding-l-0">

								<table id="overviewTable" class="table ntable table-striped table-bordered nowrap greyheading" style="width:100%">

									<thead>

										<tr>

											<th></th>

											<th onclick="javascript:sort_ite_firstname()">First Name</th>

											<th onclick="javascript:sort_ite_lastname()">Last Name</th>

											<th onclick="javascript:sort_ite_class()">Class</th>

											<th onclick="javascript:sort_ite_email()">Email</th>

											<th onclick="javascript:sort_ite_score()">Score</th>

									</thead>

									<tbody id="load_ite_data">

									</tbody>

								</table>

								<div class="form-group tablebtn greysubmit">

									<input type="button" value="Submit" class="btn btn-primary" onclick="javascript:check_submit()" />

								</div>

							</div>
							
						</div>
<!---ITE exam end--------------------------->


<!---Certification exam start--------------->
                        <div id="cert_section" style="display:none;">
						
							<div class="col-md-4">

								<div class="yeardetialblock orgblock">

									<h3>Cert Exam - NCCAA</h3>

									<ul>

										<li><p>Expected Cert Exam <span><?php echo $cert_date;?></span></p></li>

										<li><p>Registration begins <span><?php echo $cert_begins_date;?></span></p></li>
										
										<li><p>Registration ends <span><?php echo $cert_ends_date;?></span></p></li>

									</ul><br>

									<p>To verify student eligibility for the Certification Exam, click on the box to the left of each student.  Leave the box unchecked for those students who will not take the exam at this time.  NCCAA Admin will complete the process by selecting pass/fail on the far right for each student, upon release of scores. 

									For students who are not eligible, click on “Comments”  below to indicate if this student has dropped out of the program or any other pertinent info.  Please be specific.
									</p><br>
									<p>Add Comments (<a class="add_comment">click here</a>)</p>

								</div>

							</div>

							<div class="col-md-8 padding-l-0">

								<table id="certexamTable" class="table ntable table-striped table-bordered nowrap orgheading" style="width:100%">

									<thead>

										<tr>

											<th></th>

											<th onclick="javascript:sort_cert_firstname()">First Name</th>

											<th onclick="javascript:sort_cert_lastname()">Last Name</th>

											<th onclick="javascript:sort_cert_class()">Class</th>

											<th onclick="javascript:sort_cert_email()">Email</th>

											<th onclick="javascript:sort_cert_score()">Score</th>

									</thead>

									<tbody id="load_cert_data">

									</tbody>

								</table>

								<div class="form-group tablebtn orgsubmit">

									<input type="button" value="Submit" class="btn btn-primary" onclick="javascript:check_submit()" />

								</div>

							</div>
							
						</div>
<!---Certification exam end--------->


<!---Graduation start--------------->
                        <div id="graduation_section" style="display:none;">

							<div class="col-md-4">

								<div class="yeardetialblock blueblock">

									<h3>Graduation</h3>

									<ul>

										<li><p>Expected Graduation <span><?php echo $graduation_date;?></span></p></li>

									</ul><br>
									<p>Upon graduation, click on the box to the left of each student.  Leave the box unchecked for those students who will not graduate at this time.  NCCAA Admin will complete the process by selecting pass/fail on the far right for each student, which will in turn release the certificate. 

									For students who do not graduate, click on “Comments” below to indicate if this student has dropped out of the program, delayed graduation, or any other pertinent info.  Please be specific.

									</p><br>
									<p>Add Comments (<a class="add_comment">click here</a>)</p>

								</div>

							</div>

							<div class="col-md-8 padding-l-0">

								<table id="graduationTable" class="table ntable table-striped table-bordered nowrap blueheading" style="width:100%">

									<thead>

										<tr>

											<th></th>

											<th onclick="javascript:sort_graduation_firstname()">First Name</th>

											<th onclick="javascript:sort_graduation_lastname()">Last Name</th>

											<th onclick="javascript:sort_graduation_class()">Class</th>

											<th onclick="javascript:sort_graduation_email()">Email</th>

											<th onclick="javascript:sort_graduation_score()">Score</th>

									</thead>

									<tbody id="load_graduation_data">

									</tbody>

								</table>

								<div class="form-group tablebtn bluesubmit">

									<input type="button" value="Submit" class="btn btn-primary" onclick="javascript:check_submit()" />

								</div>

							</div>

						</div>
						
                    </div>
<!---Graduation end--------------->

