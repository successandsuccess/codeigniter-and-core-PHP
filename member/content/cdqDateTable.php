<table class="table table-bordered whiteheading" style="text-align:center;">
   <thead style="font-size:15px;">
      <tr>
         <th colspan="2">To maintain certification, CDQ Exam is taken every six years. Choose one option below:</th>
      </tr>
      <tr  style="cursor:pointer">
         <th onclick="select_cdq_date1()"
            <?php
               if (isset($_GET["cdq_month"]) && $_GET["cdq_month"])
               {
                   if ($_GET["cdq_month"] == '2')
                   {
                       echo "style='background-color:#F2F2F2;'";
                   }
               }
               ?> 
            >
            <input type="radio" name="radio" id="cdq_radio1" 
               style="width:25px;height:25px;float:left; clear: none; display: block;padding: 2px 1em 0 0; margin-left:20px; cursor:pointer"
               <?php
                  if (isset($_GET["cdq_month"]) && $_GET["cdq_month"])
                  {
                      if ($_GET["cdq_month"] == '2')
                      {
                          echo "checked";
                      }
                  }
                  ?> 
               />
            <label for="cdq_radio1" style="cursor:pointer; float: left; clear: none;margin: 2px 0 0 12px;">CDQ EXAM DATE <?php echo $cdqhistory->expectedExamDate(2, date("Y", strtotime($userObject->vitals["cdq_due"])) , 'full'); ?></label>
         </th>
         <th onclick="select_cdq_date2()"
            <?php
               if (isset($_GET["cdq_month"]) && $_GET["cdq_month"])
               {
                   if ($_GET["cdq_month"] == '6')
                   {
                       echo "style='background-color:#F2F2F2;'";
                   }
               }
               ?> style="color:#007FF8">
            <input type="radio" name="radio" id="cdq_radio2" 
               style="width:25px;height:25px;float:left; clear: none; display: block;padding: 2px 1em 0 0; margin-left:20px; cursor:pointer"
               <?php
                  if (isset($_GET["cdq_month"]) && $_GET["cdq_month"])
                  {
                      if ($_GET["cdq_month"] == '6')
                      {
                          echo "checked";
                      }
                  }
                  ?> 
               />
            <label for="cdq_radio2" style="float: left; clear: none;margin: 2px 0 0 12px; cursor:pointer">CDQ EXAM DATE <?php echo $cdqhistory->expectedExamDate(6, date("Y", strtotime($userObject->vitals["cdq_due"])) , 'full'); ?></label>
         </th>
      </tr>
   </thead>
   <tbody  style="font-size:14px;">
      <tr>
         <td>Registration: 8/1/<?php echo (date("Y", strtotime($userObject->vitals["cdq_due"])) - 1); ?> - 9/30/<?php echo (date("Y", strtotime($userObject->vitals["cdq_due"])) - 1); ?>
         </td>
         <td style="color:#007FF8">Registration: 11/1/<?php echo (date("Y", strtotime($userObject->vitals["cdq_due"])) - 1); ?> - 1/15/<?php echo date("Y", strtotime($userObject->vitals["cdq_due"])); ?><br>
         </td>
      </tr>
      <tr>
         <td>Late Registration: 10/1/<?php echo (date("Y", strtotime($userObject->vitals["cdq_due"])) - 1); ?> - <?php echo $cdqhistory->expectedExamDate(2, date("Y", strtotime($userObject->vitals["cdq_due"])) , 'retake_due'); ?>
         </td>
         <td style="color:#007FF8">Late Registration: 1/16/<?php echo date("Y", strtotime($userObject->vitals["cdq_due"])); ?> - <?php echo $cdqhistory->expectedExamDate(6, date("Y", strtotime($userObject->vitals["cdq_due"])) , 'retake_due'); ?>
         </td>
      </tr>
      <tr>
         <td colspan="2">
            <?php
               if (isset($_GET["cdq_month"]) && $_GET["cdq_month"])
               {
                   $nowDay = getdate();
                   $May15th = mktime(0, 0, 0, 5, 16, ($nowDay['year']));
                   $Aug1th = mktime(0, 0, 0, 8, 1, ($nowDay['year']));
                   $CDQExamTitle = $cdqhistory->pay_title($_SESSION['user_id'], $_GET["cdq_month"]);
                   if (empty($cdq_historys) == true)
                   {
                       if (($nowDay[0] > $May15th) && ($nowDay[0] < $Aug1th))
                       {
                           echo '<input type="button" class="btn btn-default" id="using_cdq_month" style="width:30%" value="Pay Now"  />';
                       }
                       else
                       {
                           $d = date("Y", strtotime($userObject->vitals["cdq_due"])) - $nowDay['year'];
                           if ($d > 1)
                           {
                               echo '<input type="button" class="btn btn-default" id="using_cdq_month" style="width:30%" value="Pay Now"  />';
                           }
                           else
                           {
                               if ($cdqhistory->get_CDQExamType($CDQExamTitle) == 2)
                               {
                                   echo '<input type="button" class="btn btn-danger" id="cdq_first_pay" style="width:30%" value="Pay Now"  />';
                               }
                               else
                               {
                                   echo '<input type="button" class="btn btn-success" id="cdq_first_pay" style="width:30%" value="Pay Now"  />';
                               }
                           }
                       }
                   }
                   else if (empty($cdq_historys) == false)
                   {
                       if (($nowDay[0] > $May15th) && ($nowDay[0] < $Aug1th))
                       {
                           echo '<input type="button" class="btn btn-default" id="using_cdq_month" style="width:30%" value="Pay Now"  />';
                       }
                       else
                       {
                           $d = $nowDay['year'] - $cdq_historys[0]['exam_year'];
                           if (($cdq_historys[0]['action_num'] == 0 || $cdq_historys[0]['action_num'] == 1) && ($d < 5))
                           {
                               echo '<input type="button" class="btn btn-default" id="using_cdq_month" style="width:30%" value="Pay Now"  />';
                           }
                           else
                           {
                               if ($cdq_historys[0]['action_num'] == 2)
                               {
                                   echo '<input type="button" class="btn btn-default" id="waiting_cdq_month" style="width:30%" value="Pay Now"  />';
                               }
                               else
                               {
                                   if ($cdqhistory->get_CDQExamType($CDQExamTitle) == 2)
                                   {
                                       echo '<input type="button" class="btn btn-danger" id="cdq_first_pay" style="width:30%" value="Pay Now"  />';
                                   }
                                   else
                                   {
                                       echo '<input type="button" class="btn btn-success" id="cdq_first_pay" style="width:30%" value="Pay Now"  />';
                                   }
                               }
                           }
                       }
                   }
               }
               else
               {
                   echo '<input type="button" class="btn btn-default" id="select_cdq_month" style="width:30%" value="Pay Now"  />';
               }
               ?>
         </td>
      </tr>
   </tbody>
</table>