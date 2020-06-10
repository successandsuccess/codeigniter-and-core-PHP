<?php
$uri = '';
$getData = parse_url($_SERVER['REQUEST_URI']);
if(isset($getData['query'])){
	$uri = '?'.$getData['query'];
}

$address = urlencode($list_data->state . "+" . $list_data->zip_code . "+" . $list_data->city);

$file = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=AIzaSyAeLT5grSQLFusUII3xhIOjvkMFkgAWkTY";

$json = @file_get_contents($file);

$obj = json_decode($json, true);

$gps = $obj['results'][0]['geometry']['location']['lat'].", ".$obj['results'][0]['geometry']['location']['lng'];


?>
<?php $this->load->view('templates/includes/head'); ?>  
<style>
.home{
	padding-top:0;
	padding-bottom:0;
}
body{
	background:#FFF;
}
.provider_title{
	margin-top:8px;
	font-size:23px;
	
}
.provider-address{
	color:#000;
}
</style>
<body >
<div class="container view-page" id="super_container">
    	<div class="row mb">
<div class="col-md-5 col-xs-5" style="padding-right:0">
<div class="">
<div class="card-body">
<div class="provider_head">
	<h3 class="provider_title"><?=$user_data->full_name?></h3>
	<div class="provider-address"><?=$list_data->address_1?></div>
	<div class="provider-address"><?=$list_data->city?>,<?=$list_data->state?>,<?=$list_data->country?> ,<?=$list_data->zip_code?></div>
	<div class="provider-address"><?=$list_data->cell_phone?></div>
	<div class="provider-address"><?=$user_data->email?></div>
</div>
<div class="provider_text">
<!--    <p>/p>-->
</div>


</div>

	</div>
</div>
<div class="col-md-7 col-xs-7 " style="padding-left:0">
	<div class="card" style="padding:5px;">
		<div class="gmap" id="map_canvas"></div>
	</div>                
        	</div>            
        </div>
</div>
		
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyATD-1Cy4a5ltcel9jRVXGePRNxVB7A_Go" type="text/javascript"></script>
<script type="text/javascript" src="assets/plugins/gmap/jquery.gmap.js"></script> 
<script type="text/javascript" src="assets/plugins/gmap/jquery.ui.map.js"></script>

<script type="text/javascript" charset="utf-8">
$(function(){
	var val = '<?=$gps?>';
	$('#map_canvas').gmap({ 'center': val,scrollwheel: false ,zoom:13,mapTypeControl: false,streetViewControl: false,}).bind('init', function(event, map) { 
			
		$('#map_canvas').gmap('addMarker', {
			'position': val, 
		'draggable': false,
		});
	});
	// Detect user location
});
</script>
<style>
.ui-map-view article p,
.marker p{
	margin-bottom:0;
}
.gmap{
    margin-bottom:10px;
    width:100%;
    height:233px;
	
}
</style>
		
<script type="text/javascript">
parent.AdjustIframeCertificates(document.getElementById("super_container").scrollHeight);
</script>

</body>
</html>

