<?php $this->load->view('templates/includes/head'); ?>  
<link rel="stylesheet" type="text/css" href="assets/frontends/styles/certificate_page.css">
<style type="text/css" media="print">
    @page 
    {
        size:  auto;   
        margin: 0mm;  
    }
    
    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  
    }

    body
    {
        
        margin: 30mm 15mm 10mm 15mm; 
        
    }
</style>

<style>
body{
	font-family: 'playfair-regular';
	background:#FFF;
}
.text-normal{
	font-family: 'playfair-regular';
	font-weight:400;
	font-size:15px;
	font-weight:normal;
	line-height:18px;
}
.certificates-page h1,
.certificates-page h2,
.certificates-page h3,
.certificates-page h4,
.certificates-page h5
{
	font-family: 'playfair-regular';
	font-weight:400;
	margin:0;
}
.certificates-page p
{
	font-family: 'playfair-regular';
	font-size:16px;
	margin:0;
	color:#333333;
}

.certificates-page{
	border:7px solid #2b5678; 
	margin:auto;
	width:81%;
	padding:0;
}
.certificates-page .header-imge{
	margin-top:30px;
	text-align:center;
}
.certificates-page .header-imge img{
	width:215px;
	height:auto;
}
.certificates-page .text-middle{
	font-size:16px;
	line-height:20px;
}
.certificates-page .text-small{
	font-size:14px;
}
.certificates-page .text-wp-1{
	text-align:center;
    width: 73%;
    margin: auto;
	margin-top:30px;
}
.certificates-page .text-wp-1 h2{
	color:#000;
	font-size:28px;
	line-height:33px;
}
.certificates-page .text-wp-2{
	text-align:center;
    width: 73%;
    margin: auto;
	margin-top:40px;
}
.certificates-page .text-wp-2 h1{
	color:#000;
	font-family:'playfair-bold';
	font-size:32px;
	line-height:33px;
	font-weight:600;
}
.certificates-page .text-wp-3{
	text-align:center;
    width: 71%;
    margin: auto;
	margin-top:30px;
}
.certificates-page .text-wp-3 h3{
	margin-top:10px;
	color:#000;
	font-family:'playfair-bold';
	font-size:32px;
	line-height:33px;
	font-weight:600;
}

.certificates-page .text-wp-4{
	text-align:center;
    width: 94%;
    margin: auto;
	margin-top:25px;
}
.certificates-page .text-wp-4 h2{
	margin-top:10px;
	color:#000;
	font-size:24px;
	font-weight: 600;
    line-height: 30px;
}
.certificates-footer{
    width: 100%;
    margin: auto;
	margin-top:60px;
	margin-bottom:20px;
}
.certificates-footer p{
	line-height:26px;
}
.signature-text{
	font-size:12px !important;
}
.signature-link{
	border-top:2px solid #CCC;
	width:60%;
	margin:auto;
	text-align:center;
	height:7px;
	margin-top:10px;
}
.a-link{
	color:#03F;
	text-decoration:none;
	border:none;
}
.a-link:hover{
	background:none;
	color:#03F;
	text-decoration:none;
}
.top-btn{
	width:86%;
	margin:auto;
}
.f-16{
	font-size:16px !important;
}
.light-hash{
    color: #CCC;	
}

.circe-text p{
	font-family:'circe';
	color:#000;
}

.logo-mark {

   opacity: 0.5;

}

.certificates-page .logo-mark,.certificates-page .stamp{

	position: absolute;
	z-index: -1;

}

.certificates-page .logo-mark{

	top: 157px;

    width: 62%;

    left: 19%;

}

.certificates-page  .stamp{

	width: 120px;

    left: 0px;

    bottom: 25px;

    transform: rotate(-30deg);
    
    opacity: 0.7;

}


</style>
<style type="text/css" media="print">
.PRINT_VIEW{
	display: none;
}

</style>
<body >
<div class="container " id="super_container" style="padding:0 20px">
<div class="row mb">


	<div class="col-md-12 PRINT_VIEW top-btn" style="margin-bottom:10px;text-align:right;">
    <a class="btn btn-link" href="mailto:<?=$user_data->email?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> Email</a>
    <a href="http://www.facebook.com" class="btn btn-link"><i class="fa fa-share" aria-hidden="true"></i> Share</a>
    <button class="btn btn-link"  onClick="window.print();"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
	</div>
	<div class="certificates-page" id="certificates-page">
		<div class="border">
			<div class="header-imge"><img src="assets/frontends/images/logo.png" ></div>
			<div class="text-wp-1"><h2>National Commission for<br>CERTIFICATION of<br>Anesthesiologist Assistants</h2></div>
			<div class="text-wp-2"><p class="text-middle f-16">Be It Known That</p><h1><?=$user_data->full_name?></h1></div>
			<div class="text-wp-3">
            	<p class="text-middle">Successfully Completed Certifying Examination for Anesthesiologist Assistants in</p>
                <h3><?=$caa_data->first_year?></h3>
            </div>

			<div class="text-wp-4">
            	<p class="text-middle">Has met all requirements for maintaining continued certification and hereby is designated</p>
                <h2>Certified Anesthesiologist Assistant</h2>
                <h2 style="margin-top:0">Certificate <span class="light-hash">#</span> <?=$caa_data->id_certificate?></h2>
            </div>
         <img class="logo-mark" src="./assets/images/logo-mark.png">
        
        <img class="stamp" src="./assets/images/stamp.png">                             

<div class="row certificates-footer">
        <div class="col-xs-8 text-left">
            <div style=""><p class="text-small" >Official Certification Date: <?=date('F d, Y', strtotime($grad_date->actual_graduation_date))?></p></div>
            <div><p class="text-small">Certified Through <?=date('F d, Y', strtotime($caa_data->cme_due))?></p></div>
        </div>
        <div class="col-xs-4 text-center ">
            <img src="assets/frontends/images/signature.png" style="width:100px;">
            <div class="signature-link">&nbsp;</div>
            <p class="signature-text">Signature</p>
        </div>
        

</div>

	</div>
	</div>
    <div style="clear:both"></div>
            
<div class="col-md-12 PRINT_VIEW circe-text" style="margin-top:30px">
<p class="text-normal"><?=$user_data->full_name?> passed the Certifying Examination for Anesthesiologist Assistants on <?=date('F d, Y', strtotime($grad_date->actual_graduation_date))?>, was awarded Certificate Number <?=$caa_data->id_certificate?>, and has met NCCAA's requirements to maintain current certification. The certification, including the right to use the designation Certified Anesthesiologist Assistant (CAA), is valid through <?=date('F d, Y', strtotime($caa_data->cme_due))?>.<p>

<p class="">You may make a printout of this information for your records.</p>
<p class=""><a href="javascript:;" onClick="parent.tab_click('certificates');" class="a-link">Search Again</a></p>
</div>


        </div>
</div>
</body>
		
<script type="text/javascript">
$(document).ready(function() {
    
    //document.getElementById("certificates-iframe").style.height = 1000 + "px";
	$(window).on('load', function(){
		parent.AdjustIframeCertificates(document.getElementById("super_container").scrollHeight);
	}); 
});
</script>

</html>

