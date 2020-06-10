<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('templates/includes/head'); ?>  
<style>
#mu-page-breadcrumb{
  background:url('<?=!empty($page->image)?'assets/uploads/pages/'.$page->image:'assets/frontend/img/bg-1.jpg'?>');
}
</style>
<body class="home-02">

	<div class="wrapp-content">

		<!-- Header -->
		<header class="wrapp-header">
<?php $this->load->view('templates/includes/menu'); ?>  
<?php $this->load->view('templates/includes/head_img'); ?>  
			
		</header>

		<!-- Content -->
		<main class="content-row">
			
			
			
			<div class="content-box-01 padding-top-93 padding-bottom-100 padding-sm-bottom-80">
				<div class="container">
<div class="cotact-area">
             <div class="row">
               <div class="col-md-5">
                 <div class="contact-area-left">
                   <h4>Contact Info</h4>
        <div><?=$page->body;?></div>
                <ul class="contact-info-list">
                  <li> <i class="fa fa-phone"></i> <?=$settings['phone']?></li>
                  <li> <i class="fa fa-envelope-o"></i> <?=$settings['site_email']?></li>
                  <li> <i class="fa fa-map-marker"></i> <?=$settings['address']?></li>
                </ul>

<div id="map_canvas" class="gmap"></div>                
               

                 </div>
               </div>
               <div class="col-md-7">
                 <div class="contact-area-right">
                  <form class="contactform" id="contact_form" accept-charset="UTF-8"> 
                <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" name="operation" value="set"  /> 
                      <div class="form-group">
                          <label for="username" class="control-label"><?=show_static_text($lang_id,16)?> <span class="required">*</span></label>
                          <input type="text" required size="30" value="" name="author" id="input-name" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="username" class="control-label"><?=show_static_text($lang_id,18)?> <span class="required">*</span></label>
                          <input type="email" required size="30" value="" name="author" id="input-email" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="username" class="control-label"><?=show_static_text($lang_id,82)?> <span class="required">*</span></label>
                          <input type="text" required size="30" value="" name="author" id="input-phone" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="username" class="control-label"><?=show_static_text($lang_id,255)?> <span class="required">*</span></label>
                          <input type="text" required size="30" value="" name="author" id="input-subject" class="form-control">
                      </div>
                                            
                      <div class="form-group">
                          <label for="username" class="control-label"><?=show_static_text($lang_id,55)?></label>
                          <textarea class="form-control" id="input-message" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-yellow"><?=show_static_text($lang_id,56)?></button>                      
                      
                  </form>                  
                <div class="message ajax-error"></div>
                   
                 </div>
               </div>
             </div>
           </div>					
				</div>
			</div>
			
			
		</main>
<?php $this->load->view('templates/includes/footer'); ?>  
		
	</div>

	<!-- Main script -->
	<script src="assets/frontends/js/main.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyDPLi6vvwFFT3WbS1DJoU1PV6sTAFUOv2w" type="text/javascript"></script>
<script type="text/javascript" src="assets/plugins/gmap/jquery.gmap.js"></script> 
<script type="text/javascript" src="assets/plugins/gmap/jquery.ui.map.js"></script>
<script type="text/javascript" charset="utf-8">
$(function(){
	var val = '<?=$settings['gps']?>';
	$('#map_canvas').gmap({ 'center': val,scrollwheel: false ,zoom:13}).bind('init', function(event, map) { 
			
		$('#map_canvas').gmap('addMarker', {
			'position': val, 
		'draggable': false,
		}).mouseover(function() {
			$('#map_canvas').gmap('openInfoWindow', { 'content': '<b><?=$settings['site_name']?></b><p><?=$settings['address']?><br><?=$settings['phone']?></p>' }, this);
        }).mouseout(function() {
            $('#map_canvas').gmap('closeInfoWindow');
        });
	});

	// Detect user location
});
</script>
<style>
.gmap{
    margin-bottom:10px;
    width:100%;
    height:250px;
	
}
</style>

<script>
$( document ).ready(function() {
	$( "#contact_form" ).submit(function() {
		var email = $('#input-email').val();
		var name = $('#input-name').val();
		var message = $('#input-message').val();
		var subject = $('#input-subject').val();
		var phone = $('#input-phone').val();
		$('.ajax-error').html('sending..');
		$.ajax({
				type:"POST",
				url:"ajax_contact/send_contact",
				data:{email:email,user_name:name,messege:message,subject:subject,phone:phone,lang_id:'<?=$lang_id?>',<?=$this->security->get_csrf_token_name();?>:'<?=$this->security->get_csrf_hash();?>'},
				dataType: 'json',
				success: function(json) {	
					if(json.status=='ok'){
						$('.ajax-error').html(json.msg);
						$("#input-email").val('');
						$("#input-name").val('');
						$("#input-subject").val('');
						$("#input-message").val('');
					}
					if(json.status=='error'){
						$('.ajax-error').html(json.msg);
					}
				}
		});
	return false;	
	});
});
</script>

</body>
</html>
