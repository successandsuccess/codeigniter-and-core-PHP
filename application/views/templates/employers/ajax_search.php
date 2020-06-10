<?php
if($products){
	foreach($products as $set_data){
?>
<tr>
<td><?=$set_data->employer_name?></td>
<td><?=$set_data->employer_city." ".$set_data->employer_state?></td>
<td><a href="<?='employers/view/'.$set_data->user_id?>">View</a> | <a href="employers/ajax_total_map?<?=http_build_query($_GET);?>">Map All</a></td>
</tr>
<?php		
	}
}
else{
?>
<tr>
<td colspan="3" style="text-align:center">Nothing matched your search criteria</td></tr>
<?php		
}
?>  