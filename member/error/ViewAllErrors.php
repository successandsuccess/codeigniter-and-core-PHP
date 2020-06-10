<?php
    if(isset($_GET["act"]) && $_GET["act"] == "del"){
        $error->id = $_GET["id"]; 
        $error->delete();
    }
    $result = $error->readAll();
?>
                <div class="member-card card">
                    <h3>Errors</h3>
                    <div class="form-group">
                        <div class="right">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <table id="memberTable" class="table sorttable table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Added Date</th>
                                <th>Name</th>
                                <th>Hardware </th>
                                <th>Browser</th>
                                <!-- <th>Platform</th> -->
                                <th>Attachment</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result) {
                                foreach ($result as $rec) {
                            ?>
                            <tr>
                                <td> <?php $date=date_create($rec['addeddate']); echo date_format($date, "m/d/y"); ?> </td>
                                <!-- <td><a href="?content=../error/admin/PreviewError&li_class=Error&id=<?php echo $rec['error_id'] ?>"> <?php echo $rec['uname'] ?> </a></td> -->
                                <td><?php echo $rec['uname'] ?></td>
                                <td><?php echo $rec['hardware'] ?></td>
                                <td><?php echo $rec['browser'] ?></td>
                                <!-- <td><?php echo $rec['platform'] ?></td> -->
                                <td>
                                                                <?php
                                                                if(empty($rec['attachedfile'])){
                                                                    echo "No Attachment";
                                                                }
                                                                else{
																$path = $rec['attachedfile'];
																$ext = pathinfo($path, PATHINFO_EXTENSION);
																if($ext == 'docx' || $ext == 'doc' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'rtf'){
																?>
																	<a href="https://docs.google.com/gview?url=http://nccaatest.org/member/<?php echo $rec['attachedfile']?>&embedded=true" >View</a></td>
																<?php	
																}else if($ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'bmp' || $ext == 'tif'){
																?>			
																		<a href="#myModal<?php echo $rec['error_id']?>" data-toggle="modal" >View</a>
															</td>
																	
																	<div id="myModal<?php echo $rec['error_id']?>" class="modal fade" role="dialog">
																	<div class="modal-dialog modal-lg">
																			<!-- Modal content-->
																			<div class="modal-content">
																				<div class="modal-header">
																					<h4 class="modal-title">View Error Attachment</h4>
																					<button type="button" class="close" data-dismiss="modal">&times;</button>
																				</div>
																				<div class="modal-body" align="center">
																					<?php
																						list($width, $height) = getimagesize($_SERVER['DOCUMENT_ROOT']. "/"."member/".$rec['attachedfile']);
																						if($width <= $height){
																							$img_width = 700 * ($width/$height);
																							$img_height = 700;
																							
																						}else{
																							$img_width = 700;
																							$img_height = 700 * ($height/$width);
																						}
																					?>																	        
																						<img class='zoom' style="cursor: grab;" src="<?php echo ("/member/".$rec['attachedfile']);?>" width="<?=$img_width?>" height="<?=$img_height?>" onmousedown="zoom_grabbing()" onmouseup="zoom_grab()" >																	  	
																				</div>
																				<div class="modal-footer">
																					<button type="button" class="btn btn-blue" data-dismiss="modal">Close</button>
																				</div>
																			</div>
																	</div>
																	</div>														
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>														
                                                                        <a href="<?php echo "/member/".$rec['attachedfile']?>" target="_blank">View</a></td>
                                                                <?php
                                                                }
                                                            }
                                                                ?>
                                <td><?php echo $rec['status'] ?></td>
                                <td class="text-center"><a href="?content=../error/admin/EditError&li_class=Error&act=edit&id=<?php echo $rec['error_id'] ?>" title="Edit"><span class="glyphicon glyphicon-edit"></span></a><a onclick="confirmDelete($(this)); return false;" href="?content=../error/admin/ViewAllErrors&li_class=Error&act=del&id=<?php echo $rec['error_id'] ?>" title="Delete"><span class="glyphicon glyphicon-trash"></span></a></td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
<script>
$('.sorttable').DataTable( {
		"order": [ 0, 'desc' ],
        paging: false
}); 
</script>

<script src="../js/wheelzoom.js"></script>

<script>
    function zoom_grab(){
        $(".zoom").css("cursor", "grab");
    }
    function zoom_grabbing(){
        $(".zoom").css("cursor", "grabbing");
    }
    wheelzoom(document.querySelectorAll('img.zoom'));
</script>

