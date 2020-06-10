<?php

    if(empty($_SESSION['admin_id']) || $_SESSION['admin_id'] == ""){

        header('Location: /logincaamember.php');
    }

    if(isset($_GET['act']) && $_GET['act'] == 'del'){

        $blastemail->removeById($_GET['id']);
    }

    $result = $blastemail->getAllBlastEmails();
?>

<div class="member-card card">

    <h3>ALL BLAST EMAIL</h3>

    <div class="form-group">
        <div class="right">
            <a href="?content=../emailblast/admin/AddNewBlastEmail&li_class=EmailBlast" class="btn btn-primary">+ Compose New Blast Email</a>
        </div>
        <div class="clearfix"></div>
    </div>

    <table id="viewAllEmailTbl" class="table table-striped table-bordered nowrap" style="width:100%">

        <thead>
          <tr>
		    <th style="display: none">No</th>
            <th>From</th>
            <th>IP</th>
            <th>To</th>
            <th>Subject</th>
            <th>Send Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>            
    <?php foreach($result as $key=>$row){ ?>
        <tr>
            <td style="display: none;"><?= $row['id']?></td>
            <td><?= $row['sender_name']?></td>
            <td style="width: 16%"><?= $row['sender_ip']?></td>
            <td title="<?=$row['receiver_to']?>">
                <?php $rr = strlen($row['receiver_to']) > 30 ? substr($row['receiver_to'], 0, 50)." ..." : $row['receiver_to'];?>
                <?= $rr?>                    
            </td>
            <td style="width: 20%">
                <?php $rowContents = strlen($row['subject']) > 27 ? substr($row['subject'], 0, 40)." ..." : $row['subject'];?>
                <a href="?content=../emailblast/admin/PreviewBlastEmail&li_class=EmailBlast&id=<?= $row['id'] ?>" title="<?= $row['subject']?>">
                    <?= $rowContents?> 
                </a>
            </td>
            <td style="width: 16%"><?= date( 'm/d/Y H:i', strtotime($row['regdate']) ) ?></td>
            <td class="text-center" style="width: 11%">
                <a href="?content=../emailblast/admin/PreviewBlastEmail&li_class=EmailBlast&act=edit&id=<?= $row['id'] ?>" title="View"> 
                    <span class="glyphicon glyphicon-eye-open" style="margin: 0px 8px;"></span>
                </a>
                <a href="?content=../emailblast/admin/ViewAllBlastEmail&li_class=EmailBlast&act=del&id=<?= $row['id'] ?>" title="Delete">
                    <span class="glyphicon glyphicon-trash" style="margin: 0px 5px;"></span>
                </a>
            </td>
        </tr>
    <?php }?>    
        </tbody>
    </table>
</div>
<?php 
if( isset($_SESSION["emailMSG"]['type']) ){ ?>
        
<script type="text/javascript">
$(document).ready(function() {
    jQuery.gritter.add({

        title: "<?php $_SESSION["emailMSG"]['type']==0 ? print('Notify!') : print('Success!')?>",

        text: "<?= $_SESSION["emailMSG"]['msg']?>",

        sticky: false,

        class_name: "<?php $_SESSION["emailMSG"]['type']==0 ? print('bg-error') : print('bg-success')?>",

        time: '5000'                

    });

});

</script>
<?php unset($_SESSION["emailMSG"]); ?>
<?php } ?>

<?php if( isset($_SESSION["resultMSG"]['type']) && $_SESSION["resultMSG"]['type']==1 ){ ?>
<script type="text/javascript">
$(document).ready(function() {
    jQuery.gritter.add({

        title: "Notify!",

        text: "<?= $_SESSION["resultMSG"]['msg']?>",

        sticky: false,

        class_name: "bg-error",

        time: '3000'                

    });
});
</script>
<?php unset($_SESSION["resultMSG"]); ?>
<?php } ?>