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
	<h3 class="provider_title"><?=$list_data->company_name?></h3>
	<div class="provider-address"><?=$list_data->address?></div>
	<div class="provider-address"><?=$list_data->city?>,<?=$list_data->state?>,<?=$list_data->country?> ,<?=$list_data->zip?></div>
	<div class="provider-address"><?=$list_data->phone?></div>
	<div class="provider-address" style="margin-top:15px;"><?=$list_data->email?></div>
	<div class="provider-address"><?=$list_data->website?></div>
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
	var val = '<?=$list_data->gps?>';
	$('#map_canvas').gmap({ 'center': val,scrollwheel: false ,zoom:13,mapTypeControl: false,streetViewControl: false,}).bind('init', function(event, map) { 
			
		$('#map_canvas').gmap('addMarker', {
			'position': val, 
		'draggable': false,
		}).mouseover(function() {
			$('#map_canvas').gmap('openInfoWindow', { 'content': '<h4><?=$list_data->company_name;?></h4><p><?=$list_data->address;?><br><?=$list_data->city.' '.$list_data->country.', '.$list_data->zip;?></p><p><?=$list_data->phone;?></p><p><?=$list_data->email;?></p>' }, this);
        }).mouseout(function() {
            $('#map_canvas').gmap('closeInfoWindow');
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
	parent.AdjustIframePrograms(document.getElementById("super_container").scrollHeight);
</script>

</body>
</html>

