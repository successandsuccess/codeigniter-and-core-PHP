<?php
$i = ($page_number-1)*$list_data;
if($all_data){
	foreach($all_data as $set_data){
		$i++;
?>
<tr>
<td><?=$set_data->id?></td>
<td><?=$set_data->company_name;?></td>
<td><?=$set_data->email;?></td>
<td><?=$set_data->phone;?></td>
<td>
<a class="btn btn-xs btn-primary" href="<?=$_cancel.'/edit/'.$set_data->id;?>" ><i class="fa fa-edit"></i></a>
<a class="btn btn-xs btn-info" href="<?=$_cancel.'/view/'.$set_data->id;?>" ><i class="fa fa-eye"></i></a>
<a class="btn btn-xs btn-danger" href="<?=$_delete?>/<?=$set_data->id;?>" onclick="return confirm_box();"><i class="fa fa-trash-o"></i></a>
    </td>
</tr>

<?php             
	}
}
?>                        
