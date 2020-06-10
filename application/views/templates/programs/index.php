<?php $this->load->view('templates/includes/head'); ?>  
<style>
.home{
	padding-top:0;
	padding-bottom:0;
}
body{
	background:#FFF;
}
</style>
<body >
<div class="super_container search-page" id="super_container">
	<div class="container">
    	<div class="row">
<div class="col-md-12">
<form action="" class="search-form" id="advance-search-form" style="display:none">
<input type="hidden" name="name" value="<?=$this->input->get('name');?>" />
<input type="hidden" name="city" value="<?=$this->input->get('city');?>" />
<input type="hidden" name="state" value="<?=$this->input->get('state');?>" />
<input type="hidden" name="zip" value="<?=$this->input->get('zip');?>" />
<input type="hidden" name="alumni" value="<?=$this->input->get('alumni');?>" />
<input type="hidden" name="classes" value="<?=$this->input->get('classes');?>"  />
</form>
<table class="table table-bordered" >
    <thead>
        <tr><th>University Program</th>
		<th>Location</th>
		<th style="width:128px">More Info</th></tr>
    </thead>
<tbody id="result-data">
</tbody>    
</table>	
</div>

                </div>
        	</div>            
</div>
		
<script type="text/javascript">
function submit_form(){
    var loadUrl = '<?='programs/ajax'?>';
    var data = jQuery('#advance-search-form').serialize();
    $.get(
        loadUrl,
        data,
        function(response){          
			$('#result-data').html(response.html);
			parent.AdjustIframePrograms(document.getElementById("super_container").scrollHeight);
        },
        'json'
    );
}
submit_form();
</script>
		
	</div>

</body>
</html>

