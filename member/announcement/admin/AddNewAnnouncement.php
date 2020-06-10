<?php
   if (empty($_SESSION['admin_id']) || $_SESSION['admin_id'] == "")
   {
       header('Location: /logincaamember.php');
   }
   else
   {
       if (isset($_POST) && !empty($_POST))
       {
           if($_POST['check_back'] == "Yes")
           {
                print "<script>location.href='?content=../announcement/admin/ViewAllAnnouncements&li_class=Announcement';</script>\n";
                exit;
           }
           else
           {
                if ($_POST["announcement_id"] == "")
                {
                    $announcement->created = date('Y-m-d H:i:s', strtotime($_POST['created']));
                    $announcement->subject = $_POST['subject'];
                    $announcement->visibility = $_POST['visibility'];
                    $announcement->contents = $_POST['announce_editor'];
                    $announcement->audience = $_POST['audience'];
                    $announcement->button = $_POST['button'];
                    $_POST['user_id'] = $_SESSION['admin_id'];
                    $result = $announcement->create();
                    if ($result)
                    {
                        print "<script>location.href='?content=../announcement/admin/ViewAllAnnouncements&li_class=Announcement';</script>\n";
                        exit;
                    }
                }
                else
                {
                    $announcement->id = $_POST["announcement_id"];
                    $announcement->created = date('Y-m-d H:i:s', strtotime($_POST['created']));
                    $announcement->subject = $_POST['subject'];
                    $announcement->visibility = $_POST['visibility'];
                    $announcement->contents = $_POST['announce_editor'];
                    $announcement->audience = $_POST['audience'];
                    $announcement->button = $_POST['button'];
                    $_POST['user_id'] = $_SESSION['admin_id'];
                    $result = $announcement->update();
                    if ($result)
                    {
                        print "<script>location.href='?content=../announcement/admin/ViewAllAnnouncements&li_class=Announcement';</script>\n";
                        exit;
                    }
                }
           }
       }
       if (isset($_GET["act"]) && $_GET["act"] == "edit")
       {
           $announcement->id = $_GET['id'];
           $result = $announcement->readWithWhere("id = " . $_GET['id']);
           $rec = $result[0];
       }
   }
   ?>
<style>
   .profile_photo{
   width:120px;
   height:120px;
   border-radius:50%;
   background-position: top 20px;
   background-repeat: no-repeat;
   background-size: 120px;
   }
   .profile_photo div{
   visibility: hidden;
   width:120px;
   height:120px;
   border-radius:50%;
   font-size: 17px;
   }
   .profile_photo:hover div{
   visibility: visible;
   cursor:pointer;
   background: rgba(25,32,45,.7);
   }
</style>
<link rel="stylesheet" href="../assets/fonts/font-awesome/fontawesome-all.min.css">

<div class="member-card card">
   <h3>Add New Announcement</h3>
   <div class="row">
      <div class="col-md-12">
         <form action="?content=../announcement/admin/AddNewAnnouncement&li_class=Announcement" method="post" enctype="multipart/form-data" id="announcementForm"  autocomplete="off" >
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-1">
                           <label>Date:</label>
                        </div>
                        <div class="col-md-11">
                           <input type="hidden" name="announcement_id" id="announcement_id" class="form-control border-0" value="<?php echo isset($rec["id"]) ? $rec["id"] : "" ?>" />
                           <input type="text" name="created" id="created" class="form-control border-0 datepicker" value="<?php echo isset($rec["created"]) ? date('m/d/Y', strtotime($rec["created"])) : "" ?>" required/>
                        </div>
                     </div>
                  </div>
                  <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-1">
                           <label>Subject:</label>
                        </div>
                        <div class="col-md-11">
                           <input type="text" name="subject" id="subject" class="form-control border-0" value="<?php echo isset($rec["subject"]) ? $rec["subject"] : "" ?>" required maxLength="47" onkeyup="this.value = this.value.toUpperCase();"/>
                        </div>
                     </div>
                  </div>
                  <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-1">
                           <label>Visibility:</label>
                        </div>
                        <div class="col-md-11">
                                <span class="radio-row" style="line-height:32px; margin:13px;"><input style="margin-right:3px" class="type_of_setting radiobox empinfo check-group" data-group="empinfo"  type="radio" <?php if (isset($rec['visibility']) == true && $rec['visibility'] == 1){ echo "Checked";} ?>  name="visibility" value="1" id="visibility"><span>Show</span></span> 
                                <span class="radio-row" style="line-height:32px; margin:13px;"><input style="margin-right:3px" class="type_of_setting radiobox empinfo check-group" data-group="empinfo"  type="radio" <?php if (isset($rec['visibility']) == true && $rec['visibility'] == 0){ echo "Checked";} elseif(isset($rec['visibility']) == false ) { echo "Checked";} ?>  name="visibility" value="0" id="visibility"><span>Hide</span></span> 
                        </div>
                     </div>
                  </div>
                  <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-1">
                           <label>Audience:</label>
                        </div>
                        <div class="col-md-11">
                                <span class="radio-row" style="line-height:32px; margin:13px;"><input style="margin-right:3px" class="type_of_setting radiobox empinfo check-group" data-group="empinfo"  type="radio" <?php if (isset($rec['audience']) == true && $rec['audience'] == 'All'){ echo "Checked";} elseif(isset($rec['audience']) == false) { echo "Checked"; } ?>  name="audience" value="All" id="audience"><span>All</span></span> 
                                <span class="radio-row" style="line-height:32px; margin:13px;"><input style="margin-right:3px" class="type_of_setting radiobox empinfo check-group" data-group="empinfo"  type="radio" <?php if (isset($rec['audience']) == true && $rec['audience'] == 'CAAs'){ echo "Checked";} ?>  name="audience" value="CAAs" id="audience"><span>CAAs</span></span> 
                                <span class="radio-row" style="line-height:32px; margin:13px;"><input style="margin-right:3px" class="type_of_setting radiobox empinfo check-group" data-group="empinfo"  type="radio" <?php if (isset($rec['audience']) == true && $rec['audience'] == 'Students'){ echo "Checked";} ?>  name="audience" value="Students" id="audience"><span>Students</span></span> 
                        </div>
                     </div>
                  </div>
                  <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-1">
                           <label>Button:</label>
                        </div>
                        <div class="col-md-11">
                           <input type="text" name="button" id="button" class="form-control border-0" value="<?php echo isset($rec["button"]) ? $rec["button"] : "" ?>" />
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group border-b-1">
               <div class="row">
                  <div class="col-md-12">
                     <textarea id="announce_editor" name="announce_editor" class="editor form-control border-0" data-maxlen='255'>
                     <?php echo isset($rec["contents"]) ? $rec["contents"] : "" ?>
                     </textarea>
                  </div>
               </div>
            </div>
            <input type="hidden" name="check_back" id="check_back" class="form-control border-0" value="No" />
            <div class="form-group clearfix">
               <div class="right">
                  <div class="right margin-l-30">
                     <button type="submit" class="btn btn-success" id="saveAnnouncement">Save</button>
                     <button id="cancelAnnouncement" class="btn btn-primary">Back</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
    document.addEventListener( 'DOMContentLoaded',function()
    {
        CKEDITOR.replace( 'announce_editor',{
            toolbar: [
             {
               name: 'basicstyles',
               groups: ['basicstyles', 'cleanup'],
               items: ['Bold', 'Italic', 'Underline']
            }, {
                name: 'links',
                items: ['Link', 'Unlink',]
            }, {
                name: 'styles',
                items: ['Styles']
            }, {
                name: 'colors',
                items: ['TextColor']
            },{
                name: 'editing',
                groups: ['spellchecker'],
                items: ['Scayt']
            }
        ],
        } );	
    });


   $(document).ready(function() {
       $('#cancelAnnouncement').on('click', function (){
            $('#check_back').val("Yes");
            announcementForm.submit();
       });
       
        $('.datepicker').datepicker({
            autoclose: true,
            format: 'mm/dd/yyyy'
        });
   });
</script>