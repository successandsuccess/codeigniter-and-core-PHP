<?php
   if (empty($_SESSION['admin_id']) || $_SESSION['admin_id'] == "")
   {
       header('Location: /logincaamember.php');
   }
   else
   {
       if (empty($_POST['edit_id']) == false && $_POST['edit_id'] > 0)
       {
           $financial->update_financial($_POST);
           $_POST = array();
       }
       if (empty($_POST['delete_id']) == false && $_POST['delete_id'] > 0)
       {
           $financial->delete_financial($_POST);
           $_POST = array();
       }
       if (empty($_POST['add_amount']) == false)
       {
           $financial->add_financial($_POST);
           $_POST = array();
       }
       $info = $financial->readAllFinancial();
       if (empty($_GET['s_year']) == false || empty($_GET['s_term']) == false || empty($_GET['s_type']) == false)
       {
           $info = $financial->load_financial_filter($_GET);
       }
       $total_students = $financial->getTotalMember('Student');
       $total_caas = $financial->getTotalMember('CAA');
       // print_r($total_students);
       require_once ("admin_dashboard.php");
   }
   ?>
<script src='./js/select2.min.js' type='text/javascript'></script>
<link href='./css/select2.min.css' rel='stylesheet' type='text/css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
<div class="member-card card">
   <h3>Financial General Ledger</h3>
   <div class="form-group">
      <div class="left">
         <a href="?content=content/financial_report&li_class=Financials" class="btn btn-default">Report</a>
         <!--a href="?content=content/financial_report" class="btn btn-default">Print</a-->
      </div>
      <div class="right">
      </div>
      <div class="clearfix"></div>
   </div>
   <div class="form-group">
      <div class="row">
         <div class="col-lg-4">
            <select class="form-control" id="select_year" onchange="javascript:financial_filter_year();">
               <?php
                  $array_year = array(
                      'Select Year',
                      (date('Y') - 1) ,
                      date('Y') ,
                      (date('Y') + 1) ,
                      (date('Y') + 2) ,
                      (date('Y') + 3) ,
                      (date('Y') + 4)
                  );
                  $year_val = array(
                      'null',
                      (date('Y') - 1) ,
                      date('Y') ,
                      (date('Y') + 1) ,
                      (date('Y') + 2) ,
                      (date('Y') + 3) ,
                      (date('Y') + 4)
                  );
                  for ($i = 0;$i < count($array_year);$i++)
                  { ?>
               <option value="<?php echo $year_val[$i]; ?>" 
                  <?php
                     if (empty($_GET['s_year']) == false && $year_val[$i] == $_GET['s_year'])
                     {
                         echo " selected='selected'";
                     }
                     ?>><?php echo $array_year[$i]; ?></option>
               <?php
                  }
                  ?>
            </select>
         </div>
         <div class="col-lg-4">
            <select class="form-control" id="select_term" onchange="javascript:financial_filter_term();">
               <?php
                  $array_term = array(
                      'Select Term',
                      'Today',
                      'Week-to-Date',
                      'Month-to-Date',
                      'Quarter-to-Date',
                      'Year-to-Date',
                      'Last Year',
                      'January',
                      'February',
                      'March',
                      'April',
                      'May',
                      'June',
                      'July',
                      'August',
                      'September',
                      'October',
                      'November',
                      'December'
                  );
                  $term_val = array(
                      'null',
                      'Today',
                      'Week',
                      'Month',
                      'Quarter',
                      'Year',
                      'Last_Year',
                      'January',
                      'February',
                      'March',
                      'April',
                      'May',
                      'June',
                      'July',
                      'August',
                      'September',
                      'October',
                      'November',
                      'December'
                  );
                  for ($i = 0;$i < count($array_term);$i++)
                  { ?>
               <option value="<?php echo $term_val[$i]; ?>" 
                  <?php
                     if (empty($_GET['s_term']) == false && $term_val[$i] == $_GET['s_term'])
                     {
                         echo " selected='selected'";
                     }
                     ?>><?php echo $array_term[$i]; ?></option>
               <?php
                  }
                  ?>
            </select>
         </div>
         <div class="col-lg-4">
            <select class="form-control" id="select_type" onchange="javascript:financial_filter_type();">
               <?php
                  $array_type = array(
                      'Select Type',
                      'All Types',
                      'ITE Only',
                      'Certification only',
                      'CDQ only',
                      'CME only',
                      'Expenses only',
                      'Interest only',
                      'Other only'
                  );
                  $type_val = array(
                      'null',
                      'All',
                      'ITE',
                      'Certification',
                      'CDQ',
                      'CME',
                      'Admin',
                      'Interest',
                      'Other'
                  );
                  for ($i = 0;$i < count($array_type);$i++)
                  { ?>
               <option value="<?php echo $type_val[$i]; ?>" 
                  <?php
                     if (empty($_GET['s_type']) == false && $type_val[$i] == $_GET['s_type'])
                     {
                         echo " selected='selected'";
                     }
                     ?>><?php echo $array_type[$i]; ?></option>
               <?php
                  }
                  ?>
            </select>
         </div>
      </div>
   </div>
   <table id="financialLedger" class="table table-striped table-bordered nowrap" style="width:100%">
      <thead>
         <tr>
            <th style="text-align:center;"><input type="button" onclick="javascript:print_admin_financial(document.getElementById('print_financialLedger'))" value="Print" /></th>
            <th>Date</th>
            <th>User</th>
            <th>Description</th>
            <th>Category</th>
            <th>Amount</th>
         </tr>
      </thead>
      <tbody>
         <?php
            if (empty($info) == false)
            {
                for ($i = 0;$i < count($info);$i++)
                {
            ?>		
         <input class="hidden" id="count_tr" value="<?php echo count($info); ?>" />
         <tr id="financial_tr<?php echo $i ?>" style="cursor:pointer;">
            <td align="center"><input type="checkbox" id="check_financial<?php echo $i ?>" onclick='javascript:tr_baground(<?php echo $i ?>)' style="width:20px; height:20px; cursor:pointer;" /></td>
            <td <?php if ($info[$i]['exam_type'] == 'Admin') echo "onclick='javascript:edit_financial_modal(" . $info[$i]['id'] . ")'"; ?>><?php echo $financial->convert_date($info[$i]['action_date']); ?></td>
            <td><?php echo '<a href="../index.php?dXNlcl9yb2xl=' . base64_encode('CAA') . '&dXNlcl9pZA===' . base64_encode($info[$i]['user_id']) . '" target="_blank">' . $info[$i]['user_id'] . '</a>'; ?></td>
            <td><a href="?content=content/financial_student&li_class=Financials&financial_id=<?php echo $info[$i]['user_id']; ?>&member_name=<?php echo $info[$i]['first_name'] . " " . $info[$i]['last_name']; ?>"><?php echo $info[$i]['first_name'] . " " . $info[$i]['last_name']; ?></a></td>
            <?php if ($info[$i]['exam_type'] == 'Admin')
               { ?>
            <td><a href="?content=content/financial_type&li_class=Financials&financial_exam_type=<?php echo $info[$i]['exam_type']; ?>&financial_receipt_title=<?=$info[$i]['receipt_title'] ?>">
               <?php echo $info[$i]['receipt_title']; ?>
               </a>
            </td>
            <?php
               }
               else if ($info[$i]['exam_type'] == 'CME')
               { ?>
            <td><a href="?content=content/financial_type&li_class=Financials&financial_exam_type=<?php echo $info[$i]['exam_type']; ?>&exam_mon=<?=$info[$i]['exam_mon'] ?>&exam_year=<?=$info[$i]['cme_cycle_start'] ?>">
               <?php echo $financial->category_title($info[$i]['exam_mon'], $info[$i]['exam_year'], $info[$i]['cme_cycle_start'], $info[$i]['exam_type'], $info[$i]['receipt_title']); ?>
               </a>
            </td>
            <?php
               }
               else
               { ?>
            <td><a href="?content=content/financial_type&li_class=Financials&financial_exam_type=<?php echo $info[$i]['exam_type']; ?>&exam_mon=<?=$info[$i]['exam_mon'] ?>&exam_year=<?=$info[$i]['exam_year'] ?>">
               <?php echo $financial->category_title($info[$i]['exam_mon'], $info[$i]['exam_year'], $info[$i]['cme_cycle_start'], $info[$i]['exam_type'], $info[$i]['receipt_title']); ?>
               </a>
            </td>
            <?php
               } ?>
            <td <?php if ($info[$i]['exam_type'] == 'Admin') echo "onclick='javascript:edit_financial_modal(" . $info[$i]['id'] . ")'"; ?>><?php echo $financial->pay_amount($info[$i]['amount_num'], $info[$i]['exam_type']); ?></td>
         </tr>
         <div id="edit_financial<?php echo $info[$i]['id']; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width:400px; -webkit-transform: translate(0,50%); -o-transform: translate(0,50%); transform: translate(0,50%);">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <div class="edit_financial_title" style="margin-top:10px">Edit financial</div>
                  </div>
                  <div class="modal-body" style="height:220px;">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="col-md-4">
                              <label>Date</label>
                           </div>
                           <div class="col-md-8">
                              <input type="text" class="form-control reducesize datepicker" name="edit_date<?php echo $info[$i]['id']; ?>" id="edit_date<?php echo $info[$i]['id']; ?>" value="<?php echo $financial->admin_date($info[$i]['action_date']); ?>" >
                           </div>
                        </div>
                        <div class="col-md-12" style="margin-top:15px;">
                           <div class="col-md-4">
                              <label>Description</label>
                           </div>
                           <div class="col-md-8">
                              <input type="text" class="form-control reducesize" name="edit_description<?php echo $info[$i]['id']; ?>" id="edit_description<?php echo $info[$i]['id']; ?>" value="<?php echo $info[$i]['first_name']; ?>" >
                           </div>
                        </div>
                        <div class="col-md-12" style="margin-top:15px;">
                           <div class="col-md-4">
                              <label>Category</label>
                           </div>
                           <div class="col-md-8">
                              <input type="text" class="form-control reducesize" name="edit_category<?php echo $info[$i]['id']; ?>" id="edit_category<?php echo $info[$i]['id']; ?>" value="<?php echo $info[$i]['receipt_title']; ?>" >
                           </div>
                        </div>
                        <div class="col-md-12" style="margin-top:15px; margin-bottom:15px;">
                           <div class="col-md-4">
                              <label>Amount</label>
                           </div>
                           <div class="col-md-8">
                              <input type="text" class="form-control reducesize" name="edit_amount<?php echo $info[$i]['id']; ?>" id="edit_amount<?php echo $info[$i]['id']; ?>" value="<?php echo "$" . number_format($info[$i]['amount_num'], 2); ?>" >
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <a type="button" class="btn btn-primary" onclick="javascript:update_financial(<?php echo $info[$i]['id']; ?>);" style="width:67px;" >Update</a>
                     <a type="button" class="btn btn-primary" onclick="javascript:delete_financial(<?php echo $info[$i]['id']; ?>);" style="width:67px;" >Delete</a>
                  </div>
               </div>
            </div>
         </div>
         <?php
            }
            }
            else
            {
            ?>	
         <tr style="cursor:pointer;">
            <td colspan="5" align="center">No registered data</td>
         </tr>
         <?php
            }
            ?>
      </tbody>
   </table>
   <table id="print_financialLedger" class="table table-striped table-bordered nowrap" style="width:100%; display:none;">
      <thead>
         <tr>
            <th style="width:15%;">Date</th>
            <th style="width:15%">User</th>
            <th style="width:15%;">Description</th>
            <th style="width:40%;">Category</th>
            <th style="width:15%;">Amount</th>
         </tr>
      </thead>
      <tbody>
         <?php
            if (empty($info) == false)
            {
                for ($i = 0;$i < count($info);$i++)
                {
            ?>		
         <tr id="print_financial_tr<?php echo $i ?>" style="cursor:pointer;">
            <td  style="width:15%;" <?php if ($info[$i]['exam_type'] == 'Admin') echo "onclick='javascript:edit_financial_modal(" . $info[$i]['id'] . ")'"; ?>><?php echo $financial->convert_date($info[$i]['action_date']); ?></td>
            <td style="width:15%"><?php echo $info[$i]['user_id'] ?></td>
            <td  style="width:15%;" <?php if ($info[$i]['exam_type'] == 'Admin') echo "onclick='javascript:edit_financial_modal(" . $info[$i]['id'] . ")'"; ?>><?php echo $info[$i]['first_name'] . " " . $info[$i]['last_name']; ?></td>
            <td  style="width:40%;">
               <?php echo $financial->category_title($info[$i]['exam_mon'], $info[$i]['exam_year'], $info[$i]['cme_cycle_start'], $info[$i]['exam_type'], $info[$i]['receipt_title']); ?>
            </td>
            <td  style="width:15%;" <?php if ($info[$i]['exam_type'] == 'Admin') echo "onclick='javascript:edit_financial_modal(" . $info[$i]['id'] . ")'"; ?>><?php echo $financial->pay_amount($info[$i]['amount_num'], $info[$i]['exam_type']); ?></td>
         </tr>
         <?php
            }
            }
            else
            {
            ?>	
         <tr style="cursor:pointer;">
            <td colspan="4" align="center">No registered data</td>
         </tr>
         <?php
            }
            ?>
      </tbody>
   </table>
   <div class="clearfix">
      <div class="right" style="margin-top: 5px;">
         <input type="button" id="add_cert" class="btn btn-primary" value="Cert" />
         <input type="button" id="add_cdq" class="btn btn-primary" value="CDQ" />
         <input type="button" id="add_cme" class="btn btn-primary" value="CME" />
         <input type="button" id="add_admin" class="btn btn-primary" value="Admin" />
      </div>
   </div>
</div>
<div id="add_cert_modal" class="modal fade" role="dialog">
   <div class="modal-dialog" style="width:435px; -webkit-transform: translate(0,30%); -o-transform: translate(0,30%); transform: translate(0,30%);">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="edit_financial_title" style="margin-top:10px">Add cert financial</div>
         </div>
         <div class="modal-body" style="height:395px;">
            <div class="row">
               <div class="col-md-12" style="margin-top:10px;">
                  <div class="col-md-4" align="right">
                     <label>Student name</label>
                  </div>
                  <div class="col-md-8">
                     <select id="cert_name" style="width: 238px;" placeholder = "Select Student">
                        <option value=''>Select Student</option>
                        <?php
                           $ii = 0;
                           while ($ii < count($total_students))
                           {
                               echo '<option value="' . $total_students[$ii]['id'] . '">' . $total_students[$ii]['full_name'] . ' (' . $total_students[$ii]['role'] . ')</option>';
                               $ii++;
                           }
                           ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-4" align="right">
                     <label>Date paid</label>
                  </div>
                  <div class="col-md-8">
                     <input type="text" class="form-control datepicker" id="cert_date" >
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-4" align="right">
                     <label>Card number</label>
                  </div>
                  <div class="col-md-8">
                     <input type="text" class="form-control" placeholder="Enter card last 4 number" id="cert_4cardnum">
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-4" align="right">
                     <label>Exam month</label>
                  </div>
                  <div class="col-md-8">
                     <select class="form-control" id="cert_month">
                        <option value='0'>Select exam month</option>
                        <option value='2'>February</option>
                        <option value='6'>June</option>
                        <option value='10'>October</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-4" align="right">
                     <label>Exam year</label>
                  </div>
                  <div class="col-md-8">
                     <select class="form-control" id="cert_year">
                        <option value='0'>Select exam year</option>
                        <option value='<?=(date("Y") - 1) ?>'><?=(date("Y") - 1) ?></option>
                        <option value='<?=date("Y") ?>'><?=date("Y") ?></option>
                        <option value='<?=(date("Y") + 1) ?>'><?=(date("Y") + 1) ?></option>
                     </select>
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-4" align="right">
                     <label>Category</label>
                  </div>
                  <div class="col-md-8">
                     <select class="form-control" id="cert_category"  onchange="cert_category_change()">
                        <option value='0'>Select Category</option>
                        <?php
                           $cert_i = 0;
                           $array_category = array(
                               'Certification Income Exam',
                               'Certification Income Late Fee',
                               'Certification Income Retake #1',
                               'Certification Income Retake #2',
                               'Certification Income Retake #3',
                               'Certification Income Retake #4',
                               'Certification Income Retake #5'
                           );
                           while ($cert_i < count($array_category))
                           {
                               echo '<option value="' . ($cert_i + 1) . '">' . $array_category[$cert_i] . '</option>';
                               $cert_i++;
                           }
                           ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px; margin-bottom:15px;">
                  <div class="col-md-4" align="right">
                     <label>Amount</label>
                  </div>
                  <div class="col-md-8">
                     <input type="text" class="form-control" id="cert_amount" readonly />
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <input type="button" class="btn btn-primary" id="add_cert_info" style="width:67px;" value="Add" />
            <input type="button" class="btn btn-primary" data-dismiss="modal" style="width:67px;" value="Cancel" />
         </div>
      </div>
   </div>
</div>
<div id="add_cdq_modal" class="modal fade" role="dialog">
   <div class="modal-dialog" style="width:435px; -webkit-transform: translate(0,30%); -o-transform: translate(0,30%); transform: translate(0,30%);">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="edit_financial_title" style="margin-top:10px">Add CDQ financial</div>
         </div>
         <div class="modal-body" style="height:395px;">
            <div class="row">
               <div class="col-md-12"  style="margin-top:10px;">
                  <div class="col-md-4" align="right">
                     <label>CAA name</label>
                  </div>
                  <div class="col-md-8">
                     <select id="cdq_name" style="width: 238px;" placeholder="Select CAA">
                        <option value=''>Select CAA</option>
                        <?php
                           $ii = 0;
                           while ($ii < count($total_caas))
                           {
                               echo '<option value="' . $total_caas[$ii]['id'] . '">' . $total_caas[$ii]['full_name'] . ' (' . $total_caas[$ii]['role'] . ')</option>';
                               $ii++;
                           }
                           ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-4" align="right">
                     <label>Date paid</label>
                  </div>
                  <div class="col-md-8">
                     <input type="text" class="form-control datepicker" id="cdq_date" >
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-4" align="right">
                     <label>Card number</label>
                  </div>
                  <div class="col-md-8">
                     <input type="text" class="form-control" placeholder="Enter card last 4 number" id="cdq_4cardnum">
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-4" align="right">
                     <label>Exam month</label>
                  </div>
                  <div class="col-md-8">
                     <select class="form-control" id="cdq_month">
                        <option value='0'>Select exam month</option>
                        <option value='2'>February</option>
                        <option value='6'>June</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-4" align="right">
                     <label>Exam year</label>
                  </div>
                  <div class="col-md-8">
                     <select class="form-control" id="cdq_year">
                        <option value='0'>Select exam year</option>
                        <option value='<?=(date("Y") - 1) ?>'><?=(date("Y") - 1) ?></option>
                        <option value='<?=date("Y") ?>'><?=date("Y") ?></option>
                        <option value='<?=(date("Y") + 1) ?>'><?=(date("Y") + 1) ?></option>
                     </select>
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-4" align="right">
                     <label>Category</label>
                  </div>
                  <div class="col-md-8">
                     <select class="form-control" id="cdq_category"  onchange="cdq_category_change()">
                        <option value='0'>Select Category</option>
                        <?php
                           $cdq_i = 0;
                           $array_category = array(
                               'CDQ Exam Income',
                               'CDQ Exam Income Late Fee',
                               'CDQ Income Retake #1',
                               'CDQ Income Retake #2'
                           );
                           while ($cdq_i < count($array_category))
                           {
                               echo '<option value="' . ($cdq_i + 1) . '">' . $array_category[$cdq_i] . '</option>';
                               $cdq_i++;
                           }
                           ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px; margin-bottom:15px;">
                  <div class="col-md-4" align="right">
                     <label>Amount</label>
                  </div>
                  <div class="col-md-8">
                     <input type="text" class="form-control" id="cdq_amount" readonly />
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <input type="button" class="btn btn-primary" id="add_cdq_info" style="width:67px;" value="Add" />
            <input type="button" class="btn btn-primary" data-dismiss="modal" style="width:67px;" value="Cancel" />
         </div>
      </div>
   </div>
</div>
<div id="add_cme_modal" class="modal fade" role="dialog">
   <div class="modal-dialog" style="width:435px; -webkit-transform: translate(0,30%); -o-transform: translate(0,30%); transform: translate(0,30%);">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="edit_financial_title" style="margin-top:10px">Add CME financial</div>
         </div>
         <div class="modal-body" style="height:395px;">
            <div class="row">
               <div class="col-md-12" style="margin-top:10px;">
                  <div class="col-md-4" align="right">
                     <label>CAA name</label>
                  </div>
                  <div class="col-md-8">
                     <select id="cme_name" style="width: 238px;" placeholder="Select CAA">
                        <option value=''>Select CAA</option>
                        <?php
                           $ii = 0;
                           while ($ii < count($total_caas))
                           {
                               echo '<option value="' . $total_caas[$ii]['id'] . '">' . $total_caas[$ii]['full_name'] . ' (' . $total_caas[$ii]['role'] . ')</option>';
                               $ii++;
                           }
                           ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-4" align="right">
                     <label>Date paid</label>
                  </div>
                  <div class="col-md-8">
                     <input type="text" class="form-control datepicker"  id="cme_date" >
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-4" align="right">
                     <label>Card number</label>
                  </div>
                  <div class="col-md-8">
                     <input type="text" class="form-control" placeholder="Enter card last 4 number" id="cme_4cardnum">
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-4" align="right">
                     <label>CME month</label>
                  </div>
                  <div class="col-md-8">
                     <input type="text" class="form-control" value="June" readonly />
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-4" align="right">
                     <label>Submit year</label>
                  </div>
                  <div class="col-md-8">
                     <select class="form-control" id="cme_year">
                        <option value='0'>Select exam year</option>
                        <option value='<?=(date("Y") - 1) ?>'><?=(date("Y") - 1) ?></option>
                        <option value='<?=date("Y") ?>'><?=date("Y") ?></option>
                        <option value='<?=(date("Y") + 1) ?>'><?=(date("Y") + 1) ?></option>
                     </select>
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-4" align="right">
                     <label>Category</label>
                  </div>
                  <div class="col-md-8">
                     <select class="form-control" id="cme_category"  onchange="cme_category_change()">
                        <option value='0'>Select Category</option>
                        <?php
                           $cme_i = 0;
                           $array_category = array(
                               'CME Submission',
                               'CME Income Late Fee'
                           );
                           while ($cme_i < count($array_category))
                           {
                               echo '<option value="' . ($cme_i + 1) . '">' . $array_category[$cme_i] . '</option>';
                               $cme_i++;
                           }
                           ?>
                     </select>
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px; margin-bottom:15px;">
                  <div class="col-md-4" align="right">
                     <label>Amount</label>
                  </div>
                  <div class="col-md-8">
                     <input type="text" class="form-control" id="cme_amount" readonly />
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <input type="button" class="btn btn-primary" id="add_cme_info" style="width:67px;" value="Add" />
            <input type="button" class="btn btn-primary" data-dismiss="modal" style="width:67px;" value="Cancel" />
         </div>
      </div>
   </div>
</div>
<div id="add_admin_modal" class="modal fade" role="dialog">
<div class="modal-dialog" style="width:400px; -webkit-transform: translate(0,50%); -o-transform: translate(0,50%); transform: translate(0,50%);">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <div class="edit_financial_title" style="margin-top:10px">Add Admin financial</div>
      </div>
      <div class="modal-body" style="height:310px;">
         <form id="frmAddfinancial" action="?content=content/financial&li_class=Financials" method="post" enctype="multipart/form-data" autocomplete="off" >
            <div class="row">
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-3" align="right">
                     <label>Date</label>
                  </div>
                  <div class="col-md-9">
                     <input type="text" class="form-control datepicker" name="add_date" id="add_date" placeholder="Date" required />
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-3" align="right">
                     <label>Description</label>
                  </div>
                  <div class="col-md-9">
                     <input type="text" class="form-control" name="add_name" id="add_name" placeholder="Description" required />
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px;">
                  <div class="col-md-3" align="right">
                     <label>Category</label>
                  </div>
                  <div class="col-md-9">
                     <input type="text" class="form-control" name="add_category" placeholder="Category" list="add_category" required />
                     <datalist id="add_category">
                        <?php
                           $array_category = array(
                               'Contractor Expense',
                               'Merchant Expenses',
                               'NBME(Exam Administration)',
                               'Office Expenses',
                               'Management & Administration',
                               'Insurance',
                               'Taxes & Titles',
                               'Test Committee Meeting Expenses',
                               'Test Committee Expense',
                               'Board of Director Expenses',
                               'Accreditation'
                           );
                           $category_val = array(
                               'Contractor Expense',
                               'Merchant Expenses',
                               'NBME(Exam Administration)',
                               'Office Expenses',
                               'Management & Administration',
                               'Insurance',
                               'Taxes & Titles',
                               'Test Committee Meeting Expenses',
                               'Test Committee Expense',
                               'Board of Director Expenses',
                               'Accreditation'
                           );
                           for ($i = 0;$i < count($array_category);$i++)
                           { ?>
                        <option value="<?php echo $category_val[$i]; ?>"><?php echo $array_category[$i]; ?></option>
                        <?php
                           }
                           ?>
                     </datalist>
                  </div>
               </div>
               <div class="col-md-12" style="margin-top:15px; margin-bottom:25px;">
                  <div class="col-md-3" align="right">
                     <label>Amount</label>
                  </div>
                  <div class="col-md-9">
                     <input type="text" class="form-control" name="add_amount" id="add_amount" placeholder="Amount" required />
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <input type="submit" class="btn btn-primary" style="width:67px;" value="Add" />
               <input type="button" class="btn btn-primary" data-dismiss="modal" style="width:67px;" value="Cancel" />
            </div>
         </form>
      </div>
   </div>
</div>
<script src='./js/financial.js' type='text/javascript'></script>
<script>
      $('#cdq_name').selectize({
            sortField: 'text'
      });
      $('#cme_name').selectize({
         sortField: 'text'
      })
      $('#cert_name').selectize({
         sortField: 'text'
      })
</script>