<?php
   if (isset($_GET["select_exam_date"]))
   {
       $result = $exam->readAll($_GET["select_exam_date"]);
   }
   else
   {
       $result = $exam->readAll('');
   }
   $select_exam_date = getdate(strtotime('2019-01-01'));
   require_once ("admin_dashboard.php");
   ?>
<style>
   .dataTables_length, .dataTables_info {
      display: block !important;
   }
</style>

<div class="member-cards card">
<h3 class="exam-title">Exams</h3>
<div class="form-group">
   <div class="row">
      <div class="col-md-12">
         <div class="col-md-4">
            <a href="?content=content/cmes&li_class=Exams&cme_add_date=61" class="btn select_exams" id="select_cme">CMEs</a>
         </div>
         <div class="col-md-4">
            <a href="?content=content/exams&li_class=Exams" class="btn select_exams" id="select_cdq" align="center" style="background: rgb(36,96,139); color: white;">CDQs</a>
         </div>
         <div class="col-md-4">
            <a href="?content=content/certification&li_class=Exams" class="btn select_exams" id="select_certification">Certification</a>
         </div>
      </div>
   </div>
   <div class="row" style="margin-top:20px">
      <div class="col-md-12" align="center">
         <a href="?content=content/exams&li_class=Exams&select_exam_date=21" style="font-weight: bold; color: <?php
            if (isset($_GET['select_exam_date']))
            {
                if ($_GET['select_exam_date'] == 21)
                {
                    echo "#c32b33;";
                }
            }
            ?>">Feb. <?=$exam->expectedExamDate(2, ($select_exam_date['year'] + 1) , 'day') . ", " . ($select_exam_date['year'] + 1) ?></a>
         <a href="?content=content/exams&li_class=Exams&select_exam_date=61" style="font-weight: bold; padding-left: 40px; color: <?php
            if (isset($_GET['select_exam_date']))
            {
                if ($_GET['select_exam_date'] == 61)
                {
                    echo "#c32b33;";
                }
            }
            ?>">June <?=$exam->expectedExamDate(6, ($select_exam_date['year'] + 1) , 'day') . ", " . ($select_exam_date['year'] + 1) ?></a>
         <a href="?content=content/exams&li_class=Exams&select_exam_date=22" style="font-weight: bold; padding-left: 40px; color: <?php
            if (isset($_GET['select_exam_date']))
            {
                if ($_GET['select_exam_date'] == 22)
                {
                    echo "#c32b33;";
                }
            }
            ?>">Feb. <?=$exam->expectedExamDate(2, ($select_exam_date['year'] + 2) , 'day') . ", " . ($select_exam_date['year'] + 2) ?></a>
         <a href="?content=content/exams&li_class=Exams&select_exam_date=62" style="font-weight: bold; padding-left: 40px; color: <?php
            if (isset($_GET['select_exam_date']))
            {
                if ($_GET['select_exam_date'] == 62)
                {
                    echo "#c32b33;";
                }
            }
            ?>">June <?=$exam->expectedExamDate(6, ($select_exam_date['year'] + 2) , 'day') . ", " . ($select_exam_date['year'] + 2) ?></a>
         <a href="?content=content/exams&li_class=Exams&select_exam_date=23" style="font-weight: bold; padding-left: 40px; color: <?php
            if (isset($_GET['select_exam_date']))
            {
                if ($_GET['select_exam_date'] == 23)
                {
                    echo "#c32b33;";
                }
            }
            ?>">Feb. <?=$exam->expectedExamDate(2, ($select_exam_date['year'] + 3) , 'day') . ", " . ($select_exam_date['year'] + 3) ?></a>
         <a href="?content=content/exams&li_class=Exams&select_exam_date=63" style="font-weight: bold; padding-left: 40px; color: <?php
            if (isset($_GET['select_exam_date']))
            {
                if ($_GET['select_exam_date'] == 63)
                {
                    echo "#c32b33;";
                }
            }
            ?>">June <?=$exam->expectedExamDate(6, ($select_exam_date['year'] + 3) , 'day') . ", " . ($select_exam_date['year'] + 3) ?></a>
      </div>
   </div>
   <div class="clearfix"></div>
</div>
<table id="memberTable" class="table exam-stable table-striped table-bordered nowrap" style="width:100%; text-align:center; font-size:14px !important">
   <thead>
      <tr>
         <th>User ID</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Date Paid</th>
         <th>Amount</th>
         <th>Exam Date</th>
         <th>Show/No Show</th>
         <th>Pass/Fail</th>
      </tr>
   </thead>
   <tbody>
      <?php
         if ($result)
         {
             foreach ($result as $rec)
             {
         ?>
      <tr>
         <td><?php echo $rec[0]['user_id'] ?></td>
         <td><?php echo '<a href="../index.php?dXNlcl9yb2xl=' . base64_encode('CAA') . '&dXNlcl9pZA===' . base64_encode($rec[0]['user_id']) . '" target="_blank">' . $rec[0]['first_name'] . '</a>'; ?></td>
         <td><?php echo '<a href="../index.php?dXNlcl9yb2xl=' . base64_encode('CAA') . '&dXNlcl9pZA===' . base64_encode($rec[0]['user_id']) . '" target="_blank">' . $rec[0]['last_name'] . '</a>'; ?></td>
         <td><?php $date = getdate($rec[0]['action_date']);
            echo $date['mon'] . "/" . $date['mday'] . "/" . $date['year']; ?></td>
         <td><?php echo ("$" . $exam->readActionAmount($rec[0]['amount_num'])); ?></td>
         <td><?php echo $exam->expectedExamDate($rec[0]['exam_mon'], $rec[0]['exam_year'], 'full'); ?></td>
         <td>
            <select class = "form-control" style = "width:100%; font-size:16px; padding-left:5px;" id = "show_allow_id<?php echo $rec[0]['user_id']; ?>" onchange = "javascript:show_allow(<?php echo $rec[0]['user_id'] ?>);">
               <?php
                  $show_set = array(
                      "Select",
                      "Show",
                      "No Show"
                  );
                  foreach ($show_set as $key)
                  { ?>
               <option 
                  <?php
                     if ($rec[0]['show_allow'] == 0)
                     {
                         $key_value = "Select";
                     }
                     if ($rec[0]['show_allow'] == 1)
                     {
                         $key_value = "Show";
                     }
                     if ($rec[0]['show_allow'] == 2)
                     {
                         $key_value = "No Show";
                     }
                     if ($key_value == $key)
                     {
                         echo 'selected = "selected"';
                     }
                     ?> 
                  value = "<?php echo array_search($key, $show_set); ?>">
                  <?php echo $key ?> 
               </option>
               <?php
                  } ?>
            </select>
         </td>
         <td>
            <select class = "form-control" style = "width:100%; font-size:16px;padding-left:5px;" id = "admin_select_id<?php echo $rec[0]['user_id']; ?>" onchange = "javascript:admin_select(<?php echo $rec[0]['user_id'] ?>);">
               <?php
                  $order_set = array(
                      "Select",
                      "Pass",
                      "Fail"
                  );
                  foreach ($order_set as $key)
                  { ?>
               <option 
                  <?php
                     if ($rec[0]['action_num'] < 2)
                     {
                         $key_value = "Pass";
                     }
                     if ($rec[0]['action_num'] == 2)
                     {
                         $key_value = "Select";
                     }
                     if ($rec[0]['action_num'] > 2)
                     {
                         $key_value = "Fail";
                     }
                     if ($key_value == $key)
                     {
                         echo 'selected = "selected"';
                     }
                     ?> 
                  value = "<?php echo array_search($key, $order_set); ?>">
                  <?php echo $key ?> 
               </option>
               <?php
                  } ?>
            </select>
         </td>
      </tr>
      <?php
         }
         }
         else
         {
         ?>	
      <tr>
         <td colspan = "7" align = "center">No registered data</td>
      </tr>
      <?php
         }
         ?>
   </tbody>
</table>
<div class="row">
   <div class="col-md-10"></div>
   <div class="col-md-2">
      <button class="save_data" id="save_data">SAVE</button>
   </div>
</div>

<script>
$('.exam-stable').DataTable({
   order: [3, 'desc'],
   lengthMenu: [50, 100, 250, 500],
   columnDefs: [
      {
         targets: [6,7],
         render: function (data, type, full, meta){
            if(type === 'filter' || type === 'sort'){
               var api = new $.fn.dataTable.Api(meta.settings);
               var td = api.cell({row: meta.row, column: meta.col}).node();
               data = $('select, input', td).val();
            }
            return data;
         }
      }
   ],
});
</script>