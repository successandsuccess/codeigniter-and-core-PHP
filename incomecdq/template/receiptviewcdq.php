<?php
global $incomecdq;

include_once "../incomecdq/classes/historycdq.class.php";

$cdqhistory = new PaymentHistoryCdq();

$cdq = $cdqhistory->readAllReceipt($_SESSION['user_id']);

$receipt_date = getdate($cdq['action_date']);
?>

<link href="../incomecdq/css/script.css" rel="stylesheet" type="text/css">

<div class="modal fade" id="receiptContentModal"  role="dialog" style="display:none;">

    <div class="modal-dialog modal-lg" role="document">

        <div id="receiptmodal_body" class="modal-content paymentContent" style="min-height: auto;">

            <div class="row top_body" style="margin: 0">
                <img src="../incomecdq/image/logo.png" width="80" height="80">

                <div class="logo_title">
                    National Commission for Certification <br> of Anesthesiologist Assistants
                </div>

                <div class="today_date">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p><?php echo date('m/d/Y') ?></p>
                </div>
            </div>

            <div class="row section1" style="padding: 20px 15px 45px 15px">
                <div class="col-md-12">
                    <div class="receipt_head">
                        <h6>RECEIPT</h6>
                        <p>Payment Successful</p>
                    </div>
                    <h5>
                        <?php echo $cdq['receipt_title']; ?>
                    </h5>
                    <p>For <?php echo $cdqhistory->readActionExamMon($cdq['exam_mon']).". 1.".$cdq['exam_year']?></p>
                    <ul>
                        <li><a>CAA name: <span><?php echo $userObject->data["login"]['full_name'];?></span></a></li>
                        <li><a>Amount due: <span><?php echo '$'.$cdqhistory->readActionAmount($cdq['amount_num']); ?></span></a></li>
                        <li><a>Due date: <span><?php echo $cdq['exam_mon']."/1/".$cdq['exam_year']?></span></a></li>
                        <li><a>Date paid: <span><?php echo $receipt_date['mon']."/".$receipt_date['mday']."/".$receipt_date['year'] ?></span></a></li>
                        <li><a>Amount paid: <span>0 (still due)</span></a></li>
                        <li><a>Amount due: <span><?php echo '$'.$cdqhistory->readActionAmount($cdq['amount_num']); ?> (pay below)</span></a></li>
                    </ul>
                </div>

            </div>
            <div class="deadline"></div>

            <div class="row receipt_body">
                <div class="col-md-3">
                    <p style="margin-bottom: 15px">Next CME Submission:	</p>
                    <h5>Feb, <?php echo ($cdq['exam_year'] + 1);?></h5>
                    <p>or</p>
                    <h5>June, <?php echo ($cdq['exam_year'] + 1);?></h5>
                </div>
                <div class="col-md-9">
                <p>CME submissions have been accepted; however, all CAAs are subject to an audit and notified accordingly if any discrepancies are found. Within 24-48 hours your certificate will be updated to show the new expiration date. Thank you!</p>
                </div>
            </div>

            <div class="receipt_bottom">
                <a href="http://localhost/member?content=content/cdqhistory"><i class="fas fa-arrow-left"></i>Back to CDQ History</a>
                <a href="" onclick="window.print();return false;"><i class="fa fa-print" aria-hidden="true"></i>Print</a>
                <a href=""><i class="fas fa-envelope"></i>Email</a>
            </div>
		</div>
	</div>     
</div>



