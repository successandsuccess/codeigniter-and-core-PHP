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
<div class="page-title-wrapp">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-title-01"><?=$page->title?></h1>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<ul class="breadcrumbs">
								<li class="active">
									<a href="<?=$lang_code?>">Home</a>
								</li>
								<li><?=$page->title?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>			
			
			
			<div class="content-box-01 padding-top-20 padding-bottom-100 padding-sm-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center">
<?=$page->body?>                        
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

