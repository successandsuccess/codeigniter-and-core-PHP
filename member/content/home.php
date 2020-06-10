<style>
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
	color:#000;
}

.certificates-page{
	border:7px solid #2b5678; 
	width:81%;
	padding:0;
}
.certificates-page .header-imge{
	margin-top:30px;
	margin-left:30%;
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
	margin-left:15px;
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
	width:100px;
	margin:auto;
	text-align:center;
	height:7px;
	margin-top:10px;
}
.f-16{
	font-size:16px !important;
}
.light-hash{
    color: #CCC;	
}

.certificates-page .logo-mark,.certificates-page .stamp{

	position: absolute;
	z-index: 0;

}

.certificates-page .logo-mark{

	top: 27%;
	
	z-index: 0;

    width: 43%;

    left: 28.4%;
	
	opacity: 0.2;

}

.certificates-page  .stamp{

	width: 120px;

    left: 12%;

    bottom: 70px;

    transform: rotate(-30deg);
    
    opacity: 0.7;

}

/* .html2canvas-container { width: 0px !important; height: 0px !important; } */
</style>
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
        font-family: 'playfair-regular';
		background:#FFF;
        margin: 30mm 15mm 10mm 15mm; 
        
    }
	
	body * {
		
		visibility:hidden;
		
    }
  
  #printSection, #printSection * {
    visibility:visible;
  }
  
  #printSection {
    position:absolute;
	width: 800px;
    left:120;
    top:200;
  }
	
</style>
					  
					<div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="home-main block-border ncca-right-padding">
								<p class="midium-title title-bottom-border text-uppercase">CERTIFICATE
									<button class="print" onclick="javascript:cert_print(document.getElementById('certmodal_body'));"><img src="./assets/images/white version.png"> Print</button>
									<button class="share" onclick="share_link()"><img src="./assets/images/share white.png"> Share</button>
									<button class="email" onclick="email_link()" ><img src="./assets/images/mail white.png"> Download</button> 
								</p>
								<div id="capture" class="home-main-container <?php if ( ( $userObject->status["certificate"]=="" ) || ( $userObject->status["certificate"]=="COMING SOON!" )) echo "watermarked"; ?>" data-watermark="COMING SOON!">
									<div class="home-inner-container" >
										<p class="center">
											<img class="logo" src="./assets/images/logo2.png">
										</p>
										<h2 class="center">National Commission for CERTIFICATION of Anesthesiologist Assistants</h2>
										<p class="center">Be It Known That</p>
										<h3 class="center title-1"><?php echo $userObject->data["login"]["full_name"]; ?></h3>
											<?php 
											if ( $userObject->status["certificate"] > 0 ) { 
																				?>
										<p class="center">Successfully Completed Certifying Examination for Anesthesiologist Assistants in</p>
										<h3 class="center title-2"><?php echo $userObject->status["certification_year"]; ?></h3>
										<p class="center">Has met all requirements for maintaining continued certification and hereby is designated</p>
										<h3 class="center title-3">Certified Anesthesiologist Assistants Certificate #<?php echo $userObject->status["certificate"]; ?></h3>
										<?PHP
											} else {
										?>
										<center><h2>CERTIFICATE<br><?php echo $userObject->status["certificate"]; ?></h2></center>
										<p>&nbsp;</p>
										<h3>&nbsp;</h3>
										<?PHP
											}
										?>
										<div class="row">
											<div class="col-sm-7 sm-center">
												<?php 
												if ( $userObject->status["certificate"] > 0 ) 
												{ 
													print "<h4>Official Certification Date: ".date('F d, Y', strtotime($userObject->status["certification_date"]))."</h4>\n";
													if($userObject->vitals["cme_due"] == "0000-00-00" && $userObject->vitals["cdq_due"] == "0000-00-00")
													{
															print "<h4>Certified Through N/A</h4>\n";
													}else
													{
														if(empty($userObject->status["certification_end"]) == true || $userObject->status["certification_end"] == "01/01/1970"){
															print "<h4>Certified Through N/A</h4>\n";
														}else{
															print "<h4>Certified Through ".date('F d, Y', strtotime($userObject->status["certification_end"]))."</h4>\n";
														}
													}
												} 
												else 
												{
													print "<h4>&nbsp;</h4><h4>&nbsp;</h4>\n";
												}
												?>
											</div>
											<div class="col-sm-5 text-right sm-center">
												<img src="./assets/images/signature.png" style="width:200px;">
												<span class="sign">signature</span>
											</div>
										</div>
									</div> 
									<img class="logo-mark" src="./assets/images/logo-mark.svg">
									<img class="stamp" src="./assets/images/stamp.png">                             
								</div>
							</div>


                        </div>        

                    </div>
					  
<div id="certication_print">
	<div class="modal fade" id="certContentModal"  role="dialog">

		<div class="modal-dialog modal-lg" role="document">

			<div class="modal-content" style="min-height: auto;">
				<div class="modal-body" id="certmodal_body" align="center">
				
					<div class="certificates-page" id="certificates-page">
						<div class="header-imge"><img src="./assets/images/logo2.png" ></div>
						<div class="text-wp-1"><h2>National Commission for<br>CERTIFICATION of<br>Anesthesiologist Assistants</h2></div>
						<div class="text-wp-2"><p class="text-middle f-16">Be It Known That</p><h1><?php echo $userObject->data["generalinfo"]["f_name"]." ".$userObject->data["generalinfo"]["l_name"]; ?></h1></div>
						<div class="text-wp-3">
							<p class="text-middle">Successfully Completed Certifying Examination for Anesthesiologist Assistants in</p>
							<h3><?php echo $userObject->status["certification_year"]; ?></h3>
						</div>

						<div class="text-wp-4">
							<p class="text-middle">Has met all requirements for maintaining continued certification and hereby is designated</p>
							<h2>Certified Anesthesiologist Assistant</h2>
							<h2 style="margin-top:0">Certificate <span class="light-hash">#</span> <?php echo $userObject->status["certificate"]; ?></h2>
						</div>
						<img class="logo-mark" src="./assets/images/logo-mark.svg">
						
						<img class="stamp" src="./assets/images/stamp.png">                             

						<div class="row certificates-footer">
								<div class="col-xs-7 text-left">
									<div style=""><p class="text-small" >Official Certification Date: <?=$userObject->status["certification_date"]?></p></div>
									<div><p class="text-small">Certified Through <?=$userObject->status["certification_end"]?></p></div>
								</div>
								<div class="col-xs-4" style="margin-left: 200px;">
									<img src="assets/images/signature.png" style="width:100px;">
									<div class="signature-link">&nbsp;</div>
									<p class="signature-text">Signature</p>
								</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

			<div class="modal-body" id="certmodal_bodyy" align="center" style="display:none; margin-top: 200px;">
				
					<div class="certificates-page" id="certificates-page" style="width: 100%">
						<div class="header-imge"><img src="./assets/images/logo2.png" ></div>
						<div class="text-wp-1"><h2>National Commission for<br>CERTIFICATION of<br>Anesthesiologist Assistants</h2></div>
						<div class="text-wp-2"><p class="text-middle f-16">Be It Known That</p><h1><?php echo $userObject->data["generalinfo"]["f_name"]." ".$userObject->data["generalinfo"]["l_name"]; ?></h1></div>
						<div class="text-wp-3">
							<p class="text-middle">Successfully Completed Certifying Examination for Anesthesiologist Assistants in</p>
							<h3><?php echo $userObject->status["certification_year"]; ?></h3>
						</div>

						<div class="text-wp-4">
							<p class="text-middle">Has met all requirements for maintaining continued certification and hereby is designated</p>
							<h2>Certified Anesthesiologist Assistant</h2>
							<h2 style="margin-top:0">Certificate <span class="light-hash">#</span> <?php echo $userObject->status["certificate"]; ?></h2>
						</div>
						<img class="logo-mark" src="./assets/images/logo-mark.svg">
						
						<img class="stamp" src="./assets/images/stamp.png">                             

						<div class="row certificates-footer">
								<div class="col-xs-7 text-left">
									<div style=""><p class="text-small" >Official Certification Date: <?=$userObject->status["certification_date"]?></p></div>
									<div><p class="text-small">Certified Through <?=$userObject->status["certification_end"]?></p></div>
								</div>
								<div class="col-xs-4" style="margin-left: 200px;">
									<img src="assets/images/signature.png" style="width:100px;">
									<div class="signature-link">&nbsp;</div>
									<p class="signature-text">Signature</p>
								</div>

						</div>
					</div>
			</div>


<div id="content" hidden>
</div>


<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script>

function cert_print(elem) {
	

	// $(".close").hide();
	
	$('#certContentModal').modal('show');
	
    var domClone = elem.cloneNode(true);
    
    var $printSection = document.getElementById("printSection");
    
    if (!$printSection) {
		
        var $printSection = document.createElement("div");
		
        $printSection.id = "printSection";
		
        document.body.appendChild($printSection);
		
    }
    
    $printSection.innerHTML = "";
	
    $printSection.appendChild(domClone);
	
    window.print();
	
	window.history.replaceState({}, '', '?item=homepage');
	
	window.location.reload(true);
	
}

function share_link(){
	
	location.href = "https://www.facebook.com/";
	
}


function email_link(){

	document.getElementById('certmodal_bodyy').style.display = 'block';
	window.scrollTo(0,0); 

	html2canvas(document.querySelector("#certmodal_bodyy"),{ scale: 5}).then(canvas => {
		document.getElementById('content').appendChild(canvas);
	});


	setTimeout(function(){
		document.getElementById('certmodal_bodyy').style.display = 'none';
	},
	100);
	
	
	setTimeout(function()
		{
			var canvas = document.querySelector('canvas');
			var imgData = canvas.toDataURL("image/jpeg", 1.0);
			var pdf = new jsPDF();

			pdf.addImage(imgData, 'JPEG', 3, 20, 200, 230);
			pdf.save("download.pdf");
		}, 
	1000);
	
	
}


</script>