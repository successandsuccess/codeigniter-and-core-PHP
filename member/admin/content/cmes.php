<?php
   if (isset($_GET["cme_add_date"])) {
       $result = $audit->readAll_cmetab($_GET["cme_add_date"]);
   } else {
       $result = $audit->readAll_cmetab('');
   }
   $cme_add_date = date('Y');
   require_once("admin_dashboard.php");
   ?>
<style>
.dataTables_length, .dataTables_info {
    display: block !important;
}
#admin-cmes a{
   color: #92badc;
}
</style>
<div class="member-cards card">
<h3 class="exam-title">Exams</h3>
<div class="form-group">
   <div class="row">
      <div class="col-md-12">
         <div class="col-md-4">
            <a href="?content=content/cmes&li_class=Exams&cme_add_date=61" class="btn select_exams" id="select_cme"  style="background: rgb(36,96,139); color: white;">CMEs</a>
         </div>
         <div class="col-md-4">
            <a href="?content=content/exams&li_class=Exams" class="btn select_exams" id="select_cdq" align="center">CDQs</a>
         </div>
         <div class="col-md-4">
            <a href="?content=content/certification&li_class=Exams" class="btn select_exams" id="select_certification">Certification</a>
         </div>
      </div>
   </div>
   <div class="row" style="margin-top:20px" id="admin-cmes">
      <div class="col-md-12" align="center">
         <a href="?content=content/cmes&li_class=Exams&cme_add_date=61" style="font-weight: bold; color: <?php
            if (isset($_GET['cme_add_date'])) {
                if ($_GET['cme_add_date'] == 61) {
                    echo "#337ab7;";
                }
            }
            ?>">June <?= $exam->expectedExamDateForCME(6, $cme_add_date, 'day') . ", " . ($cme_add_date) ?></a>
         <a href="?content=content/cmes&li_class=Exams&cme_add_date=62" style="font-weight: bold; padding-left: 100px; color: <?php
            if (isset($_GET['cme_add_date'])) {
                if ($_GET['cme_add_date'] == 62) {
                    echo "#337ab7;";
                }
            }
            ?>">June <?= $exam->expectedExamDateForCME(6, ($cme_add_date + 1), 'day') . ", " . ($cme_add_date + 1) ?></a>
         <a href="?content=content/cmes&li_class=Exams&cme_add_date=63" style="font-weight: bold; padding-left: 100px; color: <?php
            if (isset($_GET['cme_add_date'])) {
                if ($_GET['cme_add_date'] == 63) {
                    echo "#337ab7;";
                }
            }
            ?>">June <?= $exam->expectedExamDateForCME(6, ($cme_add_date + 2), 'day') . ", " . ($cme_add_date + 2) ?></a>
      </div>
   </div>
   <div class="clearfix"></div>
</div>
<table id="cme_memberTable" class="table table-striped table-bordered nowrap" style="width:100%; font-size:14px !important">
   <thead>
      <tr>
	  	 <th>#</th>
         <th>User ID</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Date Paid</th>
         <th>Amount</th>
         <th>Cycle</th>
      </tr>
   </thead>
   <tbody>
      <?php
	  		$inc = 1;
         if ($result) {
             foreach ($result as $rec) {
         ?>
      <tr>
         <td style="width: 10%"><?php
            echo $inc;
            ?></td>
         <td style="width: 10%">
            <?php echo $rec[0]['user_id'];?>
         </td>
         <td style="width: 20%;"><?php
            echo '<a href="../index.php?dXNlcl9yb2xl=' . base64_encode('CAA') . '&dXNlcl9pZA===' . base64_encode($rec[0]['user_id']) . '" target="_blank">' . $rec[0]['first_name'] . '</a>';
            ?></td>
         <td style="width: 20%;"><?php
             echo '<a href="../index.php?dXNlcl9yb2xl=' . base64_encode('CAA') . '&dXNlcl9pZA===' . base64_encode($rec[0]['user_id']) . '" target="_blank">' . $rec[0]['last_name'] . '</a>';
            ?></td>
         <td style="width: 15%;"><?php
            echo date("m/d/Y", $rec[0]['action_date']);
            ?></td>
         <td style="width: 12%;"><?php
            echo ("$" . $audit->readActionAmount($rec[0]['amount_num']));
            ?></td>
         <td style="width: 13%;"><?php
            echo $rec[0]['cme_cycle_start'] . " - " . ($rec[0]['cme_cycle_start'] + 2);
            ?></td>
      </tr>
      <?php
	  		$inc++;
         }
         } else {
         ?>    
      <tr>
         <td colspan = "5" align = "center">There is no data available.</td>
      </tr>
      <?php
         }
         ?>
   </tbody>
</table>
<script>
   $('#cme_memberTable').DataTable({
      order: [4, 'desc'],
      "pageLength": 50,
      "deferRender": true,
      "orderClasses": false,
      searching: true,
      paging: true,
      lengthMenu: [25, 50, 100, 250, 500],
   });
</script>