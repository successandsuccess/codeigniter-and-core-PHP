<?php
   if (empty($_GET['cycle']) == true) {
       echo "<script>window.history.back();</script>";
   } else if (empty($_GET['cycle']) == false) {
        $cme_cycle        = $_GET['cycle'];
        $total_audit = $audit->readAllAudit($cme_cycle);
        $total_completed_audit = $audit->readAllCompletedAudit($cme_cycle);
        $total_passed_audit = $audit->readAllPassedAudit($cme_cycle);
        $total_failed_audit = $audit->readAllFailedAudit($cme_cycle);
   }
   require_once("admin_dashboard.php");
   ?>
<div class="member-cards card">
   <div class="cme-title">Detail CME AUDIT : <font style="font-size:15px; text-transform: capitalize; align:center;font-weight: 600; text-align:center;color:#A3162C;"><?php
      echo  $cme_cycle . "-" . ($cme_cycle + 2) ;
      ?></font></div>
   <div class="form-group">
      <div class="left">
         <a href="?content=content/audit&li_class=CME" class="btn btn-primary">< Back</a>
      </div>
      <div class="right">
      </div>
      <div class="clearfix"></div>
   </div>
   <table id="memberTable" class="table stable table-striped table-bordered nowrap" style="width:100%; text-align:center; font-size:14px !important">
      <thead>
         <tr>
            <th>Total Audit</th>
            <th>Completed Audit</th>
            <th>Completed %</th>
            <th>Passed Audit</th>
            <th>Failed Audit</th>
         </tr>
      </thead>
      <tbody>
         <?php
            if ($total_audit) 
            {
            ?>
         <tr>
            <td scope="row"><?php
               echo $total_audit;
               ?>
            </td>
            <td><?php
               echo $total_completed_audit;
               ?>
            </td>
            <td><?php
               echo round(($total_completed_audit/$total_audit)*100, 2)."%";
               ?>
            </td>
            <td align="left"><?php
               echo $total_passed_audit;
               ?>
            </td>
            <td align="left"><?php
               echo $total_failed_audit;
               ?>
            </td>
         </tr>
         <?php
            } 
            else 
            {
            ?>
         <tr>
            <td scope="row" colspan="5" align="center">There is not available any audit still.</td>
         </tr>
         <?php
            }
            ?>
      </tbody>
   </table>
   <div class="row">
   </div>
</div>