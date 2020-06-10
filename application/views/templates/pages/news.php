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
					<div class="row">
						<div class="col-lg-12 text-center">
							<h3 class="title-02"><span><?=$page->title?></span>
							</h3>
<?=$page->body?>                        
							
						</div>
					</div>
					
<?php
//if(isset($this->data['user_details'])){
?>					
                    
                    <div class="row">
						<div class="col-lg-12">
							
                            
                            
<?php
$this->db->order_by('id','desc');
$home_news = $this->comman_model->get_lang('news',$this->data['lang_id'],NULL,array('enabled'=>1),'news_id',false);
if($home_news){
	foreach($home_news as $set_exam){
		$this->data['news_item'] = $set_exam;
?>
<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
<?php $this->load->view('templates/comman/news_item',$this->data); ?>  
</div>
<?php		
	}
}
?>
                            
                               
						</div>
					</div>
<?php
//}
?>
				</div>
			</div>
		</main>
<?php $this->load->view('templates/includes/footer'); ?>  
		
	</div>

	<!-- Main script -->
	<script src="assets/frontends/js/main.js"></script>

</body>
</html>

