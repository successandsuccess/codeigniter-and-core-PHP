<?php 

	$info = $financial->readAllCertFinancial();
	
	require_once("admin_dashboard.php");


?>

                <div class="member-card card">
                    <h4>Report</h4>
                    <a class="backbtn" onclick="go_back();" ><span class="glyphicon glyphicon-chevron-left"></span>Back</a>										<div class="clearfix" style="height: 15px;"></div>
                    <table id="financialReport" class="table table-striped table-bordered nowrap" style="width:100%;">
                        <thead>
                            <tr>
                                <th>First Name </th>
                                <th>Last Name </th>
                                <th>Paid</th>
                                <th>Amount</th>
                                <th>Program</th>
                                <th>Type</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
						
						<?php 
						
						if(empty($info) == false){
							
							for($i=0; $i < count($info); $i++){
								
						?>	
                            <tr id="financial_tr<?php echo $i?>" style="cursor:pointer;">

                                <td><?php echo $info[$i]['first_name']; ?></td>
                                
								<td><?php echo $info[$i]['last_name']; ?></td>

                                <td><?php echo $financial->convert_date($info[$i]['action_date']);?></td>

                                <td><?php echo $financial->pay_amount($info[$i]['amount_num'], $info[$i]['exam_type']); ?></td>

                                <td style="width: 30%;"><?php if(empty($financial->get_programName($info[$i]['user_id'])) == false){		echo $financial->get_programName($info[$i]['user_id']);	}else{		echo "N/A";	}?>								</td>
                                
								<td>Group</td>
                                
								<td>1st</td>

                            </tr>
						
						<?php	}
							
						}else{
							
						?>	
						
						<tr style="cursor:pointer;"><td colspan="7" align="center">No registered data</td></tr>
							
						<?php 
						
						}
						
						?>

                        </tbody>
                    </table>
                </div>				<script>    $('#financialReport').DataTable( {		"deferRender": true,				"orderClasses": false,				searching: true,		paging: true,				lengthMenu: [10, 50, 100, 500],    } );	    $('#financialReport_length').css('display', 'block');	    $('#financialReport_info').css('display', 'block');</script>				