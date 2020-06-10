<style>

.footer{

	background: #F2F2F2;

	margin-top:70px;

}

.footer .container{

	width:980px;

	padding:0;

}

.footer .footer_col{

	padding:0;

}

.footer .footer_logo_text img{

    width: 300px;

    height: 111.2px;

}

.footer_title, .footer_about_text p{

	color:rgba(0, 0, 0, 0.4);

	opacity:0.4;

}

.footer_title{

	line-height:25px;

	margin-top:20px;

}

.footer_links{

	margin-top:10px;

	padding-left:0;

}

.footer_links li a{

	color:rgba(0, 0, 0, 0.8);

	font-size:18px;

	line-height:30px;

	font-weight:bold;

}

.footer-menu{

	padding-left:108px;

}

.footer_contact_info{

	margin-top:10px;

}

.footer_contact_address{

	font-size:18px;

	font-family:'circe-bold';

	line-height:30px;

	color:rgba(0, 0, 0, 0.8);

	opacity:0.4;

}

.footer_links_container ul li a{

	color:rgba(0, 0, 0, 0.8);

	opacity:0.4;

	

}

.footer_contact_info i{

	margin-right:16px;

	font-size:17px;

}

.footer_contact_info .contact-text{

	font-size:18px;

	font-family:'circe-bold';

	line-height:30px;

}



.footer-bottom{

	background:rgba(0, 0, 0, 0.1);

}

.footer-bottom .cr_text{

	font-size:18px;

	line-height:30px;

	color:rgba(0, 0, 0, 0.8);

	font-family:'circe-bold';

}

.copyright{

	border-top:none;

}



#contact-email::-moz-selection { /* Code for Firefox */

  color: #ffffff;

  background: #007CC4;

}



#contact-email::selection {

  color: #ffffff;

  background: #007CC4;

}

</style>

<footer class="footer">

		<div class="container">

			<div class="rows footer_row">

				<div class="col">

					<div class="footer_content">

						<div class="rows">



							<div class="col-lg-3 footer_col">

					

								<!-- Footer About -->

								<div class="footer_section footer_about">

									<div class="footer_logo_container">

										<a href="">

											<div class="footer_logo_text"><img src="<?='assets/frontends/images/logo.png'?>"  /></div>

										</a>

									</div>

								</div>

								

							</div>



							<div class="col-lg-3 footer_col">

					

								<!-- Footer Contact -->

								<div class="footer_section footer_contact footer-menu">

									<div class="footer_title">Helpful Links</div>

									<div class="footer_links">

										<ul>

											<li><a style="cursor:pointer" onclick="nccaa_board()" >NCCAA Board</a></li>

											<li><a style="cursor:pointer" onclick="aaaa_page()" >AAAA</a></li>

											<!--<li><a style="cursor:not-allowed" >NCCAA Board</a></li>-->

											<!--<li><a style="cursor:not-allowed" >AAAA</a></li>-->

										</ul>

									</div>

								</div>

								

							</div>

                            

                            <div class="col-lg-3 footer_col">

					

								<!-- Footer Contact -->

								<div class="footer_section footer_contact">

									<div class="footer_title">Address</div>

									<div class="footer_contact_info footer_contact_address">

										<?=$settings['address']?>

									</div>

								</div>

								

							</div>

                            <div class="col-lg-3 footer_col">

					

								<!-- Footer Contact -->

								<div class="footer_section footer_contact">

									<div class="footer_title">Contact Us</div>

									<div class="footer_contact_info">

										<ul>

											<li><i class="fa fa-phone"></i> <span class="contact-text"><?=$settings['phone']?></span></li>

											<li><i class="fa fa-envelope-o" style="color: #000000"></i> <span class="contact-text" id="contact-email" style="user-select: text !important; color: #000000"><?=$settings['site_email']?></span></li>

										</ul>

									</div>

								</div>

								

							</div>

                            <div style="clear:both"></div>

						</div>

					</div>

				</div>

			</div>

		</div>            



<div class="footer-bottom">

    <div class="container">



        <div class="row copyright_row">

            <div class="col">

                <div class="copyright  flex-lg-row flex-column align-items-center justify-content-start ">

                    <div class="cr_text text-center">All Rights Reserved  &copy; 2020 NCCAA </div>

                </div>

            </div>

        </div>

    </div>

</div>        

	</footer>

	

	<style>

.img-circle{

	width:65px;

	height:65px;

	border-radius:50%;

}



#NCCAA-page-modal .modal-header{

    border-bottom: 1px solid #CCC;

}



#NCCAA-page-modal .modal-header .close {

    font-size: 27px;

}





#NCCAA-page-modal .modal-dialog {

    width: 680px;

}



#NCCAA-page-modal .modal-content{

	padding:20px;

}

#NCCAA-page-modal .modal-content .modal-header{

	padding:10px 0px;

}

#NCCAA-page-modal .modal-content .modal-title{

	font-family:'circe-bold';

	font-weight:600;

	font-size:15px;

}

.board-member-list{

	border-bottom:#CCC 1px solid;

	padding:10px 0;

}



#NCCAA-page-modal .modal-body  .u-title{

	font-family:'circe-bold';

	font-weight:700;

	font-size:14px;

	color:rgba(101, 101, 101);

	margin-bottom:20px;

}



#NCCAA-page-modal .modal-body  .u-desc,

#NCCAA-page-modal .modal-body  .u-desc p{

	font-family:'circe';

	font-weight:400;

	font-size:14px;

	color:rgba(33, 37, 41);

	line-height:17px;

}



</style>

<div class="modal fade page-modal in" id="NCCAA-page-modal" role="dialog" style="display: none;">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                <h4 class="modal-title" style="">NCCAA BOARD</h4>

            </div>

            <div class="modal-body ">

<div class=" board-member-list">

    <div class="row ">

	    <div class="col-md-2 text-center">

    	    <img src="./Board_files/Headshot 01.jpg" class="img-circle">

	    </div>

        <div class="col-md-10">

            <h4 class="u-title">NANCY C. SOUTHERN<br>CHAIR &amp; CHIEF EXECUTIVE OFFICER</h4>

            <div class="u-desc"><p>Nancy Southern is Chair &amp; Chief Executive Officer of ATCO Ltd., as well as Chair &amp; Chief Executive Officer of Canadian Utilities Limited, an ATCO company. Reporting to the Boards of Directors, she has full responsibility for executing the strategic direction and ongoing operations for both companies.

<br><br>

After joining the ATCO Board of Directors in 1989, Ms. Southern served as Co-Chair of ATCO for 16 years prior to being elected Chair in December 2012. Ms. Southern was named President &amp; Chief Executive Officer of ATCO Ltd. in 2003. She serves on the boards of all ATCO subsidiary companies.



</p></div>    

        </div>

    </div><!--//row//-->

</div>

<div class=" board-member-list">

    <div class="row ">

	    <div class="col-md-2 text-center">

    	    <img src="./Board_files/Headshot 02.JPG" class="img-circle">

	    </div>

        <div class="col-md-10">

            <h4 class="u-title">ADAM BEATTIE<br>SENIOR VICE PRESIDENT &amp; GENERAL MANAGER, STRUCTURES</h4>

            <div class="u-desc"><p>Adam Beattie is the Senior Vice President &amp; General Manager of ATCO’s Structures division. Reporting to the Chair &amp; Chief Executive Officer, Mr. Beattie is responsible for leading Workforce Housing, Space Rentals, and Permanent Modular Construction business lines worldwide, as well as the manufacturing of modular products.<br><br>



ATCO’s Structures division sells and leases Workforce Housing products in Canada, the U.S., Australia, Chile and other select international markets. The Space Rentals and sales business leases and sells relocatable modular offices, classrooms and other structures in Canada, Australia, the U.S. and Chile. . The Structures division also designs and manufactures permanent modular building solutions that include dormitories, schools, daycares, gymnasiums, hockey arenas, gas stations, multi-purpose community centres and offices.

</p></div>    

        </div>

    </div><!--//row//-->

</div>

<div class=" board-member-list">

    <div class="row ">

	    <div class="col-md-2 text-center">

    	    <img src="./Board_files/Headshot 03.jpg" class="img-circle">

	    </div>

        <div class="col-md-10">

            <h4 class="u-title">M. GEORGE CONSTANTINESCU<br>SENIOR VICE PRESIDENT &amp; CHIEF TRANSFORMATION OFFICER</h4>

            <div class="u-desc"><p>George Constantinescu is Senior Vice President &amp; Chief Transformation Officer with ATCO Ltd., a global leader in integrated energy and infrastructure solutions. In this role, Mr. Constantinescu is responsible for leading transformation initiatives that enable innovation and growth across the enterprise, and advancing new commercial initiatives around the world.

<br><br>

Mr. Constantinescu first joined ATCO in 1986 and has held progressively senior positions in ATCO Gas, ATCO Electric, ATCO Power and ATCO’s Corporate Office. He played a pivotal role in establishing ATCO’s international electricity generation operations in Australia, as well as evaluating opportunities both in the United Kingdom and the United States. In 2002, he joined ATCO’s Corporate Office as Senior Manager, Corporate Development, where he was an instrumental member of the team that successfully led the strategic divestiture of ATCO’s retail energy operations. Mr. Constantinescu was appointed Senior Vice President &amp; Chief Transformation Officer in February 2018, after spending 14 years cultivating substantial entrepreneurial experience in a range of diverse industries throughout North America.

</p></div>    

        </div>

    </div><!--//row//-->

</div>

<div class=" board-member-list">

    <div class="row ">

	    <div class="col-md-2 text-center">

    	    <img src="./Board_files/Headshot 04.jpg" class="img-circle">

	    </div>

        <div class="col-md-10">

            <h4 class="u-title">ADAM BEATTIE<br>SENIOR VICE PRESIDENT &amp; GENERAL MANAGER, STRUCTURES</h4>

            <div class="u-desc"><p>Adam Beattie is the Senior Vice President &amp; General Manager of ATCO’s Structures division. Reporting to the Chair &amp; Chief Executive Officer, Mr. Beattie is responsible for leading Workforce Housing, Space Rentals, and Permanent Modular Construction business lines worldwide, as well as the manufacturing of modular products.<br><br>



ATCO’s Structures division sells and leases Workforce Housing products in Canada, the U.S., Australia, Chile and other select international markets. The Space Rentals and sales business leases and sells relocatable modular offices, classrooms and other structures in Canada, Australia, the U.S. and Chile. . The Structures division also designs and manufactures permanent modular building solutions that include dormitories, schools, daycares, gymnasiums, hockey arenas, gas stations, multi-purpose community centres and offices.

</p></div>    

        </div>

    </div><!--//row//-->

</div>

<div class=" board-member-list">

    <div class="row ">

	    <div class="col-md-2 text-center">

    	    <img src="./Board_files/Headshot 05.jpg" class="img-circle">

	    </div>

        <div class="col-md-10">

            <h4 class="u-title">ADAM BEATTIE<br>SENIOR VICE PRESIDENT &amp; GENERAL MANAGER, STRUCTURES</h4>

            <div class="u-desc"><p>Adam Beattie is the Senior Vice President &amp; General Manager of ATCO’s Structures division. Reporting to the Chair &amp; Chief Executive Officer, Mr. Beattie is responsible for leading Workforce Housing, Space Rentals, and Permanent Modular Construction business lines worldwide, as well as the manufacturing of modular products.<br><br>



ATCO’s Structures division sells and leases Workforce Housing products in Canada, the U.S., Australia, Chile and other select international markets. The Space Rentals and sales business leases and sells relocatable modular offices, classrooms and other structures in Canada, Australia, the U.S. and Chile. . The Structures division also designs and manufactures permanent modular building solutions that include dormitories, schools, daycares, gymnasiums, hockey arenas, gas stations, multi-purpose community centres and offices.

</p></div>    

        </div>

    </div><!--//row//-->

</div>

<div class=" board-member-list">

    <div class="row ">

	    <div class="col-md-2 text-center">

    	    <img src="./Board_files/Headshot 06.jpg" class="img-circle">

	    </div>

        <div class="col-md-10">

            <h4 class="u-title">ADAM BEATTIE<br>SENIOR VICE PRESIDENT &amp; GENERAL MANAGER, STRUCTURES</h4>

            <div class="u-desc"><p>Adam Beattie is the Senior Vice President &amp; General Manager of ATCO’s Structures division. Reporting to the Chair &amp; Chief Executive Officer, Mr. Beattie is responsible for leading Workforce Housing, Space Rentals, and Permanent Modular Construction business lines worldwide, as well as the manufacturing of modular products.<br><br>



ATCO’s Structures division sells and leases Workforce Housing products in Canada, the U.S., Australia, Chile and other select international markets. The Space Rentals and sales business leases and sells relocatable modular offices, classrooms and other structures in Canada, Australia, the U.S. and Chile. . The Structures division also designs and manufactures permanent modular building solutions that include dormitories, schools, daycares, gymnasiums, hockey arenas, gas stations, multi-purpose community centres and offices.

</p></div>    

        </div>

    </div><!--//row//-->

</div>

<div class=" board-member-list">

    <div class="row ">

	    <div class="col-md-2 text-center">

    	    <img src="./Board_files/Headshot 07.jpg" class="img-circle">

	    </div>

        <div class="col-md-10">

            <h4 class="u-title">ADAM BEATTIE<br>SENIOR VICE PRESIDENT &amp; GENERAL MANAGER, STRUCTURES</h4>

            <div class="u-desc"><p>Adam Beattie is the Senior Vice President &amp; General Manager of ATCO’s Structures division. Reporting to the Chair &amp; Chief Executive Officer, Mr. Beattie is responsible for leading Workforce Housing, Space Rentals, and Permanent Modular Construction business lines worldwide, as well as the manufacturing of modular products.<br><br>



ATCO’s Structures division sells and leases Workforce Housing products in Canada, the U.S., Australia, Chile and other select international markets. The Space Rentals and sales business leases and sells relocatable modular offices, classrooms and other structures in Canada, Australia, the U.S. and Chile. . The Structures division also designs and manufactures permanent modular building solutions that include dormitories, schools, daycares, gymnasiums, hockey arenas, gas stations, multi-purpose community centres and offices.

</p></div>    

        </div>

    </div><!--//row//-->

</div>

<div class=" board-member-list">

    <div class="row ">

	    <div class="col-md-2 text-center">

    	    <img src="./Board_files/Headshot 08.jpg" class="img-circle">

	    </div>

        <div class="col-md-10">

            <h4 class="u-title">ADAM BEATTIE<br>SENIOR VICE PRESIDENT &amp; GENERAL MANAGER, STRUCTURES</h4>

            <div class="u-desc"><p>Adam Beattie is the Senior Vice President &amp; General Manager of ATCO’s Structures division. Reporting to the Chair &amp; Chief Executive Officer, Mr. Beattie is responsible for leading Workforce Housing, Space Rentals, and Permanent Modular Construction business lines worldwide, as well as the manufacturing of modular products.<br><br>



ATCO’s Structures division sells and leases Workforce Housing products in Canada, the U.S., Australia, Chile and other select international markets. The Space Rentals and sales business leases and sells relocatable modular offices, classrooms and other structures in Canada, Australia, the U.S. and Chile. . The Structures division also designs and manufactures permanent modular building solutions that include dormitories, schools, daycares, gymnasiums, hockey arenas, gas stations, multi-purpose community centres and offices.

</p></div>    

        </div>

    </div><!--//row//-->

</div>

<div class=" board-member-list">

    <div class="row ">

	    <div class="col-md-2 text-center">

    	    <img src="./Board_files/Headshot 09.jpg" class="img-circle">

	    </div>

        <div class="col-md-10">

            <h4 class="u-title">ADAM BEATTIE<br>SENIOR VICE PRESIDENT &amp; GENERAL MANAGER, STRUCTURES</h4>

            <div class="u-desc"><p>Adam Beattie is the Senior Vice President &amp; General Manager of ATCO’s Structures division. Reporting to the Chair &amp; Chief Executive Officer, Mr. Beattie is responsible for leading Workforce Housing, Space Rentals, and Permanent Modular Construction business lines worldwide, as well as the manufacturing of modular products.<br><br>



ATCO’s Structures division sells and leases Workforce Housing products in Canada, the U.S., Australia, Chile and other select international markets. The Space Rentals and sales business leases and sells relocatable modular offices, classrooms and other structures in Canada, Australia, the U.S. and Chile. . The Structures division also designs and manufactures permanent modular building solutions that include dormitories, schools, daycares, gymnasiums, hockey arenas, gas stations, multi-purpose community centres and offices.

</p></div>    

        </div>

    </div><!--//row//-->

</div>

<div class=" board-member-list">

    <div class="row ">

	    <div class="col-md-2 text-center">

    	    <img src="./Board_files/Headshot 10.jpeg" class="img-circle">

	    </div>

        <div class="col-md-10">

            <h4 class="u-title">ADAM BEATTIE<br>SENIOR VICE PRESIDENT &amp; GENERAL MANAGER, STRUCTURES</h4>

            <div class="u-desc"><p>Adam Beattie is the Senior Vice President &amp; General Manager of ATCO’s Structures division. Reporting to the Chair &amp; Chief Executive Officer, Mr. Beattie is responsible for leading Workforce Housing, Space Rentals, and Permanent Modular Construction business lines worldwide, as well as the manufacturing of modular products.<br><br>



ATCO’s Structures division sells and leases Workforce Housing products in Canada, the U.S., Australia, Chile and other select international markets. The Space Rentals and sales business leases and sells relocatable modular offices, classrooms and other structures in Canada, Australia, the U.S. and Chile. . The Structures division also designs and manufactures permanent modular building solutions that include dormitories, schools, daycares, gymnasiums, hockey arenas, gas stations, multi-purpose community centres and offices.

</p></div>    

        </div>

    </div><!--//row//-->

</div>

<div class=" board-member-list">

    <div class="row ">

	    <div class="col-md-2 text-center">

    	    <img src="./Board_files/Headshot 11.jpeg" class="img-circle">

	    </div>

        <div class="col-md-10">

            <h4 class="u-title">ADAM BEATTIE<br>SENIOR VICE PRESIDENT &amp; GENERAL MANAGER, STRUCTURES</h4>

            <div class="u-desc"><p>Adam Beattie is the Senior Vice President &amp; General Manager of ATCO’s Structures division. Reporting to the Chair &amp; Chief Executive Officer, Mr. Beattie is responsible for leading Workforce Housing, Space Rentals, and Permanent Modular Construction business lines worldwide, as well as the manufacturing of modular products.<br><br>



ATCO’s Structures division sells and leases Workforce Housing products in Canada, the U.S., Australia, Chile and other select international markets. The Space Rentals and sales business leases and sells relocatable modular offices, classrooms and other structures in Canada, Australia, the U.S. and Chile. . The Structures division also designs and manufactures permanent modular building solutions that include dormitories, schools, daycares, gymnasiums, hockey arenas, gas stations, multi-purpose community centres and offices.

</p></div>    

        </div>

    </div><!--//row//-->

</div>

            </div>

        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->

</div>  



<style>

#AAAA-page-modal .modal-dialog {

    width: 680px;

}



#AAAA-page-modal .modal-header .close {

    font-size: 27px;

}



#AAAA-page-modal .modal-header{

    border-bottom: 1px solid #CCC;

}

#AAAA-page-modal .modal-content{

	padding:20px;

}

#AAAA-page-modal .modal-content .modal-header{

	padding:10px 0px;

}

#AAAA-page-modal .modal .modal-header .close{

	margin-top:0;

}

#AAAA-page-modal .modal-content .modal-title{

	font-family:'circe-bold';

	font-weight:600;

	font-size:15px;

}

.aaaa-h-title{

	font-family:'circe';

	font-size:16px;

	font-weight:700;

	margin-top:10px;

	margin-bottom:20px;

	color:rgba(101, 101, 101);

	text-align:center;

}

#AAAA-page-modal .modal-body{

	padding:20px 10px !important;

}

#AAAA-page-modal .modal-body p{

	margin-bottom:15px;

/*	color:#000;

	line-height:17px;*/

}

#AAAA-page-modal .modal-body .aaaa-text-1{

	font-family:'circe';

	font-size:14px;

	font-weight:700;

	color:rgba(101, 101, 101);

	line-height:17px;

	margin-bottom:10px;

}



#AAAA-page-modal .modal-body .aaaa-text-2,

#AAAA-page-modal .modal-body .aaaa-text-2 p{

	font-family:'circe';

	font-size:14px;

	font-weight:400;

	color:rgba(33, 37, 41);

	line-height:17px;

}

#AAAA-page-modal .modal-body .aaaa-text-2 p{

}



#AAAA-page-modal .modal-body ul{

    list-style-type: disc;

	padding-left:18px;

}

</style>



<div class="modal fade page-modal" id="AAAA-page-modal" role="dialog" style="display: none;">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                <h4 class="modal-title" style="">AAAA</h4>

            </div>

            <div class="modal-body">

<div class="text-center"><img src="./Board_files/aaaa-icon.png"></div>

<h3 class="aaaa-h-title" style="">American Academy of Anesthesiologist Assistants</h3>

<h4 class="aaaa-text-1">What is the AAAA®?<br>

Encouraging the skilled and compassionate practice of anesthesia with respect for human dignity and the rights of patients in their care.

</h4>

<div class="aaaa-text-2">

<p>The AAAA® is a non-profit association of graduates from CAHEA-AMA/CAAHEP accredited training programs specializing in the science and clinical practice of anesthesiology.

</p>

<p>The purpose of the Academy is to...

</p><ul>

<li>Establish and maintain the standards of the profession by fostering and encouraging continuing education and research to all graduate Anesthesiologist Assistants and enrolled students of accredited programs.</li>

<li>Represent the interests of the profession</li>

<li>Initiate and cultivate relationships with other organizations of health care providers.</li>

<li>Instill confidence in the public by adhering to established ethical norms and legal constraints</li>

</ul>

<p></p>

<br>

<h4 class="aaaa-text-1">MEMBERSHIP</h4>

<p>Dedicated to the ethical advancement of the Certified Anesthesiologist Assistant profession and to excellence in patient care through education, advocacy, and promotion of the Anesthesia CareTeam.</p>

<br>



<h4 class="aaaa-text-1">What is Advocacy?</h4>

<p>The American Academy of Anesthesiologist Assistants (AAAA®) actively advocates for patient safety and improved access to care through grassroots lobbying and a AAAA® legislative fund.  Member engagement and donations are key to the success of AAAA® advocacy efforts. Explore the ways that you can help.</p>



<p>The American Academy of Anesthesiologist Assistants (AAAA®) is the national organization dedicated to the ethical advancement of the Certified Anesthesiologist Assistant profession and to excellence in patient care through education, advocacy, and promotion of the Anesthesia Care Team. From AAAA® Mission Statement Adopted October 15, 2011</p>



<p>Values

</p><ul>

<li>Teamwork</li>

<li>Leadership</li>

<li>Communication</li>

<li>Professionalism</li>

</ul>

<p></p>

<br>



<h4 class="aaaa-text-1">Definition and Purpose</h4>

<p>The AAAA® is a non-profit association of graduates from CAHEA-AMA/CAAHEP accredited training programs specializing in the science and clinical practice of anesthesiology.</p>



<p>The purpose of the Academy is to...

</p><ul>

<li>Establish and maintain the standards of the profession by fostering and encouraging continuing education and research to all graduate Anesthesiologist Assistants and enrolled students of accredited programs.</li>

<li>Represent the interests of the profession</li>

<li>Initiate and cultivate relationships with other organizations of health care providers.</li>

<li>Instill confidence in the public by adhering to established ethical norms and legal constraints</li>

</ul>

<p></p>

<p>

Encouraging the skilled and compassionate practice of anesthesia with respect for human dignity and the rights of patients in their care

</p>

</div><!--aaaa-text-2-->

            </div>

        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->

</div>      

<script>

function nccaa_board(){

	

	$('#NCCAA-page-modal').modal('show');

	$('#AAAA-page-modal').modal('hide');

	

}



function aaaa_page(){

	

	$('#AAAA-page-modal').modal('show');

	$('#NCCAA-page-modal').modal('hide');

	

}



</script>	

