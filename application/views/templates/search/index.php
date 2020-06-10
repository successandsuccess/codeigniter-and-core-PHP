<?php $this->load->view('templates/includes/head'); ?>  
<style>
body{
	background:#FFF;
}

.home{
	padding-top:0px;
	padding-bottom:0px;
}
</style>
<body >
<div class="home search-page" id="super_container">
	<div class="container">
    	<div class="row">
<div class="col-md-12">
<form action="caas" class="search-form" id="advance-search-form" style="display:none">
<input type="hidden" name="f_name" value="<?=$this->input->get('f_name');?>"  class="form-control" />
<input type="hidden" name="l_name" value="<?=$this->input->get('l_name');?>"  class="form-control"  />
<input type="hidden" name="city" value="<?=$this->input->get('city');?>" class="form-control"/>
<input type="hidden" name="state" value="<?=$this->input->get('state');?>" class="form-control" />
<input type="hidden" name="zip" value="<?=$this->input->get('zip');?>" class="form-control"/>
<input type="hidden" name="employer" value="<?=$this->input->get('employer');?>" class="form-control"/>
</form>
<table class="table table-bordered" >
    <thead>
        <tr><th>Practitioner</th>
		<th>Certificate #</th>
		<th>Verify</th></tr>
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
    var loadUrl = '<?='search/ajax'?>';
    var data = jQuery('#advance-search-form').serialize();
    $.get(
        loadUrl,
        data,
        function(response){          
			$('#result-data').html(response.html);
			parent.AdjustIframeCertificates(document.getElementById("super_container").scrollHeight);
        },
        'json'
    );
}
submit_form();
</script>
</body>
</html>

