<?php
include("../config.php");



 ?>
 <!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Global Tech Style</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto"/>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<style>
input[type="number"]::-webkit-outer-spin-button, input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
 
input[type="number"] {
    -moz-appearance: textfield;
}
.hide2{
display:none;	
}
</style>
</head>

<body>
<section class="form-container">
	
		<div class="row">
			<div class="col-md-12">
				<form id="email_form" name="email_form"  action="email_form.php" method="POST">	
					<strong><p>Email will be sent to the database Users For New Generated Passwords</p></strong>
					<div class="col-md-12 general-info form-section" id="general-info">
						<div class="col-md-12">
							<strong>Multiple Email Form</strong>
						</div>
						<div class="col-md-12 title">
						<?php
							if($_GET['msg'] == "success"){
								echo "<p style='color:green;'>Success Email Sent</p>";
							}else if($_GET['msg'] == "failed"){
								echo "<p style='color:red;'>Cannot Sent Email</p>";
							}else {
								
							}
							?>
							<div class="row">
								<div class="col-md-8">
										<select class="js-example-basic-single" name="emails[]" multiple="multiple" >
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-12 save-cancel">
							<div class="row">
								<div class="col-md-offset-8 col-md-2">
									<input type="submit" name="submit" value="Send Email" class="form-control btn btn-danger">

								</div>
								<div class="col-md-2">
                                    <input type="submit" name="sendtoall" value="Send To All" class="form-control btn btn-danger">
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
	 //$(".js-example-basic-single").select2({ width: '100%' }); 
	 $('.js-example-basic-single').select2({
	width: '100%',
	placeholder: 'Select Emails',
	ajax: {
    url: 'getEmails.php',
    dataType: 'json',
	delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
});
});
</script>
</body>
</html>