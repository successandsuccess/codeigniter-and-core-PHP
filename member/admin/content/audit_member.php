<?php
   if (empty($_GET['member_id']) == true && empty($_GET['cycle']) == true) {
       echo "<script>window.history.back();</script>";
   } else if (empty($_GET['member_id']) == false && empty($_GET['cycle']) == false) {
       $id               = $_GET['member_id'];
       $cme_cycle        = $_GET['cycle'];
       $add_cme_historys = $membercme->readAllById($id, $cme_cycle);
       $member_name      = $membercme->readMemberName($id);
   }
   require_once("admin_dashboard.php");
   ?>
   <style>
	.auditMember tr:nth-child(4n+1), .auditMember tr:nth-child(4n+2) {
	background: #f2f2f2;
	}
</style>
<div class="member-cards card">
   <div class="cme-title">CME AUDIT : <font style="font-size:15px; text-transform: capitalize; align:center;font-weight: 600; text-align:center;color:#A3162C;"><?php
      echo $member_name . " (" . $cme_cycle . "-" . ($cme_cycle + 2) . ")";
      ?></font></div>
   <div class="form-group">
      <div class="left">
         <a href="?content=content/audit&li_class=CME" class="btn btn-primary">< Back</a>
      </div>
      <div class="right">
      </div>
      <div class="clearfix"></div>
   </div>
   <table id="memberTable" class="table auditMember table-bordered " style="width:100%; text-align:center; font-size:14px !important">
      <thead>
         <tr>
            <th>Date Added</th>
            <th>Full Name</th>
            <th># Credits</th>
            <th>Type</th>
            <th>Certificate</th>
         </tr>
      </thead>
      <tbody>
         <?php
            if ($add_cme_historys) {
                foreach ($add_cme_historys as $cme_index => $cme) {
                    $add_date = getdate($cme['date_submitted']);
            ?>
         <tr>
            <td colspan="5" style="text-align: left; border-bottom: none; padding-top: 15px;">
                  <b>Description:</b>&nbsp;<?php echo $cme['file_name']; ?>
            </td>
         </tr>
         <tr style="border-top: none">
            <td scope="row" style="border: none; " align="left"><?php
               echo $add_date['mon'] . "/" . $add_date['mday'] . "/" . $add_date['year'];
               ?></td>
            <td style="border: none;" align="left"><?php
               echo $member_name;
               ?></td>
            <td align="left" style="border: none;"><?php
               if ($cme['cme_hours'] == 0.25) {
                   echo "<sup>1</sup>&frasl;<sub>4</sub>";
               } else if ($cme['cme_hours'] == 0.5) {
                   echo "<sup>1</sup>&frasl;<sub>2</sub>";
               } else if ($cme['cme_hours'] == 0.75) {
                   echo "<sup>3</sup>&frasl;<sub>4</sub>";
               } else {
                   echo $cme['cme_hours'];
               }
               ?></td>
            <td align="left" style="border: none;"><?php
               echo $membercme->readCMEType($cme['cme_type']);
               ?></td>
            <td align="left" style="border: none;">
               <?php
                  $path = $cme['cme_doc'];
                  $ext  = pathinfo($path, PATHINFO_EXTENSION);
                  if ($ext == 'docx' || $ext == 'doc' || $ext == 'xls' || $ext == 'xlsx') {
                  ?>
               <a href="https://docs.google.com/gview?url=http://nccaatest.org/member/<?php
                  echo $cme['cme_doc'];
                  ?>&embedded=true" >View</a>
               <?php
                  } else if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'bmp' || $ext == 'tif') {
                  ?>            
               <a href="#myModal<?php
                  echo $cme_index;
                  ?>" data-toggle="modal" >View</a>
            </td>
         </tr>
         <div id="myModal<?php
            echo $cme_index;
            ?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg" style="width:720px; height:auto;">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header" style="height:90px;">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h3 class="modal-title" style="padding-top:20px;">View Certificate</h3>
                  </div>
                  <div class="modal-body" align="center" style="padding-bottom:15px;">
                     <?php
                        list($width, $height) = getimagesize('../' . $cme['cme_doc']);
                        if ($width <= $height) {
                            $img_width  = 700 * ($width / $height);
                            $img_height = 700;
                        } else {
                            $img_width  = 700;
                            $img_height = 700 * ($height / $width);
                        }
                        ?>                                                                            <img class='zoom' style="cursor: grab;" src="../<?php
                        echo $cme['cme_doc'];
                        ?>" width="<?= $img_width ?>" height="<?= $img_height ?>" onmousedown="zoom_grabbing()" onmouseup="zoom_grab()" >                                                                          
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-blue" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
         </div>
         <?php
            } else {
            ?>                                                        
         <a href="../<?php
            echo $cme['cme_doc'];
            ?>" >View</a>
         <?php
            }
            }
            } else {
            ?>
         <tr>
            <td scope="row" colspan="5" align="center">There is no credit cycle data available until a CME document has been uploaded.</td>
         </tr>
         <?php
            }
            ?>
      </tbody>
   </table>
   <div class="row">
   </div>
</div>
<script src="../js/wheelzoom.js"></script>
<script>
   function zoom_grab(){
       $(".zoom").css("cursor", "grab");
   }
   
   function zoom_grabbing(){
       $(".zoom").css("cursor", "grabbing");
   }
   wheelzoom(document.querySelectorAll('img.zoom'));
</script>