<?php $this->load->view('templates/includes/head'); ?>  
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
  height: 460px;
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
function infoOpen(i){
	google.maps.event.trigger(gmarkers[i], 'click');
}

var gmarkers = [];
var infowindow = new google.maps.InfoWindow;
var map = '';

function render_map( $el ) {
	// var
	var $markers = $el.find('.marker');
	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP,
		mapTypeControl: false,
/*	    scaleControl: false,*/
		streetViewControl: false,
	};

	// create map	        	
	map = new google.maps.Map( $el[0], args);

	// add a markers reference
	map.markers = [];

	// add markers
	$markers.each(function(){
	   	add_marker( $(this), map );
	});

	// center map
	center_map( map );
	initialize1(map);	
	get_location();
}
function get_location(){}

function add_marker( $marker, map ) {
	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});

	// add to array
	map.markers.push( marker );
	gmarkers.push(marker);
	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		infowindow = new google.maps.InfoWindow({maxHeight: 100});
		var content = $marker.html();
		google.maps.event.addListener(marker, 'click', (function(marker, content) {
			return function() {
				infowindow.close();
				infowindow.setContent(content);
				infowindow.open(map, marker);
			}
		})(marker, content));
	}
}

function center_map( map ) {
	// vars
	var bounds = new google.maps.LatLngBounds();
	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){
		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
		bounds.extend( latlng );
	});

	// only 1 marker?
	if( map.markers.length == 1 ){
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else{
		// fit to bounds
		map.fitBounds( bounds );
	}

}
function initialize() {
	//alert('sdf');
 var map = document.getElementById("map_canvas");
    google.maps.event.trigger(map, 'resize');         // fixes map display
   // map.setCenter(center); 
	google.maps.event.trigger(document.getElementById("map_canvas"), 'resize');
}



$(document).ready(function(){
	$('.acf-map').each(function(){
		render_map( $(this) );
	});
});
function reloadMap(){
	$('.acf-map').each(function(){
		render_map( $(this) );
	});

}

var autocomplete;
function initialize1(map) {}

function selectCountry(ids) {}

function add_markers(){
	//console.log('asd');
	// var
	var latlng = new google.maps.LatLng( 22.30228751349172, 76.21589389376999 );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});

	// add to array
	map.markers.push( marker );
	gmarkers.push(marker);
	// if marker contains HTML, add it to an infoWindow
		// create info window
		infowindow = new google.maps.InfoWindow({maxHeight: 100});
		var content = 'Hello';
		google.maps.event.addListener(marker, 'click', (function(marker, content) {
			return function() {
				infowindow.close();
				infowindow.setContent(content);
				infowindow.open(map, marker);
			}
		})(marker, content));

}

</script>
<body >
<div class="super_container search-page" id="super_container">
	<div class="container">
    	<div class="row">
<form action="caas" class="search-form" id="advance-search-form" style="display:none">
    <input type="hidden" name="name" value="<?=$this->input->get('name');?>" />
    <input type="hidden" name="city" value="<?=$this->input->get('city');?>" />
    <input type="hidden" name="state" value="<?=$this->input->get('state');?>" />
    <input type="hidden" name="zip" value="<?=$this->input->get('zip');?>" />
    <input type="hidden" name="alumni" value="<?=$this->input->get('alumni');?>" />
    <input type="hidden" name="classes" value="<?=$this->input->get('classes');?>"  />
</form>


<div class="col-md-12">
	
	<div class="google-map">
    	<div class="ui-map-view">
		<div class="acf-map" id="map_canvas"></div>
	    <div class="clearfix"></div>
</div>
	</div>
</div>
            
        </div>
	</div>
</div>
		
<script type="text/javascript" src="assets/plugins/ajax-pagination/pagination.min.js"></script>
<script type="text/javascript">
var initialURL = location.href;

function submit_form(){
    var loadUrl = '<?='programs/ajax_map'?>';
    var data = jQuery('#advance-search-form').serialize();
    $('.recent-loading').show(); 

    $.get(
        loadUrl,
        data,
        function(response){          
		    $('.recent-loading').hide(); 
/*			if(response.url!=window.location){
				window.history.pushState({path:response.url},'',response.url);
			}*/
			
			$('#map_canvas').html(response.html);
			reloadMap();
			$('#result-data').html(response.html);
			if(response.total>20){
				$('#list-paginations').pagination('destroy');
				$('#list-paginations').pagination({
					total: response.total,
					current: 1,
					length: 2,
					size: 2, 
					click: function(options,$target) {
						urls = response.ajax_url;
						set_d = 'page='+options.current;
						$.get(urls,set_d,
							function(result){          
								$('#result-data').html(result.html);
								$('#map_canvas').html(response.html);
								reloadMap();
							},
							'json'
						);
	
					}
					
				});
			}
			parent.AdjustIframePrograms(document.getElementById("super_container").scrollHeight);

        },
        'json'
    );
}
submit_form();
</script>
</body>		
</html>

