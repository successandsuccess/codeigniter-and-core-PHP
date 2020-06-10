<style>
.logo_container{
	margin-top:10px;
	display:inline-block;
}
.header-national-text{
	display:inline-block;
	margin-left: 145.86px;
}
.header-sign-text{
	display:inline-block;
	margin-left: 247.75px;
}

#comming_modal .modal-dialog .modal-content {
    -webkit-border-radius:8px;
    -moz-border-radius:8px;
    -o-border-radius:8px;
    -ms-border-radius:8px;
    border-radius:8px;
    -webkit-box-shadow:0 0 10px #000;
    -moz-box-shadow:0 0 10px #000;
    -o-box-shadow:0 0 10px #000;
    -ms-box-shadow:0 0 10px #000;
    box-shadow:0 0 10px #000;   

}
</style>
<header class="header">
		<!-- Header Content -->
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo_container">
								<a href="/">
									<div class="logo_text"><img src="<?='assets/uploads/sites/'.$settings['logo']?>"  /></div>
								</a>
							</div>
							<nav class="main_nav_contaner header-national-text "><!--ml-auto-->
								<div class="h-text">National Commission for Certification of Anesthesiologist Assistants</div>
							</nav>
							<nav class="main_nav_contaner header-sign-text"><!--ml-auto-->
								<ul class="main_nav">
									<li><a href="../logincaamember.php" class="link-a">Sign In</a></li>
									<!--<li><a style="cursor: pointer;" class="link-a" onclick="comming_open()">Sign In</a></li>-->
								</ul>
							</nav>

						</div>
					</div>
				</div>
			</div>
		</div>

					
	</header>
	
	
<div id="comming_modal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:400px;">

		<!-- Modal content-->
		<div class="modal-content">
			  <div class="modal-header">
			  <button type="button" class="close" onclick="location.href='http://www.nccaatest.org'" data-dismiss="modal">&times;</button>
			  </div>
			  <div class="modal-body" style="height:80px;">
					<div class="row">
						<div class="col-md-12" align="center" style="font-size: 30px;">
						    Coming Soon!
						</div>  
					</div>
			  </div>	
		</div>
	</div>
</div>														



<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<div class="search">
			<form action="#" class="header_search_form menu_mm">
				<input type="search" class="search_input menu_mm" placeholder="Search" required="required">
				<button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
					<i class="fa fa-search menu_mm" aria-hidden="true"></i>
				</button>
			</form>
		</div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li class="menu_mm"><a href="">Home</a></li>
				<li class="menu_mm"><a href="#">About</a></li>
				<li class="menu_mm"><a href="#">Page</a></li>
				<li class="menu_mm"><a href="">Contact</a></li>
			</ul>
		</nav>
	</div>

<script>

<?php
if(empty($_GET['member_id']) == false && ($_GET['member_id'] < 2000 || ($_GET['member_id'] > 2000 && $_GET['member_id'] < 3202))){
    
 echo"comming_open();";
 
}
?>
function comming_open(){
    
    $("#comming_modal").modal('show');
    
}

</script>
    