<?php
    if(isset($_GET["id"]) && $_GET["id"]){
        $blog->id = $_GET['id'];
        $result = $blog->readWithWhere("id = ".$_GET['id']);				$photo_name = $blog->viewPhoto($_GET['id']);
        		$rec = $result[0];
    }
    
?><style>.preview_post img {		width:794px;	}</style>
                <div class="member-card card">
                    <h3>Blog</h3>                    <a href="?content=../blog/admin/ViewAllBlogs&li_class=Blog" class="backbtn"><span class="glyphicon glyphicon-chevron-left"></span>Back</a>                    					<div class="previewBlog">
                        <h1> <?php echo $rec["title"]; ?> </h1>
                        <div class="form-group clearfix">
                            <div class="left">
                                <div class="image">
                                    <img src="../<?php													if(empty($photo_name) == false){																												if(empty($photo_name[0]['photo']) == false){																														echo $photo_name[0]['photo'];																												}else{																														echo"assets/images/ceo.png";																													}													} 													else echo"assets/images/ceo.png";													?>" 															alt="" class="img-responsive" />
                                </div>
                                <div class="blogauth">
                                    <h5> <?php echo $rec["author"]; ?> </h5>
                                    <p>NCCAA Director</p>
                                </div>
                            </div>
                            <div class="right">
                                <p class="emaildate"> <?php $date=date_create($rec['created']); echo date_format($date, "m/d/Y"); ?> </p>
                            </div>
                        </div>
                        <div class="form-group clearfix border-b-1">													<div class="preview_post">
								<?php echo $rec["contents"]; ?> 							</div>
                        </div>
                   </div>
                </div>

