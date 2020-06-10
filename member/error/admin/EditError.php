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
                print "<script>location.href='?content=../error/admin/ViewAllErrors&li_class=Error';</script>\n";
                exit;
           }
           if ($_POST["error_id"] == "")
           {
                print "<script>location.href='?content=../error/admin/ViewAllErrors&li_class=Error';</script>\n";
                exit;
           }
           else
           {
               $error->id = $_POST["error_id"];
            //    $error->created = date('Y-m-d H:i:s', strtotime($_POST['created']));
               $error->status = $_POST['status'];
               $error->fix_content = $_POST['fix_content'];
            //    $error->title = $_POST['title'];
            //    $error->contents = $_POST['editor'];
            //    $error->publish = $_POST['publish'];
            //    $_POST['user_id'] = $_SESSION['admin_id'];
               $result = $error->update();
               if ($result)
               {
                   print "<script>location.href='?content=../error/admin/ViewAllErrors&li_class=Error';</script>\n";
                   exit;
               }
           }
       }
       if (isset($_GET["act"]) && $_GET["act"] == "edit")
       {
           $error->id = $_GET['id'];
           $result = $error->readWithWhere("error_id = " . $_GET['id']);
        //    $photo_name = $blog->viewPhoto($_GET['id']);
           $rec = $result[0];
        //    print_r($rec['status']); exit;
       }
   }
   ?>
<link rel="stylesheet" href="../assets/fonts/font-awesome/fontawesome-all.min.css">
<div class="member-card card">
   <h3>VIEW ERROR POST</h3>
   <div class="row">
      <div class="col-md-12">
         <form action="?content=../error/admin/EditError&li_class=Error" method="post" enctype="multipart/form-data" id="errorForm"  autocomplete="off" >
            <div class="row">
               <div class="col-md-8">
                  <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Added Date:</label>
                        </div>
                        <div class="col-md-8">
                           <input type="hidden" name="error_id" id="error_id" class="form-control border-0" value="<?php echo isset($rec["error_id"]) ? $rec["error_id"] : "" ?>" />
                           <input type="text" name="addeddate" id="addeddate" class="form-control border-0 datepicker" value="<?php echo isset($rec["addeddate"]) ? date('m/d/Y', strtotime($rec["addeddate"])) : "Not Provided" ?>" readonly/>
                        </div>
                     </div>
                  </div>
                  <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-4">
                           <label>From:</label>
                        </div>
                        <div class="col-md-8">
                           <input type="text" name="uname" id="uname" class="form-control border-0" value="<?php echo isset($rec["uname"]) ? $rec["uname"] : "Not Provided" ?>" readonly/>
                        </div>
                     </div>
                  </div>
                  <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Email:</label>
                        </div>
                        <div class="col-md-8">
                           <input type="text" name="email" id="email" class="form-control border-0" value="<?php echo isset($rec["email"]) ? $rec["email"] : "Not Provided" ?>" readonly/>
                        </div>
                     </div>
                  </div>
                  <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Hardware:</label>
                        </div>
                        <div class="col-md-8">
                           <input type="text" name="hardware" id="hardware" class="form-control border-0" value="<?php echo isset($rec["hardware"]) ? $rec["hardware"] : "Not Provided" ?>" readonly/>
                        </div>
                     </div>
                  </div>
                  <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Browser:</label>
                        </div>
                        <div class="col-md-8">
                           <input type="text" name="browser" id="browser" class="form-control border-0" value="<?php echo isset($rec["browser"]) ? $rec["browser"] : "Not Provided" ?>" readonly/>
                        </div>
                     </div>
                  </div>
                  <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Browser Version:</label>
                        </div>
                        <div class="col-md-8">
                           <input type="text" name="browser_version" id="browser_version" class="form-control border-0" value="<?php echo isset($rec["browser_version"]) ? $rec["browser_version"] : "Not Provided" ?>" readonly/>
                        </div>
                     </div>
                  </div>
                  <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Platform:</label>
                        </div>
                        <div class="col-md-8">
                           <input type="text" name="platform" id="platform" class="form-control border-0" value="<?php echo isset($rec["platform"]) ? $rec["platform"] : "Not Provided" ?>" readonly/>
                        </div>
                     </div>
                  </div>
                  <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Connection:</label>
                        </div>
                        <div class="col-md-8">
                           <input type="text" name="connection" id="connection" class="form-control border-0" value="<?php echo isset($rec["connection"]) ? $rec["connection"] : "Not Provided" ?>" readonly/>
                        </div>
                     </div>
                  </div>
                  <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Screen Size:</label>
                        </div>
                        <div class="col-md-8">
                           <input type="text" name="screen_size" id="screen_size" class="form-control border-0" value="<?php echo !empty($rec["screen_size"]) ? $rec["screen_size"] : "Not Provided" ?>" readonly/>
                        </div>
                     </div>
                  </div>
                  <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-4">
                           <label>Attachment:</label>
                        </div>
                        <div class="col-md-8" style="margin-top: 5px;">
                           <?php
                              if(isset($rec["attachedfile"]) && !empty($rec["attachedfile"]))
                              {
                           ?>
                                 <a target='_blank' href="/member/<?php echo $rec['attachedfile']; ?>">View</a>
                           <?php   
                              }
                              else
                              {
                           ?>
                                 Not Provided
                           <?php      
                              }
                           ?>
                        </div>
                     </div>
                  </div>
                  
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-12" style="height:120px;">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group border-b-1">
               <div class="row">
                  <div class="col-md-4">
                           <label>Issue Detail Description:</label>
                  </div>
                  <div class="col-md-12">
                     <textarea id="issue" name="issue" class="issue form-control border-0" readonly style="min-block-size: -webkit-fill-available; resize: none" autofocus><?php echo isset($rec["issue"]) ? $rec["issue"] : "Not Provided" ?></textarea>
                  </div>
               </div>
            </div>
            <div class="form-group border-b-1">
               <div class="row">
                  <div class="col-md-4">
                           <label>When And How Corrected:</label>
                  </div>
                  <div class="col-md-12">
                     <textarea id="fix_content" name="fix_content" class="issue form-control border-0" style="min-block-size: -webkit-fill-available; resize: none; border: 1px solid;" autofocus><?php echo isset($rec["fix_content"]) ? $rec["fix_content"] : "" ?></textarea>
                  </div>
               </div>
            </div>
            <div class="form-group border-b-1">
                     <div class="row">
                        <div class="col-md-3">
                           <label>Status:</label>
                        </div>
                        <div class="col-md-3">
                           <select type="text" name="status" id="status" class="form-control border-1" >
                                <option value="pending" <?php if($rec['status'] == "pending" ){ echo "selected";} ?> >Pending</option>
                                <option value="solved"  <?php if($rec['status'] == "solved" ){ echo "selected";} ?> >Solved</option>
                           </select>
                        </div>
                     </div>
            </div>
            <input type="hidden" name="check_back" id="check_back" class="form-control border-0" value="No" />
            <div class="form-group clearfix">
               <div class="right">
                  <div class="right margin-l-30">
                     <button class="btn btn-primary" id="saveError">Save</button>
                     <button class="btn btn-warning" id="back">Back</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {
       $("#back").on("click", function(){
           $("#check_back").val("Yes");
           blogForm.submit();
       });
       $("#saveError").on("click", function(){
           errorForm.submit();
       });
   });

   $("#add_picture_file").change(function() {
   readURL(this);
   });

   function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#profile_photo').css({
                    "background": "url("+ e.target.result +") no-repeat",
                    "background-size": "120px"
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
   }
</script>