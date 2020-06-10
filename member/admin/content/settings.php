<?php

if(empty($_SESSION['admin_id']) || $_SESSION['admin_id'] == "")
{
	header('Location: /logincaamember.php');
}

$result = $settings->readAllSettings();
	
require_once("admin_dashboard.php");
?>

<style>

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 15px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #BDC1C6;
  -webkit-transition: .2s;
  transition: .2s;

}

.slider:before {
	position: absolute;
	content: "";
	height: 20px;
	width: 20px;
	top: -3px;
	left: -2px;
	bottom: 0px;
	background-color: white;
	-webkit-transition: .2s;
	transition: .2s;
	-moz-box-shadow: 1px 2px 4px rgba(0, 0, 0,0.5);
	-webkit-box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
	box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(25px);
  -ms-transform: translateX(25px);
  transform: translateX(25px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 10px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

<div class="member-card card">

    <h3>Settings</h3>

    <div class="form-group">

		<div class="right">

			<a class="btn btn-primary" style="cursor: pointer;" onclick="setting_add_modal()">Add Setting</a>

		</div>
		
        <div class="clearfix"></div>

    </div>


    <table id="viewAllSettingsTbl" class="table table-striped table-bordered nowrap" style="width:100%;">

        <thead>
          <tr>
            <th style="text-align: center; width: 5%">#</th>
            <th style="text-align: center; width: 20%">Item</th>
            <th style="text-align: center; width: 20%">Settings</th>
            <th style="text-align: center; width: 15%">Created</th>
            <th style="text-align: center; width: 15%">Modified</th>
            <th style="text-align: center; width: 10%">Show</th>
            <th style="text-align: center; width: 15%">Action</th>
          </tr>
        </thead>

        <tbody>
<?php
$i = 1; 
foreach($result as $key=>$row){
?>
        <tr>
            <td><?= $i++?></td>
            <td><?= $row['field']?></td>
            <td><?= $row['value']?></td>
            <td><?= $row['created']?></td>
            <td><?= $row['modified']?></td>
            <td>
				<label class="switch">
				  <input type="checkbox" checked>
				  <span class="slider round"></span>
				</label>
			</td>
            <td align="center"><a class="btn btn-success" style="cursor: pointer; color: #ffffff; padding: 3px 4px 3px 4px;">Edit</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" style="cursor: pointer;  color: #ffffff; padding: 3px 4px 3px 4px;">Delete</a></td>
        </tr>
<?php
}

?>
        </tbody>
    </table>
</div>

<script>

$('#viewAllSettingsTbl').DataTable({
	
	paging: true,
	
	lengthMenu: [50, 100, 200, 500],
	
	select: {
		style:    'os',
		selector: 'td:first-child'
	},
	
	order: [[ 0, 'asc' ]]

	
});

$('#viewAllSettingsTbl_length').css('display', 'block');

$('#viewAllSettingsTbl_info').css('display', 'block');



</script>
