<?php

$empty_check = 0;
if(empty($member_cert_id) == false && empty($member_fullname) == false){
	for($i = 0; $i < count($member_cert_id); $i++){
	     if((empty($member_cert_id[$i]) == false) && (empty($member_fullname[$i]) == false)){
	         $empty_check = $empty_check + 1;
?>

<tr>
<td><?=$member_fullname[$i]->f_name." ".$member_fullname[$i]->l_name?></a></td>
<td><?=$member_cert_id[$i]->id_certificate?></td>
<td><a href="search/view/<?=$member_cert_id[$i]->user_id?>">View Certificate</a></td>
</tr>

<?php	
      }
	}
}
else if($empty_check = 0){
?>
<tr>
<td colspan="3" style="text-align:center">Nothing matched your search criteria</td></tr>
<?php		
}
?>  