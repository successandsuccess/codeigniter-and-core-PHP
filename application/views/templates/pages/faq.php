<?php
//fetch data 
$this->db->order_by('order','asc');
$faqs_data = $this->comman_model->get_lang('faqs',$this->data['lang_id'],NULL,array('enabled'=>1),'faqs_id',false);

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
                                <a href="<?=$lang_code?>"><?=show_static_text($lang_id,10)?></a>
                            </li>
                            <li><?=$page->title?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <div class="content-box-01 padding-top-33 padding-bottom-36">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-listing ">
<?php
if($faqs_data) {
	foreach($faqs_data as $set_faq){
?>
<article class="blog-post">
<h5 class="blog-post__title">
<a href="javascript:;"><?=$set_faq->title?></a>
</h5>

<div class="blog-post__meta">
</div>
<div class="blog-post__text">
<div class="more more-comment"><?=$set_faq->body?></div>
</div>

</article>

<?php		
	}
}
?>                    
                        
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

<style>
.content-box-01 a {
	color: #0254EB
}
.content-box-01 a:visited {
	color: #0254EB
}
.content-box-01 a.morelink {
	text-decoration:none;
	outline: none;
}
.morecontent span {
	display: none;
}
.more-comment {
}
</style>
 


</body>

</html>



