<?php



    if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "")

        header('Location: /logincaamember.php');



    $adminList = $email->getAdmins();

	

    $user = $email->getUser($_SESSION['user_id']);



	function getSenderFullName($email){

		

		$admin_fullname = "";

		

		if (strpos(strtolower($email), "cynthia") !== false){

			

			$admin_fullname = "Cynthia Maraugha - Director of Operations";

			

		}else if(strpos(strtolower($email), "soren") !== false){

			

			$admin_fullname = "Soren Campbell - CEO";

			

		}else if((strpos(strtolower($email), "jimfletcher") !== false) || (strpos(strtolower($email), "globaltechkyllc") !== false)){

			

			$admin_fullname = "Jim Fletcher";

			

		}



		return $admin_fullname;

		

	}



?>



<link rel="stylesheet" href="./admin/css/jquery.gritter.css">

<script src="./admin/js/jquery.gritter.min.js"></script>



<div class="member-card card">



    <div class="col-md-12" style="padding-top: 20px">

        <p class="midium-title title-bottom-border text-uppercase">New Message</p>

    </div>



    <div class="col-sm-12">



        <div class="col-md-12">



        <form id="emailUserForm" action="./email/admin/emailprocmember.php" method="post" enctype="multipart/form-data"  autocomplete="off" >





            <div class="col-sm-12" style="padding: 0px">





                <div class="col-md-12" style="padding: 0px">





                    <div class="row">



                        <div class="col-md-2" style="padding-top: 11px">

                            <label>From:</label>

                        </div>

                        <div class="col-md-10">

                            <input type="text" name="" readonly="true" style="background-color: white" class="form-control border-0" value="<?= $user['full_name'].' - '. $_SESSION['email']?> -  You." />

                            <input type="hidden" name="sender_id" value="<?= $_SESSION['user_id']?>">

                        </div>



                    </div>

                    <hr>



                    <div class="row">



                        <div class="col-md-2" style="padding-top: 11px">

                            <label>To:</label>

                        </div>



                        <div class="col-md-10">

                            <select class="browser-default custom-select" style="width: 300px" name="receiver_ids">

                                <option value="0">- Please select -</option>

                              <?php foreach($adminList as $key => $admin ){

								  

								 if(!empty(getSenderFullName($admin['email']))){ 

							  ?>

                                <option value="<?= $admin['id']?>"><?= getSenderFullName($admin['email']) ?></option>

                              <?php }}?>

                            </select>

                            <input type="hidden" name="receiver_ids">

                            <input type="hidden" name="receiver_type" value="members">

                            <input type="hidden" name="emailType" value="user">

                        </div>



                    </div>

                    <hr>





                    <div class="row">



                        <div class="col-md-2" style="padding-top: 11px">

                            <label>Subject:</label>

                        </div>



                        <div class="col-md-10">

                            <input type="text" name="title" id="title" class="form-control border-0" value="" required />

                        </div>



                    </div>                   





                </div>



            </div>



            <hr>



            <div>

                <div class="reply mt-2">



                    <a onclick="$('#my_file').click();" class="btn btn-secondary w-6 mb-3" style="background-color: #e5e5e5; color:#000; border: 0; margin-bottom: 3px!important">

                        <i class="fas fa-paperclip"></i>

                        Attach Files

                    </a>&nbsp;<label id="filenameshow" style=""></label>



                    <input type="file" id="my_file" style="display: none;" name="attached">

                        <script>

                            $('#my_file').on('change', function(){

                                $('#filenameshow').text(this.value.replace(/.*[\/\\]/, ''));

                            });

                        </script>

                    <div id="summernote"></div>

                    <input type="hidden" name="msg_contents">

                </div>



                <div class="text-right my-3" style="margin-top: 10px">

                    <button type="submit" class="btn btn-primary px-4 cl-fff" name="submit"><i class="fas fa-paper-plane"></i>  SEND</button>

                </div>              

            </div>



        </form>





        </div>



    </div>



</div>



<script src="./admin/ckeditor/ckeditor.js"></script>

<script>

  CKEDITOR.replace( 'summernote',{

	  

      toolbar: 



      	[

					

					{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },

					{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },

					{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },

					{ name: 'others', items: [ 'Flash'] },

					

					{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },

					{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },

					{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },

					{ name: 'others', items: [ 'Language', 'ShowBlocks' ] },



					'/',

					{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },

					{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },

					'/',

					{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },

					{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },

					{ name: 'tools', items: [ 'Maximize' ] },

					{ name: 'others', items: [ '-' ] },

					// { name: 'about', items: [ 'About' ] },

					{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },



      	]

  });

  

  $('#reply_preview_email').click(function(e){

        $(this).css('display', 'none');

        $('#reply_send_box').show();

  });

</script>

<style type="text/css">

    textarea{border: none; background-color: #e6e6e6;} 

    .bg-error{

        background: rgba(183, 101, 101, 0.9);

        margin-top: 30px;

    }

</style>



<script type="text/javascript">

$(document).ready(function() {

    

    /*==========>> Email send js script*/

    $('#emailUserForm').on('submit', function(e){



        var data = CKEDITOR.instances.summernote.getData();

        $('input[name="msg_contents"]').val(data.trim());



        var r_ids = $('select[name="receiver_ids"]').val();

        r_ids = r_ids*1;

        

        if(r_ids > 0){

            $('input[name="receiver_ids"]').val(r_ids);

        }

        else{

            

            var msg = 'Please Select the Receiver. <br> Please retry with another name.';

        }



        if( data.length <= 0 ){



            var msg = 'Please type the message contents.';

        }



        // if (data.length <= 0 || r_ids.length <=0) {

        if (data.length <= 0 || r_ids <=0) {



            jQuery.gritter.add({



                title: 'Caution!',



                text: msg,



                sticky: false,



                class_name: 'bg-error',



                time: '3000'                



            });

            e.preventDefault();

            return;

        }



    });



});

</script>