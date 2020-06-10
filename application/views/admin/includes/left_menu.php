<script>
jQuery(document).ready(function() {
	jQuery(window).load(function() { 
	});
});

</script>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            
                <li <?php echo $active=='home'?'class=" active"':'class=""'; ?> >
					<a href="<?=$admin_link?>/dashboard" target="">
					<i class="fa fa-home"></i>
					<span class="title"><?=show_static_text($adminLangSession['lang_id'],80);?></span>
					</a>
				</li>
            
<?php
if($admin_details->role=='super admin'){
?>

<li class="nav-item <?=$active=='General Settings'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-gears"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],162);?></span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/settings">Main</a></li>
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/email">Email Setting</a></li>
<li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/background">Background Image</a></li>

    </ul>
</li>


<li <?php echo $active=='Certificates'?'class=" active"':'class=""'; ?> >
    <a href="<?=$admin_link?>/certificates" target="">
    <i class="fa fa-list"></i>
    <span class="title">Certificates</span>
    </a>
</li>

<li <?php echo $active=='Programs'?'class=" active"':'class=""'; ?> >
    <a href="<?=$admin_link?>/programs" target="">
    <i class="fa fa-list"></i>
    <span class="title">Programs</span>
    </a>
</li>

<li <?php echo $active=='Employers'?'class=" active"':'class=""'; ?> >
    <a href="<?=$admin_link?>/employers" target="">
    <i class="fa fa-list"></i>
    <span class="title">Employers</span>
    </a>
</li>

<li <?php echo $active=='caas'?'class=" active"':'class=""'; ?> >
    <a href="<?=$admin_link?>/caas" target="">
    <i class="fa fa-list"></i>
    <span class="title">CAAs</span>
    </a>
</li>



<!--<li class="nav-item  <?=$active=='Offers Management'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-list"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],10062);?>Offer Management</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/offers'?>">Offers</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/offers/create'?>">Create Offers</a></li>
    </ul>
</li>-->


<li class="nav-item  <?=$active=='Content Management'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-file-code-o"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],180);?></span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
		<li class="nav-item start"><a class="nav-link " href="<?=$admin_link.'/page'?>"><?=show_static_text($adminLangSession['lang_id'],182);?></a></li>

    </ul>
</li>
<?php
}
else{
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'general_setting','value'=>1))){
?>

<li class="nav-item <?=$active=='General Settings'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-gears"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],162);?></span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/settings">Main</a></li>
        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/background">Background Image</a></li>

        <li class="nav-item start"><a class="nav-link " href="<?=$admin_link?>/paypal_setting">Paypal Setting</a></li>
    </ul>
</li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'advertisers_manage','value'=>1))){
?>
<li class="nav-item  <?=$active=='User Management'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],10062);?>Advertisers</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/advertiser'?>"> Manage Advertiser</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/advertiser/pending'?>">Pending Advertiser</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/advertiser/create'?>">Create Advertiser</a></li>
    </ul>
</li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'affiliates_manage','value'=>1))){
?>
<li class="nav-item  <?=$active=='Affiliates'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],10062);?>Affiliates</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/user'?>">Manage Affiliates</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/user/pending'?>">Pending Affiliates</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/user/create'?>">Create Affiliates</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/affiliate_offer'?>">Affiliates Offers</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/affiliate_log'?>">Affiliates Log</a></li>
<!--        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/affiliate_click'?>">Affiliates Clicks</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/affiliate_sales'?>">Affiliates Sales</a></li>-->
    </ul>
</li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'offer_manage','value'=>1))){
?>
<li class="nav-item  <?=$active=='Programs Management'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-users"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],10062);?>Offer Management</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/category'?>">Category</a></li>
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/programs'?>">Offers</a></li>
    </ul>
</li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'reports_manage','value'=>1))){
?>
<li class="nav-item  <?=$active=='Reports'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-bar-chart"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],10062);?>Reports</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item "><a class="nav-link " href="<?=$admin_link.'/advertisers_reports'?>">Advertisers Reports</a></li>
    </ul>
</li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'balance_request','value'=>1))){
?>

<li class=" <?php echo $active=='balance_request'?'active':''; ?>" >
    <a href="<?=$admin_link?>/balance_request" target="">
    <i class="fa fa-usd"></i>
    <span class="title">Balance Request</span>
    </a>
</li>
<?php
}
if(checkPermission('admin_permission',array('user_id'=>$admin_details->id,'type'=>'content_manage','value'=>1))){
?>

<li class="nav-item  <?=$active=='Content Management'?'active open':''; ?> ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-file-code-o"></i>
        <span class="title"><?=show_static_text($adminLangSession['lang_id'],180);?></span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
    <ul class="sub-menu">
		<li class="nav-item start"><a class="nav-link " href="<?=$admin_link.'/page'?>"><?=show_static_text($adminLangSession['lang_id'],182);?></a></li>
		<li class="nav-item start"><a class="nav-link " href="<?=$admin_link.'/slider'?>">Slider</a></li>
		<li class="nav-item start"><a class="nav-link " href="<?=$admin_link.'/partner_slider'?>">Partner Slider</a></li>

    </ul>
</li>
<?php
}

}
?>
            
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
                    <!-- END SIDEBAR -->
                </div>
                
