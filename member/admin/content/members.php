<?php



if(empty($_SESSION['admin_id']) || $_SESSION['admin_id'] == "")

{

	header('Location: /logincaamember.php');

}



$result = $members->readAllUsers();

// print_r($result); exit;



require_once("admin_dashboard.php");



$role_set = array("Student", "CAA", "PD", "Employer", "Admin", "Retired", "De-certified");



?>



<div class="member-card card">



    <h3>Members</h3>



    <div class="form-group">





        <div class="clearfix"></div>



    </div>





    <table id="viewAllMembersTbl" class="table table-striped table-bordered nowrap" style="width:100% !important;">



        <thead>

          <tr>

            <th colspan="3" style="text-align: center;">User Info</th>

            <th colspan="2" style="text-align: center;">Login</th>

            <th style="text-align: center;">Role</th>

          </tr>

          <tr>

            <th style="text-align: center;">ID</th>

            <th style="text-align: center;">First</th>

            <th style="text-align: center;">Last</th>

            <th style="text-align: center;">User/Email</th>

            <th style="text-align: center;">Password</th>

            <th style="text-align: center;">Title</th>

          </tr>

        </thead>

        <tbody>
            <?php 
				foreach($result as $item)
				{
					echo "<tr><td>".$item[0]."</td><td>".$item[1]."</td><td>".$item[2]."</td><td>".$item[3]."</td><td>".$item[4]."</td><td>".$item[5]."</td></tr>";
				}
			?>
        </tbody>

    </table>

</div>



<script>


var table_member = $('#viewAllMembersTbl').DataTable({



// 	'ajax': '../admin/classes/tables_load.php?members=true',

	"processing": true,
        // "serverSide": true,

	"deferRender": true,
	
	
	"pageLength": 20,

	

	paging: true,

	

	lengthMenu: [50, 100, 200, 500],

			

	bAutoWidth: false, 

	

	aoColumns : [

		{ sWidth: '5%' },

		{ sWidth: '16%' },

		{ sWidth: '16%' },

		{ sWidth: '32%' },

		{ sWidth: '17%' },

		{ sWidth: '14%' }

	],

	

	'order': [[0, 'asc']],

});

// $('#viewAllMembersTbl').show();
// table_member.columns.adjust().draw();



$('#viewAllMembersTbl_length').css('display', 'block');



$('#viewAllMembersTbl_info').css('display', 'block');



function edit_role(id){

	

	var role_val = $('#role_member_id'+id).val();

	

	var data = {'id':id, 'member_role':role_val };

	

	$.ajax({

		url : "classes/edit_role.php",

		method : "POST",

		data : data,

		async : true,

		dataType : 'json',

		

		success: function(data){

			

			if(data['statusCode'] == 1){

				

				jQuery.gritter.add({

					title: 'Success!',

					text: 'Role is changed to ' + role_val + '.',

					//image: 'assets/images/user-profile-2.jpg',			

					sticky: false,

					class_name: 'bg-success',

					time: '1000'				

				});

			

			}else if(data['statusCode'] == 2){

				

				$('#role_member_id'+id).val(data['data']);

				

				jQuery.gritter.add({

					title: 'Failed!',

					text: 'You can not change the role to Admin or Program Director.',

					sticky: false,

					class_name: 'bg-error',

					time: '3000'				

				});

				

			}else{

				

				jQuery.gritter.add({

					title: 'Failed!',

					text: 'There is one issue in Database.',

					sticky: false,

					class_name: 'bg-error',

					time: '3000'				

				});

				

			}

			

			$(".gritter-item-wrapper").css("width", "350px");



			$(".gritter-item-wrapper").css("text-align", "center");



			$("#gritter-notice-wrapper").css("position","fixed");



			$("#gritter-notice-wrapper").css("top", "45%");



			$("#gritter-notice-wrapper").css("left", "45%");

			

			id = null;

			

			role_val = null;

			

			data = null;



		},

		

		error: function(data){

			

			jQuery.gritter.add({



				title: 'Failed!',



				text: 'You can not change the role to Admin or PD.',



				sticky: false,



				class_name: 'bg-error',



				time: '3000'				



			});

			

			$(".gritter-item-wrapper").css("width", "350px");



			$(".gritter-item-wrapper").css("text-align", "center");



			$("#gritter-notice-wrapper").css("position","fixed");



			$("#gritter-notice-wrapper").css("top", "40%");



			$("#gritter-notice-wrapper").css("left", "50%");





			

			id = null;

			

			role_val = null;

			

			data = null;



		}

		

	});

}



</script>