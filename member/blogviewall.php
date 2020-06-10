<?php
session_start();
//print_r($_SESSION);
if($_SESSION['user_id'] == "" || empty($_SESSION['user_id']))
{
    header('Location: ../logincaamember.php');
}   
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/fonts/font-awesome/fontawesome-all.min.css">
    <link rel="stylesheet" href="./assets/fonts/fonts.css">
    <link rel="stylesheet" href="./assets/css/stylesheet.css">
    <title>index</title>
</head>
<body>
    <div class="wrapper">
	    <header class="header">
        <div class="header-top">
          <div class="container">
            <div class="header-top-inner d-sm-flex justify-content-between align-items-center">
              <div class="header-logo">
                <a href="/member/home.php"><img src="./assets/images/logo2.png" alt="" class="img-fluid"></a>
              </div>
              <div class="header-top-right">
                <p>National Commission for Certification of Anesthesiologist Assistants</p>
              </div>
            </div>
          </div>
        </div>
        <div class="header-bottom">
          <div class="container">
            <div class="header-bottom-inner">
              <div class="heade-menu">
                  <nav class="navbar navbar-expand-md">
                    <div class="header-search">
                      <form class="form-inline position-relative">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <div class="header-search-icon">
                            <i class="fas fa-search"></i>
                        </div>
                      </form>
                    </div>
                    <div class="collapse navbar-collapse" id="navbardropdown">
                      <div class="mobile-logo d-md-none">
                        <a href="#"><img src="./assets/images/logo2.png" alt="" class="img-fluid"></a>
                      </div>
                      <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                          <a class="nav-link" href="home.php">Home</a>
                        </li>
                        <li class="nav-item active">
                          <a class="nav-link" href="blogviewall.php">Blog</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="emailviewall.php">Email</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="cmehistory.php">History</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="homesurvey1.php">Surveys</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link logout-btn" href="logout.php">Log Out</a>
                        </li>
                      </ul>
                    </div>
                    <button class="navbar-toggler pr-0" type="button" data-toggle="collapse" data-target="#navbardropdown" aria-controls="navbardropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                  </nav>
              </div>
            </div>
          </div>
        </div>
    	</header>
    	<section>
        <div class="page-block ncca-section">
          <div class="container">
            <div class="ncca-section-inner">
              <div class="row">
                <div class="col-lg-4 left-side-bar">
                  <div class="page-block block-border page-block-margin">
                    <div class="ncca-left-section page-block">
                      <div class="ncca-profile ncca-left-block">
                          <img src="./assets/images/profile-img.png" alt="" class="img-fluid">
                          <p>Soren Campbell</p>
                          <span>The Christ Hospital</br>2139 Auburn Ave.Cincinnati, OH 45219</span>
                          <a href="#">Edit Profile</a>
                      </div>
                      <div class="ncca-left-info ncca-left-block">
                        <div class="accordion" id="accordionExample">
                            <div class="accorion-header" id="headingOne">
                              <button class="btn btn-link midium-title p-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  NCCA INFO <i class="far fa-question-circle"></i>
                              </button>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="accordion-body">
                                <ul>
                                  <li><b>Employed since: </b> <span>11/18/1999</span></li>
                                  <li><b>Time: </b> <span>10 years/11 months</span></li>
                                  <li><b>Status:</b> <span>CAA</span></li>
                                  <li><b>Certified Through: </b> <span>6/1/2019</span></li>
                                  <li><b>CME Due Date: </b> <span>6/1/2019</span></li>
                                  <li><b>CDQ Due Date: </b> <span>6/1/2020</span></li>
                                </ul>
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="ncca-left-info ncca-left-block">
                        <div class="accordion" id="accordionExample">
                            <div class="accorion-header" id="headingOne">
                              <button class="btn btn-link midium-title p-0" type="button" data-toggle="collapse" data-target="#education_info" aria-expanded="true" aria-controls="education_info">
                                  EDUCATION INFO <i class="far fa-question-circle"></i>
                              </button>
                            </div>
                            <div id="education_info" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="accordion-body">
                                <ul>
                                  <li><b>Graduation: </b> <span>5/11/1997</span></li>
                                  <li><b>School: </b> <span>Univ.of Colorado - Denver </span></li>
                                  <li><b>Year 1: </b> <span>1997</span></li>
                                  <li><b># of Year: </b> <span>17</span></li>
                                  <li><b>Designation: </b> <span>HHSc</span></li>
                                  <li><b>Certificate #: </b> <span>584</span></li>  
                                </ul>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="ncca-contact">
                      <p class="midium-title text-uppercase pb-4">NCCA CONTACT</p>
                      <ul>
                        <li>Cynthia Maraugha</li>
                        <li><a href="#">612-859-4415</a></li>
                        <li><a href="#">cynthia@nccaa.org</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="facebook-icon page-block">
                    <a href="#" class="facebook"><i class="fab fa-facebook-square"></i> <span>Share on facebook</span></a>
                  </div>
                </div>
                <div class="col-lg-8 main-container">
                  <div class="ncca-right-section page-block">
                    <div class="ncca-right-block block-border ncca-right-padding page-block-margin">
                      <div class="row">
                        <div class="col-sm-6 pr-0 jk-60">
                          <div class="ncca-welcome">
                            <h3 class="big-title">Welcome back, Soren.</h3>
                            <p>
                              NCCAA Internal Email:
                              <a href="#">soren.campbell@nccaa.org</a>
                            </p>
                          </div>
                        </div>
                        <div class="col-6 col-sm-3 jk-20">
                          <div class="mail-status">
                            <h2 class="big-title">4</h2>
                            <p>Unread mails</p>
                            <a href="#" class="text-blue">Click here</a>
                          </div>
                        </div>
                        <div class="col-6 col-sm-3 jk-20">
                          <div class="mail-status">
                            <h2 class="big-title">4</h2>
                            <p>Unread posts</p>
                            <a href="#" class="text-blue">Click here</a>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="ncca-reminders">
                            <div class="accordion" id="accordionExample">
                                <div class="accorion-header" id="headingOne">
                                  <button class="btn btn-link midium-title text-uppercase p-0" type="button" data-toggle="collapse" data-target="#reminder_accordion" aria-expanded="true" aria-controls="reminder_accordion">REMINDERS</button>
                                </div>
                                <div id="reminder_accordion" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                  <div class="accordion-body">
                                    <ul>
                                      <li class="dots-pink"><span>You have completed only 10% of your profile</span> <a href="#" class="text-blue">Click here</a></li>
                                      <li class="dots-green"><span>"New Blog Posts Name" has been published today.</span><a href="#" class="text-blue">Click here</a></li>
                                    </ul>
                                  </div>
                                </div>
                            </div> 
                          </div>
                        </div>
                      </div>
                    </div>
                  <div class="ncca-right-block cme-block-main">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="page-block block-border page-block-margin">
                            <div class="cme-block-head ncca-right-padding">
                              <p class="midium-title text-uppercase">CME</p>
                              <b>Deadline:</b>
                              <span>June 1, 2019 - only 25 weeks left to register</span>
                            </div>
                            <div class="cme-block-bottom page-block">
                              <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link  text-blue" href="cmehistory.php">History</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link text-blue" href="cmeadd.php">Add CME</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link text-blue" id="contact-tab" data-toggle="tab" href="#" role="tab" aria-controls="contact" aria-selected="false">NCCAA CMEs</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="page-block block-border page-block-margin">
                            <div class="cme-block-head ncca-right-padding">
                              <p class="midium-title ">CDQ Exam</p>
                              <b>Deadline:</b>
                              <span>June 1, 2020 - only 18 months left to register</span>
                            </div>
                            <div class="cme-block-bottom page-block">
                              <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link text-blue" href="cdqhistory.php" role="tab">History</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link text-blue" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">NCCAA Prep Course</a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="ncca-right-block ">
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                          <div class="blog-main block-border ncca-right-padding">
                            <p class="midium-title title-bottom-border text-uppercase">BLOG
                              <span class="blog-like">282 likes</span>
                            </p>
                            <div class="blog-main-container">
                              <h1 class="blog-title">Headline of the Blog</h1>
                              <div class="author-time row">
                                <div class="col-9">
                                  <img src="./assets/images/profile-img.png" alt="" class="img-fluid">
                                  <span class="author-name"><h4>Soren Campbell</h4><p>NCCAA Director</p></span>
                                </div>
                                <div class="col-3 text-right">
                                  <p class="post-time">12/17/2018</p>
                                </div>
                              </div>
                              <div class="blog-content">
                                <p>In this article, I have included a whole load of blog examples from a wide variety of different niches.</p>
                                <p>Since the beginning of the internet, millions and millions and millions of blogs have been created. Many have died due to lost interest or their owners giving up on the idea, while others have thrived and continue to grow, making money and earning their owners a steady income. It's a constant evolution of content that keeps people coming back for more. especially if these blogs contact highly resourceful material that people find useful and interesting.</p>
                                <p>Each example listed in this blog post are all different in some way and all bring something
                                unique to their readers & subscribers. I want to show you what is possible and how you can
                                take inspiration from them and create an awesome blog of your own.</p>
                                <p>Some of these blogs make over $100k a month. others are just a hobby for their owners, but
                                all have the same purpose at their core... the love of writing and sharing information.</p>
                                <p>Since the beginning of the inteniet. millions and millions and millions of blogs have been
                                created. Many have died due to lost interest or their owners giving up on the idea, while
                                others have thrived and continue to grow, making money and earning their owners a steady
                                income. It's a constant evolution of content that keeps people coming back for more,
                                especially if these blogs contact highly resourceful material that people ﬁnd useful and
                                interesting.</p>
                                <p class="center"><img src="./assets/images/Screenshot_18.png"><span class="img-comment">comment on the picture</span></p>
                                <p>Each example listed in this blog post are all different in some way and all bring something
                                unique to their readers 8. subscribers. I want to show you what is possible and how you can
                                take inspiration from them and create an awesome blog of your own.</p>
                                <p>Some of these blogs make over $100k a month, others are just a hobby for their owners, but
                                all have the same purpose at their core... the love of writing and sharing information.</p>
                              </div>
                              <div class="blog-footer row">
                                <div class="col-sm-6"><span style="line-height: 33px;font-weight: 600;color: #777">Was this article helpful?</span></div>
                                <div class="col-sm-6 text-right"><span style="line-height: 33px;color:#e83e8c;font-weight: 600;padding-right: 30px;">No, it wasn't helpful.</span><span><button class="btn btn-blue helpful">Yes, thank you.</button></span></div>
                              </div>
                            </div>
                          </div>
                          <div class="block-border ncca-right-padding blog-main-footer">
                            <div class="row">
                              <div class="col-6"><a href="#"><span class="before-article"><img src="./assets/images/move.png"></span><span class="d-hidden">"Name of this article"</span></a></div>
                              <div class="col-6 text-right"><a href="#"><span class="d-hidden">"Name of this article"</span><span class="next-article"><img src="./assets/images/move.png"></span></a></div>
                            </div>
                          </div>
                        </div>     
                    </div>
                  </div>
                </div>
              </div>
            </div>  
          </div>
        </div>
      </section>		
    	<footer class="footer">
      </footer>
    </div>
<script src="./assets/js/jquery.min.js" type="text/javascript"></script>
<script src="./assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="./assets/js/script.js" type="text/javascript"></script>
<div class="modal fade modal-form" id="all-modal"  role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="margin-left:10px">SEARCH RESULTS</h4>
            </div>
            <div class="modal-body search-form pt-0">

<!-- Classic tabs -->
<div class="classic-tabs">
<div class="tab-lite">
<ul role="tablist" class="nav nav-tabs" id="modal-tabs">
    <li class=" active">
      <a class=" " data-toggle="tab" href="#tab-certificates" onClick="tab_click('certificates');" >Certificates</a>
    </li>
    
    <li class=" ">
      <a class=" " data-toggle="tab" href="#tab-caas" onClick="tab_click('caas');"  >Find CAAs</a>
    </li>
    <li class="">
      <a class=" " data-toggle="tab" href="#tab-employers"  onClick="tab_click('employers');" >Employers</a>
    </li>
    <li class="">
      <a class="nav-link " data-toggle="tab" href="#tab-programs" onClick="tab_click('programs');" >Programs</a>
    </li>
</ul>
  
  <div class="tab-content p-3" id="myClassicTabContent" style="" >
<div class="tab-pane fade active in" id="tab-certificates" >
  <form class="form-horizontal" action="" id="certificates-form">
<div class="form-group">
  <label for="" class="col-sm-4 control-label ">First Name</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="f_name" class="form-control" placeholder="First Name" />
    </div>
</div>
<div class="form-group">
  <label for="" class="col-sm-4 control-label ">Last Name</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
      <input type="text" name="l_name" class="form-control" placeholder="Last Name"  />
    </div>
</div>    

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">City</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="city" class="form-control" placeholder="City" />
    </div>
</div>

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">State</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="state" class="form-control" placeholder="State" />
    </div>
</div>

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">Zip</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="zip" class="form-control" placeholder="Zip" />
    </div>
</div>
<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">Employer</label>
  <div class="col-sm-8 field-box mb-3 mb-sm-0">
    <input type="text" name="employer" class="form-control" placeholder="Employer" />
  </div>
</div>
<div class="form-group">
<div class="col-sm-12 mb-3 mb-sm-0">
<button class="btn btn-primary btn-block">Search</button>
</div>
</div>

</form>
  <iframe src="" class="certificates-iframe tab-iframe"  id="certificates-iframe" ></iframe>
</div>  
<div class="tab-pane fade " id="tab-caas" >
  <form class="form-horizontal" action="caas" id="caas-form">
<div class="form-group">
  <label for="" class="col-sm-4 control-label ">First Name</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="f_name" class="form-control" placeholder="First Name" />
    </div>
</div>
<div class="form-group">
  <label for="" class="col-sm-4 control-label ">Last Name</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
      <input type="text" name="l_name" class="form-control" placeholder="Last Name"  />
    </div>
</div>    

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">Address</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="address" class="form-control" placeholder="Address" />
    </div>
</div>

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">City</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="city" class="form-control" placeholder="City" />
    </div>
</div>

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">State</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="state" class="form-control" placeholder="State" />
    </div>
</div>

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">Zip</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="zip" class="form-control" placeholder="Zip" />
    </div>
</div>

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">Phone</label>
  <div class="col-sm-8 field-box mb-3 mb-sm-0">
    <input type="text" name="phone" class="form-control" placeholder="Phone" />
  </div>
</div>

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">Email</label>
  <div class="col-sm-8 field-box mb-3 mb-sm-0">
    <input type="text" name="email" class="form-control" placeholder="Email" />
  </div>
</div>
<div class="form-group">
<div class="col-sm-12 mb-3 mb-sm-0">
<button class="btn btn-primary btn-block">Search</button>
</div>
</div>

</form>
  <iframe src="" class="caas-iframe tab-iframe"  id="caas-iframe" onload="AdjustIframeHeightOnLoad()"></iframe>
</div><!--caas search-->

    <div class="tab-pane fade" id="tab-employers">
<form class="form-horizontal" action="employers" id="employers-form">
<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">Eemployer Name</label>
        <div class="col-sm-8 ">
            <input type="text" name="name" class="form-control" placeholder="Employer Name" />
        </div>
</div>    

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">Address</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="address" class="form-control" placeholder="Address" />
    </div>
</div>

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">City</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="city" class="form-control" placeholder="City" />
    </div>
</div>

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">State</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="state" class="form-control" placeholder="State" />
    </div>
</div>

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">Zip</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="zip" class="form-control" placeholder="Zip" />
    </div>
</div>

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">Phone</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="phone" class="form-control" placeholder="Phone" />
    </div>
</div>

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">Email</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="email" class="form-control" placeholder="Email" />
    </div>
</div>



<div class="form-group">
    <div class="col-sm-12 mb-3 mb-sm-0">
  <button class="btn btn-primary btn-block">Search</button>
    </div>
</div>

</form>
  <iframe src="" class="employers-iframe tab-iframe"  id="employers-iframe" ></iframe>

    </div>
    <div class="tab-pane fade" id="tab-programs" >
<!--<form class="form-horizontal" action="" id="programs-form">
<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">Program Name</label>
    <div class="col-sm-8 ">
      <input type="text" name="name" class="form-control" placeholder="Program Name"  />
    </div>
</div>    

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">City</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="city" class="form-control" placeholder="City" />
    </div>
</div>

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">State</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="state" class="form-control" placeholder="State" />
    </div>
</div>

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">Zip</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="zip" class="form-control" placeholder="Zip" />
    </div>
</div>


<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">Alumni</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
        <input type="text" name="alumni" class="form-control" placeholder="Alumni" />
    </div>
</div>

<div class="form-group">
  <label for="staticEmail" class="col-sm-4 control-label ">Class</label>
    <div class="col-sm-8 field-box mb-3 mb-sm-0">
<select name="classes" class="form-control">
<option value="">Select</option>
<?php
for($i=date('Y');$i>=1980;$i--){
?>
<option value="<?=$i?>"><?=$i?></option>
<?php 
}
?>
</select>
    </div>
</div>



<div class="form-group">
    <div class="col-sm-12 mb-3 mb-sm-0">
  <button class="btn btn-primary btn-block">Search</button>
    </div>
</div>

</form>-->
  <iframe src="" class="programs-iframe tab-iframe" style="display:block"  id="programs-iframe" ></iframe>

    </div>
    
  </div>
</div>

</div>
<!-- Classic tabs -->            
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!--all-->
<?php include 'survey-modal.php'; ?>
</body>
</html>
