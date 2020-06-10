<?php 

    if($_SESSION['user_id'] == "" || empty($_SESSION['user_id'])){



        header('Location: ../logincaamember.php');

    }



    if(isset($_GET["id"]) && isset($_GET["Uid"])){

		

		if(isset($_GET['subject'])){

			

			$email->updateReadById($_GET['Uid'], base64_decode($_GET['subject']));

			

		}



       		// $row = $email->getById($_GET['id']);
               $row = $email->getByIdEmail($_GET['id']);



               // $rows = $email->getAllChainsByid($_GET['id']);
               $rows = $email->getAllChainsByidEmail($_GET['id']);

            //    print_r($row); exit;



    }

    else{

        echo "No Data!";

        return;

    }

?>

<div class="ncca-right-block ">



    <div class="tab-content" id="myTabContent">



     <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">



      <div class="block-border ncca-right-padding new_msg_style new_msg_style_2 ">



        <p class="midium-title title-bottom-border text-uppercase">Read Message</p>       



            <h5 class="fs-16 w-4 my-3 "><?= $row[5]?></h5>



            <div class="row">



                <div class="col-md-8">



                    <h3 class="fs-14 mb-1 w-6"><span class="bld_cl">From:</span> <?= $row[7]?> ( <?= $row[2]?> )</h3>



                    <h3 class="fs-14 mb-1 w-6"><span class="bld_cl">To:</span> <span style="color:#969696;"><?= $row[8]?> ( <?= $row[3]?> )</span> </h3>



                </div>



                <div class="col-md-4">



                    <p class="fs-14 text-md-right" style="color:#969696;">

                        <?= substr( date('r', strtotime($row[6])), 0, 22) ?>                        

                    </p>



                </div>



            </div>

            <hr>

            <?php foreach($rows as $key=>$r){?>

                <strong style="font-size: 10pt; background-color: #f0f0f0">

                    <i class="fa fa-pencil-alt"></i> <?= $r[7]?> : <?= $r[6]?>

                </strong>

                <div class="email-msg" style="padding: 10px 0px 15px 0px">

                  <?= $r[4]?>



                <?php if($r[9] != ""){ ?>

                    <i class="fas fa-paperclip" style="color: #23527c"></i>

                    <a href="./upload/<?= $r[9]?>" target="_blank" download><?= $r[9]?></a>

                <?php } ?>



                </div>

                <hr style="margin-top: 0px;margin-bottom: 5px;">

            <?php }?>



            <div id="reply_preview_email">

                <div class="text-left my-3">

                   <a href="?content=content/emailviewall&item=emailpage" class="back_txt_color">&lt; Back</a>

                </div>



                <div class="reply text-right my-3">

                    <a href="javascript:void(0)" class="btn btn-outline-secondary my-5 px-3" id="reply_preview_email_btn">

                        <i class="fas fa-reply-all"></i>Reply

                    </a>

                </div>                

            </div>



            <div id="reply_send_box" style="display: none; padding-top: 20px">

                <form id="emailUserForm" action="./email/admin/emailprocmember.php" method="post" enctype="multipart/form-data"  autocomplete="off" >

                    <div>



                        <a onclick="$('#my_file').click();" class="btn btn-secondary w-6 mb-3" style="background-color: #e5e5e5; color:#000; border: 0; margin-bottom: 3px!important">

                            <i class="fas fa-paperclip"></i>

                            Attach Files

                        </a>&nbsp;<label id="filenameshow" style=""></label>

                        <?php 

                            /* If receiver_id is the same as like me, then replace with sender_id */

                            $receiver = $_SESSION['user_id'] == $row[14] ? $row[15] : $row[14];



                            /*>> set the latest email*/

                            $parent_id = isset($rows[ count($rows)-1 ][1]) ? $rows[count($rows)-1][1] : $_GET[1];

                        ?>

                        <input type="hidden" name="receiver_ids" value="<?= $receiver?>">

                        <input type="hidden" name="sender_id" value="<?= $_SESSION['user_id']?>">

                        <input type="hidden" name="receiver_type" value="members">

                        <input type="hidden" name="parent_id" value="<?= $parent_id ?>">

                        <input type="hidden" name="title" value="<?= $row[5] ?>">

                        <input type="hidden" name="emailType" value="user">



                        <input type="file" id="my_file" style="display: none;" name="attached">

                            <script>

                                $('#my_file').on('change', function(){

                                    $('#filenameshow').text(this.value.replace(/.*[\/\\]/, ''));

                                });

                            </script>

                        <div id="summernote"></div>

                        <input type="hidden" name="msg_contents" required>

                    </div>



                    <div style="margin-top: 10px; text-align: right;">

                        <button type="submit" class="btn btn-primary px-4 cl-fff" name="submit"><i class="fas fa-paper-plane"></i>  SEND</button>

                    </div>  

                </form>             

            </div>



        </div>





    </div>   



  </div>



</div>



<script src="./admin/js/jquery.gritter.min.js"></script>

<link rel="stylesheet" href="./admin/css/jquery.gritter.css">

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

  

  $('#reply_preview_email_btn').click(function(e){

        $('#reply_preview_email').css('display', 'none');

        $('#reply_send_box').show();

  });

</script>



<style type="text/css">

    .bg-error{

        background: rgba(183, 101, 101, 0.9);

        margin-top: 30px;

    }

</style>



<script type="text/javascript">

    /*==========>> Email send js script*/

    $('#emailUserForm').on('submit', function(e){

        var data = CKEDITOR.instances.summernote.getData();

        $('input[name="msg_contents"]').val(data.trim());

        var r_ids = $('input[name="receiver_ids"]').val();



        if( data.length <= 0 ){



            var msg = 'Please type the message contents.';

        }

        else if( r_ids.length <=0 ){



            var msg = 'Please Select the Receiver. <br> Please retry with another name.';

        }



        if (data.length <= 0 || r_ids.length <=0) {



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

</script>