<?php
$get_q = $this->input->get('q');
$get_s_date= $this->input->get('s_date');
$get_e_date= $this->input->get('e_date');
?>
<script type="text/javascript" src="assets/plugins/ajax-pagination/pagination.min.js"></script>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title"><div class="caption"><?=$name?></div></div>
            <div class="portlet-body">
<div class="row" style="margin-bottom:10px">
    <div class="col-md-4">
        <div class="btn-group">
            <a href="<?=$_add?>" class="btn btn-primary m-r-5 m-b-5"><?=show_static_text($adminLangSession['lang_id'],233);?> <i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="col-md-8 text-right">
		<form action="" method="get" id="search-form" class="form-inline">
  <div class="form-group">
        <input type="text" name="q" placeholder="<?=show_static_text(1,3);?>" value="<?=$get_q;?>" class="form-control search-q" >
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
    </div>
</div>
    <div class="table-responsive">
        <table id="data-table" class="table table-striped table-hover">
            <thead>
            <tr>
                
                <th>ID</th>
                <th>Employers</th>
                <th>City</th>
                <th>Phone</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody id="result-data"><tr><td colspan="5">Loading..</td></tr></tbody>
        </table>
<div class="pull-left">Total: <span class="search-total">0</span></div>
<ul class="pagination pull-right" id="list-paginations"></ul>
        
    </div>
    
		    </div>
		</div>
    </div>
</div>



<!--<link href="assets/global/plugins/bootstrap-datepicker/css/datepicker.css"  rel='stylesheet' type='text/css' >
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script>
$(document).ready(function(){
	$('#i-e-date').datepicker({ dateFormat: 'mm-dd-yy', altField: '#input-date_alt', altFormat: 'yy-mm-dd' }).on('changeDate', function(e){
    $(this).datepicker('hide');});

	$('#i-s-date').datepicker({ dateFormat: 'mm-dd-yy', altField: '#input-date_alt', altFormat: 'yy-mm-dd' }).on('changeDate', function(e){
    $(this).datepicker('hide');});

});

var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

var checkin = $('#i-s-date').datepicker({
    beforeShowDay: function(date) {
       // return date.valueOf() < now.valueOf() ? 'disabled' : '';
    }
}).on('changeDate', function(ev) {
    if (ev.date.valueOf() > checkout.viewDate.valueOf()){
        var newDate = new Date(ev.date)
        newDate.setDate(newDate.getDate() + 1);
        checkout.setDate(newDate);		
    }
    else {
        checkout.setDate(ev.date + 1);
    }
    
    checkin.hide();
    $('#i-e-date')[0].focus();
}).data('datepicker');

var checkout = $('#i-e-date').datepicker({
    beforeShowDay: function(date) {
        return date.valueOf() <= checkin.viewDate.valueOf() ? 'disabled' : '';
    }
}).on('changeDate', function(ev) {
    checkout.hide();
}).data('datepicker');

</script>-->

<script>
function submit_search(){
	$('#result-data').html('<tr><td colspan="8">Loading..</td></tr>');
    var data = $('#search-form').serialize();
	$.ajax({
		type: 'GET',
		url : "<?php echo $_cancel.'/ajax_get_list'?>",
		data:data,
		dataType:'json',
		success: function(response){
			$('#result-data').html(response.html);
			$('.search-total').html(response.total);
			if(response.total>20){
				$('#list-paginations').pagination('destroy');
				$('#list-paginations').pagination({
					total: response.total,
					current: 1,
					length: 20,
					size: 2, 
					click: function(options,$target) {
						//$('#input-pagi').val(options.current);
						urls = response.url;
						set_d = 'page='+options.current;
						$.get(urls,set_d,
							function(result){          
								$('#result-data').html(result.html);
							},
							'json'
						);
	
					}
					
				});
			}
			
		}
	});
}
submit_search();
//get_data();
</script>
<script>
function export_data(){
    var data = $('#search-form').serialize();
	window.location = '<?=$_cancel.'/export?'?>'+data;
}

function confirm_box(){
    var answer = confirm ("<?=show_static_text(1,265);?>");
    if (!answer)
     return false;
}

function set_top(id){
    $.ajax({
       type: "GET",
       url: "<?=$_cancel?>/set_top", /* The country id will be sent to this file */
       data: {id:id},
       beforeSend: function () {
        },
       success: function(msg){
       }
	});
}
</script>