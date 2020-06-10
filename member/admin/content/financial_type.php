<?php 

$info = "";

$total_amount = "";

if(isset($_GET['financial_exam_type'])){

	$info = $financial->readFinancialByExamType($_GET);
	
	$total_amount = $financial->total_count_type($_GET);
		if($_GET['financial_exam_type'] == 'Admin'){				$income_title = "Expenses: Board of Director Expenses";						$pdf_link = "../receipt/financial_pdf_type.php?&financial_exam_type=".$_GET['financial_exam_type'];				$print_link = "?content=content/financial_type&li_class=Financials&financial_exam_type=".$_GET['financial_exam_type']."&financial_receipt_title=".$_GET['financial_receipt_title'];			}else{				if($_GET['exam_mon'] == 2){						$exam_mon = "Feb";					}else if($_GET['exam_mon'] == 6){						$exam_mon = "June";					}else{						$exam_mon = "Oct";					}		if($_GET['financial_exam_type'] == "CME"){						$income_title = "Income: June ". ($_GET['exam_year'] + 2) ." CME Registration";					}else{						$income_title = "Income: ". $exam_mon ." ". $_GET['exam_year'] ." ". $_GET['financial_exam_type'] ." Exam";					}		$pdf_link = "../receipt/financial_pdf_type.php?&financial_exam_type=".$_GET['financial_exam_type']."&exam_mon=".$_GET['exam_mon']."&exam_year=".$_GET['exam_year'];		$print_link = "?content=content/financial_type&li_class=Financials&financial_exam_type=".$_GET['financial_exam_type']."&exam_mon=".$_GET['exam_mon']."&exam_year=".$_GET['exam_year'];	}
}

require_once("admin_dashboard.php");

?><style type="text/css" media="print">    @page     {        size:  auto;         margin: 0mm !important;     }        html    {        background-color: #FFFFFF;         margin: 0px;      }    body    {                margin: 0mm !important;             }		</style>
                <div class="member-card card">
                    <h4><?=$income_title?></h4>
                    <a class="backbtn" onclick="go_back();" ><span class="glyphicon glyphicon-chevron-left"></span>Back</a>
                    
					<div class="right">
						<input type="button" onclick="javascript:print_financialLedgerDetail(document.getElementById('print_financialLedgerDetail_table'))"  class="btn btn-primary" value="Print" />
						<a href="<?=$pdf_link?>" class="btn btn-primary">Save as PDF</a>
					   
					</div><br><br>											
                    <table id="financialLedgerDetail" class="table stable table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Member</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php 
						if($info != ""){
							if(count($info) > 0){
								echo '<input class="hidden" id="count_tr" value="'.count($info).'" />';
								for($i=0; $i < count($info); $i++){
									
							?>		
								<tr id="financial_tr<?php echo $i?>" style="cursor:pointer;">

									<td style="cursor:pointer;"><?php echo $i + 1?></td>

									<td><?php echo $financial->convert_date($info[$i]['action_date']);?></td>

									<td><a href="?content=content/financial_student&li_class=Financials&financial_id=<?php echo $info[$i]['user_id'];?>&member_name=<?php echo $info[$i]['first_name']." ".$info[$i]['last_name'];?>"><?php echo $info[$i]['first_name']." ".$info[$i]['last_name'];?></a></td>

									<td><?php echo $financial->pay_amount($info[$i]['amount_num'], $info[$i]['exam_type']); ?></td>

								</tr>

		
							<?php	}
								
							}else{
								
							?>	
							
							<tr style="cursor:pointer;"><td colspan="4" align="center">No registered data</td></tr>
							
						<?php 
						
							}
						}
						?>

                        </tbody>
                    </table>															
                    <table id="print_financialLedgerDetail_table" class="table table-striped table-bordered nowrap" style="width:100%; display:none;" >
                        <thead>
                            <tr>
                                <th style="width:20%;">#</th>
                                <th style="width:20%;">Date</th>
                                <th style="width:40%;">Member</th>
                                <th style="width:20%;">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php 
						if($info != ""){
							if(count($info) > 0){
								echo '<input class="hidden" id="count_tr" value="'.count($info).'" />';
								for($i=0; $i < count($info); $i++){
									
							?>		
								<tr id="financial_tr<?php echo $i?>" style="cursor:pointer;">

									<td style="width:20%;"><?php echo $i + 1?></td>

									<td style="width:20%;"><?php echo $financial->convert_date($info[$i]['action_date']);?></td>

									<td style="width:40%;"><?php echo $info[$i]['first_name']." ".$info[$i]['last_name'];?></td>

									<td style="width:20%;"><?php echo $financial->pay_amount($info[$i]['amount_num'], $info[$i]['exam_type']); ?></td>

								</tr>

		
							<?php	}
								
							}else{
								
							?>	
							
							<tr style="cursor:pointer;"><td colspan="4" align="center">No registered data</td></tr>
							
						<?php 
						
							}
						}
						?>

                        </tbody>
                    </table>
                    <div class="total">
                        <h2>Total <span><?php if($total_amount != "") echo "$".number_format($total_amount, 2);?></span></h2>
                    </div>
                </div><script>function print_financialLedgerDetail(elem){		$("#print_financialLedgerDetail_table").show();		$("div").hide();	    var domClone = elem.cloneNode(true);        var $printSection = document.getElementById("printSection");        if (!$printSection) {		        var $printSection = document.createElement("div");		        $printSection.id = "printSection";		        document.body.appendChild($printSection);		    }        $printSection.innerHTML = "";	    $printSection.appendChild(domClone);	    window.print();		location.href = "<?=$print_link?>";	}	</script>