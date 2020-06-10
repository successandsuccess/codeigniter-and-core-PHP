<?php
    if(isset($_GET["act"]) && $_GET["act"] == "del")
    {
        $announcement->id = $_GET["id"]; 
        $announcement->delete();
    }
    $result = $announcement->readAll();
?>

<style>
.dataTables_length, .dataTables_info {
    display: block !important;
}
</style>
                <div class="member-card card">
                    <h3>ANNOUNCEMENTS</h3>
                    <div class="form-group">
                        <div class="right">
                            <a href="?content=../announcement/admin/AddNewAnnouncement&li_class=Announcement" class="btn btn-primary">Add Post</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <table id="memberTable" class="table sorttable table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Added</th>
                                <th>Subject </th>
                                <th>Visibility</th>
                                <th>Audience</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result) {
                                foreach ($result as $rec) {
                            ?>
                            <tr>
                                <td> <?php $date=date_create($rec['created']); echo date_format($date, "m/d/y"); ?> </td>
                                <td><a href="?content=../announcement/admin/PreviewAnnouncement&li_class=Announcement&id=<?php echo $rec['id'] ?>" target="_blank"> <?php echo strtoupper($rec['subject']); ?> </a></td>
                                <td><?php if($rec['visibility'] == 1) { echo 'Show';} else { echo 'Hide';} ?></td>
                                <td><?php echo $rec['audience'] ?></td>
                                <td class="text-center"><a href="?content=../announcement/admin/AddNewAnnouncement&li_class=Announcement&act=edit&id=<?php echo $rec['id'] ?>" title="Edit"><span class="glyphicon glyphicon-edit"></span></a><a onclick="confirmDelete($(this)); return false;" href="?content=../announcement/admin/ViewAllAnnouncements&li_class=Announcement&act=del&id=<?php echo $rec['id'] ?>" title="Delete"><span class="glyphicon glyphicon-trash"></span></a></td>
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
        paging: true,
        lengthMenu: [50,100,250,500],
}); 
</script>

