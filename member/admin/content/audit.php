<?php
   if (empty($_SESSION['admin_id']) || $_SESSION['admin_id'] == "") 
   {
       header('Location: /logincaamember.php');
   } 
   else 
   {
       //pass/fail
       if (isset($_POST['id']) && isset($_POST['audit_result_id'])) {
		//    print_r($_POST); exit;
           $audit->updateActionNum($_POST);
       }
       //data save
       if (isset($_POST['id']) && isset($_POST['issues_text'])) {
           $audit->saveIssuesText($_POST);
       }
       $result = $audit->readAll();
       require_once ("admin_dashboard.php");
   }
   ?>
<style>
.dataTables_length, .dataTables_info {
    display: block !important;
}
</style>
<div class="member-cards card">
   <h3 class="cme-title">CME AUDIT</h3>
   <div class="form-group">
      <div class="right">
         <a href="#" class="btn btn-primary" style="display:none">Report</a>
      </div>
      <div class="clearfix"></div>
   </div>
   <div class="row" style="text-align:center; margin-bottom:20px;">
      <a href="?content=content/audit_complete&li_class=CME&cycle=2018" style="margin-right: 20px; font-size:13pt; font-weight: bold;">2018-2020</a>
      <a href="?content=content/audit_complete&li_class=CME&cycle=2019" style="margin-right: 20px; font-size:13pt; font-weight: bold;">2019-2021</a>
      <a href="?content=content/audit_complete&li_class=CME&cycle=2020" style="margin-right: 20px; font-size:13pt; font-weight: bold;">2020-2022</a>
      <a href="?content=content/audit_complete&li_class=CME&cycle=2021" style="margin-right: 20px; font-size:13pt; font-weight: bold;">2021-2023</a>
      <a href="?content=content/audit_complete&li_class=CME&cycle=2022" style="margin-right: 20px; font-size:13pt; font-weight: bold;">2022-2024</a>
   </div>
   <table id="memberTable" class="table audit table-striped table-bordered nowrap" style="width:100%; text-align:center; font-size:14px !important">
      <thead>
         <tr>
            <th>User ID</th>
            <th>Date Added</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Action</th>
            <th>Issues</th>
            <th>Completed</th>
         </tr>
      </thead>
      <tbody>
         <?php
            if ($result) {
                for ($i = 0;$i < count($result);$i++) {
            ?>
         <tr>
            <td><?php echo $result[$i][0]['user_id']; ?></td>
            <td><?php $date = getdate($result[$i][0]['action_date']);
               echo $date['mon'] . "/" . $date['mday'] . "/" . $date['year']; ?></td>
            <td><?php echo '<a href="../index.php?dXNlcl9yb2xl=' . base64_encode('Student') . '&dXNlcl9pZA===' . base64_encode($result[$i][0]['user_id']) . '" target="_blank">' . $result[$i][0]['first_name'] . '</a>'; ?></td>
            <td><?php echo '<a href="../index.php?dXNlcl9yb2xl=' . base64_encode('Student') . '&dXNlcl9pZA===' . base64_encode($result[$i][0]['user_id']) . '" target="_blank">' . $result[$i][0]['last_name'] . '</a>'; ?></td>
            <td><a href="?content=content/audit_member&li_class=CME&member_id=<?php echo $result[$i][0]['user_id']; ?>&cycle=<?php echo $result[$i][0]['cme_cycle_start']; ?>" target="_blank">View</a></td>
            <td><input type="text" name="issues_text<?php echo $result[$i][0]['user_id']; ?>" id="issues_text<?php echo $result[$i][0]['id']; ?>" class="form-control reducesize" value="<?php echo $result[$i][0]['issues_text'] ?>" /></td>
            <input type="hidden" id="<?php echo $i; ?>" value="<?php echo $result[$i][0]['id']; ?>">
            <td>
               <select class = "form-control" style = "width:100%; font-size:16px;padding-left:5px;" id = "cme_audit_id<?php echo $result[$i][0]['user_id']; ?>" onchange = "javascript:cme_audit(<?php echo $result[$i][0]['user_id'] ?>);">
                  <?php
                     $order_set = array("Select", "Pass", "Fail");
                     foreach ($order_set as $key) { ?>
                  <option 
                     <?php
                        if ($result[$i][0]['action_num'] == 4) {
                            $key_value = "Pass";
                        }
                        if ($result[$i][0]['action_num'] == 3) {
                            $key_value = "Select";
                        }
                        if ($result[$i][0]['action_num'] == 5) {
                            $key_value = "Fail";
                        }
                        if ($key_value == $key) {
                            echo 'selected = "selected"';
                        }
                        ?> 
                     value = "<?php echo (array_search($key, $order_set) + 3); ?>">
                     <?php echo $key ?> 
                  </option>
                  <?php
                     } ?>
               </select>
            </td>
         </tr>
         <?php
            }
            } else {
            ?>	
         <tr>
            <td colspan = "7" align = "center">No registered data</td>
         </tr>
         <?php
            }
            ?>
      </tbody>
   </table>
   <div class="row">
      <div class="col-md-4" align="center" style="padding-top:10px;">
         <span id="date_time" class="date_time"></span>
      </div>
      <div class="col-md-6"></div>
      <div class="col-md-2">
         <input type="hidden" id="id_count" value="<?php echo count($result); ?>">
         <button  class="save_data" onclick="javascript:save_cme_audit()">SAVE</button>
      </div>
   </div>
</div>
<script>
$('.audit').DataTable({
   order:[1, 'desc'],
   "pageLength": 50,
   "deferRender": true,
   "orderClasses": false,
   searching: true,
   paging: true,
   lengthMenu: [50, 100, 250, 500],
   columnDefs: [
      {
         targets: [5,6],
         render: function (data, type, full, meta){
            if(type === 'filter' || type === 'sort'){
               var api = new $.fn.dataTable.Api(meta.settings);
               var td = api.cell({row: meta.row, column: meta.col}).node();
               data = $('select, input', td).val();
            }
            return data;
         }
      }
   ],
}); 
</script>
<script type="text/javascript">

   window.onload = date_time('date_time');
   function date_time(id)
   {
   	date = new Date;
   	year = date.getFullYear();
   	month = date.getMonth();
   	months = new Array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
   	d = date.getDate();
   	day = date.getDay();
   	days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
   	h = date.getHours();
   	if(h<10)
   	{
   			h = "0"+h;
   	}
   	m = date.getMinutes();
   	if(m<10)
   	{
   			m = "0"+m;
   	}
   	s = date.getSeconds();
   	if(s<10)
   	{
   			s = "0"+s;
   	}
   	result = ''+days[day]+' '+months[month]+'/'+d+'/'+year+'   '+h+':'+m+':'+s;
   	document.getElementById(id).innerHTML = result;
   	setTimeout('date_time("'+id+'");','1000');
   	return true;
   }		
</script>