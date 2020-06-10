<?php
    if(isset($_GET["id"]) && $_GET["id"]){
        $error->id = $_GET['id'];
        $result = $error->readWithWhere("error_id = ".$_GET['id']);
		// $photo_name = $error->viewPhoto($_GET['id']);
		$rec = $result[0];
    }
?>
<style>
.preview_post img {
	width:794px;
}
</style>
                <div class="member-card card">
                    <h3>Error</h3>
                    <a href="?content=../error/admin/ViewAllErrors&li_class=Error" class="backbtn"><span class="glyphicon glyphicon-chevron-left"></span>Back</a>
					<div class="previewBlog">
                        <h1> <?php echo $rec["uname"]; ?> </h1>
                        <div class="form-group clearfix">
                            <div class="left">
                                <div class="blogauth">
                                    <h5> Status </h5>
                                    <p><?php echo $rec["status"]; ?></p>
                                </div>
                            </div>
                            <div class="right">
                                <p class="emaildate"> <?php $date=date_create($rec['addeddate']); echo date_format($date, "m/d/Y"); ?> </p>
                            </div>
                        </div>
                        <div class="form-group clearfix border-b-1">
							<div class="preview_post">
								<?php echo $rec["issue"]; ?> 
							</div>
                        </div>
                   </div>
                </div>





