<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('templates/includes/head'); ?>  
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
       <div class="col-md-12">
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
        
        <?php //echo validation_errors();?>   
      <form method="post" action="" id="customer_login" accept-charset="UTF-8"  onSubmit="return submit_reg_form(this);">
        <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash();?>" />
        <input type="hidden" name="operation" value="set"  /> 
        <div class="row" style="margin-top:10px">
            <div class="col-md-12">
            <div class="row">    	            
        <div class="col-md-4 form-field" >
            <label class="control-label"><?=show_static_text($lang_id,16);?> * </label>
            <div class="">
                <input type="text" class="form-control" title=""  id="lastname" name="first_name" value="<?=set_value('first_name'); ?>">
                <span class="error-span"><?php echo form_error('first_name'); ?></span>
            </div>
        </div>
        <div class="col-md-4 form-field" >
            <label class="control-label"><?=show_static_text($lang_id,17);?> * </label>
            <div class="">
                <input type="text" class="form-control" title=""  id="lastname" name="last_name" value="<?=set_value('last_name'); ?>">
                <span class="error-span"><?php echo form_error('last_name'); ?></span>
            </div>
        </div>                      
    
        <div class="col-md-4 form-field" >
            <label class="control-label"><?=show_static_text($lang_id,18);?> * </label>
            <div class="">
                <input type="email" class="form-control" title=""  id="lastname" name="email" value="<?=set_value('email'); ?>">
                <span class="error-span"><?php echo form_error('email'); ?></span>
            </div>
        </div>
    
        
        <div class="hide-data" style="">
            <div class="col-md-4 form-field" >
                <label class="control-label"><?=show_static_text($lang_id,82);?> * </label>
                <div class="">
        
                    <input type="text" class="form-control" title=""  id="lastname" name="phone" value="<?=set_value('phone'); ?>">
                    <span class="error-span"><?php echo form_error('phone'); ?></span>
                </div>
            </div>                      
        
			                       

        </div>
        <div class="col-md-4 form-field" >
            <label class="control-label" for=""><?=show_static_text($lang_id,20);?> * </label>
            <div class="input-box">
                <input type="password" class="form-control" title="" id="password" name="password" value="<?=set_value('password'); ?>">
                  <span class="error-span"><?php echo form_error('password'); ?></span>
            </div>
        </div>
    
    
        <div class="col-md-4 form-field" >
            <label class="control-label" for=""><?=show_static_text($lang_id,21);?> * </label>
            <div class="input-box">
                <input type="password" class="form-control" id="confirmation" title="" name="confirm" value="<?=set_value('confirm'); ?>">
                <span class="error-span"><?php echo form_error('confirm'); ?></span>
            </div>
        </div>
        <div  style="clear:both"></div>		
        </div>
        
    
        </div>
        </div>
    <br>
      <div class="action-btn">
        <p>
          <input type="submit" class="btn btn-yellow" value="<?=show_static_text($lang_id,1);?>">
        </p>
      </div>
      </form>
    </div>
     </div>					
				</div>
			</div>
			
			
		</main>
<?php $this->load->view('templates/includes/footer'); ?>  
		
	</div>

	<!-- Main script -->
	<script src="assets/frontends/js/main.js"></script>

    
<style>
.form-field{
	min-height:90px;
}
.error-span p{
	margin-bottom:0px;
	color:#C00;
	font-size:13px;
}
</style>

</body>
</html>

