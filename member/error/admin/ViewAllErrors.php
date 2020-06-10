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
                                <th>Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Hardware </th>
                                <!-- <th>Browser</th> -->
                                <th id="error_check_status">Status</th>
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
                                <td><?php echo $rec['uname'] ?></td>
                                <td><?php echo $rec['email'] ?></td>
                                <td><?php echo $rec['hardware'] ?></td>
                                <!-- <td><?php echo $rec['browser'] ?></td> -->
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
		"order": [ 4, 'asc' ],
        paging: false,
        "autoWidth": true,
        aoColumns : [
            { sWidth: '10%' },
            { sWidth: '30%' },
            { sWidth: '35%' },
            { sWidth: '15%' },
            { sWidth: '5%' },
            { sWidth: '5%' }
        ],
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




