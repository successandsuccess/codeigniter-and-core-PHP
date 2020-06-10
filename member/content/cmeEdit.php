<?php
   global $addcme;
   if (empty($_POST) == false)
   {
       //    print_r($_POST); exit;
       $addcme->update_cme($_POST);
   }
   $cmeData = $addcme->readByCmeId($_GET['id']);
   //    print_r($cmeData[0]['cme_hours']); exit;
   $cme_cycle_verify = $addcme->readCMECyclePayButton();
   $cme_credit_verify = $addcme->readCreditsCompleted($_SESSION['user_id'], $cme_cycle_verify); //40hours.
   $cme_payment_verify = $addcme->readCMEPaymentVerify($_SESSION['user_id'], $cme_cycle_verify); //payment verify for this cycle.
   
   ?>
<style>
   .loader {
   position: relative;
   text-align: center;
   margin: 15px auto 35px auto;
   z-index: 9999;
   display: block;
   width: 80px;
   height: 80px;
   border: 16px solid rgba(0, 0, 0, .3);
   border-top: 16px solid #000;
   border-bottom: 16px solid #000;
   border-radius: 50%;
   animation: spin 1.5s ease-in-out infinite;
   -webkit-animation: spin 1s ease-in-out infinite;
   }
   @keyframes spin {
   to {
   -webkit-transform: rotate(360deg);
   }
   }
   @-webkit-keyframes spin {
   to {
   -webkit-transform: rotate(360deg);
   }
   }
   .modal-content {
   border-radius: 0px;
   box-shadow: 0 0 20px 8px rgba(0, 0, 0, 0.7);
   }
   .modal-backdrop.show {
   opacity: 0.75;
   }
   .loader-txt {
   p {
   font-size: 14px;
   color: #666;
   small {
   font-size: 11.5px;
   color: #999;
   }
   }
   }
   [data-tip] {
   position:relative;
   }
   /* [data-tip]:before {
   content:'';
   display:none;
   content:'';
   border-left: 5px solid transparent;
   border-right: 5px solid transparent;
   border-bottom: 5px solid #1a1a1a;	
   position:absolute;
   top:30px;
   left:35px;
   z-index:8;
   font-size:0;
   line-height:0;
   width:0;
   height:0;
   } */
   [data-tip]:after {
   display:none;
   content:attr(data-tip);
   position:absolute;
   top:-85px;
   left:0px;
   padding:20px 25px;
   background:#e8e8e8;
   color:#495057;
   z-index:9;
   font-size: 1em;
   line-height:18px;
   -webkit-border-radius: 3px;
   -moz-border-radius: 3px;
   border-radius: 3px;
   white-space:pre-line;
   word-wrap:normal;
   }
   [data-tip]:hover:before,
   [data-tip]:hover:after {
   display:block;
   }
</style>
<div class="tab-content" id="myTabContent">
   <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <div class="add-cme-form block-border ncca-right-padding">
         <div class="midium-title title-bottom-border">
            <div class="row">
               <div class="col-sm-6">
                  <p class="text-uppercase">EDIT CME</p>
               </div>
               <div class="col-sm-6 text-right">
                  <p><a href="?content=content/cmehelp" style="display:none">Help</a></p>
               </div>
               <div class="clearfix"></div>
            </div>
         </div>
         <div class="row align-items-center mb-3">
            <div class="col-sm-6"><a href="?content=content/cmehistory">< Back</a></div>
            <div class="col-sm-6 text-right">
               <?php
                  if ($cme_credit_verify >= 40)
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
         <div class="cme-content-block form-group">
            <p>CME Submission is now easier than ever and NCCAA has gone completely digital (no more paper!). Upload the CME certificate earned, which displays the hours granted, attendance date, name of accreditor issuing the CME, and title of meeting or CME as proof you earned the CME credit. You may enter credits in increments of 1/4 hour. NCCAA accepts CME credits provided by the AMA, AAPA, ACCME, and FAACT.</p>
            <br>
            <p>The content for thirty (30) hours of each registration period must be in the field of anesthesia or one of its sub-specialties. The content for the remaining ten (10) hours may be in any medical topic. ACLS and PALS instruction will be tabulated as anesthesia-related content.  ACLS and PALS certification qualify for 4 CME credit hours per course.</p>
            <br>
            <p>NCCAA will accept ACLS and/or PALS credit provided by the AHA, however all other CME credit must be provided by the above listed CME providers.  Upload a photo of the card(s) you received upon completion of the ACLS and/or PALS instruction.</p>
            <br>
            <p><b>Important Dates!</b></p>
            <br>
            <p>During the two-year registration cycle, CME credit must be earned and awarded between June 2 of the initial year and June 1 of the second year.</p>
         </div>
         <div style="height:30px"></div>
         <div class="cme-form-block fullwidth">
            <form id="frmAddCME" action="?content=content/cmeEdit" method="post" enctype="multipart/form-data" onsubmit = "return validateForm()">
               <input type="text" name = "id" value = "<?php echo $cmeData[0]['id'] ?>" hidden>
               <div class="form-group row">
                  <label class="col-sm-5 text-right align-self-center">Select + Upload Image to attach your CME document or certificate</label>
                  <div class="col-sm-7 align-self-center ">
                     <input type="file" name="upload_file" id="upload_file"  accept=".doc, .docx, .rtf, .xls, .xlsx, .pdf, .gif, .jpg, .png, .jpeg, .bmp, .tif" class="form-control" required autofocus style="font-size: 14px">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-5 text-right align-self-center">Give a name to the document you just uploaded</label>
                  <div class="col-sm-7 align-self-center ">
                     <input type="text" name="file_name" id="file_name" class="form-control" placeholder="Enter the document name" required autofocus value="<?php echo $cmeData[0]['file_name']; ?>" maxlength = "255" style="font-size: 14px">
                  </div>
               </div>
               <div class="form-group row" >
                  <label class="col-sm-5 text-right align-self-center" >How many Anesthesia credits does this document show?</label>
                  <div class="col-sm-7 align-self-center" data-tip="You may enter credit hours for &#013;&#010; Anesthesia or Other – not both">
                     <input type="text" name="anesthesia_credits" id="anesthesia_credits" maxlength="6" class="form-control reducesize" onclick="javascript:anesthesia_field()" autofocus
                        oninvalid="this.setCustomValidity('Please enter # of Anesthesia credits')" 
                        oninput="setCustomValidity('')"
                        value = "<?php if ($cmeData[0]['cme_type'] == 1) echo $cmeData[0]['cme_hours']; ?>"
                        placeholder= "Anesthesia hours"
                        style="font-size: 14px"
                        >
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-5 text-right align-self-center"></label>
                  <div class="col-sm-7 align-self-center">
                     <p style="font-style: italic; color: red;">Either Anesthesia Credits/Hours or Other Credit/Hours – not both</p>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-5 text-right align-self-center" >How many Other credits does this document show?</label>
                  <div class="col-sm-7 align-self-center" data-tip="You may enter credit hours for &#013;&#010; Anesthesia or Other – not both">
                     <input type="text" name="other_credits" id="other_credits" maxlength="6" class="form-control reducesize" onclick="javascript:other_field()" 
                        oninvalid="this.setCustomValidity('Please enter # of Other credits')"
                        oninput="setCustomValidity('')"
                        value = "<?php if ($cmeData[0]['cme_type'] == 2) echo $cmeData[0]['cme_hours']; ?>"
                        placeholder = "Other hours"
                        style="font-size: 14px"
                        >
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-5 text-right align-self-center">I hereby acknowledge that the document attached is from an actual approved CME provider</label>
                  <div class="col-sm-7 align-self-center">
                     <select name="cme_provider" id="cme_provider"  class="form-control" style="font-size: 14px" >
                        <?php
                           $cme_provider = array(
                               "Select a CME Provider",
                               "AMA",
                               "ACCME",
                               "AAPA",
                               "AHA (include note ACLS or PALS instruction only)",
                               "FAACT"
                           );
                           foreach ($cme_provider as $key)
                           {
                           ?>
                        <option value = "<?php
                           echo array_search($key, $cme_provider);
                           ?>" <?php if ($cmeData[0]['cme_provider'] == array_search($key, $cme_provider)) echo "selected"; ?>>
                           <?php
                              echo $key;
                              ?> 
                        </option>
                        <?php
                           }
                           ?>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-5 text-right align-self-center">I hereby attest that I personally took the CME course for which the<br> credit is entered</label>
                  <div class="col-sm-7 align-self-center">
                     <input type="checkbox" name="cme_check1" id="cme_check1" class="form-control" style="max-width:42px" required autofocus
                        oninvalid="this.setCustomValidity('Please check the disclaimer')"
                        oninput="setCustomValidity('')"
                        >
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-5 text-right align-self-center add-cme-padding">I hereby acknowledge that the information submitted may be audited at any time and the  entire CME document is clearly legible, containing all required information.</label>
                  <div class="col-sm-7 align-self-center">
                     <input type="checkbox" name="cme_check2" id="cme_check2" class="form-control" style="max-width:42px" required autofocus
                        oninvalid="this.setCustomValidity('Please check the disclaimer')"
                        oninput="setCustomValidity('')"
                        >
                  </div>
               </div>
               <div class="form-group row form-btn d-flex align-items-center justify-content-end">
                  <div class="col-sm-10 align-self-center text-center" id="success_text">
                     <p style="margin-top:10px">Your CME information has been successfully submitted</p>
                  </div>
                  <div class="col-sm-10 align-self-center text-center" id="error_text">
                     <p style="margin-top:10px">Your CME information...</p>
                  </div>
                  <div class="col-sm-2 align-self-center text-right">
                     <button type="submit" class="btn btn-blue" onmouseover="check_credits()" >Submit</button>
                  </div>
                  <div class="col-sm-2 align-self-center text-right">
                     <a class="btn btn-blue" href="?content=content/cmehistory">Cancel</a>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-body text-center">
            <div class="loader"></div>
            <div clas="loader-txt">
               <p>Uploading...</small></p>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
 function validateForm() {
    var x = $("#anesthesia_credits").val();
    if (x != '') {
        xpart = x.split(' ');
        xpartfloat = xpart[0].split('.');
        if (xpart[0].match(/^[0-9]+$/) == null) {
            if (xpart[0] == '1/4' || xpart[0] == '1/2' || xpart[0] == '3/4' || xpart[0] == '.25' || xpart[0] == '.5' || xpart[0] == '.75') {
                return true;
            } else {
                if (typeof xpartfloat[1] !== 'undefined') {
                    if (xpartfloat[1] == 25 || xpartfloat[1] == 5 || xpartfloat[1] == 75) {
                        return true;
                    }
                }
                window.alert("Anesthesia input validation failed." + " Please insert the formate as like" + " 1, 2, 10, 15, 20 or 1/4, .25, 2 3/4, or 2.75");
                return false;
            }
        }
        if (typeof xpart[1] !== 'undefined') {
            if (xpart[1] == '1/4' || xpart[1] == '1/2' || xpart[1] == '3/4') {
                return true;
            } else {
                window.alert("Anesthesia input validation failed." + " Please insert the formate as like" + " 1, 2, 10, 15, 20 or 1/4, .25, 2 3/4, or 2.75");
                return false;
            }
        }
        return true;
    }
    var y = $("#other_credits").val();
    if (y != '') {
        ypart = y.split(' ');
        ypartfloat = ypart[0].split('.');
        if (ypart[0].match(/^[0-9]+$/) == null) {
            if (ypart[0] == '1/4' || ypart[0] == '1/2' || ypart[0] == '3/4' || ypart[0] == '.25' || ypart[0] == '.5' || ypart[0] == '.75') {
                return true;
            } else {
                if (typeof ypartfloat[1] !== 'undefined') {
                    if (ypartfloat[1] == 25 || ypartfloat[1] == 5 || ypartfloat[1] == 75) {
                        return true;
                    }
                }
                window.alert("Other Credit input validation failed." + " Please insert the formate as like" + " 1, 2, 10, 15, 20 or 1/4, .25, 2 3/4, or 2.75");
                return false;
            }
        }
        if (typeof ypart[1] !== 'undefined') {
            if (ypart[1] == '1/4' || ypart[1] == '1/2' || ypart[1] == '3/4') {
                return true;
            } else {
                window.alert("Other Credit input validation failed." + " Please insert the formate as like" + " 1, 2, 10, 15, 20 or 1/4, .25, 2 3/4, or 2.75");
                return false;
            }
        }
        return true;
    }
}
$("#frmAddCME").submit(function() {
    // $("#loadMe").modal({
    //     show: true,
    //     backdrop: "static", 
    //     keyboard: false 
    // });
});

function check_credits() {
    if ($("#anesthesia_credits").val() == 0) {
        $("#anesthesia_credits").val("");
    }
    if ($("#other_credits").val() == 0) {
        $("#other_credits").val("");
    }
}

function other_field() {
    $('#other_credits').attr('readonly', false);
    $('#anesthesia_credits').prop('required', false);
    $('#other_credits').prop('required', true);
    if ($("#anesthesia_credits").val() != '') {
        if (window.confirm('You already have credits entered in Anesthesia – please delete the hours and then enter them into Other.')) {}
        $("#anesthesia_credits").val("");
        $('#anesthesia_credits').attr('readonly', true);
        $('#other_credits').prop('required', false);
    }
}

function anesthesia_field() {
    $('#anesthesia_credits').attr('readonly', false);
    $('#other_credits').prop('required', false);
    $('#anesthesia_credits').prop('required', true);
    if ($('#other_credits').val() != '') {
        if (window.confirm('You already have credits entered in Other – please delete the hours and then enter them into Anesthesia.')) {}
        $("#other_credits").val("");
        $('#other_credits').attr('readonly', true);
        $('#anesthesia_credits').prop('required', false);
    }
}
$("[data-toggle=tooltip]").tooltip();
</script>