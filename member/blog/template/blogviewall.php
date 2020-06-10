<?php



//include_once 'blog/classes/blog.class.php';


//$blog = new BlogObject;





global $blog;


// echo $blog->output_list(  ); exit;


?>

<style>
.author-photo{
	/* border-radius:50%; */
	/* margin: auto; */
    width: 77px;
    height: 90px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    overflow:hidden;

}
span.author-name2{
	margin: auto;
    margin-left: 15px;
}
</style>


<div class="tab-content" id="myTabContent">


	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


		<div class="blog-main block-border ncca-right-padding">


			<?php echo $blog->output_list(  ); ?>


		</div>


	</div>     


</div>