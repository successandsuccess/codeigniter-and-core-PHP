<?php
if($products){
	foreach($products as $set_data){
?>
<tr>
<td><?=$set_data->company_name?></td>
<td><?=$set_data->city.', '.$set_data->state?></td>
<td><a href="<?='programs/view/'.$set_data->id?>">View</a> | <a href="programs/map?<?=http_build_query($_GET);?>">Map All</a></td>
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