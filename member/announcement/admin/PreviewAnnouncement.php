<?php
    if(isset($_GET["id"]) && $_GET["id"]){
        $announcement->id = $_GET['id'];
        $result = $announcement->readWithWhere("id = ".$_GET['id']);
		$rec = $result[0];
    }
?>
    <script>
        // Safari 3.0+ "[object HTMLElementConstructor]" 
         var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));
         if(isSafari == true)
         {
            $('head').append('<style>.card.announcement{ min-height: 161px !important; }</style>')
         }
         else
         {
            $('head').append('<style>.card.announcement{ height: 171px !important; }</style>')
         }
      </script>
      <style>
         .card.announcement{
            margin-top:5px;
            margin-bottom:10px;
            /* height: 171px !important; */
            padding: 20px !important;
            width: 620px !important;
         }
         h3.big-title.announcement{
            margin-top: 35px !important;
            margin-left: 20px !important;
            margin-bottom: 15px !important;
            border-bottom: none !important;
            font-size: 28px !important;
            color: white !important;
            text-transform: none !important;
         }
         .card.parent{
            border: none !important;
            max-height: 300px !important;
            background-color: #C1002D !important;
            padding-right: 9px;
            padding-top:0px !important;
            padding-bottom: 8px !important;
            margin-bottom: 0px !important;
         }
         .card-header.announcement{
            border-bottom: none;
         }
         .announcement-date{
            margin-top: 5px;
            margin-bottom: 5px;
            opacity: 0.6;
         }
         .card-body.announcement{
             opacity:0.6;
         }
         .card-body.announcement em{
            font-style: italic !important;
         }
         .announcement-btn{
             margin-top: 3px;
             padding-top:3px;
             padding-bottom:1px;
             font-size: 11px;
             font-family: 'Circe' !important;
             border-radius: 20px;
             border: none;
             padding-left: 12px;
             padding-right: 12px;
             cursor: default;
             background-color: #01920c;
             color: white;
         }
         
      </style>
                <div class="member-card card">
                    <h3>Announcement</h3>
                    <a href="?content=../announcement/admin/ViewAllAnnouncements&li_class=Announcement" class="backbtn"><span class="glyphicon glyphicon-chevron-left"></span>Back</a>
                <div class="row">
                    <div class="col-md-1"> 
                    </div>
                    <div class="col-md-7 col-sm-12">

                            <div class="ncca-right-block block-border ncca-right-padding page-block-margin" style="background-color:#C1002D; width: 650px;">
                                        <div class="row">
                                            <div class="col-sm-6 pr-0 jk-60">
                                                <div class="ncca-welcome">
                                                    <h3 class="big-title announcement">Welcome back, XXXX.</h3>
                                                    <p style="color: white; margin-left:20px; margin-bottom: 0px; font-weight: bold; font-size: 16px;">
                                                        ANNOUNCEMENTS
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="card parent" id="style-2">
                                                
                                                            <div class="card announcement">
                                                                <div class="card-header announcement" style="background: none;">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="announcement-date" style="font-weight: bolder;">
                                                                                <?php echo date('m/d/y', strtotime(str_replace('-','/', $rec['created'])));?>
                                                                            </div>
                                                                        </div>
                                                                        <?php if($rec['button'] != '') {?>
                                                                        <div class="col-md-6">
                                                                            <div class="announcement-button" style="text-align: right;">
                                                                                <button class="announcement-btn"><?php echo strtoupper($rec['button']);?></button>
                                                                            </div>
                                                                        </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <h3 style="border-bottom: none; font-size: 20px; padding-bottom:0px; text-transform:none;"><?php echo strtoupper($rec["subject"]);?></h3>  
                                                                </div>
                                                                <div class="card-body announcement" style="padding-top:0px;">
                                                                    <?php echo $rec["contents"];?>
                                                                </div>
                                                            </div>

                                                </div>
                                            
                                            </div>
                                        </div>
                            </div>


                    </div>
                    <div class="col-md-1">
                    </div>
                </div>
                            


                </div>

                                





