<?php $this->load->view('templates/includes/head'); ?>  
<style>
body{
	background:#FFF;
}
</style>
<body >
<div class="super_container search-page" id="super_container">
	<div class="container">
    	<div class="row">
<div class="col-md-12">
<form action="caas" class="search-form" id="advance-search-form" style="display:none">
    <input type="hidden" name="name" value="<?=$this->input->get('name');?>"   />
    <input type="hidden" name="address" value="<?=$this->input->get('address');?>"   />
    <input type="hidden" name="city" value="<?=$this->input->get('city');?>" />
    <input type="hidden" name="state" value="<?=$this->input->get('state');?>"  />
    <input type="hidden" name="zip" value="<?=$this->input->get('zip');?>" />
    <input type="hidden" name="phone" value="<?=$this->input->get('phone');?>" />
    <input type="hidden" name="email" value="<?=$this->input->get('email');?>" />
</form>
<table class="table table-bordered" >
    <thead>
        <tr><th>Employer</th>
		<th style="width:128px">City</th>
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
    var loadUrl = '<?='employers/ajax'?>';
    var data = jQuery('#advance-search-form').serialize();
    $.get(
        loadUrl,
        data,
        function(response){          
			$('#result-data').html(response.html);
			parent.AdjustIframeEemployers(document.getElementById("super_container").scrollHeight);
        },
        'json'
    );
}
submit_form();
</script>
</body>
</html>

