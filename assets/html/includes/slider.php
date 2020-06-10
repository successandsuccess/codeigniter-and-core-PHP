<style>
.home {
    width: 100%;
    padding-top: 71px;
}
.home .left-content,
.home .right-content{
	float:left;
	
}
.home .container{
	width:980px;
	padding:0;
}
.home .container> .row{
	padding:0;
}
.home .left-content{
	width:568px;
	margin-right:26px;
}
.home .right-content{
	width:386px;
}
.home .right-content{
	padding-right:0;
	padding-left:0px;
}

.home .right-content .card{
	border:1px solid rgba(0, 0, 0, 0.1);
	border-raduis:3px;
}
.pos-relative {
    position: relative;
}

.hov-img-zoom {
	display: block;
	overflow: hidden;
}
.over-bg:before{
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.2);
}

.hov-img-zoom img{
	width: 100%;
	height:398px;
}

.ab-t-l {
    position: absolute;
    left: 0px;
    top: 0px;
	width:100%;
	height:100%;
}

.home h3.l-text1 {
    position: relative;
	font-size: 2.4em;
	font-weight: 500;
	color: #FFF;
	margin: 0 0 0.5em;
	font-family: Arial,sans-serif;
	padding: 0 5px;
}
.search-form{
	padding: 0px 18px 0 30px;
}
.h-search-form{
/*	padding:15px 10px;*/
padding:0;
}

.h-search-form .heder-box{
    padding-top: 21px;
    padding-left: 30px;
    padding-right: 18px;
	margin-bottom:20px;
}
.h-search-form .s-title {
	margin:0;
	font-family:'circe-regular';
    font-size: 18px;
    margin-bottom: 0px;
    color: #424242;
	font-weight:bold;
}
/*.h-search-form .s-title{
	font-size:20px;
	margin-bottom:5px;
	color:#424242;
}*/
.h-search-form .s-text{
	font-family:'circe-regular';
	font-size:18px;
	margin:0px;
}
.h-search-form .form-group{
	margin-bottom:0px;
}
.h-search-form .form-group:last-child{
	margin-bottom:0;
}
.h-search-form .field-box{
	padding:0 3px;
}
.h-search-form .col-form-label{
	padding-top:calc(.375rem + 1px);
	float:left;
	color:rgba(0, 0, 0, 0.6);
	text-align:right;
/*	padding-top:0;*/
	font-size:14px;
	font-weight:bold;
	line-height:17px;
	padding-left:0;
	padding-right:8px;
	width: 89px;
}
.h-search-form .col-form-label.pt{
	padding-top:13px;
}

.h-search-form .field-boxs{
	float:left;
}
.h-search-form .form-control{
	height:43.25px;
	font-family:'circe-regular';
	font-size:13px;
	border-radius:3px;
}
.h-search-form .col-md-9{
	max-width:250px
}

.h-search-form .or-text{
	font-family:'circe-bold';
	padding-left:5px;
	font-weight:normal;
	font-size:14px;
	line-height:20px;
	color:rgba(0, 0, 0, 0.6);
}
.field-box-half{
	width:118px;
	float:left;
}
.f-m-l{
	margin-right:14px;
}
.search-bn-content{
	margin-top:10px;
	padding-left:25px;
	margin-bottom:18px;
	padding-right:28px;
}
.search-btn{
	background-color: #24608B;
	border-color: #24608B;
/*	height:43.25px;*/
	border-radius:3px;
	font-size:14px;
	padding:10px;
	font-family:'circe-bold';
}
</style>
<div class="home">
	<div class="container">
    	<div class="rows">
	    	<div class="left-content">
            	<div class="hov-img-zoom pos-relative ">
                    <img src="assets/images/slider.jpg" alt="IMG">
    
<!--                    <div class="ab-t-l sizefull flex-col-c-m p-l-15 p-r-15 over-bg">
                        <h3 class="l-text1 fs-35-sm text-center"></h3>
                    </div>-->
            </div>
        	</div>
	    	<div class="right-content">
                <div class="card">
                    <div class="card-body h-search-form">
                    <div class="heder-box">
                        <h3 class=" s-title">NCCAA Certified Professional REGISTRY</h3>
                        <p class="s-text">Use this tool to access a CAA Certificate.</p>
					</div>
<form action="search " class="search-form">
<div class="row form-group">
	<label for="staticEmail" class="col-form-label">First and<br>Last Name</label>
    <div class="field-boxs">
        <div class="field-box-half f-m-l field-box"><!--u-form--no-brd-->
            <input type="text" name="f_name" class="form-control" placeholder="First Name" />
        </div>
        <div class="field-box-half field-box"><!--u-form--no-brd-->
            <input type="text" name="l_name" class="form-control" placeholder="Last Name"  />
        </div>
        <div style="clear:both"></div>
        <div class=" ">
            <span class="or-text">or</span>    
        </div>
	</div>        
</div>



<div class="row form-group">
	<label for="staticEmail" class="col-md-3 col-form-label pt">City</label>
    <div class="col-md-9 field-box mb-3 mb-sm-0"><!--u-form--no-brd-->
        <input type="text" name="city" class="form-control" placeholder="City" />
        <span class="or-text">or</span>    
    </div>
    
</div>


<div class="row form-group">
	<label for="staticEmail" class="col-md-3 col-form-label pt">State and Zip</label>
<div class="col-md-9">
    <div class="row ">
        <div class="field-box-half f-m-l field-box"><!--u-form--no-brd-->
            <input type="text" name="state" class="form-control" placeholder="State" />
        </div>
        <div class="field-box-half field-box"><!--u-form--no-brd-->
            <input type="text" name="zip" class="form-control" placeholder="Zip"  />
        </div>
	</div>
    <div class="row ">
		<span class="or-text">or</span>    
	</div>
    
</div>
</div>


<div class="row form-group">
	<label for="staticEmail" class="col-md-3 col-form-label pt">Employer</label>
    <div class="col-md-9 field-box mb-3 mb-sm-0"><!--u-form--no-brd-->
        <input type="text" name="employee" class="form-control" placeholder="Employers First and Last Name" />
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-12 search-bn-content" style="">
	<button class="btn btn-primary btn-block search-btn">Search For Certificate</button>
    </div>
</div>

</form>                    
                    </div>
                </div>
        	</div>
        </div>
	</div>
</div>
