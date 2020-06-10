<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('templates/includes/head'); ?>  
<link rel="stylesheet" href="assets/frontends/css/social.css">

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
<div class="row">
       <div class="col-md-12" >
<?php
if($this->session->flashdata('success')) {
$msg = $this->session->flashdata('success');
?>
<div class="alert alert-success"><?php echo $msg;?></div>
<?php	
}
if($this->session->flashdata('error')) {
$msg = $this->session->flashdata('error');
?>
<div class="alert alert-danger"><?php echo $msg;?></div>
<?php
}   
?>
<div class="row">
    <div class="col-md-6 col-xs-12">
        <h3><?=show_static_text($lang_id,33);?></h3>
      <!--<ul class="list-unstyled" style="line-height: 2">
          <li><span class="fa fa-check text-success"></span> See all your orders</li>
          <li><span class="fa fa-check text-success"></span> Fast re-order</li>
          <li><span class="fa fa-check text-success"></span> Save your favorites</li>
          <li><span class="fa fa-check text-success"></span> Fast checkout</li>
          <li><span class="fa fa-check text-success"></span> Get a gift <small>(only new customers)</small></li>
          <li><a href="/read-more/"><u>Read more</u></a></li>
      </ul>-->
        <p><a class="btn btn-yellow " href="<?=$lang_code.'/secure/register'?>" ><?=show_static_text($lang_id,86);?></a></p>
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="well">
    <?php //echo validation_errors();?>   
            <form method="post" action="" id="customer_login" accept-charset="UTF-8">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
            <input type="hidden" name="operation" value="set"  /> 
                  <div class="form-group">
                      <label for="username" class="control-label"><?=show_static_text($lang_id,111);?></label>
                      <input type="text" class="form-control" id="username" name="email" value="" required="" >
                      <span style="color:#F00;"><?php echo form_error('email'); ?></span>
                  </div>
                  <div class="form-group">
                      <label for="password" class="control-label"><?=show_static_text($lang_id,20);?></label>
                      <input type="password" class="form-control passwords" id="password" name="password" value="" required="">
                      <span style="color:#F00;"><?php echo form_error('password'); ?></span>
                  </div>                      
                                                                          
                  <button type="submit" class="btn btn-yellow btn-block"><?=show_static_text($lang_id,2);?></button>
<!--                  <div style="margin-top:10px"> OR 
     						<a class="btn btn-social-icon btn-facebook" href="<?='auth_fb'?>"><i class="fa fa-facebook"></i></a>
					        <a class="btn btn-social-icon btn-google-plus" href="<?='auth_google/google_session'?>"><i class="fa fa-google-plus"></i></a>
                  </div>-->
                  
                  <div style="margin-top:10px">
                    <a class="forgot" href="<?=$lang_code.'/secure/forgot'?>" ><?=show_static_text($lang_id,24);?></a>
                  </div>
              </form>
          </div><!--//well//-->
      </div><!--///col-xs-6/-->
</div><!--//row//-->    
    </div>
     </div>					
				</div>
			</div>
			
			
		</main>
<?php $this->load->view('templates/includes/footer'); ?>  
		
	</div>

	<!-- Main script -->
	<script src="assets/frontends/js/main.js"></script>

</body>
</html>


