<?php
if (empty($_GET['deleteId']) == false)
{
    $addcme->delete_cme_byId($_GET['deleteId']);
}
$cme_cycle = $addcme->readCMECycle();
if (empty($_GET['cycle']) == false)
{
    $cme_cycle = $_GET['cycle'];
}
$add_cme_historys = $addcme->readAllById($_SESSION['user_id'], $cme_cycle);
$select_cycle = $addcme->selectCMECycle($_SESSION['user_id']);
$cme_credit_need = $addcme->readCreditsNeeded($_SESSION['user_id'], $cme_cycle);
$cme_payment_verify = $addcme->readCMEPaymentVerify($_SESSION['user_id'], $cme_cycle); //payment verify for this cycle.
$cme_historys = $cmehistory->readAllAction($_SESSION['user_id']);
?>
<style>
   .creditCmeHistory tr:nth-child(4n+1), .creditCmeHistory tr:nth-child(4n+2) {
   background: #f2f2f2;
   }
   .creditCmeHistory td{
   width:25%;
   }
</style>


<?php 
	$today_time_50 = getdate();
	$add_abailable_time_50 = mktime(0, 0, 0, 6, 1, 2020);
	if ( ($today_time_50[0] > $add_abailable_time_50) && ($cme_cycle != 2018 && $cme_cycle != 2019) )
	{ 
 ?>
<div class="tab-content" id="myTabContent">
   <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="add-cme-form block-border ncca-right-padding">
         <div class="midium-title title-bottom-border ">
            <div class="row">
               <div class="col-sm-6">
                  <p class="text-uppercase">CME Activity/History</p>
               </div>
               <div class="col-sm-6 text-right">
                  <p><a href="?content=content/cmehelp" style="display:none" >Help</a></p>
               </div>
               <div class="clearfix"></div>
            </div>
         </div>
         <div class="row align-items-center mb-3">
            <div class="col-sm-6">
               <?php
$today_time = getdate();
$add_abailable_time = mktime(0, 0, 0, 6, 1, $cme_cycle);
if ($today_time[0] >= $add_abailable_time && $cme_payment_verify < 1)
{
?>								
               <button onclick="window.location.href='?content=content/cmeadd&update=1'" type="button" class="btn nobg" id="cme_first_add">Add CME</button>
               <?php
}
?>								
            </div>
            <div class="col-sm-6 text-right">
               <?php if ($cme_credit_need == 0)
{
    if ($cme_payment_verify > 0)
    {
        echo '<button type="button" class="btn" id="cme_first_pay" style="display:none">Pay Now</button>';
    }
    else
    {
        echo '<button type="button" class="btn" id="cme_first_pay">Pay Now</button>';
    }
}
else
{
    echo '<button type="button" class="btn" id="cme_first_pay" style="display:none">Pay Now</button>';
}
?>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="form-group">
            <p>CMEs are managed on this page. The default CME cycle will always show the current cycle; going forward, all documents you have uploaded into your account will become part of your permanent record. If you do not see previous cycles, we do not have sufficient documents since moving from paper submissions to digital submissions. We have streamlined CME Submissions for both the desktop and mobile versions. Simply click on Add CME and upload the actual certificate or document. The document must display all the required information, enabling us to verify the practitioner name, dates, titles, accrediting body, and earned CMEs. For "credits," you may enter EITHER anesthesia or other credit hours, not both within the same document. If you enter hours into the anesthesia box, please leave the other box blank (no zeros or N/A needed). Likewise with the other box. If you have a document which includes both types of credits, please upload the document twice.</p>
            <br>
            <p>Although CME documents cannot be modified or deleted after submission, please make sure you upload only the CME credits you want counted. If you need a particular document deleted from the system, please email us with at contact@nccaa.org with specific details of the document you want deleted from your account. Once submitted, we will keep track of your hours earned and documents, wherein you can review 24/7 on both desktop and mobile. The Pay Now button above will activate once you have entered 40 approved hours in the system (minimum 30 Anesthesia, plus 10 Other Medical Related; or 40 total Anesthesia hours) and have uploaded all necessary CME documents or certificates.</p>
            <br>
            <p>Any issues during the CME submission process should be reported to contact@nccaa.org. Please include very specific details, such as, type of device, browser, operating system, etc.</p>
            <br>
            <p>The regular CME submission fee is $235.00 before the June 1st deadline, and $735.00 between June 2 - Aug. 31.</p>
            <br>
         </div>
         <form>
            <div class="row">
               <div class="col-sm-6 align-self-center form-group form-text" style="max-width:280px">
                  <select class="form-control" id="select_cycle_id" onchange="javascript:select_cycle();">
                     <?php
if (empty($select_cycle) == false)
{
    foreach ($select_cycle as $val)
    { ?>
                     <option value="<?php echo $val ?>" 
                        <?php
        if (empty($_GET['cycle']) == false)
        {
            if ($val == $_GET['cycle'])
            {
                echo " selected='selected'";
            }
        }
?>
                        >CME Credit Cycle <?php echo ($val . "-" . ($val + 2)) ?>
                     </option>
                     <?php
    }
}
else if (empty($select_cycle) == true)
{
    $get_year = getdate();
?>
                     <option value="<?php echo $get_year['year'] ?>">CME Credit Cycle <?php echo ($get_year['year'] . "-" . ($get_year['year'] + 2)) ?></option>
                     <?php
}
?>
                  </select>
               </div>
               <div class="clearfix"></div>
               <div class="col-sm-8 align-self-center">
                  <p>Credit needed for this cycle (<font id="selected_this_cycle1"></font>)</p>
               </div>
               <div class="col-sm-4 align-self-center">
                  <p>50</p>
               </div>
               <div class="clearfix"></div>
               <div class="col-sm-8 align-self-center">
                  <p>Credits Completed and Added</p>
               </div>
               <div class="col-sm-4 align-self-center">
                  <p><?php echo $addcme->readCreditsCompleted($_SESSION['user_id'], $cme_cycle); ?></p>
               </div>
               <div class="clearfix"></div>
               <div class="col-sm-8 align-self-center">
                  <p>Credit still needed</p>
               </div>
               <div class="col-sm-4 align-self-center">
                  <p><?php echo $addcme->readCreditsNeeded($_SESSION['user_id'], $cme_cycle); ?></p>
               </div>
               <div class="clearfix"></div>
            </div>
            <hr style="margin: 5px 0;">
            <div class="row form-group">
               <div class="col-sm-2 align-self-center"></div>
               <div class="col-sm-6 align-self-center">
                  <p>Credits still needed (min.40/hrs Anesthesia)</p>
               </div>
               <div class="col-sm-4 align-self-center">
                  <p><?php echo $addcme->readCreditsType($_SESSION['user_id'], 1, $cme_cycle); ?></p>
               </div>
               <div class="clearfix"></div>
               <div class="col-sm-3 align-self-center"></div>
               <div class="col-sm-5 align-self-center" style="display:none">
                  <p>Other credits still needed</p>
               </div>
               <div class="col-sm-4 align-self-center" style="display:none">
                  <p><?php echo $addcme->readCreditsType($_SESSION['user_id'], 2, $cme_cycle); ?></p>
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="row">
               <div class="col-sm-12 align-self-center">
                  <br>
                  <p><b>Credit Cycle - <font id="selected_this_cycle2"></font></b></p>
                  <table class="creditCmeHistory table" style="color:#656565;">
                     <thead>
                        <tr style="background-color: white;">
                           <th scope="col" >Date</th>
                           <th class="text-left" scope="col" ># Credits</th>
                           <th class="text-left" scope="col" >Type</th>
                           <th class="text-left" scope="col" >Certificate</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
if ($add_cme_historys)
{
    global $storedCmeIds;
    $storedCmeIds = array();
    foreach ($add_cme_historys as $cme_index => $cme)
    {
        $add_date = getdate($cme['date_submitted']);
        array_push($storedCmeIds, $cme['id']);
?>
                        <tr style="border-bottom:none;">
                           <td colspan="4">
                              <strong style="color:black;">Description</strong>:&nbsp;<?php echo $cme['file_name']; ?>
                           </td>
                        </tr>
                        <tr style="border-bottom:none;">
                           <td scope="row" style="border-top:none; padding: .75rem;"><?php echo $add_date['mon'] . "/" . $add_date['mday'] . "/" . $add_date['year']; ?></td>
                           <td align="left" style="border-top:none; padding: .75rem;"><?php
        if ($cme['cme_hours'] == 0.25)
        {
            echo "<sup>1</sup>&frasl;<sub>4</sub>";
        }
        else if ($cme['cme_hours'] == 0.5)
        {
            echo "<sup>1</sup>&frasl;<sub>2</sub>";
        }
        else if ($cme['cme_hours'] == 0.75)
        {
            echo "<sup>3</sup>&frasl;<sub>4</sub>";
        }
        else
        {
            echo $cme['cme_hours'];
        }
?></td>
                           <td align="left" style="border-top:none; padding: .75rem;"><?php echo $addcme->readCMEType($cme['cme_type']) ?></td>
                           <td align="left" style="border-top:none; padding: .75rem;">
                              <?php
        $path = $cme['cme_doc'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if ($ext == 'docx' || $ext == 'doc' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'rtf')
        {
?>
                              <a href="https://docs.google.com/gview?url=http://nccaatest.org/member/<?php echo $cme['cme_doc'] ?>&embedded=true" style="margin-right:4.2px;">View</a>
                              <?php
            if ($cme['checked'] != 1)
            {
?>
                              <a href="?content=content/cmeEdit&update=1&id=<?php echo $cme['id']; ?>" style="margin-right:4.2px;">Edit</a>
                              <a style="color:#1f80e8; cursor:pointer;"  onclick="cmeDeleteFunc(<?php echo $cme['id']; ?>)">Delete</a>
                              <?php
            }
?>
                              <?php
        }
        else if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'bmp' || $ext == 'tif')
        {
?>			
                              <a href="#myModal<?php echo $cme_index ?>" data-toggle="modal" style="margin-right:4.2px;">View</a>
                              <?php
            if ($cme['checked'] != 1)
            {
?>
                              <a href="?content=content/cmeEdit&update=1&id=<?php echo $cme['id']; ?>" style="margin-right:4.2px;">Edit</a>
                              <a style="color:#1f80e8; cursor:pointer;"  onclick="cmeDeleteFunc(<?php echo $cme['id']; ?>)">Delete</a>
                              <?php
            }
?>
                           </td>
                        </tr>
                        <div id="myModal<?php echo $cme_index ?>" class="modal fade" role="dialog">
                           <div class="modal-dialog modal-lg">
                              <!-- Modal content-->
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h4 class="modal-title">View Certificate</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 </div>
                                 <div class="modal-body" align="center">
                                    <?php
            list($width, $height) = getimagesize($cme['cme_doc']);
            if ($width <= $height)
            {
                $img_width = 700 * ($width / $height);
                $img_height = 700;
            }
            else
            {
                $img_width = 700;
                $img_height = 700 * ($height / $width);
            }
?>																	        
                                    <img class='zoom' style="cursor: grab;" src="<?php echo $cme['cme_doc'] ?>" width="<?=$img_width ?>" height="<?=$img_height ?>" onmousedown="zoom_grabbing()" onmouseup="zoom_grab()" >																	  	
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-blue" data-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php
        }
        else
        {
?>														
                        <a href="<?php echo $cme['cme_doc'] ?>" style="margin-right:4.2px;">View</a>
                        <?php
            if ($cme['checked'] != 1)
            {
?>
                        <a href="?content=content/cmeEdit&update=1&id=<?php echo $cme['id']; ?>" style="margin-right:4.2px;">Edit</a>
                        <a style="color:#1f80e8; cursor:pointer;"  onclick="cmeDeleteFunc(<?php echo $cme['id']; ?>)">Delete</a>
                        <?php
            }
?>
                        <?php
        }
    }
}
else
{
?>
                        <tr>
                           <td scope="row" colspan="4" align="center">There is no credit cycle data available until a CME document has been uploaded.</td>
                        </tr>
                        <?php
}
?>
                     </tbody>
                  </table>
               </div>
               <div class="col-sm-12" align="right">
                  <?php
$today_time = getdate();
$add_abailable_time = mktime(0, 0, 0, 6, 1, $cme_cycle);
if ($today_time[0] >= $add_abailable_time && $cme_payment_verify < 1)
{
?>								
                  <button type="button" onclick="window.location.href='?content=content/cmeadd&update=1'" class="btn btn-blue">Add CME</button>
                  <?php if ($cme_credit_need == 0)
    {
        if ($cme_payment_verify > 0)
        {
            echo '<button type="button" class="btn btn-blue" id="cme_first_pay_1" style="display:none">Pay Now</button>';
        }
        else
        {
            echo '<button type="button" class="btn btn-blue" id="cme_first_pay_1">Pay Now</button>';
        }
    }
    else
    {
        echo '<button type="button" class="btn btn-blue" id="cme_first_pay_1" style="display:none">Pay Now</button>';
    }
?>
                  <?php
}
?>								
               </div>
            </div>
            <div style="height:30px"></div>
            <p><strong>Previous CME History</strong></p>
            <div class="row">
               <div class="col-sm-12 align-self-center">
                  <table class="credit table" style="color:#656565;">
                     <tbody>
                     <thead>
                        <tr>
                           <th scope="col">Date</th>
                           <th scope="col">Amount</th>
                           <th scope="col">Action</th>
                           <th scope="col">Document</th>
                        </tr>
                     </thead>
                     <?php
if (empty($cme_historys) == true)
{
    $out = "<tr style=\"background-color:#e2efd9; text-align:center;\">
                        
                        
                        
                        	<td colspan='4'>There is no history data available until the next CME payment is made.</td>
                        
                        
                        
                        	</tr>";
    echo $out;
}
if (empty($cme_historys) == false)
{
    if (count($cme_historys) > 0)
    {
        for ($i = 0;$i < count($cme_historys);$i++)
        {
            $get_date = getdate($cme_historys[$i]['action_date']);
            $action_number[$i] = $cmehistory->readActionContent($cme_historys[$i]['amount_num']) . " (" . $cme_historys[$i]['cme_cycle_start'] . "-" . ($cme_historys[$i]['cme_cycle_start'] + 2) . ")";
            $out = "<tr style=\"background-color:#e2efd9; text-align:left;\">
                        
                        
                        
                        						<td scope=\"row\">" . $get_date['mon'] . "/" . $get_date['mday'] . "/" . $get_date['year'] . "</td>
                        
                        
                        
                        						<td scope=\"row\">$" . $cmehistory->readActionAmount($cme_historys[$i]['amount_num']) . "</td>
                        
                        
                        
                        						<td scope=\"row\">" . $action_number[$i] . "</td>
                        
                        
                        
                        						<td scope=\"row\"><a href=\"receipt/cme.php?&receipt_id=" . $cme_historys[$i]['id'] . "\">View Receipt</a></td>
                        
                        
                        
                        					</tr>";
            echo $out;
        }
    }
}
?>
                     </tbody>
                  </table>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>




<?php } else { ?>




	<div class="tab-content" id="myTabContent">
   <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="add-cme-form block-border ncca-right-padding">
         <div class="midium-title title-bottom-border ">
            <div class="row">
               <div class="col-sm-6">
                  <p class="text-uppercase">CME Activity/History</p>
               </div>
               <div class="col-sm-6 text-right">
                  <p><a href="?content=content/cmehelp" style="display:none" >Help</a></p>
               </div>
               <div class="clearfix"></div>
            </div>
         </div>
         <div class="row align-items-center mb-3">
            <div class="col-sm-6">
               <?php
$today_time = getdate();
$add_abailable_time = mktime(0, 0, 0, 6, 1, $cme_cycle);
if ($today_time[0] >= $add_abailable_time && $cme_payment_verify < 1)
{
?>								
               <button onclick="window.location.href='?content=content/cmeadd'" type="button" class="btn nobg" id="cme_first_add">Add CME</button>
               <?php
}
?>								
            </div>
            <div class="col-sm-6 text-right">
               <?php if ($cme_credit_need == 0)
{
    if ($cme_payment_verify > 0)
    {
        echo '<button type="button" class="btn" id="cme_first_pay" style="display:none">Pay Now</button>';
    }
    else
    {
        echo '<button type="button" class="btn" id="cme_first_pay">Pay Now</button>';
    }
}
else
{
    echo '<button type="button" class="btn" id="cme_first_pay" style="display:none">Pay Now</button>';
}
?>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="form-group">
            <p>CMEs are managed on this page. The default CME cycle will always show the current cycle; going forward, all documents you have uploaded into your account will become part of your permanent record. If you do not see previous cycles, we do not have sufficient documents since moving from paper submissions to digital submissions. We have streamlined CME Submissions for both the desktop and mobile versions. Simply click on Add CME and upload the actual certificate or document. The document must display all the required information, enabling us to verify the practitioner name, dates, titles, accrediting body, and earned CMEs. For "credits," you may enter EITHER anesthesia or other credit hours, not both within the same document. If you enter hours into the anesthesia box, please leave the other box blank (no zeros or N/A needed). Likewise with the other box. If you have a document which includes both types of credits, please upload the document twice.</p>
            <br>
            <p>Although CME documents cannot be modified or deleted after submission, please make sure you upload only the CME credits you want counted. If you need a particular document deleted from the system, please email us with at contact@nccaa.org with specific details of the document you want deleted from your account. Once submitted, we will keep track of your hours earned and documents, wherein you can review 24/7 on both desktop and mobile. The Pay Now button above will activate once you have entered 40 approved hours in the system (minimum 30 Anesthesia, plus 10 Other Medical Related; or 40 total Anesthesia hours) and have uploaded all necessary CME documents or certificates.</p>
            <br>
            <p>Any issues during the CME submission process should be reported to contact@nccaa.org. Please include very specific details, such as, type of device, browser, operating system, etc.</p>
            <br>
            <p>The regular CME submission fee is $235.00 before the June 1st deadline, and $735.00 between June 2 - Aug. 31.</p>
            <br>
         </div>
         <form>
            <div class="row">
               <div class="col-sm-6 align-self-center form-group form-text" style="max-width:280px">
                  <select class="form-control" id="select_cycle_id" onchange="javascript:select_cycle();">
                     <?php
if (empty($select_cycle) == false)
{
    foreach ($select_cycle as $val)
    { ?>
                     <option value="<?php echo $val ?>" 
                        <?php
        if (empty($_GET['cycle']) == false)
        {
            if ($val == $_GET['cycle'])
            {
                echo " selected='selected'";
            }
        }
?>
                        >CME Credit Cycle <?php echo ($val . "-" . ($val + 2)) ?>
                     </option>
                     <?php
    }
}
else if (empty($select_cycle) == true)
{
    $get_year = getdate();
?>
                     <option value="<?php echo $get_year['year'] ?>">CME Credit Cycle <?php echo ($get_year['year'] . "-" . ($get_year['year'] + 2)) ?></option>
                     <?php
}
?>
                  </select>
               </div>
               <div class="clearfix"></div>
               <div class="col-sm-8 align-self-center">
                  <p>Credit needed for this cycle (<font id="selected_this_cycle1"></font>)</p>
               </div>
               <div class="col-sm-4 align-self-center">
                  <p>40</p>
               </div>
               <div class="clearfix"></div>
               <div class="col-sm-8 align-self-center">
                  <p>Credits Completed and Added</p>
               </div>
               <div class="col-sm-4 align-self-center">
                  <p><?php echo $addcme->readCreditsCompleted($_SESSION['user_id'], $cme_cycle); ?></p>
               </div>
               <div class="clearfix"></div>
               <div class="col-sm-8 align-self-center">
                  <p>Credit still needed</p>
               </div>
               <div class="col-sm-4 align-self-center">
                  <p><?php echo $addcme->readCreditsNeeded($_SESSION['user_id'], $cme_cycle); ?></p>
               </div>
               <div class="clearfix"></div>
            </div>
            <hr style="margin: 5px 0;">
            <div class="row form-group">
               <div class="col-sm-2 align-self-center"></div>
               <div class="col-sm-6 align-self-center">
                  <p>Credits still needed (min.30/hrs Anesthesia)</p>
               </div>
               <div class="col-sm-4 align-self-center">
                  <p><?php echo $addcme->readCreditsType($_SESSION['user_id'], 1, $cme_cycle); ?></p>
               </div>
               <div class="clearfix"></div>
               <div class="col-sm-3 align-self-center"></div>
               <div class="col-sm-5 align-self-center" style="display:none">
                  <p>Other credits still needed</p>
               </div>
               <div class="col-sm-4 align-self-center" style="display:none">
                  <p><?php echo $addcme->readCreditsType($_SESSION['user_id'], 2, $cme_cycle); ?></p>
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="row">
               <div class="col-sm-12 align-self-center">
                  <br>
                  <p><b>Credit Cycle - <font id="selected_this_cycle2"></font></b></p>
                  <table class="creditCmeHistory table" style="color:#656565;">
                     <thead>
                        <tr style="background-color: white;">
                           <th scope="col" >Date</th>
                           <th class="text-left" scope="col" ># Credits</th>
                           <th class="text-left" scope="col" >Type</th>
                           <th class="text-left" scope="col" >Certificate</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
if ($add_cme_historys)
{
    global $storedCmeIds;
    $storedCmeIds = array();
    foreach ($add_cme_historys as $cme_index => $cme)
    {
        $add_date = getdate($cme['date_submitted']);
        array_push($storedCmeIds, $cme['id']);
?>
                        <tr style="border-bottom:none;">
                           <td colspan="4">
                              <strong style="color:black;">Description</strong>:&nbsp;<?php echo $cme['file_name']; ?>
                           </td>
                        </tr>
                        <tr style="border-bottom:none;">
                           <td scope="row" style="border-top:none; padding: .75rem;"><?php echo $add_date['mon'] . "/" . $add_date['mday'] . "/" . $add_date['year']; ?></td>
                           <td align="left" style="border-top:none; padding: .75rem;"><?php
        if ($cme['cme_hours'] == 0.25)
        {
            echo "<sup>1</sup>&frasl;<sub>4</sub>";
        }
        else if ($cme['cme_hours'] == 0.5)
        {
            echo "<sup>1</sup>&frasl;<sub>2</sub>";
        }
        else if ($cme['cme_hours'] == 0.75)
        {
            echo "<sup>3</sup>&frasl;<sub>4</sub>";
        }
        else
        {
            echo $cme['cme_hours'];
        }
?></td>
                           <td align="left" style="border-top:none; padding: .75rem;"><?php echo $addcme->readCMEType($cme['cme_type']) ?></td>
                           <td align="left" style="border-top:none; padding: .75rem;">
                              <?php
        $path = $cme['cme_doc'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if ($ext == 'docx' || $ext == 'doc' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'rtf')
        {
?>
                              <a href="https://docs.google.com/gview?url=http://nccaatest.org/member/<?php echo $cme['cme_doc'] ?>&embedded=true" style="margin-right:4.2px;">View</a>
                              <?php
            if ($cme['checked'] != 1)
            {
?>
                              <a href="?content=content/cmeEdit&&id=<?php echo $cme['id']; ?>" style="margin-right:4.2px;">Edit</a>
                              <a style="color:#1f80e8; cursor:pointer;"  onclick="cmeDeleteFunc(<?php echo $cme['id']; ?>)">Delete</a>
                              <?php
            }
?>
                              <?php
        }
        else if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'bmp' || $ext == 'tif')
        {
?>			
                              <a href="#myModal<?php echo $cme_index ?>" data-toggle="modal" style="margin-right:4.2px;">View</a>
                              <?php
            if ($cme['checked'] != 1)
            {
?>
                              <a href="?content=content/cmeEdit&&id=<?php echo $cme['id']; ?>" style="margin-right:4.2px;">Edit</a>
                              <a style="color:#1f80e8; cursor:pointer;"  onclick="cmeDeleteFunc(<?php echo $cme['id']; ?>)">Delete</a>
                              <?php
            }
?>
                           </td>
                        </tr>
                        <div id="myModal<?php echo $cme_index ?>" class="modal fade" role="dialog">
                           <div class="modal-dialog modal-lg">
                              <!-- Modal content-->
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h4 class="modal-title">View Certificate</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 </div>
                                 <div class="modal-body" align="center">
                                    <?php
            list($width, $height) = getimagesize($cme['cme_doc']);
            if ($width <= $height)
            {
                $img_width = 700 * ($width / $height);
                $img_height = 700;
            }
            else
            {
                $img_width = 700;
                $img_height = 700 * ($height / $width);
            }
?>																	        
                                    <img class='zoom' style="cursor: grab;" src="<?php echo $cme['cme_doc'] ?>" width="<?=$img_width ?>" height="<?=$img_height ?>" onmousedown="zoom_grabbing()" onmouseup="zoom_grab()" >																	  	
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-blue" data-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php
        }
        else
        {
?>														
                        <a href="<?php echo $cme['cme_doc'] ?>" style="margin-right:4.2px;">View</a>
                        <?php
            if ($cme['checked'] != 1)
            {
?>
                        <a href="?content=content/cmeEdit&&id=<?php echo $cme['id']; ?>" style="margin-right:4.2px;">Edit</a>
                        <a style="color:#1f80e8; cursor:pointer;"  onclick="cmeDeleteFunc(<?php echo $cme['id']; ?>)">Delete</a>
                        <?php
            }
?>
                        <?php
        }
    }
}
else
{
?>
                        <tr>
                           <td scope="row" colspan="4" align="center">There is no credit cycle data available until a CME document has been uploaded.</td>
                        </tr>
                        <?php
}
?>
                     </tbody>
                  </table>
               </div>
               <div class="col-sm-12" align="right">
                  <?php
$today_time = getdate();
$add_abailable_time = mktime(0, 0, 0, 6, 1, $cme_cycle);
if ($today_time[0] >= $add_abailable_time && $cme_payment_verify < 1)
{
?>								
                  <button type="button" onclick="window.location.href='?content=content/cmeadd'" class="btn btn-blue">Add CME</button>
                  <?php if ($cme_credit_need == 0)
    {
        if ($cme_payment_verify > 0)
        {
            echo '<button type="button" class="btn btn-blue" id="cme_first_pay_1" style="display:none">Pay Now</button>';
        }
        else
        {
            echo '<button type="button" class="btn btn-blue" id="cme_first_pay_1">Pay Now</button>';
        }
    }
    else
    {
        echo '<button type="button" class="btn btn-blue" id="cme_first_pay_1" style="display:none">Pay Now</button>';
    }
?>
                  <?php
}
?>								
               </div>
            </div>
            <div style="height:30px"></div>
            <p><strong>Previous CME History</strong></p>
            <div class="row">
               <div class="col-sm-12 align-self-center">
                  <table class="credit table" style="color:#656565;">
                     <tbody>
                     <thead>
                        <tr>
                           <th scope="col">Date</th>
                           <th scope="col">Amount</th>
                           <th scope="col">Action</th>
                           <th scope="col">Document</th>
                        </tr>
                     </thead>
                     <?php
if (empty($cme_historys) == true)
{
    $out = "<tr style=\"background-color:#e2efd9; text-align:center;\">
                        
                        
                        
                        	<td colspan='4'>There is no history data available until the next CME payment is made.</td>
                        
                        
                        
                        	</tr>";
    echo $out;
}
if (empty($cme_historys) == false)
{
    if (count($cme_historys) > 0)
    {
        for ($i = 0;$i < count($cme_historys);$i++)
        {
            $get_date = getdate($cme_historys[$i]['action_date']);
            $action_number[$i] = $cmehistory->readActionContent($cme_historys[$i]['amount_num']) . " (" . $cme_historys[$i]['cme_cycle_start'] . "-" . ($cme_historys[$i]['cme_cycle_start'] + 2) . ")";
            $out = "<tr style=\"background-color:#e2efd9; text-align:left;\">
                        
                        
                        
                        						<td scope=\"row\">" . $get_date['mon'] . "/" . $get_date['mday'] . "/" . $get_date['year'] . "</td>
                        
                        
                        
                        						<td scope=\"row\">$" . $cmehistory->readActionAmount($cme_historys[$i]['amount_num']) . "</td>
                        
                        
                        
                        						<td scope=\"row\">" . $action_number[$i] . "</td>
                        
                        
                        
                        						<td scope=\"row\"><a href=\"receipt/cme.php?&receipt_id=" . $cme_historys[$i]['id'] . "\">View Receipt</a></td>
                        
                        
                        
                        					</tr>";
            echo $out;
        }
    }
}
?>
                     </tbody>
                  </table>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<?php } ?>
<script src="./js/wheelzoom.js"></script>
<script>
function zoom_grab() {
    $(".zoom").css("cursor", "grab");
}

function zoom_grabbing() {
    $(".zoom").css("cursor", "grabbing");
}
wheelzoom(document.querySelectorAll('img.zoom'));
// wheelzoom(document.querySelectorAll('img.zoom'), {zoom: 0.05});
// wheelzoom(document.querySelectorAll('img.zoom'), {maxZoom: 2});
function select_cycle() {
    var default_cycle = $("#select_cycle_id").val();
    location.href = "?content=content/cmehistory&cycle=" + parseInt(default_cycle);
}

function cmeDeleteFunc(id) {
    if (window.confirm("Are you sure you want to delete this CME record?")) {
        window.location.href = "?content=content/cmehistory&&deleteId=" + id;
    }
}
</script>
