<?php
   if (empty($_SESSION['admin_id']) || $_SESSION['admin_id'] == "")
   {
       header('Location: /logincaamember.php');
   }
   else
   {
       //certification Show/no show
       if (isset($_POST['student_id']) && isset($_POST['show_certification_id']))
       {
           $certification->updateShowAllow($_POST);
       }
       //certification pass/fail
       if (isset($_POST['student_id']) && isset($_POST['admin_certification_id']))
       {
           $certification->updateActionNum($_POST);
       }
       if (isset($_GET["select_exam_date"]))
       {
           $result = $certification->readAll($_GET["select_exam_date"]);
       }
       else
       {
           $result = $certification->readAll('');
       }
       $select_exam_date = getdate(strtotime('2019-01-01'));
       require_once ("admin_dashboard.php");
   }
   ?>
<style>
   .tab-menu{float:left; width:100%; background:rgba(51,51,51,.03);    padding:16px 24px 10px;}
   ul.tabs{
   margin: 0px;
   padding: 0px;
   list-style: none; float:left;    height: 20px;
   }
   ul.tabs li{
   color: #24608B;
   padding:3px 5px;
   display: inline-block;
   cursor: pointer; font-size:14px;font-family: 'CirceBold'; line-height:20px; position:relative;
   }
   ul.tabs li.current{
   color:#000; font-family: 'CirceRegular';
   background-color:#24608B;
   color:#fff;
   }
   /*ul.tabs li.current:before{position:absolute; left:0; bottom:-10px; height:2px; width:100%; background:#333333; content:''; }*/
   .tab-content{
   display: none;
   }
   .tab-content.current{
   display: inherit;
   }
   .owl-theme .owl-nav {
   margin: 0 !important;
   }   
   .owl-carousel .owl-nav button.owl-prev {
   left: -25px !important;
   width: 30px;
   height: 30px; background:url(../../images/prev.png) no-repeat center center !important;
   }
   .owl-carousel .owl-nav button.owl-prev span,.owl-carousel .owl-nav button.owl-next span{display:none !important;}
   .owl-carousel .owl-nav button.owl-next {
   right: -25px !important;
   width: 30px;
   height: 30px;background:url(../../images/next.png) no-repeat center center !important;
   }
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
            <a href="?content=content/exams&li_class=Exams" class="btn select_exams" id="select_cdq" align="center">CDQs</a>
         </div>
         <div class="col-md-4">
            <a href="?content=content/certification&li_class=Exams" class="btn select_exams" id="select_certification"  style="background: rgb(36,96,139); color: white;">Certification</a>
         </div>
      </div>
   </div>
   <div class="row" style="margin-top:20px">
      <div class="col-md-12" align="center">
         <a href="?content=content/certification&li_class=Exams&select_exam_date=21" style="font-weight: bold; color: <?php
            if (isset($_GET['select_exam_date']))
            {
                if ($_GET['select_exam_date'] == 21)
                {
                    echo "#c32b33;";
                }
            }
            ?>">Feb. <?=$certification->expectedExamDate(2, ($select_exam_date['year'] + 1) , 'day') . ", " . ($select_exam_date['year'] + 1) ?></a>
         <a href="?content=content/certification&li_class=Exams&select_exam_date=61" style="font-weight: bold; padding-left: 8px; color: <?php
            if (isset($_GET['select_exam_date']))
            {
                if ($_GET['select_exam_date'] == 61)
                {
                    echo "#c32b33;";
                }
            }
            ?>">June <?=$certification->expectedExamDate(6, ($select_exam_date['year'] + 1) , 'day') . ", " . ($select_exam_date['year'] + 1) ?></a>
         <a href="?content=content/certification&li_class=Exams&select_exam_date=101" style="font-weight: bold; padding-left: 8px; color: <?php
            if (isset($_GET['select_exam_date']))
            {
                if ($_GET['select_exam_date'] == 101)
                {
                    echo "#c32b33;";
                }
            }
            ?>">Oct. <?=$certification->expectedExamDate(10, ($select_exam_date['year'] + 1) , 'day') . ", " . ($select_exam_date['year'] + 1) ?></a>
         <a href="?content=content/certification&li_class=Exams&select_exam_date=22" style="font-weight: bold; padding-left: 8px; color: <?php
            if (isset($_GET['select_exam_date']))
            {
                if ($_GET['select_exam_date'] == 22)
                {
                    echo "#c32b33;";
                }
            }
            ?>">Feb. <?=$certification->expectedExamDate(2, ($select_exam_date['year'] + 2) , 'day') . ", " . ($select_exam_date['year'] + 2) ?></a>
         <a href="?content=content/certification&li_class=Exams&select_exam_date=62" style="font-weight: bold; padding-left: 8px; color: <?php
            if (isset($_GET['select_exam_date']))
            {
                if ($_GET['select_exam_date'] == 62)
                {
                    echo "#c32b33;";
                }
            }
            ?>">June <?=$certification->expectedExamDate(6, ($select_exam_date['year'] + 2) , 'day') . ", " . ($select_exam_date['year'] + 2) ?></a>
         <a href="?content=content/certification&li_class=Exams&select_exam_date=102" style="font-weight: bold; padding-left: 8px; color: <?php
            if (isset($_GET['select_exam_date']))
            {
                if ($_GET['select_exam_date'] == 102)
                {
                    echo "#c32b33;";
                }
            }
            ?>">Oct. <?=$certification->expectedExamDate(10, ($select_exam_date['year'] + 2) , 'day') . ", " . ($select_exam_date['year'] + 2) ?></a>
         <a href="?content=content/certification&li_class=Exams&select_exam_date=23" style="font-weight: bold; padding-left: 8px; color: <?php
            if (isset($_GET['select_exam_date']))
            {
                if ($_GET['select_exam_date'] == 23)
                {
                    echo "#c32b33;";
                }
            }
            ?>">Feb. <?=$certification->expectedExamDate(2, ($select_exam_date['year'] + 3) , 'day') . ", " . ($select_exam_date['year'] + 3) ?></a>
         <a href="?content=content/certification&li_class=Exams&select_exam_date=63" style="font-weight: bold; padding-left: 8px; color: <?php
            if (isset($_GET['select_exam_date']))
            {
                if ($_GET['select_exam_date'] == 63)
                {
                    echo "#c32b33;";
                }
            }
            ?>">June <?=$certification->expectedExamDate(6, ($select_exam_date['year'] + 3) , 'day') . ", " . ($select_exam_date['year'] + 3) ?></a>
         <a href="?content=content/certification&li_class=Exams&select_exam_date=103" style="font-weight: bold; padding-left: 8px; color: <?php
            if (isset($_GET['select_exam_date']))
            {
                if ($_GET['select_exam_date'] == 103)
                {
                    echo "#c32b33;";
                }
            }
            ?>">Oct. <?=$certification->expectedExamDate(10, ($select_exam_date['year'] + 3) , 'day') . ", " . ($select_exam_date['year'] + 3) ?></a>
      </div>
   </div>
   <div class="clearfix"></div>
</div>
<table id="memberTable" class="table certification-stable table-striped table-bordered nowrap" style="width:100%; text-align:center; font-size:14px !important">
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
         <td><?php echo '<a href="../index.php?dXNlcl9yb2xl=' . base64_encode('Student') . '&dXNlcl9pZA===' . base64_encode($rec[0]['user_id']) . '" target="_blank">' . $rec[0]['first_name'] . '</a>'; ?></td>
         <td><?php echo '<a href="../index.php?dXNlcl9yb2xl=' . base64_encode('Student') . '&dXNlcl9pZA===' . base64_encode($rec[0]['user_id']) . '" target="_blank">' . $rec[0]['last_name'] . '</a>'; ?></td>
         <td><?php $date = getdate($rec[0]['action_date']);
            echo $date['mon'] . "/" . $date['mday'] . "/" . $date['year']; ?></td>
         <td><?php echo ("$" . $certification->readActionAmount($rec[0]['amount_num'])); ?></td>
         <td><?php echo $certification->expectedExamDate($rec[0]['exam_mon'], $rec[0]['exam_year'], 'full'); ?></td>
         <td>
            <select class = "form-control" style = "width:100%; font-size:16px; padding-left:5px;" id = "show_certification_id<?php echo $rec[0]['user_id']; ?>" onchange = "javascript:show_certification(<?php echo $rec[0]['user_id'] ?>);">
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
            <select class = "form-control" style = "width:100%; font-size:16px;padding-left:5px;" id = "admin_certification_id<?php echo $rec[0]['user_id']; ?>" onchange = "javascript:admin_certification(<?php echo $rec[0]['user_id'] ?>);">
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
   $('.certification-stable').DataTable({
   
   
   
      order:[3, 'desc'],
   
   
   
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