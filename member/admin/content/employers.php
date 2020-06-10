<?php

if(empty($_SESSION['admin_id']) || $_SESSION['admin_id'] == "")
{
	header('Location: /logincaamember.php');
}

$result = $employers->readAllEmployers();
	
require_once("admin_dashboard.php");
?>

<div class="member-card card">

    <h3  onclick="openURL()">Employers</h3>

    <div class="form-group">


        <div class="clearfix"></div>

    </div>


    <table id="viewAllEmployersTbl" class="table table-striped table-bordered nowrap" style="width:100%;">

        <thead>
          <tr>
            <th style="text-align: center;">#</th>
            <th style="text-align: center;">Employer (Workplace)</th>
            <th style="text-align: center;">Address</th>
            <th style="text-align: center;">City</th>
            <th style="text-align: center;">State</th>
            <th style="text-align: center;">Zip</th>
            <th style="text-align: center; display: none;">#CAAs</th>
          </tr>
        </thead>

        <tbody>
<?php
$i = 1; 
foreach($result as $key=>$row){
	if(empty($row['employer_name']) == false){
?>
        <tr>
            <td><?= $i++?></td>
            <td><?= $row['employer_name']?></td>
            <td><?= $row['employer_address']?></td>
            <td><?= $row['employer_city']?></td>
            <td><?= $row['employer_state']?></td>
            <td><?= $row['employer_zip']?></td>
            <td style="display: none;"><?= $employers->countCaas($row['employer_name'])?></td>
        </tr>
<?php
	}
}

?>
        </tbody>
    </table>
</div>

<script>

$('#viewAllEmployersTbl').DataTable({
	
	paging: true,
	
	lengthMenu: [50, 100, 200, 500],
	
	select: {
		style:    'os',
		selector: 'td:first-child'
	},
	
	order: [[ 0, 'asc' ]]

	
});

$('#viewAllEmployersTbl_length').css('display', 'block');

$('#viewAllEmployersTbl_info').css('display', 'block');


</script>
