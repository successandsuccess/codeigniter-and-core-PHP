<?php
   $info = "";
   $total_amount = "";
   $member_email = "";
   $member_name = "";
   if (empty($_GET['financial_id']) == false || $_GET['financial_id'] > 0)
   {
       $info = $financial->readFinancialById($_GET['financial_id']);
       $total_amount = $financial->total_count_id($_GET['financial_id']);
       $member_email = $financial->get_email_id($_GET['financial_id']);
   }
   if (empty($_GET['member_name']) == false)
   {
       $member_name = $_GET['member_name'];
   }
   require_once ("admin_dashboard.php");
   ?>
<div class="member-card card">
   <h4><font style="font-size:15px; text-transform: capitalize; align:center;font-weight: 600; text-align:center;color:#A3162C;"><?php echo $member_name . ": </font> Financial Ledger"; ?></h4>
   <a class="backbtn"  onclick="go_back();" ><span class="glyphicon glyphicon-chevron-left"></span>Back</a>
   <div class="right">
      <input type="button" onclick="javascript:print_financialMemberDetail(document.getElementById('print_financialMemberDetail_table'))"  class="btn btn-primary" value="Print" />
      <a href="../receipt/financial_pdf_student.php?&financial_id=<?php echo $_GET['financial_id']; ?>" class="btn btn-primary">Save as PDF</a>
   </div>
   <br><br>
   <table id="financialLedgerDetail" class="table stable table-striped table-bordered nowrap" style="width:100%">
      <thead>
         <tr>
            <th>#</th>
			<th>User ID</th>
            <th>Date</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Amount</th>
         </tr>
      </thead>
      <tbody>
         <?php
            if ($info != "")
            {
                if (count($info) > 0)
                {
                    for ($i = 0;$i < count($info);$i++)
                    {
            ?>		<input class="hidden" id="count_tr" value="<?php echo count($info); ?>" />
         <tr id="financial_tr<?php echo $i ?>" style="cursor:pointer;">
            <td style="cursor:pointer;"><?php echo $i + 1 ?></td>
			<td><?php echo $info[$i]['user_id']; ?> </td>
            <td><?php echo $financial->convert_date($info[$i]['action_date']); ?></td>
            <td><?php echo '<a href="../index.php?dXNlcl9yb2xl=' . base64_encode('Student') . '&dXNlcl9pZA===' . base64_encode($info[$i]['user_id']) . '" target="_blank">' . $info[$i]['first_name'] . ' ' . $info[$i]['last_name'] . '</a>'; ?></td>
            <td><a href="mailto:<?php if ($member_email != "") echo $member_email; ?>"><?php echo $member_email; ?></a></td>
            <td><?php echo $info[$i]['exam_type']; ?></td>
            <td <?php if ($info[$i]['exam_type'] == 'Admin') echo "onclick='javascript:edit_financial_modal(" . $info[$i]['id'] . ")'"; ?>><?php echo $financial->pay_amount($info[$i]['amount_num'], $info[$i]['exam_type']); ?></td>
         </tr>
         <?php
            }
            }
            else
            {
            ?>	
         <tr style="cursor:pointer;">
            <td colspan="6" align="center">No registered data</td>
         </tr>
         <?php
            }
            }
            ?>
      </tbody>
   </table>
   <table id="print_financialMemberDetail_table" class="table table-striped table-bordered nowrap" style="width:100%; display:none;">
      <thead>
         <tr>
            <th style="width: 8%">#</th>
			<th style="width: 10%">User ID</th>
            <th style="width: 12%">Date</th>
            <th style="width: 18%">Full Name</th>
            <th style="width: 30%">Email</th>
            <th style="width: 13%">Type</th>
            <th style="width: 9%">Amount</th>
         </tr>
      </thead>
      <tbody>
         <?php
            if ($info != "")
            {
                if (count($info) > 0)
                {
                    for ($i = 0;$i < count($info);$i++)
                    {
            ?>		<input class="hidden" id="count_tr" value="<?php echo count($info); ?>" />
         <tr id="financial_tr<?php echo $i ?>" style="cursor:pointer;">
            <td style="width: 8%"><?php echo $i + 1 ?></td>
			<td style="width: 10%"><?php echo $info[$i]['user_id'] ?></td>
            <td style="width: 12%"><?php echo $financial->convert_date($info[$i]['action_date']); ?></td>
            <td style="width: 18%"><?php echo $info[$i]['first_name'] . " " . $info[$i]['last_name']; ?></td>
            <td style="width: 30%"><?php echo $member_email; ?></td>
            <td style="width: 13%"><?php echo $info[$i]['exam_type']; ?></td>
            <td  style="width: 9%"><?php echo $financial->pay_amount($info[$i]['amount_num'], $info[$i]['exam_type']); ?></td>
         </tr>
         <?php
            }
            }
            else
            {
            ?>	
         <tr style="cursor:pointer;">
            <td colspan="6" align="center">No registered data</td>
         </tr>
         <?php
            }
            }
            ?>
      </tbody>
   </table>
   <div class="total">
      <h2>Total <span><?php if ($total_amount != "") echo "$" . number_format($total_amount, 2); ?></span></h2>
   </div>
</div>
<script>
   function print_financialMemberDetail(elem){
   	$("#print_financialMemberDetail_table").show();
   	$("div").hide();
       var domClone = elem.cloneNode(true);
       var $printSection = document.getElementById("printSection");
       if (!$printSection) {
           var $printSection = document.createElement("div");
           $printSection.id = "printSection";
           document.body.appendChild($printSection);
       }
       $printSection.innerHTML = "";
       $printSection.appendChild(domClone);
       window.print();
   	location.href = "?content=content/financial_student&li_class=Financials&financial_id=<?=$_GET['financial_id'] ?>&member_name=<?=$_GET['member_name'] ?>";
   }
</script>