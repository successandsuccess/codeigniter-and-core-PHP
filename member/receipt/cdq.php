<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once ("../config.php");
session_start();
//print_r($_SESSION);
if (empty($_SESSION['user_id']) || $_SESSION['user_id'] == "")
{
    header('Location: /logincaamember.php');
}
include ('../vendor/autoload.php');
require_once ("../../includes/util.php");
require_once ("../../classes/user.class.php");
$userObject = new userObject();
$userObject->init($_SESSION['user_id']);
require_once ("../classes/database.class.php");
global $db;
$db = new Database();
include_once "../../incomecdq/classes/historycdq.class.php";
$cdqhistory = new PaymentHistoryCdq();
$receipt_cdq = $cdqhistory->readByReceiptId($_GET['receipt_id']);
if ((empty($_GET['exam_type']) == false) && ($_GET['exam_type'] == "CDQ")){
    $receipt_cdq = $cdqhistory->readReceiptHistory($_GET['receipt_id']);
}
$re_arr1 = explode("Main", $receipt_cdq['receipt_title']);
$re_arr2 = explode("Late", $receipt_cdq['receipt_title']);
$re_arr3 = explode("#1", $receipt_cdq['receipt_title']);
$re_arr4 = explode("#2", $receipt_cdq['receipt_title']);
if (count($re_arr1) > 1){
    $receipt_title = "CDQ Initial Exam";
}
if (count($re_arr2) > 1){
    $receipt_title = "CDQ Initial Exam";
}
if (count($re_arr3) > 1){
    $receipt_title = "CDQ Exam";
}
if (count($re_arr4) > 1){
    $receipt_title = "CDQ Exam";
}
$receipt_date = getdate($receipt_cdq['action_date']);
$receipt_title_day = $cdqhistory->expectedExamDate($receipt_cdq['exam_mon'], $receipt_cdq['exam_year'], 'full');
$receipt_due_date = $cdqhistory->expectedExamDate($receipt_cdq['exam_mon'], $receipt_cdq['exam_year'], 'due');
$sub_title = "For " . $receipt_title_day . " CDQ Exam";
if ($receipt_cdq['card_num4']){
    $final_card_num = $receipt_cdq['card_num4'];
}else{
    $final_card_num = "N/A";
}
$covid_extended_users_id = [
9
,21
,46
,52
,56
,87
,88
,90
,92
,100
,128
,180
,217
,222
,230
,258
,266
,287
,290
,291
,295
,311
,346
,360
,406
,443
,448
,468
,484
,486
,490
,519
,522
,559
,569
,597
,598
,601
,611
,665
,668
,687
,689
,690
,778
,787
,788
,855
,881
,908
,928
,944
,965
,979
,1005
,1010
,1015
,1028
,1044
,1054
,1060
,1066
,1084
,1094
,1095
,1112
,1129
,1145
,1149
,1174
,1202
,1219
,1284
,1291
,1292
,1294
,1296
,1302
,1334
,1342
,1360
,1361
,1366
,1367
,1382
,1388
,1439
,1441
,1480
,1482
,1490
,1503
,1562
,1584
,1589
,1602
,1615
,1629
,1637
,1646
,1655
,1682
,1690
,1703
,1778
,1797
,1817
,1828
,1830
,1865
,1873
,1901
,1905
,1926
,1927
,1934
,1945
,1961
,2000
,2014
,2018
,2067
,2103
,2118
,2136
,2162
,2175
,2194
,2200
,2202
,2230
,2236
,2274
,2275
,2284
,2297
,2298
,2303
,2344
,2390
,2402
,2426
,2435
,2445
,2475
,2530
,2539
,2546
,2553
,2563
,2569
,2586
,3045
,3054
,3103
,3112
,3113
,3114
]; 
if ( in_array($_SESSION['user_id'], $covid_extended_users_id) )
{
    $out = '



<!DOCTYPE HTML>



<html>



<head>



    <title></title>



    <link rel="stylesheet" href="../assets/fonts/font-awesome/fontawesome-all.min.css">



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>



    <link href="css/script.css" rel="stylesheet" type="text/css"/>



</head>



<body>











        <div id="receiptmodal_body" class="paymentContent" style="min-height: auto;">







            <div class="row top_body" style="margin: 0px; padding-left: 45px;">



			



                <div class="col-xs-2" style="padding: 0px">



                    <img src="img/logo.png" width="80" height="80">



                </div>







                <div class="col-xs-7 logo_title">



                    National Commission for Certification <br> of Anesthesiologist Assistants



                </div>







                <div class="col-xs-2 today_date">



				



                    <p>' . $receipt_date['mon'] . "/" . $receipt_date['mday'] . "/" . $receipt_date['year'] . '</p>



                </div>



            </div>







            <div class="row section1" style="padding: 20px 15px 15px 35px">



                <div class="col-xs-11">



                    <div class="receipt_head">



                        <h6>RECEIPT</h6>



                        <p>Payment Successful</p>



                    </div>



                    <h5>



                        ' . $receipt_title . '



                    </h5>



                    <p>' . $sub_title . '</p>



					<div class="row">



						<div class="col-xs-5">



							<ul style="padding-left: 0px;">



								<li><a>CAA name: <span>' . $userObject->data["login"]['full_name'] . '</span></a></li>



								<li><a>Amount due: <span>' . '$' . $cdqhistory->readActionAmount($receipt_cdq['amount_num']) . '</span></a></li>



								<li><a>Due date: <span>' . $receipt_due_date . '</span></a></li>



								<li><a>Date paid: <span>' . $receipt_date['mon'] . "/" . $receipt_date['mday'] . "/" . $receipt_date['year'] . '</span></a></li>



								<li><a>Amount paid: <span>' . '$' . $cdqhistory->readActionAmount($receipt_cdq['amount_num']) . '</span></a></li>



								<li><a>Amount due: <span>$0</span></a></li>



							</ul>



						</div>



						<div class="col-xs-6" style="border-style: solid; border-width: 2px;border-color: #e5e5e5; padding:0px; color:rgb(112, 112, 112);">



                        
                        



							<div class="col-xs-11"  align="left" style="margin-top:15px;">



								Last 4 digits of credit card used for payment:<font id="final_digits" style="color: #28a745; font-size: 14px;"> ' . $final_card_num . '</font>



							</div>



							<div class="col-xs-11" align="left">



								Employer questions regarding verification may be directed to NCCAA:



							</div>



							



							<div class="col-xs-11" align="center" style="margin-top: 15px">



								Fiona Sanchez



							</div>



							



							<div class="col-xs-11" align="center">



								<i>Secretary</i>



							</div>



							



							<div class="col-xs-11" align="center">



								<i class="fa fa-phone"></i> 212-396-5501



							</div>



							



							<div class="col-xs-11" align="center">



								<i class="fa fa-envelope"></i> fiona@gmail.com



							</div>



							



							<div class="col-xs-11" align="center" style="margin-top: 15px"></div>



							



						</div>



					



					</div>



                



				</div>







            </div>



            <div class="deadline" style="margin-top:20px;"></div>







            <div class="row receipt_body" style="padding-left: 35px; padding-right: 35px;">



                <div class="col-xs-2">



                    <p style="margin-bottom: 15px">Next CDQ Exam:	</p>



                    <h5>Feb, ' . ($receipt_cdq['exam_year'] + 9) . '</h5>



                    <p>or</p>



                    <h5>June, ' . ($receipt_cdq['exam_year'] + 9) . '</h5>



                </div>



                <div class="col-xs-9">



					<p style="text-align: justify;">Your CDQ registration has been accepted. Scheduling permits will be released via email within 30 days of registration closing. Until the 10-year CDQ plan has been developed, your next CDQ exam will occur in six years, regardless of how many retakes to pass the CDQ exam.  We will update your account to the new CDQ date once we learn the results of the new 10-year plan. Check your account for score results within 8-10 weeks following the exam, per NBME processing time frame. Any CAA who fails the CDQ Exam is required to take the next consecutive CDQ Exam available, until the CAA passes – up to two more times for a total of three exams.</p>



                </div>



            </div>







		</div>



    



</body>



</html>



';
}
else 
{
    $out = '



    <!DOCTYPE HTML>
    
    
    
    <html>
    
    
    
    <head>
    
    
    
        <title></title>
    
    
    
        <link rel="stylesheet" href="../assets/fonts/font-awesome/fontawesome-all.min.css">
    
    
    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    
    
    
        <link href="css/script.css" rel="stylesheet" type="text/css"/>
    
    
    
    </head>
    
    
    
    <body>
    
    
    
    
    
    
    
    
    
    
    
            <div id="receiptmodal_body" class="paymentContent" style="min-height: auto;">
    
    
    
    
    
    
    
                <div class="row top_body" style="margin: 0px; padding-left: 45px;">
    
    
    
                
    
    
    
                    <div class="col-xs-2" style="padding: 0px">
    
    
    
                        <img src="img/logo.png" width="80" height="80">
    
    
    
                    </div>
    
    
    
    
    
    
    
                    <div class="col-xs-7 logo_title">
    
    
    
                        National Commission for Certification <br> of Anesthesiologist Assistants
    
    
    
                    </div>
    
    
    
    
    
    
    
                    <div class="col-xs-2 today_date">
    
    
    
                    
    
    
    
                        <p>' . $receipt_date['mon'] . "/" . $receipt_date['mday'] . "/" . $receipt_date['year'] . '</p>
    
    
    
                    </div>
    
    
    
                </div>
    
    
    
    
    
    
    
                <div class="row section1" style="padding: 20px 15px 15px 35px">
    
    
    
                    <div class="col-xs-11">
    
    
    
                        <div class="receipt_head">
    
    
    
                            <h6>RECEIPT</h6>
    
    
    
                            <p>Payment Successful</p>
    
    
    
                        </div>
    
    
    
                        <h5>
    
    
    
                            ' . $receipt_title . '
    
    
    
                        </h5>
    
    
    
                        <p>' . $sub_title . '</p>
    
    
    
                        <div class="row">
    
    
    
                            <div class="col-xs-5">
    
    
    
                                <ul style="padding-left: 0px;">
    
    
    
                                    <li><a>CAA name: <span>' . $userObject->data["login"]['full_name'] . '</span></a></li>
    
    
    
                                    <li><a>Amount due: <span>' . '$' . $cdqhistory->readActionAmount($receipt_cdq['amount_num']) . '</span></a></li>
    
    
    
                                    <li><a>Due date: <span>' . $receipt_due_date . '</span></a></li>
    
    
    
                                    <li><a>Date paid: <span>' . $receipt_date['mon'] . "/" . $receipt_date['mday'] . "/" . $receipt_date['year'] . '</span></a></li>
    
    
    
                                    <li><a>Amount paid: <span>' . '$' . $cdqhistory->readActionAmount($receipt_cdq['amount_num']) . '</span></a></li>
    
    
    
                                    <li><a>Amount due: <span>$0</span></a></li>
    
    
    
                                </ul>
    
    
    
                            </div>
    
    
    
                            <div class="col-xs-6" style="border-style: solid; border-width: 2px;border-color: #e5e5e5; padding:0px; color:rgb(112, 112, 112);">
    
    
    
                            
                            
    
    
    
                                <div class="col-xs-11"  align="left" style="margin-top:15px;">
    
    
    
                                    Last 4 digits of credit card used for payment:<font id="final_digits" style="color: #28a745; font-size: 14px;"> ' . $final_card_num . '</font>
    
    
    
                                </div>
    
    
    
                                <div class="col-xs-11" align="left">
    
    
    
                                    Employer questions regarding verification may be directed to NCCAA:
    
    
    
                                </div>
    
    
    
                                
    
    
    
                                <div class="col-xs-11" align="center" style="margin-top: 15px">
    
    
    
                                    Fiona Sanchez
    
    
    
                                </div>
    
    
    
                                
    
    
    
                                <div class="col-xs-11" align="center">
    
    
    
                                    <i>Secretary</i>
    
    
    
                                </div>
    
    
    
                                
    
    
    
                                <div class="col-xs-11" align="center">
    
    
    
                                    <i class="fa fa-phone"></i> 212-396-5501
    
    
    
                                </div>
    
    
    
                                
    
    
    
                                <div class="col-xs-11" align="center">
    
    
    
                                    <i class="fa fa-envelope"></i> fiona@gmail.com
    
    
    
                                </div>
    
    
    
                                
    
    
    
                                <div class="col-xs-11" align="center" style="margin-top: 15px"></div>
    
    
    
                                
    
    
    
                            </div>
    
    
    
                        
    
    
    
                        </div>
    
    
    
                    
    
    
    
                    </div>
    
    
    
    
    
    
    
                </div>
    
    
    
                <div class="deadline" style="margin-top:20px;"></div>
    
    
    
    
    
    
    
                <div class="row receipt_body" style="padding-left: 35px; padding-right: 35px;">
    
    
    
                    <div class="col-xs-2">
    
    
    
                        <p style="margin-bottom: 15px">Next CDQ Exam:	</p>
    
    
    
                        <h5>Feb, ' . ($receipt_cdq['exam_year'] + 10) . '</h5>
    
    
    
                        <p>or</p>
    
    
    
                        <h5>June, ' . ($receipt_cdq['exam_year'] + 10) . '</h5>
    
    
    
                    </div>
    
    
    
                    <div class="col-xs-9">
    
    
    
                        <p style="text-align: justify;">Your CDQ registration has been accepted. Scheduling permits will be released via email within 30 days of registration closing. Until the 10-year CDQ plan has been developed, your next CDQ exam will occur in six years, regardless of how many retakes to pass the CDQ exam.  We will update your account to the new CDQ date once we learn the results of the new 10-year plan. Check your account for score results within 8-10 weeks following the exam, per NBME processing time frame. Any CAA who fails the CDQ Exam is required to take the next consecutive CDQ Exam available, until the CAA passes – up to two more times for a total of three exams.</p>
    
    
    
                    </div>
    
    
    
                </div>
    
    
    
    
    
    
    
            </div>
    
    
    
        
    
    
    
    </body>
    
    
    
    </html>
    
    
    
    ';
}


$mpdf = new \Mpdf\Mpdf([
// 'debug' => true,
'allow_output_buffering' => true, 'mode' => 'utf-8', 'format' => [220, 190], 'margin_top' => 0, 'margin_left' => 0, 'margin_right' => 0, 'margin_bottom' => 0, ]);
$mpdf->WriteHTML($out);
$mpdf->Output();
?>
