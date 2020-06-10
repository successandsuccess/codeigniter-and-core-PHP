<?php

if($products){
	foreach($products as $set_data){
	    
		if(!empty($set_data->state) || !empty($set_data->zip_code) || !empty($set_data->city)){

		$address = urlencode($set_data->state . "+" . $set_data->zip_code . "+" . $set_data->city);

		$json = @file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=AIzaSyATD-1Cy4a5ltcel9jRVXGePRNxVB7A_Go');

		$obj = json_decode($json, true);

		$gps[0] = $obj['results'][0]['geometry']['location']['lat'];
		$gps[1] = $obj['results'][0]['geometry']['location']['lng'];
?>
<div class="marker" data-lat="<?=$gps[0];?>" data-lng="<?=$gps[1];?>" style="display:block">
    <article class="js-card " style="">
    <div class="card-block" style="padding-top:0%">
            <div class="" style="">
<h4></h4>
<p><?=$set_data->address_1;?>
<br><?=$set_data->city.' '.$set_data->state.', '.$set_data->zip_code;?>
</p>
<p><?=$set_data->cell_phone;?></p>
<p><?=$set_data->email;?></p>

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