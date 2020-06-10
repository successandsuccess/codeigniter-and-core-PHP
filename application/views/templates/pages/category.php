<?php
//fetch parent_id=0 from categories data 
$this->db->order_by('order','asc');
$category_list = $this->comman_model->get_lang('categories',$this->data['lang_id'],NULL,array('enabled'=>1,'parent_id'=>0),'category_id',false);

?>
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
		<main class="content-row" id="category-wrapper">
        
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
                        <div class="col-lg-12 text-center"><?=$page->body?></div>
                    </div>
<div class="row ">
<div class="categories-listing grid" id="nestable">
<?php		
if($category_list){
	foreach($category_list as $set_cat){
		$sub_category_list = $this->comman_model->get_lang('categories',$this->data['lang_id'],NULL,array('parent_id'=>$set_cat->id),'category_id',false);
		if($sub_category_list){
?>
<div class="category-item grid-item">
<h2><a href="<?=$lang_code.'/courses?category_id='.$set_cat->id?>" ><?=$set_cat->title?></a></h2>
<ul>
<?php
	foreach($sub_category_list as $set_sub_cat){
?>
<li><a href="<?=$lang_code.'/courses?category_id='.$set_sub_cat->id?>" class="category-item-inner"><?=$set_sub_cat->title?></a></li>
<?php
	}
?>
</ul>
</div>
<?php		
		}
	}
}
?>






<!--<div class="category-item grid-item">
<h2>
<a title="Math" href="https://alison.com/courses/math">
Math
</a>
</h2>
<ul>
<li><h3 class="category-item-inner">
<a title="Core Maths Skills" href="https://alison.com/courses/core-maths-skills">
Core Maths Skills
</a>
</h3></li>
<li><h3 class="category-item-inner">
<a title="Calculus" href="https://alison.com/courses/calculus">
Calculus
</a>
</h3></li>
<li><h3 class="category-item-inner">
<a title="Probability and Statistics" href="https://alison.com/courses/probability-and-statistics">
Probability and Statistics
</a>
</h3></li>
<li><h3 class="category-item-inner">
<a title="Algebra" href="https://alison.com/courses/algebra">
Algebra
</a>
</h3></li>
<li><h3 class="category-item-inner">
<a title="Geometry" href="https://alison.com/courses/geometry">
Geometry
</a>
</h3></li>
<li><h3 class="category-item-inner">
<a title="Series and Sequences" href="https://alison.com/courses/series-and-sequences">
Series and Sequences
</a>
</h3></li>
<li><h3 class="category-item-inner">
<a title="Exam Prep" href="https://alison.com/courses/exam-prep">
Exam Prep
</a>
</h3></li>
</ul>
</div>-->


</div>    
                    
					</div>                    
				</div>
			</div>
		</main>
<?php $this->load->view('templates/includes/footer'); ?>  
		
	</div>

	<!-- Main script -->
	<script src="assets/frontends/js/main.js"></script>
	<script src="assets/plugins/masonry/masonry.js"></script>
<script>
if($(window).width() > 767){
	$('.grid').masonry({
		// options
		itemSelector: '.grid-item',
	});
}
</script>

</body>
</html>

