<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('templates/includes/head'); ?>  
<style>
#mu-page-breadcrumb{
  background:url('<?=!empty($page->image)?'assets/uploads/pages/'.$page->image:'assets/frontend/img/bg-1.jpg'?>');
}

.home-02 .product-list__item {
  border: 1px solid #eeeeee;
  width:100%;
}
.product-list__item .exam-list li{
	border-bottom: solid 1px #EEE;
	
}
.exam-list-name{
	color:#999;
	text-transform:uppercase;
}
.product-list__item .time{
	font-size:12px;
}
.product-list__content {
	padding: 32px 18px 26px;
	border: none;
}
.product-label {
  color: #fff;
  font-size: 14px;
  font-weight: 700;
  line-height: 1;
  position: absolute;
  top: 0;
  z-index: 3;
  left:15px;
}
span.new-product-icon {
  background-color: #62b959;
  display: block;
  text-align: center;
}
.product-label span {
  border-radius: 4px;
  font-size: 12px;
  font-weight: 600;
  padding: 7px 10px;
  position: relative;
  text-transform: uppercase;
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
                        <div class="col-lg-12 text-center"><?=$page->body?></div>
                    </div>
<div class="row " id="result-data">
                    
<?php
$this->db->limit(12);
$this->db->order_by('id','desc');
$academy_data = $this->comman_model->get_by('users',array('confirm'=>'confirm','account_type'=>'T'),false,false,false);
$count_exam_list = print_count('users',array('confirm'=>'confirm','account_type'=>'T'));

//$exam_list = $this->comman_model->get_by('exams',array('enabled'=>1),false,array('id'=>'desc'),false);
if($academy_data){
	foreach($academy_data as $set_exam){
	$courseShow =true;
	$totalRating = 0;
	$stringQuery = "SELECT AVG(rate)AS rate FROM users_review where user_id  =".$set_exam->id;
	$rating = $this->comman_model->get_query($stringQuery,true);
	if($rating&&!empty($rating->rate)){			
		$totalRating = round($rating->rate,1);
	}
	else{
		$totalRating = 0;
	}
	
?>
<div class="col-xs-12 col-sm-4 col-md-3 ">
	<div class="product-list__item">
	    <figure class="product-list__img">
<a href="<?=$lang_code.'/academies/'.$set_exam->id?>">
<img src="<?=!empty($set_exam->logo)?'assets/uploads/users/full/'.$set_exam->logo:$default_image?>" alt="" style="width:100%;height:190px">
</a>
		</figure>
    
		<div class="product-list__content">
            <h3 class="product-list__title">
                <a href="<?=$lang_code.'/academies/'.$set_exam->id?>"><?=$set_exam->username?></a>
            </h3>
<ul class="product-list__star-list">
<li><a href="javascript:;"><i class="fa <?=$totalRating>=1?'fa-star':'fa-star-o'?>" aria-hidden="true"></i></a></li>
<li><a href="javascript:;"><i class="fa <?=$totalRating>=2?'fa-star':'fa-star-o'?>" aria-hidden="true"></i></a></li>
<li><a href="javascript:;"><i class="fa <?=$totalRating>=3?'fa-star':'fa-star-o'?>" aria-hidden="true"></i></a></li>
<li><a href="javascript:;"><i class="fa <?=$totalRating>=4?'fa-star':'fa-star-o'?>" aria-hidden="true"></i></a></li>
<li><a href="javascript:;"><i class="fa <?=$totalRating>=5?'fa-star':'fa-star-o'?>" aria-hidden="true"></i></a></li>
            </ul>
			<p class="product-list__price"><i class="fa fa-inr"></i> 0</p>
<!--            <p class="product-list__price"></p>-->
        </div>
		<div class="product-list__item-info">
<p class="item-info__text-01"><a href="<?=$lang_code.'/academies/'.$set_exam->id?>"><?=$set_exam->username?></a></p>
<a href="javascript:;"><p class="product-list__price"><i class="fa fa-thumbs-up"></i> <?=print_count('users_favorite',array('user_id'=>$set_exam->id,'u_like'=>'like'));?></p></a>
<!--<p class="item-info__text-01"><a href="<?=$lang_code.'/academies/'.$set_exam->id?>"><?=$set_exam->username?></a></p>-->
        </div>
	</div>
</div>
<?php		
	}
}
?>                    
    </div>
    
<div style="clear:both"></div>
<div class="" style="text-align: center">
        <button type="submit" class="btn btn-primary submitBtn" id="ajax-more" style=" <?=$count_exam_list>12?'':'display:none';?> " onClick="ajax_more()" value="loadmore" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading">More </button>

<input type="hidden" name="limit" id="limit" value="12"/>
<input type="hidden" name="offset" id="offset" value="12"/>
    </div>
                    
				</div>
			</div>
		</main>
<?php $this->load->view('templates/includes/footer'); ?>  
		
	</div>

	<!-- Main script -->
	<script src="assets/frontends/js/main.js"></script>
<script>
function ajax_more(){
	$(".submitBtn").button('loading');
	offset = $('#offset').val();
	limit  = $('#limit').val()
	category_id = '<?=$this->input->get('category_id')?>';
	
    $.ajax({
        url:'<?=$lang_code?>/ajax_academies/ajax_page',
		data:{offset:offset,limit:limit,category_id:category_id},
        type:'get', 
		dataType: 'json',
        success:function(data){
			$(".submitBtn").button('reset');
			$('#result-data').append(data.content);          
			/*			if(data.more_data==0){
				$('#ajax-more').hide();
			}*/
			if(data.more_d){
			}
			else{
				$('#ajax-more').hide();
			}
			
			$('#offset').val(data.offset);
			$('#limit').val(data.limit);
        }
    })
}
</script>
</body>
</html>

