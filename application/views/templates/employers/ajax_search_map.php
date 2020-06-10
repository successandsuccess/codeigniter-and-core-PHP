<?php
if($products){
	foreach($products as $set_data){
		if(!empty($set_data->gps)){
			$gps = explode(', ',$set_data->gps);		
?>
<div class="marker" data-lat="<?=$gps[0];?>" data-lng="<?=$gps[1];?>" style="display:none">
    <article class="js-card " style="">
    <div class="card-block" style="padding-top:0%">
            <div class="" style="">
<h4><?=$set_data->name;?></h4>
<p><?=$set_data->address;?>
<br><?=$set_data->city.', '.$set_data->state.' '.$set_data->zip;?>
</p>
<p><?=$set_data->phone;?></p>
<p><?=$set_data->email;?></p>
<p><?=$set_data->website;?></p>

        </div>

    <div style="clear:both"></div>
    </div>


</article>
</div>
<?php
		}
	}
}
?>  