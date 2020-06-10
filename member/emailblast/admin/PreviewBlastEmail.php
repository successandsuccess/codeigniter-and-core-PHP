<?php	
    if(isset($_GET["id"]) && $_GET["id"]){
    	// marked as readed 
        // $blastemail->updateReadById($_GET['id']);

        $row = $blastemail->getById($_GET['id']);

        // $rows = $blastemail->getAllChainsByid($_GET['id']);

    }
    else{
    	echo "No Data!";
    	return;
    }
	
	function getSenderFullName($email){
		
		if (strpos(strtolower($email), "cynthia") !== false){
			
			$admin_fullname = "Cynthia Maraugha";
			
		}else if(strpos(strtolower($email), "soren") !== false){
			
			$admin_fullname = "Soren Campbell";
			
		}else if(strpos(strtolower($email), "contact") !== false){
			
			$admin_fullname = "Megan Varellas";
			
		}else if((strpos(strtolower($email), "jimfletcher") !== false) || (strpos(strtolower($email), "globaltechkyllc") !== false)){
			
			$admin_fullname = "Jim Fletcher";
			
		}else{
			
			$admin_fullname = $email;
			
		}

		return $admin_fullname;
		
	}

?>
<style>
.preview_post img {
	
	width:794px;	
}
</style>

<div class="member-card card">
    <h3>Blast Email View</h3>
    <a href="?content=../emailblast/admin/ViewAllBlastEmail&li_class=EmailBlast" class="backbtn"><span class="glyphicon glyphicon-chevron-left"></span>Back</a>
    
<div class="previewEmail" align="center">
	<div style="width: 640px; text-align: left;">
		
		<div>
			<label>From: </label><span> <?= getSenderFullName($row['sender_email'], "fullname")?></span>
		</div>
		
		<!--div>
			<label>To: </label>
			<?php $rr = strlen($row['receiver_to']) > 75 ? substr($row['receiver_to'], 0, 75)." ..." : $row['receiver_to'];?>
			<?php
				$ToMails = explode(',', $row['receiver_to']);
				count($ToMails);
			?>
			<span> <?= count($ToMails)?> - </span>
			<span title="<?= trim($row['receiver_to'])?>"><?= $rr ?></span>
		</div-->
		
		<div>
			<label>Subject: </label><span> <?= $row['subject']?></span>	
		</div>



		<!--div>
			<?php $cc = strlen($row['receiver_cc']) > 75 ? substr($row['receiver_cc'], 0, 75)." ..." : $row['receiver_cc'];?>
			<?php
				$ToCCMails = explode(',', $row['receiver_cc']);
				count($ToCCMails);
			?>
			
			<label>CC: </label>
			<span> <?= count($ToCCMails)?> - </span>
			<span title="<?= trim($row['receiver_cc'])?>"><?= $cc ?></span>
		</div>

		<div>
			<?php $bcc = strlen($row['receiver_bcc']) > 75 ? substr($row['receiver_bcc'], 0, 75)." ..." : $row['receiver_bcc'];?>
			<?php
				$ToBCCMails = explode(',', $row['receiver_bcc']);
				count($ToBCCMails);
			?>
			
			<label>BCC: </label>
			<span> <?= count($ToBCCMails)?> - </span>
			<span title="<?= trim($row['receiver_bcc'])?>"><?= $bcc ?></span>
			
		</div-->

	</div><br>
	<iframe src="../../member/emailblast/admin/Template.php?id=<?= $_GET["id"]?>" style="width: 790px; min-height: 2500px; border: none;"></iframe>
</div>

</div>