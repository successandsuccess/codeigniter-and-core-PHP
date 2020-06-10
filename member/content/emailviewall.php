<?php

    if(empty($_SESSION['user_id']) || $_SESSION['user_id'] == "")
    {
        header('Location: /logincaamember.php');
    }

    if(isset($_GET['act']) && $_GET['act'] == 'del'){

        $email->removeById($_GET['id']);
    }

    // print_r($_SESSION['user_id']); exit;
    $result = $email->getAllOfMember($_SESSION['user_id']);

    // print_r($result); exit;
	
    
?>

<div class="ncca-right-block " style="text-color:red !important;" >

  <div class="tab-content" id="myTabContent">
     <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="block-border ncca-right-padding">
        <p class="midium-title title-bottom-border text-uppercase">EMAIL</p> 
        <div class="sub-block-header" style="min-height: 65px">
          <a href="?content=./email/emailnew&item=emailpage">
            <button class="btn btn-blue compose" style="float: right;">
              <span class="big-font">+</span>
              <span>Compose new message</span>
            </button>
          </a>                             
        </div>
    <div>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

          <table id="viewUserEmailTbl" class="table table-striped " style="font-size: 10pt;">
            <thead>                               
              <tr>
                <th>From</th>
                <th>To</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              <?php 
              if (is_array($result) || is_object($result))
              {
                foreach($result as $key=>$row){ 
              
             
			  ?>
                  <tr style="<?php if($email->getUnreadMsgCnt($_SESSION['user_id'], $row[5])) echo 'background-color: #dcdcdc;' ?>" >
                      <td title="<?= $row[7]?>">
                        <?php $sender_fullname = strlen($row[7]) > 10 ? substr($row[7], 0, 10)."..." : $row[7];?>
                        <?= $sender_fullname?>                        
                      </td>
					  
                      <td title="<?= $row[8]?>">
                        <?php $receiver_fullname = strlen($row[8]) > 10 ? substr($row[8], 0, 10)."..." : $row[8];?>
                        <?= $receiver_fullname?>                          
                      </td>
					  
                      <td title="<?= $row[5]?>">
                        <a href="?content=email/emailpreview&item=emailpage&id=<?= $row[1] ?>&Uid=<?= $_SESSION['user_id']?>&subject=<?=base64_encode($row[5])?>" >
                          <?php $subject = strlen($row[5]) > 20 ? substr($row[5], 0, 20)."..." : $row[5];?>
                          <?= $subject?> 
                      </a><?php if($email->getUnreadMsgCnt($_SESSION['user_id'], $row[5]) > 0) echo '<span id="unread_label">'.$email->getUnreadMsgCnt($_SESSION['user_id'], $row[5]).'</span>';?>
                      </td>
					  
                      <td title="<?= $row[6]?>">
                        <?php $regdate = date("m/d/Y", strtotime($row[6]));?>
                        <?= $regdate; ?>                        
                      </td>
					  
                      <td style="text-align: center;">
                          <a href="?content=email/emailpreview&item=emailpage&id=<?= $row[1] ?>&Uid=<?= $_SESSION['user_id']?>" title="View">    
                            <i class="fa fa-eye" aria-hidden="true"></i>
                          </a>                    
                      </td>
					  
                  </tr>
              <?php }
              }
              ?>          
            </tbody>
          </table>

        </div>

        <div class="form-group row email-footer"></div>              

    </div>

  </div>   

</div>


</div>

<?php 
if( isset($_SESSION["resultMSG"]['type']) ){ ?>
        
<script type="text/javascript">
$(document).ready(function() {
    jQuery.gritter.add({

        title: "<?php $_SESSION["resultMSG"]['type']==0 ? print('Notify!') : print('Success!')?>",

        text: "<?= $_SESSION["resultMSG"]['msg']?>",

        sticky: false,

        class_name: "<?php $_SESSION["resultMSG"]['type']==0 ? print('bg-error') : print('bg-success')?>",

        time: '3000'                

    });
	
	$(".gritter-item-wrapper").css("text-align", "center");
	
	$(".gritter-item-wrapper").css("background", "rgba(35,98,136,0.8)");
	
	$("#gritter-notice-wrapper").css("position","fixed");
	
	$("#gritter-notice-wrapper").css("top", "40%");
	
	$("#gritter-notice-wrapper").css("left", "50%");
})
</script>
<?php unset($_SESSION["resultMSG"]); ?>
<?php } ?>
<script type="text/javascript">
$(document).ready(function() {

  var table = $('#viewUserEmailTbl').DataTable( {
	  
		  "ordering": false,
		  
          paging:         true
      } );
});
</script>
<style type="text/css">

  a {color: #24608b}
  
  #viewUserEmailTbl{
	  
	  color: #656565;
	  
  }
  
  #viewUserEmailTbl_length{
	  
	  color: #656565;
	  
  }
  
  #viewUserEmailTbl_filter{
	  
	  color: #656565;
	  
  }
  
  #viewUserEmailTbl_info{
	  
	  color: #656565;
	  
  }
  
  select[name="viewUserEmailTbl_length"] {
	  
	color: #656565;
  
  }
  
  input[type="search"] {
	  
	height: 30px;
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
	border: 1px solid #ccc;
	color: #656565;
  
  }
  
  #unread_label {
    display: inline;
    padding: .2em .8em .2em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: top;
    border-radius: 50%;
    background-color: #d9534f;
	color: #ffffff;
	margin-left: 3px;
  }
  
</style>