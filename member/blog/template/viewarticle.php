<?php
//include_once 'blog/classes/blog.class.php';
//$blog = new BlogObject;

global $blog;

if(isset($_GET["id"]) && $_GET["id"]){
    $blog->id = $_GET['id'];
    $result = $blog->readWithWhere("id = ".$_GET['id']);
    $rec = $result[0];

    $views = $rec["views"];
    $blog->views = $views;
    $result = $blog->updateViews();

    $result = $blog->setUserView( $_SESSION["user_id"] );

?><style>.author-photo{	border-radius:50%;	}</style>
<div class="tab-content" id="myTabContent">
	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
		<div class="blog-main block-border ncca-right-padding">
			<?php 						echo $blog->output_single( $_GET["id"]  ); 						echo $blog->output_script(); 						?>
		</div>
	</div>     
</div>

<?PHP
}
?>


