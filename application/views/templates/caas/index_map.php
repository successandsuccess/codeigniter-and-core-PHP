<?php 

$address = $this->input->get('address');
$city = $this->input->get('city');
$state = $this->input->get('state');
$zip = $this->input->get('zip');
if($address || $city || $state || $zip){
    
    $total_city = 1;
    
}else{
    
   $total_city = 0; 
}

if(empty($address) == false){
    
    $address = $address." ";
    
}

if(empty($city) == false){
    
    $city = $city." ";
    
}

if(empty($state) == false){
    
    $state = $state." ";
    
}

$area = $address.$city.$state.$zip;

$this->load->view('templates/includes/head');

if($products){
    	$data_array = array();
		$gps = array();
		$count_num = 0;
		$count_lat = 0;
		$count_lng = 0;
		
	for($i=0; $i < count($products); $i++){
	    
		if(empty($products[$i]->gps) == false){
		    
            if(empty($products[$i]->state) == false){
            
                $origin_state = $products[$i]->state." ";
            
            }
            
            if(empty($products[$i]->zip_code) == false){
            
                $origin_zip = $products[$i]->zip_code." ";
            
            }
            
            if(empty($products[$i]->city) == false){
            
                $origin_city = $products[$i]->city." ";
            
            }

		    
            $address = ' ';
            
    		$address_origin[$i] = $origin_state . $origin_zip . $origin_city;
            
    		$address = urlencode($products[$i]->state . "+" . $products[$i]->zip_code . "+" . $products[$i]->city);
    		
    		$gps[$i] = $products[$i]->gps;
    		
    		$extract_gps[$i] = explode(',', $gps[$i]);
    		
    		if(count($extract_gps[$i]) > 1){
    		    
    		    $count_num = $count_num + 1;
    		    $count_lat = $count_lat + intval(trim($extract_gps[$i][0]));
    		    $count_lng = $count_lng + intval(trim($extract_gps[$i][1]));
    		    
    		}
    		
    		$data[$i] = array("DisplayText"=>$products[$i]->user_id, "ADDRESS"=>$address_origin[$i], "LatitudeLongitude"=>$gps[$i],"MarkerId"=> "Customer");
    		
    		array_push($data_array, $data[$i]);
		

		}
	}
	
	$center_lat = (int)($count_lat/$count_num);
	$center_lng = (int)($count_lng/$count_num);

}
//print_r(json_encode($data_array));exit;
//print_r($data_array);exit;


?>  
<style>
body{
	background:#FFF;
}

.google-map{
  width: 100%;
}
.results-map .ui-map-view {
  border-color: #d7d7d7;
  border-style: solid;
  border-width: 0 0 0 1px;
  display: block;
}
.acf-map {
  border: 1px solid #ccc;
  height: 425px;
  margin: 0;
  width: 100%;
}
.ui-map-view article p,
.marker p{
	margin-bottom:0;
}
.ajax-loading{
	display:none;
	text-align:center;
}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=AIzaSyATD-1Cy4a5ltcel9jRVXGePRNxVB7A_Go"></script>
<script type="text/javascript">
  var map;
        var geocoder;
        var marker;
        var people = new Array();
        var latlng;
        var infowindow;

        $(document).ready(function() {
            ViewCustInGoogleMap();
        });

        function ViewCustInGoogleMap() {

            var mapOptions = {
                center: new google.maps.LatLng(<?=$center_lat?>, <?=$center_lng?>),   // 
                zoom: 7,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

            // Get data from database. It should be like below format or you can alter it.

            var data = '<?=json_encode($data_array)?>';

            people = JSON.parse(data); 

            for (var i = 0; i < people.length; i++) {
                setMarker(people[i]);
            }

        }

        function setMarker(people) {
            geocoder = new google.maps.Geocoder();
            infowindow = new google.maps.InfoWindow();
            if ((people["LatitudeLongitude"] == null) || (people["LatitudeLongitude"] == 'null') || (people["LatitudeLongitude"] == '')) {
                geocoder.geocode({ 'address': people["Address"] }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                        marker = new google.maps.Marker({
                            position: latlng,
                            map: map,
                            draggable: false,
                            html: people["DisplayText"],
                            icon: "images/marker/" + people["MarkerId"] + ".png"
                        });
                        //marker.setPosition(latlng);
                        //map.setCenter(latlng);
                        google.maps.event.addListener(marker, 'click', function(event) {
                            infowindow.setContent(this.html);
                            infowindow.setPosition(event.latLng);
                            infowindow.open(map, this);
                        });
                    }
                    else {
                        alert(people["DisplayText"] + " -- " + people["Address"] + ". This address couldn't be found");
                    }
                });
            }
            else {
                var latlngStr = people["LatitudeLongitude"].split(",");
                var lat = parseFloat(latlngStr[0]);
                var lng = parseFloat(latlngStr[1]);
                latlng = new google.maps.LatLng(lat, lng);
                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    draggable: false,               // cant drag it
                    html: people["DisplayText"]    // Content display on marker click
                    //icon: "images/marker.png"       // Give ur own image
                });
                //marker.setPosition(latlng);
                //map.setCenter(latlng);
                google.maps.event.addListener(marker, 'click', function(event) {
                    infowindow.setContent(this.html);
                    infowindow.setPosition(event.latLng);
                    infowindow.open(map, this);
                });
            }
        }
</script>
<body >
<div class="super_container search-page" id="super_container">
	<div class="container">
    	<div class="row">
			<form  class="search-form" id="advance-search-form" style="display:none">
				<input type="hidden" name="f_name" value="<?=$this->input->get('f_name');?>"   />
				<input type="hidden" name="l_name" value="<?=$this->input->get('l_name');?>"    />
				<input type="hidden" name="city" value="<?=$this->input->get('city');?>" />
				<input type="hidden" name="state" value="<?=$this->input->get('state');?>"  />
				<input type="hidden" name="zip" value="<?=$this->input->get('zip');?>" />
				<input type="hidden" name="phone" value="<?=$this->input->get('phone');?>" />
				<input type="hidden" name="employer" value="<?=$this->input->get('employer');?>" />
			</form>

            <div class="col-md-12" align="center"><font style="font-family:Circe;font-size: 17px;color:#000000; font-weight: bold;">
			There <?php if($count_num > 1){ echo"are ".$count_num." CAAs";}
			            else {echo"is 1 CAA";} 
			            if($total_city == 1) echo" in ".$area;
				  ?></font></div><br>
			<div class="col-md-12">
				
				<div class="google-map">
					<div class="ui-map-view">
						<div class="acf-map" id="map-canvas"></div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
            
        </div>
	</div>
</div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/plugins/ajax-pagination/pagination.min.js"></script>
</body>		
</html>

