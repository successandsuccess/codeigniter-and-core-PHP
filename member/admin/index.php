<?php
   if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off" || $_SERVER["HTTPS"] != "on")
   {
       $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
       header('HTTP/1.1 301 Moved Permanently');
       header('Location: ' . $location);
       exit;
   }
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
   session_start();
   require_once ("../config.php");
   if (empty($_SESSION['admin_id']) || $_SESSION['admin_id'] == "")
   {
       header('Location: ' . base_url() . '/logincaamember.php');
   }
   else
   {
       require_once (BASE_PATH . "../includes/util.php");
       require_once (BASE_PATH . "../classes/user.class.php");
       $userObject = new userObject();
       $userObject->init($_SESSION['admin_id']);
       require_once (BASE_PATH . "classes/database.class.php");
       global $db;
       $db = new Database();
       require_once ("classes/admin_dashboard.class.php");
       require_once ("classes/members.class.php");
       require_once ("classes/programs.class.php");
       require_once ("classes/employers.class.php");
       require_once ("classes/audit.class.php");
       require_once ("classes/audit_member.class.php");
       require_once ("classes/exam.class.php");
       require_once ("classes/certification.class.php");
       require_once ("classes/financial.class.php");
       require_once ("../email/classes/email.class.php");
       require_once ("../emailblast/classes/blastemail.class.php");
       require_once ("../blog/blog.php");
       require_once ("../announcement/announcement.php");
       require_once ("../error/error.php");
       require_once ("classes/survey.class.php");
       require_once ("classes/visitor.class.php");
       require_once ("classes/users.class.php");
       require_once ("classes/settings.class.php");
       global $dashboard_data;
       $dashboard_data = new adminDashboardObject();
       global $members;
       $members = new MembersObject();
       global $programs;
       $programs = new ProgramsObject();
       global $employers;
       $employers = new EmployersObject();
       global $audit;
       $audit = new AuditObject();
       global $membercme;
       $membercme = new MemberCMEObject();
       global $exam;
       $exam = new ExamObject();
       global $certification;
       $certification = new CertificationExamObject();
       global $financial;
       $financial = new FinancialObject();
       global $email;
       $email = new EmailObject($db);
       global $blastemail;
       $blastemail = new BlastEmailObject($db);
       global $survey;
       $survey = new SurveyObject();
       global $visitors;
       $visitors = new VisitorsObject();
       global $settings;
       $settings = new SettingsObject($db);
       //Show/no show
       if (isset($_POST['id']) && isset($_POST['show_id']))
       {
           $exam->updateShowAllow($_POST);
       }
       //pass/fail
       if (isset($_POST['id']) && isset($_POST['select_id']))
       {
           $exam->updateActionNum($_POST);
       }
   }
   ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta xmlns="" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <link href="../css/owl.carousel.css" rel="stylesheet" type="text/css">
      <!-- Jquery Core Js -->
      <script src="../plugins/jquery/jquery.min.js"></script>
      <!-- Bootstrap Core Js -->
      <script src="../plugins/bootstrap/js/bootstrap.js"></script>
      <!-- Select Plugin Js -->
      <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>
      <!-- Slimscroll Plugin Js -->
      <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
      <!-- Waves Effect Plugin Js -->
      <script src="../plugins/node-waves/waves.js"></script>
      <!-- Jquery Validation Plugin Css -->
      <script src="../plugins/jquery-validation/jquery.validate.js"></script>
      <!-- Jquery CountTo Plugin Js -->
      <script src="../plugins/jquery-countto/jquery.countTo.js"></script>
      <!-- Morris Plugin Js -->
      <script src="../plugins/raphael/raphael.min.js"></script>
      <script src="../plugins/morrisjs/morris.js"></script>
      <script src="../plugins/dropzone/4.3.0/dropzone.js"></script>
      <!-- Jquery DataTable Plugin Js -->
      <script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
      <script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
      <script src="../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
      <script src="../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
      <script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
      <script src="../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
      <script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
      <script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
      <script src="../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
      <!-- Bootstrap Notify Plugin Js -->
      <script src="../plugins/bootstrap-notify/bootstrap-notify.js"></script>
      <!-- SweetAlert Plugin Js -->
      <script src="../plugins/sweetalert/sweetalert.min.js"></script>
      <!-- Wait Me Plugin Js -->
      <script src="../plugins/waitme/waitMe.js"></script>
      <!-- Editable Table Plugin Js -->
      <script src="../plugins/editable-table/mindmup-editabletable.js"></script>
      <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>
      <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>
      <script src="../js/jquery-ui.min.js"></script>
      <link href="../css/jquery-ui.min.css" rel="stylesheet" type="text/css">
      <link href="../css/jquery-ui.structure.min.css" rel="stylesheet" type="text/css">
      <link href="../css/jquery-ui.theme.min.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="./css/bootstrap.min.css">
      <link rel="stylesheet" href="./css/dataTables.bootstrap.min.css">
      <link rel="stylesheet" href="./css/select.dataTables.min.css">
      <link rel="stylesheet" href="./css/buttons.dataTables.min.css">
      <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css" rel="stylesheet" />
      <link rel="stylesheet" href="./css/jquery-ui.css">
      <link rel="stylesheet" href="./css/jquery.gritter.css">
      <link rel="stylesheet" type="text/css" href="./fonts/fonts.css">
      <link href="./css/style.css" type="text/css" rel="stylesheet" />
      <link rel="stylesheet" href="./css/bootstrap-datepicker.css">
      <link rel="stylesheet" href="../assets/fonts/font-awesome/fontawesome-all.min.css">
      <script src="../js/owl.carousel.min.js"></script>
      <title>NCCAA</title>
   </head>
   <body>
      <header>
         <div class="container">
            <div class="headerLogo">
               <a href="/member/"><img src="./images/logo.png" alt="" /> </a>
            </div>
            <div class="headerContent">
               <p>National Commission for Certification of Anesthesiologist Assistants</p>
               <a href="../logout.php">Logout</a>
            </div>
         </div>
      </header>
      <section class="mainContent">
         <?php
            echo ("<center><font style='font-size:18px;'>Server: Eastern Standard Time Zone<br>");
            if (date_default_timezone_get() == "America/New_York")
            {
                echo ("<font id='date_time' class='date_time' style='font-weight: unset; color: #333; font-size: 18px !important;'></font></font></center>");
            }
            else
            {
                echo (date("m/d/Y (H:i:s)") . "</font></center>");
            }
            ?>
         <div class="innerContainer">
            <div class="row">
               <div class="col-lg-2">
                  <div class="sidebar card">
                     <nav id="sidebar" class="_bgdark">
                        <ul class="list-unstyled components">
                           <li
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'Dashboard')
                                     {
                                         echo 'class="active"';
                                     }
                                 }
                                 else
                                 {
                                     echo 'class="active"';
                                 }
                                 ?>
                              >
                              <a href="?content=content/admin_dashboard&li_class=Dashboard">
                              Dashboard
                              </a>
                           </li>
                           <li
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'Announcement')
                                     {
                                         echo 'class = "active"';
                                     }
                                 }
                                 ?>
                              >
                              <a href="?content=../announcement/admin/ViewAllAnnouncements&li_class=Announcement">
                              Announcement
                              </a>
                           </li>
                           <li
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'Members')
                                     {
                                         echo 'class="active"';
                                     }
                                 }
                                 ?>
                              >
                              <a href="?content=content/members&li_class=Members">
                              Members
                              </a>
                           </li>
                           <li
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'Programs')
                                     {
                                         echo 'class="active"';
                                     }
                                 }
                                 ?>
                              >
                              <a href="?content=content/programs&li_class=Programs">
                              Programs
                              </a>
                           </li>
                           <li
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'Employers')
                                     {
                                         echo 'class="active"';
                                     }
                                 }
                                 ?>
                              >
                              <a href="?content=content/employers&li_class=Employers">
                              Employers
                              </a>
                           </li>
                           <li
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'CME')
                                     {
                                         echo 'class="active"';
                                     }
                                 }
                                 ?>
                              >
                              <a href="?content=content/audit&li_class=CME">
                              CME Audit
                              </a>
                           </li>
                           <li
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'Exams')
                                     {
                                         echo 'class="active"';
                                     }
                                 }
                                 ?>
                              >
                              <a href="?content=content/exams&li_class=Exams">
                              Exams
                              </a>
                           </li>
                           <li
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'Financials')
                                     {
                                         echo 'class="active"';
                                     }
                                 }
                                 ?>
                              >
                              <a href="?content=content/financial&li_class=Financials">
                              Financials
                              </a>
                           </li>
                           <li
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'Email')
                                     {
                                         echo 'class="active"';
                                     }
                                 }
                                 ?>
                              >
                              <a href="?content=../email/admin/ViewAllEmail&li_class=Email">
                              Email
                              </a>
                           </li>
                           <li 
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'EmailBlast')
                                     {
                                         echo 'class="active"';
                                     }
                                 }
                                 ?>
                              >
                              <a href="?content=../emailblast/admin/ViewAllBlastEmail&li_class=EmailBlast">Blast Email</a>
                           </li>
                           <li
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'Blog')
                                     {
                                         echo 'class="active"';
                                     }
                                 }
                                 ?>
                              >
                              <a href="?content=../blog/admin/ViewAllBlogs&li_class=Blog">
                              Blog
                              </a>
                           </li>
                           <li
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'Error')
                                     {
                                         echo 'class="active"';
                                     }
                                 }
                                 ?>
                              >
                              <a href="?content=../error/admin/ViewAllErrors&li_class=Error">
                              Errors
                              </a>
                           </li>
                           <li
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'Surveys')
                                     {
                                         echo 'class="active"';
                                     }
                                 }
                                 ?>
                              >
                              <a href="?content=content/surveys&li_class=Surveys">
                              Surveys
                              </a>
                           </li>
                           <li
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'Visitors')
                                     {
                                         echo 'class="active"';
                                     }
                                 }
                                 ?>
                              >
                              <a href="?content=content/visitors&li_class=Visitors">
                              Visitors
                              </a>
                           </li>
                           <li
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'Settings')
                                     {
                                         echo 'class="active"';
                                     }
                                 }
                                 ?>
                              >
                              <a href="?content=content/settings&li_class=Settings">
                              Settings
                              </a>
                           </li>
                           <li
                              <?php
                                 if (isset($_GET['li_class']))
                                 {
                                     if ($_GET['li_class'] == 'Help')
                                     {
                                         echo 'class="active"';
                                     }
                                 }
                                 ?>
                              >
                              <a href="?content=content/help&li_class=Help">
                              Help
                              </a>
                           </li>
                        </ul>
                     </nav>
                  </div>
               </div>
               <div class="col-lg-10">
                  <?PHP
                     if ((!isset($_REQUEST["content"])) || ($_REQUEST["content"] == "")) $content = "content/admin_dashboard.php";
                     else $content = $_REQUEST["content"] . ".php";
                     if ($content != "") include ($content);
                     ?>
               </div>
            </div>
         </div>
      </section>
      <script src="./ckeditor/ckeditor.js"></script>
      <script src="./js/custom.js"></script>
      <script src="./js/jquery.gritter.min.js"></script>
      <script src="./js/bootstrap-datepicker.js"></script>
      <script src="./js/bootstrap-datepicker.min.js"></script>
      <script>
         <?php
            if (!isset($_GET['li_class']))
            {
            ?>
         
         
         
         	$(".top-heading").children(".toggler").toggleClass("active");
         
         
         
         	$(".admin-cards.card").slideToggle("slow");
         
         
         
         	EqualHeightAdminCards();
         
         
         
         <?php
            }
            else
            {
                if ($_GET['li_class'] == 'Dashboard')
                {
            ?>
         
         
         
         	$(".top-heading").children(".toggler").toggleClass("active");
         
         
         
         	$(".admin-cards.card").slideToggle("slow");
         
         
         
         	EqualHeightAdminCards();
         
         
         
         <?php
            }
            }
            ?>
         
         
         
         function confirmDelete(anchor)
         
         
         
         {
         
         
         
         	  var conf = confirm('Are you sure want to delete this item?');
         
         
         
         	  if(conf) 
         
         
         
            {
         
         
         
         	  window.location=anchor.attr("href");
         
         
         
         	  }
         
         
         
         }
         
         
         
      </script>
      <script type="text/javascript">
         window.onload = date_time('date_time');
         
         
         
         function date_time(id) {
         
         
         
             var date = new Date().toLocaleString("en-US", {
         
         
         
                 timeZone: "America/New_York"
         
         
         
             });
         
         
         
             date = new Date(date);
         
         
         
             year = date.getFullYear();
         
         
         
             month = date.getMonth();
         
         
         
             // months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
         
         
         
             months = new Array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
         
         
         
             d = date.getDate();
         
         
         
             day = date.getDay();
         
         
         
             days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
         
         
         
             h = date.getHours();
         
         
         
             if (h < 10) {
         
         
         
                 h = "0" + h;
         
         
         
             }
         
         
         
             m = date.getMinutes();
         
         
         
             if (m < 10) {
         
         
         
                 m = "0" + m;
         
         
         
             }
         
         
         
             s = date.getSeconds();
         
         
         
             if (s < 10) {
         
         
         
                 s = "0" + s;
         
         
         
             }
         
         
         
             // result = ''+days[day]+' '+months[month]+'/'+d+'/'+year+'   '+h+':'+m+':'+s;
         
         
         
             result = '' + months[month] + '/' + d + '/' + year + ' (' + h + ':' + m + ':' + s + ')';
         
         
         
             document.getElementById(id).innerHTML = result;
         
         
         
             setTimeout('date_time("' + id + '");', '1000');
         
         
         
             return true;
         
         
         
         }
         
         
         
      </script>					
   </body>
</html>