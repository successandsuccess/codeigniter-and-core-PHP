<script src="assets/plugins/jquery.validate.js"></script>   
<div class="row">
<?=form_open(NULL, array('class' => 'form-horizontal edit-form', 'role'=>'form','enctype'=>"multipart/form-data"))?>
    <input type="hidden" value="<?=$form_data->gps?>" id="inputGps" name="gps">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
					<div class="form-body">                    

<div class="form-group" >
	<label class="col-lg-2 control-label">Certificate no.</label>
    <div class="col-md-10">
		<input type="text" name="certificate_no" value="<?=set_value('certificate_no',$form_data->certificate_no)?>" class="form-control " required="required" />
    	<span class="error-span"><?php echo form_error('certificate_no'); ?></span>
    </div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label">First Name</label>
    <div class="col-md-10">
		<input type="text" name="first_name" value="<?=set_value('first_name',$form_data->first_name)?>" class="form-control " required="required" />
    	<span class="error-span"><?php echo form_error('first_name'); ?></span>
    </div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label">Last Name</label>
    <div class="col-md-10">
		<input type="text" name="last_name" value="<?=set_value('last_name',$form_data->last_name)?>" class="form-control " required="required" />
    	<span class="error-span"><?php echo form_error('last_name'); ?></span>
    </div>
</div>
	
<div class="form-group" >
	<label class="col-lg-2 control-label">Company Name</label>
    <div class="col-md-10">
		<input type="text" name="company_name" value="<?=set_value('company_name',$form_data->company_name)?>" class="form-control " required="required" />
    	<span class="error-span"><?php echo form_error('company_name'); ?></span>
    </div>
</div>
	
<div class="form-group" >
	<label class="col-lg-2 control-label">Email</label>
    <div class="col-md-10">
		<input type="email" name="email" value="<?=set_value('email',$form_data->email)?>" class="form-control " required="required" />
    	<span class="error-span"><?php echo form_error('email'); ?></span>
    </div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label">Address</label>
    <div class="col-md-10">
		<input type="text" name="address" value="<?=set_value('address',$form_data->address)?>" class="form-control " id="autocomplete"  required="required" />
    	<span class="error-span"><?php echo form_error('address'); ?></span>
    </div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label">City</label>
    <div class="col-md-10">
		<input type="text" name="city" value="<?=set_value('city',$form_data->city)?>" class="form-control " required="required" />
    	<span class="error-span"><?php echo form_error('city'); ?></span>
    </div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label">State</label>
    <div class="col-md-10">
		<input type="text" name="state" value="<?=set_value('state',$form_data->state)?>" class="form-control " required="required" />
    	<span class="error-span"><?php echo form_error('state'); ?></span>
    </div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label">Country</label>
    <div class="col-md-10">
		<input type="text" name="country" value="<?=set_value('country',$form_data->country)?>" class="form-control " required="required" />
    	<span class="error-span"><?php echo form_error('country'); ?></span>
    </div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label">Zip</label>
    <div class="col-md-10">
		<input type="text" name="zip" value="<?=set_value('zip',$form_data->zip)?>" class="form-control " required="required" />
    	<span class="error-span"><?php echo form_error('zip'); ?></span>
    </div>
</div>
<div class="form-group" >
	<label class="col-lg-2 control-label">Phone 1</label>
    <div class="col-md-10">
		<input type="text" name="phone" value="<?=set_value('phone',$form_data->phone)?>" class="form-control " required="required" />
    	<span class="error-span"><?php echo form_error('phone'); ?></span>
    </div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label">Phone 2</label>
    <div class="col-md-10">
		<input type="text" name="phone_2" value="<?=set_value('phone_2',$form_data->phone_2)?>" class="form-control " />
    	<span class="error-span"><?php echo form_error('phone_2'); ?></span>
    </div>
</div>
	
<div class="form-group" >
	<label class="col-lg-2 control-label">Website</label>
    <div class="col-md-10">
		<input type="url" name="website" value="<?=set_value('website',$form_data->website)?>" class="form-control " />
    	<span class="error-span"><?php echo form_error('website'); ?></span>
    </div>
</div>

<div class="form-group" >
	<label class="col-lg-2 control-label">Map</label>
    <div class="col-md-12">
<div class="gmap" id="mapsAddress" style="width:100%;height:300px"></div>
    </div>
</div>
          
</div>
<div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-2 col-md-9">
<button type="submit" class="btn btn-primary submitBtn" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> <?=show_static_text(1,235)?>"><?=show_static_text(1,235)?></button>
<a href="<?=$_cancel?>" class="btn btn-default " >Cancel</a>

                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
<?=form_close()?>
</div>

<style>
.error-span p{
	margin-bottom:0px;
	color:#C00;
	font-size:13px;
}
.edit-form .error{
	color:#C00;
}

</style>


<script>
$( ".edit-form" ).validate({
	rules: {
		url: {
		  required: true,
		  url: true
		}
	},
	submitHandler: function (form) {
		$(".submitBtn").button('loading');
		return true;
	}
});
$('.edit-form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});

</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyATD-1Cy4a5ltcel9jRVXGePRNxVB7A_Go"></script>
<script src="assets/plugins/gmap/gmap3.min.js"></script>
<script type="text/javascript">
var timerMap;
var firstSet = false;
var savedGpsData;

$(function () {
	// If alredy selected
	if($('#inputGps').length && $('#inputGps').val() != ''){
		savedGpsData = $('#inputGps').val().split(", ");
		$("#mapsAddress").gmap3({
			map:{
			  options:{
				center: [parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])],
				zoom: 14
			  }
			},
			marker:{
			values:[
			  {latLng:[parseFloat(savedGpsData[0]), parseFloat(savedGpsData[1])]},
			],
			options:{
			  draggable: true
			},
			events:{
				dragend: function(marker){
				  $('#inputGps').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
				}
		  }}});
		
		firstSet = true;
	}
	else
	{
		$("#mapsAddress").gmap3({
			map:{
			  options:{
				center: [<?php echo isset($settings['gps'])?$settings['gps']:'45.81, 15.98'?>],
				zoom: 12
			  },
			}
		  });
	}
	
	$('#autocomplete').keyup(function (e) {
	
		clearTimeout(timerMap);
		timerMap = setTimeout(function () {
			
			$("#mapsAddress").gmap3({
			  getlatlng:{
				address:  $('#autocomplete').val(),
				callback: function(results){
				  if ( !results ){
					alert('Map could not find this address!');
					return;
				  } 
				  
					if(firstSet){
						$(this).gmap3({
							clear: {
							  name:["marker"],
							  last: true
							}
						});
					}
				  
				  // Add marker
				  $(this).gmap3({
					marker:{
					  latLng:results[0].geometry.location,
					   options: {
						  id:'searchMarker',
						  draggable: true
					  },
					  events: {
						dragend: function(marker){
							  $('#inputGps').val(marker.getPosition().lat()+', '+marker.getPosition().lng());
						}
					  }
					}
				  });
				  
				  // Center map
				  $(this).gmap3('get').setCenter( results[0].geometry.location );
				  
				  $('#inputGps').val(results[0].geometry.location.lat()+', '+results[0].geometry.location.lng());
				  
				  firstSet = true;
	
				}
			  }
			});
		}, 2000);
	});
});
</script>

<style>
.gmap{
    margin:0 auto;
    border:1px dashed #C0C0C0;
    width:68%;
    height:250px;
}
</style>
