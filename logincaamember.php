<?php

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off" || $_SERVER["HTTPS"] != "on") {

	

    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	

    header('HTTP/1.1 301 Moved Permanently');

	

    header('Location: ' . $location);

	

    exit;

}

if (empty($_SESSION['user_id']) == true) {

  ?>

  <!DOCTYPE html>

  <html lang="en">

  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    

    <title>NCCAA</title>

    <meta name="viewport"

          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">

      <link rel="stylesheet" type="text/css" href="assets/frontends/styles/bootstrap/bootstrap.css">

      <link rel="stylesheet" type="text/css" href="assets/frontends/styles/responsive.css">


    <link rel="stylesheet" href="style.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-159328273-1"></script>

    <script>

      window.dataLayer = window.dataLayer || [];

      function gtag(){dataLayer.push(arguments);}

      gtag('js', new Date());



      gtag('config', 'UA-159328273-1');

</script>

  </head>

  <body>

  <div id="wrapper">

    <header id="header">

      <div class="container">

        <div class="logo"><a href="/"><img src="images/logo.png" alt=""/></a></div>

        <h2>National Commission for Certification of Anesthesiologist Assistants</h2>

      </div>

    </header><!--close header-->



    <div id="content">

      <div class="content-inner">

        <h1>CAA MEMBER PROFILE</h1>

        <?php if (!empty($_REQUEST['email'])) {

          echo "<h5>NCCAA member's user name email and temporary password has automatically been populated in the fields below. After the Login button has been selected, you will be asked to create a permanent password. Please keep this new password handy and in a safe place</h5>";

        } ?>

        <form class="modal-content animate" action="member/user/login-process.php" method="POST">

          <div class="form-sec">

            <div id="login-sec">

              <div class="form-row">

                <label>Email/Username</label>

                <input type="email" class="form-input" name="uname" "soren.campbell@nccaa.com"

                value="<?php if (!empty($_REQUEST['email'])) {

                  echo $_REQUEST['email'];

                } ?>">

                <?php if (isset($_GET['errorCode']) && $_GET['errorCode'] == 103) { ?>

                  <span class="error-msg">Please enter valid email and password</span>

                <?php } ?>

              </div>

              <div class="form-row">

                <label>Password</label>

                <input type="password" class="form-input" name="psw" "***********" value="" >

                <input type="hidden" class="form-input" name="check_admin" value="<?php if(isset($_GET['checkAdmin'])) echo $_GET['checkAdmin'];?>" >

              </div>

            </div>

            <div class="form-row">

              <a class="forgot-btn" id="forgot_btn" href="#">Forgot Your Password? (Click here)</a>

              <!--a class="forgot-btn" style="cursor: not-allowed" href="#">Forgot Your Password?</a-->

            </div>

            <?php if (isset($_GET['errorCode']) && $_GET['errorCode'] == 205) { ?>

              <h4 class="success-msg" style="color: #4CAF50;">E-mail sent successfully.</h4>

            <?php } ?>

            <div class="forgot-pass" id="forgot_pass">

              <div class="form-row">

                <label>Your previous password was not transferred to this site. Enter the email address on file with NCCAA. If forgotten, try several emails you think are correct. (Don't forget to check your Spam folder)</label>

                

                <?php if (isset($_GET['errorCode']) && $_GET['errorCode'] == 106) { ?>

                  <span class="error-msg">We're sorry, but that email is not on file. Please try again.</span>

                <?php } ?>

              </div>

              <div class="form-row">

                <label>Enter your email address</label>

                <input type="text" class="form-input" name="email_forgot_pass" value="">

              </div>

              <input type="hidden" class="form-input" id="os_info" name="os_info" value=""/>

              <input type="hidden" class="form-input" id="browser_info" name="browser_info" value=""/>

              <div class="send-row">

                <input type="submit" class="form-submit" name="forget" value="Send Password (Check your Spam folder)">

              </div>

            </div>

            <div class="submit-row" id="signin_btn">

              <input type="submit" class="form-submit" name="login" value="Sign in to your account">

            </div>

          </div>

        </form>

        <div class="footer">

          <ul>

            <li><a href="./errorsubmission.php">Error Submit</a></li>

            <li style="cursor: pointer" onclick="showConditionModal()"><a>Conditions of Use</a></li>
<!-- data-toggle="modal" data-target="#myPrivacy"-->
            <li style="cursor: pointer" onclick="showPrivacyModal()"><a>Privacy Notice</a></li>

            <!--<li><a href="#">Help</a></li>-->

          </ul>

        </div>

      </div>

    </div><!--close content-->

  </div><!--close wrapper-->

<!-- Serhii -->
  <div class="modal fade page-modal in" id="condition-modal" role="dialog" style="display: none;">

      <div class="modal-dialog" role="document">

          <div class="modal-content">

              <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                  <h4 class="modal-title" style="">Condition of Use</h4>

              </div>

              <div class="modal-body ">

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title title-italic">Last Updated: June 1, 2016</h4>

                              <div class="u-desc">
                                  <p>
                                      Welcome to the NCCAA website located at <a href="https://www.nccaa.org">www.nccaa.org</a> (the “Site”). In these Terms of Use, the terms “we,” “us,” or “our” refer to NCCAA, and the terms “you” and “your” refer to you as a visitor to the Site.
                                  </p>
                                  <br/>
                                  <p>
                                      These Terms of Use constitute a binding legal contract between you and us and set forth the terms that govern your access to and use of the Site. When using the Site, you may be subject to other posted guidelines, rules or agreements applicable to certain features or areas of the Site, or to certain application processes that may be initiated via our site (such as membership and certification applications). All such guidelines, rules and agreements are part of these Terms of Use. Accessing the Site in any manner, even through automated means, constitutes your use of the Site and your agreement to be bound by these Terms of Use.
                                  </p>
                                  <br/>
                                  <p>
                                      We reserve the right to modify these Terms of Use in the future as we deem necessary. If we do modify these Terms of Use, we will post the updated Terms of Use on this Site and change the “Last Updated” date above to reflect the date of the changes. By continuing to use the Site after we post any such changes, you accept the Terms of Use as modified.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">PRIVACY</h4>

                              <div class="u-desc">
                                  <p>
                                      We respect the privacy of the users of our Site. Please take a moment to review our Privacy Policy
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">RIGHTS AND RESTRICTIONS RELATING TO SITE CONTENT</h4>

                              <div class="u-desc">
                                  <p>
                                      <span class="bold-span">License Grant.</span> We may provide via the Site information, data, text, images and other materials created by us or our licensors or uploaded to the Site by our members, other users and/or third party partners (the “Content”). The Content available through this Site is our property or the property of our members, other users, third party partners and/or licensors, and is protected by state, national and international copyright, trademark and other intellectual property laws. Unless otherwise specified or authorized by us, the Site is intended for your personal, noncommercial use only. You may not modify, copy, reproduce, republish, upload, post, transmit or distribute in any way any Content from the Site without our authorization. If you download material from the Site for your personal, non-commercial use, you must keep intact all copyright and other proprietary notices. You may not otherwise reproduce or distribute any of the Content of the Site without our prior authorization. Of course, you’re free to encourage others to access the information themselves on our Site and to tell them how to find it.
                                  </p>
                                  <br/>
                                  <p>
                                      <span class="bold-span">Trademarks.</span> The NCCAA trademarks and service marks that appear on the Site are the property of NCCAA. You agree not to display or use in any manner any such marks or names without our prior permission.
                                  </p>
                                  <br/>
                                  <p>
                                      <span class="bold-span">Linking and Framing.</span> You may establish a hypertext link to this Site, including display of Site RSS feeds, so long as the link does not state or imply any sponsorship of, or affiliation with, your site by us. However, you may not, without our prior permission, frame any of the content of the Site, or incorporate into another website or other service any material or content belonging to us or any of our licensors.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">NCCAA MEMBERSHIP/RESTRICTED ACCESS AREA</h4>

                              <div class="u-desc">
                                  <p>
                                      While some areas of our Site are available to the public, many of the features and services that are available on the Site are made available only to NCCAA members (the “Restricted Access Areas”). If you (or your institution, agency or organization) are not an NCCAA member but would like to join, you can request membership by visiting the “Join NCCAA” section of the Site and completing the membership application for the category of membership you seek. The NCCAA membership form will require you to submit certain personally identifying information, such as billing information and general contact information. Your membership application may be reviewed by us before access to the Restricted Access Areas is granted.
                                  </p>
                                  <br/>
                                  <p>
                                      You agree to provide true, accurate, current and complete information about yourself (and/or your institution, agency, or organization) as prompted by the applicable application form. If we suspect that any information you have submitted is untrue, inaccurate or incomplete, we reserve the right to suspend or terminate your membership and to refuse any and all current or future use of the Site (or any portion thereof). Our use of any personally identifiable information you provide to us as part of the application process is governed by the terms of our Privacy Policy.
                                  </p>
                                  <br/>
                                  <p>
                                      As part of the membership application process, you also will be asked to create a username and password for access to the Restricted Access Areas of the Site. We reserve the right to reject or terminate the use of any username that we deem offensive or inappropriate. You will have the opportunity to change your password by logging in to the Restricted Access Areas of our Site and clicking on “Update Your Details/Change Password.” You are responsible for maintaining the confidentiality of your username and password, and are responsible for all activities (whether by you or by others) that occur under your member account. You agree to notify us immediately of any unauthorized use of your username, password or account or any other breach of security relating to our Site, and to ensure that you log out from your member account at the end of each browsing session.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">RESPONSIBILITY FOR USER-SUBMITTED CONTENT</h4>

                              <div class="u-desc">
                                  <p>
                                      Our Site may include interactive features, such as discussion groups, comment fields, and other features that allow NCCAA members and other Site users to post content and materials for display on the Site. You will be solely responsible for any and all content and materials of whatever nature that you post on, transmit to or link to from the Site. You agree to indemnify and hold NCCAA and its agents, representatives, directors, officers, employees and licensors, harmless from any liability of any nature arising out of or related to any content or materials submitted to or displayed on the Site by you or by others accessing your member account. 
                                  </p>
                                  <br/>
                                  <p>
                                      By submitting material to the Site, you represent that you are the owner of the material, or are making your submission with the express consent of the owner, and you grant us, our partners, agents, representatives, and service providers, the worldwide, royalty free, perpetual, irrevocable, non-exclusive and fully sublicensable right and license to use, reproduce, modify, disclose, distribute, adapt, broadcast, translate, create derivative works from, perform and publish such material (in whole or in part) on the Site, or otherwise, and/or to incorporate it into other works in any form, media or technology now known or later developed. You also agree that we may identify you as the author of any of your postings by name, email address or username as we deem appropriate.
                                  </p>
                                  <br/>
                                  <p>
                                      You agree not to use any portion of this Site to post or otherwise make available any content or material or, as applicable, to engage in any conduct or activity:
                                  </p>
                                  <ul class="list">
                                      <li>
                                          <img src="./assets/images/black-circle.svg" class="li-dot"/>that is profane, sexually explicit, tortious, vulgar, obscene, libelous, abusive, or unlawful, or infringes the rights of others or interferes with the ability of others to access or use the Site;
                                      </li>
                                      <li>
                                          <img src="./assets/images/black-circle.svg" class="li-dot"/>that harasses, degrades, intimidates or is hateful toward an individual or group of individuals on the basis of religion, gender, sexual orientation, race, ethnicity, age, or disability;
                                      </li>
                                      <li>
                                          <img src="./assets/images/black-circle.svg" class="li-dot"/>that impersonates any person or entity, including, but not limited to, a Site administrator or another member or user, or that falsely states or otherwise misrepresents your affiliation with a person or entity;
                                      </li>
                                      <li>
                                          <img src="./assets/images/black-circle.svg" class="li-dot"/>that includes personal or identifying information about another person without that person’s explicit consent;
                                      </li>
                                      <li>
                                          <img src="./assets/images/black-circle.svg" class="li-dot"/>that is false, deceptive, misleading, or deceitful;
                                      </li>
                                      <li>
                                          <img src="./assets/images/black-circle.svg" class="li-dot"/>that infringes any copyright, patent, trademark, trade secret or other rights of any party;
                                      </li>
                                      <li>
                                          <img src="./assets/images/black-circle.svg" class="li-dot"/>that is false, deceptive, misleading, or deceitful;
                                      </li>
                                      <li>
                                          <img src="./assets/images/black-circle.svg" class="li-dot"/>that infringes any copyright, patent, trademark, trade secret or other rights of any party;
                                      </li>
                                      <li>
                                          <img src="./assets/images/black-circle.svg" class="li-dot"/>that you do not have a right to make available under any law or under contractual or fiduciary relationships (such as inside information, proprietary and confidential information learned or disclosed as part of employment relationships or under nondisclosure agreements);
                                      </li>
                                      <li>
                                          <img src="./assets/images/black-circle.svg" class="li-dot"/>that constitutes or includes unsolicited or unauthorized advertising, promotional materials, “spam,” “chain letters,” “pyramid schemes,” or any other form of solicitation; or
                                      </li>
                                      <li>
                                          <img src="./assets/images/black-circle.svg" class="li-dot"/>that interferes with or disrupts the Site or servers or networks connected to the Site, or disobeys any requirements, procedures, policies or regulations of networks connected to the Site.
                                      </li>
                                  </ul>
                                  <p>
                                      We have the right (but not the obligation), in our sole discretion, to screen content and materials submitted by Site users and to edit, move, delete, and/or refuse to accept any materials that in our judgment violate these Terms of Use or are otherwise unacceptable or inappropriate, whether for legal or other reasons. You acknowledge and agree that we may preserve content and materials submitted by you, and may also disclose such content and materials if required to do so by law or if, in our business judgment, such preservation or disclosure is reasonably necessary: (a) to comply with legal process; (b) to enforce these Terms of Use; (c) to respond to claims that any content or materials submitted by you violate the rights of third parties; or (d) to protect the rights, property, or personal safety of our Site, our Site visitors, NCCAA members, us, our officers, directors, staff, representatives, and/or the public.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">FINANCIAL TRANSACTIONS</h4>

                              <div class="u-desc">
                                  <p>
                                      This Site may (now or in the future) offer the ability for you to submit payment for membership fees, NCCAA Certification fees, or other services or features offered by NCCAA. You (and the institution, agency or organization on whose behalf you are acting) agree to be financially responsible for all purchases made by you or someone acting on your behalf through the Site. You agree to only to make purchases for yourself or for a person, institution, agency, or organization on whose behalf you are legally permitted to do so. If you make a purchase for a third party that requires you to submit such party’s personal information to us, you represent that you have obtained the express consent of such party to provide that personal information.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">SUSPENSION AND TERMINATION OF ACCESS</h4>

                              <div class="u-desc">
                                  <p>
                                      You agree that, in our sole discretion, we may suspend or terminate your password, account (or any part thereof) or use of the Site, and remove and discard any materials that you submit to the Site, for any reason, including, without limitation, if we believe that you have violated or acted inconsistently with the letter or spirit of these Terms of Use. You agree that we will not be liable to you or any third-party for any suspension or termination of your password, account or use of the Site, or any removal of any materials that you have submitted. In the event that we suspend or terminate your access to and/or use of the Site, you will continue to be bound by the Terms of Use that were in effect as of the date of your suspension or termination.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">LINKS TO THIRD-PARTY SITES</h4>

                              <div class="u-desc">
                                  <p>
                                      Our Site may include links to websites offered or maintained by third parties. Linking to such third-party sites does not imply an endorsement or sponsorship of such sites, or the information, products or services offered on or through the sites. Because we have no control over such websites, you acknowledge and agree that we are not responsible for the availability of such external websites, and are not responsible or liable for any content, including, without limitation, advertising, products, or other materials, on or available from such sites.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">USE OF CONTACT INFORMATION</h4>

                              <div class="u-desc">
                                  <p>
                                      Any and all contact information that is displayed on the Site, including the information contained in any member directories or other directories that may be provided on the Site, is provided for informational purposes only and is not to be used for marketing, telemarketing or solicitation purposes, regardless of whether such marketing, telemarketing or solicitation is commercial, non-commercial, charitable or political in nature.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>


                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">DISCLAIMERS AND LIMITATIONS OF LIABILITY</h4>

                              <div class="u-desc">
                                  <p>
                                      <span class="bold-span">No Warranties.</span> YOUR USE OF THE SITE IS AT YOUR SOLE RISK. THIS SITE AND ALL MATERIALS, INFORMATION AND SERVICES AVAILABLE THROUGH IT ARE PROVIDED ON AN “AS IS” AND “AS AVAILABLE” BASIS. WE, OUR AGENTS, REPRESENTATIVES, DIRECTORS, OFFICERS, EMPLOYEES AND LICENSORS CANNOT AND DO NOT WARRANT THE ACCURACY, COMPLETENESS, CURRENTNESS, NONINFRINGEMENT, MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE OF THE MATERIALS, INFORMATION AND SERVICES AVAILABLE THROUGH THE SITE, NOR DO WE GUARANTEE THAT THE MATERIALS, INFORMATION OR SERVICES WILL BE ERROR-FREE, SECURE OR CONTINUOUSLY AVAILABLE, OR FREE OF VIRUSES OR OTHER HARMFUL COMPONENTS. WE MAKE NO WARRANTY THAT (I) THE SITE WILL MEET YOUR REQUIREMENTS, (II) THE RESULTS THAT MAY BE OBTAINED FROM THE USE OF THE SITE WILL BE ACCURATE OR RELIABLE, (III) THE QUALITY OF ANY PRODUCTS, SERVICES, INFORMATION, OR OTHER MATERIAL PURCHASED OR OBTAINED BY YOU THROUGH THE SITE WILL MEET YOUR EXPECTATIONS, OR (IV) ANY ERRORS IN THE SITE WILL BE CORRECTED. IF YOU DOWNLOAD OR OTHERWISE OBTAIN ANY MATERIAL(S) THROUGH THE SITE YOU DO SO AT YOUR OWN DISCRETION AND RISK AND YOU WILL BE SOLELY RESPONSIBLE FOR ANY DAMAGE TO YOUR COMPUTER SYSTEM OR LOSS OF DATA THAT MAY RESULT. Finally, we are not responsible for the conduct, whether online or offline, of any user of the Site.
                                  </p>
                                  <br/>
                                  <p>
                                      <span class="bold-span">Indemnity. </span>You agree to indemnify and hold NCCAA and its agents, representatives, directors, officers, employees and licensors, harmless from any claim or demand, including reasonable attorneys’ fees related to such claim or demand, made by any third party due to or arising out of your use of the Site, your violation of our Terms of Use, or your violation of any rights of another.
                                  </p>
                                  <br/>
                                  <p>
                                      <span class="bold-span">Limitation of Liability.</span> UNDER NO CIRCUMSTANCES WILL WE OR OUR AGENTS, REPRESENTATIVES, DIRECTORS, OFFICERS, EMPLOYEES OR LICENSORS BE LIABLE TO YOU OR ANYONE ELSE FOR ANY DAMAGES, INCLUDING, WITHOUT LIMITATION, LIABILITY FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL OR EXEMPLARY DAMAGES, INCLUDING BUT NOT LIMITED TO, DAMAGES FOR LOSS OF PROFITS, GOODWILL, USE, DATA OR OTHER INTANGIBLE LOSSES, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES, RESULTING FROM (A) YOUR USE OF, OR INABILITY TO USE, THE SITE, OR (B) ANY MATERIALS, INFORMATION AND SERVICES AVAILABLE THROUGH THE SITE. (BECAUSE SOME STATES DO NOT ALLOW THE EXCLUSION OR LIMITATION OF CERTAIN CATEGORIES OF DAMAGES, THE ABOVE LIMITATION MAY NOT APPLY TO YOU. IN WHICH CASE OUR LIABILITY AND THE LIABILITY OF OUR AGENTS, REPRESENTATIVES, DIRECTORS, OFFICERS, EMPLOYEES AND LICENSORS IS LIMITED TO THE FULLEST EXTENT PERMITTED BY SUCH STATE LAW.)
                                  </p>
                                  <br/>
                                  <p>
                                      Your interactions with companies, organizations and/or individuals found on or through our Site are solely between you and such companies, organizations and/or individuals. We will not be responsible or liable for any loss or damage of any sort incurred as the result of any such dealings and, if there is a dispute between users, or between a user and a third party, we are not obligated to become involved.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">MISCELLANEOUS</h4>

                              <div class="u-desc">
                                  <p>
                                      We reserve the right at any time and from time to time to modify or discontinue, temporarily or permanently, the Site (or any part thereof) with or without notice. These Terms of Use will be governed by and construed in accordance with the laws of the District of Columbia, United States, without regard to its conflict of laws provisions. By using this Site, you agree to submit to the personal and exclusive jurisdiction of the courts located within the District of Columbia in all disputes or proceedings arising out of or relating to these Terms of Use or your use of the Site. Our failure to exercise or enforce any right or provision of these Terms of Use will not constitute a waiver of such right or provision. If any provision of these Terms of Use is found by a court of competent jurisdiction to be invalid, the parties agree that the court should endeavor to give effect to the parties’ intentions as reflected in the provision, and the other provisions of the Terms of Use will remain in full force and effect. These Terms of Use are not intended to benefit any third party, and may only be invoked or enforced by you or us. This agreement is personal to you and you may not assign it to anyone. You agree that regardless of any statute or law to the contrary, any claim or cause of action arising out of or related to use of the Site or these Terms of Use must be filed within one year after such claim or cause of action arose or be forever barred.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

              </div>

          </div><!-- /.modal-content -->

      </div><!-- /.modal-dialog -->

  </div>

  <div class="modal fade page-modal in" id="privacy-modal" role="dialog" style="display: none;">

      <div class="modal-dialog" role="document">

          <div class="modal-content">

              <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                  <h4 class="modal-title" style="">Privacy Notice</h4>

              </div>

              <div class="modal-body ">

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title title-italic">Last Updated: June 1, 2016</h4>

                              <div class="u-desc">
                                  <p>
                                      This Privacy Policy discloses the privacy practices for the NCCAA website located at <a href="https://www.nccaa.org">www.nccaa.org</a> (the “Site”). In this Privacy Policy, the terms “we,” “us,” or “our” refer to NCCAA, and the terms “you” and “your” refer to you as a visitor to the Site.
                                  </p>
                                  <p>
                                      This Privacy Policy governs our collection of information from you through your use of this Site. It does not apply to any information you may provide to us, or that we may collect, offline and/or through other means (for example, information gathered via mail or telephone). By visiting and using this Site, you agree that your use of this Site, and any disputes over our online privacy practices, will be governed by this Privacy Policy and or Terms of Use.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">TYPES OF INFORMATION NCCAA COLLECTS</h4>

                              <div class="u-desc">
                                  <p>The types of information collected on our Site are described below.
                                      This information may be collected directly by us, or it may be collected by our third party website hosting provider, or
                                      another service provider, on our behalf. No personally identifiable information (such as your name, address, email address,
                                      or telephone number) is automatically collected via our Site; personally identifiable information about Site users is collected only
                                      when it is knowingly and voluntarily submitted by Site visitors.
                                  </p></div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">INFORMATION YOU VOLUNTARILY PROVIDE</h4>

                              <div class="u-desc">
                                  <p>We may collect and store information, personal or otherwise, that you voluntarily supply to us while on our Site. Some examples of this type of information include information that you submit electronically when you contact us with questions or request email updates or RSS feeds, and information you post on public posting areas on our Site (such as the comment feature for news articles and updates). We may also ask for information (including a credit or debit card number) from those who pay for an NCCAA membership, pay NCCAA Certification fees, or conduct other transactions on our Site.</p>
                                  <br/>
                                  <p>
                                      This category of information also includes information that you electronically submit when you submit an NCCAA membership application, or an NCCAA Certification application, via our Site. All information voluntarily supplied by you via our Site as part of the NCCAA membership application process and/or the NCCAA Certification process will be collected and stored by us in accordance with the terms of this Privacy Policy.
                                  </p>
                                  <br/>
                                  <p>
                                      While some areas of our Site are available to the public, many of the features and services that are available on the Site are made available only to NCCAA members (the “Restricted Access Areas”). If you (or your institution, agency or organization) are not an NCCAA member but would like to join, you can request membership by visiting the “Join NCCAA” section of the Site and completing the membership application for the category of membership you seek. The NCCAA membership form will require you to submit certain personally identifying information, such as billing information and general contact information. As part of the membership application process, you also will be asked to create a username and password for access to the Restricted Access Areas of the Site. When you log in to the Restricted Access Areas, you will have the option of providing additional information to complete your (or your institution’s, agency’s or organization’s) member profile. We may also give you the option of making your member profile visible to other registered NCCAA members. The more information you provide, the more valuable your member profile will be to other members who wish to know more about you as an NCCAA member.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">INFORMATION THAT IS AUTOMATICALLY COLLECTED</h4>

                              <div class="u-desc">
                                  <p>We also may collect and store non-personally identifiable information that is generated automatically as you navigate through our Site. For example, our Site’s servers may automatically collect limited information about your computer's connection to the Internet, including your computer’s IP address. The IP address is a number that lets computers attached to the Internet know where to send data - such as the web pages users view. Your IP address does not tell us who you are. We use this information to deliver the Site’s content to you upon request and to measure traffic within the Site. Our Site’s servers also may log information such as the type of web browser software you use to access the Site, the operating system running on your computer, and the speed of your computer’s CPU, for purposes of measuring traffic patterns on the Site and the usage of Site services and features and optimizing the Site to accommodate our users. This information is not correlated with any personally identifying information you may provide.</p>
                                  <br/>
                                  <p>
                                      We may at times also use a standard feature found in browser software called a "cookie" to enhance your experience with the Site. Cookies are small files that your web browser places on your hard drive for record-keeping purposes. By showing how and when visitors and members use the Site, cookies help us identify how many unique users visit us and track user interests, trends and patterns. They also prevent you from having to re-enter your preferences on certain areas of the site where you may have entered preference information before. For example, if you are an NCCAA member, and you select the “Remember Me” option when you log in to the Member Areas, we can use cookies to recognize you so you won’t need to reenter your username and password the next time you visit the Site). Of course, you are free to set your web browser not to accept cookies; however, doing so may render your computer unable to take advantage of certain features enjoyed by other users of our Site.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">HOW NCCAA USES COLLECTED INFORMATION</h4>

                              <div class="u-desc">
                                  <p>
                                      We may use the information that we collect from you in a variety of ways, including, but not limited to, for purposes of processing your membership request or application for NCCAA Certification, offering you more personalized features, providing you with communications and services you have requested, sending you RSS feeds and email notifications you have requested, notifying you of important changes or additions to our Site, our Site policies, or the features and services offered via our Site, sending you email updates, administrative notices and other communications that we believe may be of interest to you, delivering our Site content to you, measuring Site traffic and improving the Site and the services and features offered via the Site. By using our Site, you agree that we may use any information submitted by or collected from you via the Site for any of the foregoing purposes, and for any other purpose related to the Site and the NCCAA membership and Certification processes.
                                  </p>
                                  <br/>
                                  <p>
                                      We also may provide your information, personal or otherwise, to our third-party service providers, agents, contractors and External Reviewers for purposes related to Site administration and operation and to the processing and/or evaluation of NCCAA membership and Certification applications. For example, if you submit an application for NCCAA Certification, the information you submit will be shared with one of our External Reviewers who will evaluate your application and report to NCCAA the results of the evaluation. Also, if you use a credit or debit card to complete a transaction on our site, we may share your personal information and credit card number with a credit card processing and/or a fulfillment company in order to complete your transaction, or such service provider(s) may collect that information from you directly, on our behalf. Our third-party service providers, agents, contractors and External Reviewers have agreed not to share your information with others or to use it for purposes other than those for which we provide it to them.
                                  </p>
                                  <br/>
                                  <p>
                                      We do not sell or rent any personal information about our members or Site visitors to telemarketers, mailing list brokers, or any other companies
                                  </p>
                                  <br/>
                                  <p>
                                      Please be aware that we may occasionally release information about our Site visitors and registered members if required to so by law or if, in our business judgment, such disclosure is reasonably necessary; (a) to comply with legal process; (b) to enforce our  Terms of Use ; or (c) to protect the rights, property, or personal safety of our Site, us, our Site visitors and/or NCCAA members.
                                  </p>
                                  <br/>
                                  <p>
                                      Please also keep in mind that whenever you voluntarily make your personal information or other private information available for viewing by other Site visitors, NCCAA members or third parties online – for example, by using the “Post a Comment” tool that is available in certain areas of our Site – that information can be seen, collected and used by others besides us. We cannot be responsible for any unauthorized third party use of such information.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">INTERNATIONAL USE</h4>

                              <div class="u-desc">
                                  <p>
                                      When you use the Site or submit your information (including personal data) to us via the Site, you expressly consent to NCCAA collection, disclosure and transfer of your information (including personal data) for the purposes identified in the section of the policy entitled “How NCCAA Uses Collected Information.” If you reside outside the United States, please be aware that (i) NCCAA's databases are stored on servers and storage devices located in the United States, (ii) your information (including personal data) may be transferred to the United States for processing and storage, and (iii) the United States, and the localities within the United States where NCCAA's databases are located, may not guarantee the same level of protection for personal data as the locality or country in which you reside. By using our Site, you consent to the transfer of such information outside of your country.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">STORAGE OF INFORMATION</h4>

                              <div class="u-desc">
                                  <p>
                                      All information gathered on our Site is stored within a database to which only we and our service providers are provided access. However, as effective as the reasonable security measures implemented by us may be, no security system is impenetrable. We cannot guarantee the security of our servers or our database, nor can we guarantee that the information you supply will not be intercepted while being transmitted to us over the Internet.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">LINKS TO THIRD-PARTY SITES</h4>

                              <div class="u-desc">
                                  <p>
                                      Our Site may include links to third party websites whose privacy policies we do not control. Once you leave our Site, any information you provide at another site will be governed by the privacy policy of the operator of the site you are visiting. The privacy policies of third party websites may differ from that of our Site.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">MODIFYING YOUR MEMBER PROFILE AND INFORMATION</h4>

                              <div class="u-desc">
                                  <p>
                                      If you are an NCCAA member, you can make changes to your account information by logging in to the Restricted Access Areas of our Site and clicking on “Update Your Details/Change Password.” When you update your account or profile information, we may keep a copy of the prior version for our records.
                                  </p>
                                  <br/>
                                  <p>
                                      If at any point you decide that you would no longer like to receive information from us, please use the contact information set forth below in the “Contact Us” section of this policy to contact us to request that we remove your information from our database.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">CHILDREN’S PRIVACY</h4>

                              <div class="u-desc">
                                  <p>
                                      This Site is not directed to children under the age of 13 and we do not knowingly collect personally identifiable information from children under the age of 13. If we become aware that we have inadvertently received personally identifiable information from a user under the age of 13, we will delete such information from our records. Because we do not collect any personally identifiable information from children under the age of 13, we also do not knowingly distribute any such information to third parties. We do not knowingly allow children under the age of 13 to publicly post or otherwise distribute personally identifiable contact information.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">CHANGES TO THIS PRIVACY POLICY</h4>

                              <div class="u-desc">
                                  <p>
                                      If we need to change this Privacy Policy in the future, we will post the modified Privacy Policy on the Site and update the “Last Updated” date of the policy to reflect the date of the changes. By continuing to use the Site after we post any such changes, you accept the Privacy Policy as modified.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

                  <div class=" board-member-list">

                      <div class="row ">

                          <div class="col-md-12">

                              <h4 class="u-title">CONTACT US</h4>

                              <div class="u-desc">
                                  <p>
                                      If you have any questions about this policy or our privacy practices, please click on the “Contact NCCAA” link on our website and complete the online form to submit your question or inquiry.
                                  </p>
                              </div>

                          </div>

                      </div><!--//row//-->

                  </div>

              </div>

          </div><!-- /.modal-content -->

      </div><!-- /.modal-dialog -->

  </div>
<!--  End Serhii -->


  <style>

      @font-face{



          font-family:'circe-bold';



          src:url(./assets/frontends/fonts/circe-bold.otf) format("truetype");/*opentype*/



          font-weight:400;



          font-style:normal;



      }



      @font-face{



          font-family:'circe';



          src:url(./assets/frontends/fonts/circe.otf) format("truetype");/*opentype*/



          font-weight:400;



          font-style:normal;



      }

      #wrapper {
        background-color: #f9f9f9;
    }

    .modal-header {
        margin: 0 15px;
        padding: 15px 0;
        border-bottom: 1px solid #e5e5e5;
    }

    .modal-dialog {
        font-family: 'circe-bold';
    }

    .modal-content {
        border: none;
        border-radius: 0;
    }


    .modal-title {
        font-family: 'circe-bold';
    }


    #condition-modal .modal-header,
    #privacy-modal .modal-header{

        border-bottom: 1px solid #CCC;

    }


    #privacy-modal .modal-header .close,
    #condition-modal .modal-header .close {

        font-size: 27px;

    }

    #condition-modal .modal-dialog,
    #privacy-modal .modal-dialog {

        width: 680px;

    }

    .u-desc .list {
        list-style: none !important;
    }

    .li-dot {
        width: 7px;
        margin-right: 10px;
    }

    .bold-span {
        font-weight: bold;
    }

    #condition-modal .modal-content,
    #privacy-modal .modal-content {

        padding:20px;

    }

    #condition-modal .modal-content .modal-header,
    #privacy-modal .modal-content .modal-header {

        padding:10px 0px;

    }

    #condition-modal .modal-content .modal-title,
    #privacy-modal .modal-content .modal-title {

        font-family:'circe-bold';

        font-weight:600;

        font-size:15px;

    }

    .board-member-list{

        border-bottom:#CCC 1px solid;

        padding:10px 0;

    }



    #condition-modal .modal-body  .u-title,
    #privacy-modal .modal-body  .u-title {

        font-family:'circe-bold';

        font-weight:700;

        font-size:14px;

        color:rgba(101, 101, 101);

        margin-bottom:20px;

    }

      #condition-modal .modal-body  .u-title.title-italic,
      #privacy-modal .modal-body  .u-title.title-italic {

          font-style: italic;

      }


    #condition-modal .modal-body  .u-desc,
    #privacy-modal .modal-body  .u-desc,

    #condition-modal .modal-body  .u-desc p,
    #privacy-modal .modal-body  .u-desc p {

        font-family:'circe';

        font-weight:400;

        font-size:14px;

        color:rgba(33, 37, 41);

        line-height:17px;

    }

  </style>

  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>


  <script src="assets/frontends/styles/bootstrap/bootstrap.js"></script>


  <script>
      function showConditionModal(){

          if(screen.width > 600)

          {

              $('#condition-modal').modal('show');
              $('#privacy-modal').modal('hide');

          }


      }

      function showPrivacyModal(){

          if(screen.width > 600)

          {

              $('#privacy-modal').modal('show');
              $('#condition-modal').modal('hide');

          }


      }
  </script>


  <?php if (isset($_GET['errorCode']) && $_GET['errorCode'] == 105 || isset($_GET['errorCode']) && $_GET['errorCode'] == 106 || isset($_GET['errorCode']) && $_GET['errorCode'] == 205) { ?>



    <script>

      jQuery(document).ready(function (e) {

        jQuery('#signin_btn').toggleClass('hideme');

        jQuery('#forgot_btn').toggleClass('active');

        jQuery('#forgot_btn').click(function (e) {

          e.preventDefault();

          jQuery('#forgot_pass').slideToggle('fast');

          jQuery('#signin_btn').toggleClass('hideme');

          jQuery('#forgot_btn').toggleClass('active');

        });

      });

    </script>

  <?php } else { ?>

    <script>

      jQuery(document).ready(function (e) {

        jQuery('#forgot_pass').hide();

        jQuery('#forgot_btn').click(function (e) {

          e.preventDefault();

          jQuery('#forgot_pass').slideToggle('fast');

          jQuery('#signin_btn').toggleClass('hideme');

          jQuery('#forgot_btn').toggleClass('active');

          jQuery('#login-sec').toggleClass('hideme');

        });

      });

    </script>

  <?php } ?>

  <script type="text/javascript">

    var unknown = '-';

    // screen

    var screenSize = '';

    if (screen.width) {

      width = (screen.width) ? screen.width : '';

      height = (screen.height) ? screen.height : '';

      screenSize += '' + width + " x " + height;

    }



    // browser

    var nVer = navigator.appVersion;

    var nAgt = navigator.userAgent;

    var browser = navigator.appName;

    var version = '' + parseFloat(navigator.appVersion);

    var majorVersion = parseInt(navigator.appVersion, 10);

    var nameOffset, verOffset, ix;



    // Opera

    if ((verOffset = nAgt.indexOf('Opera')) != -1) {

      browser = 'Opera';

      version = nAgt.substring(verOffset + 6);

      if ((verOffset = nAgt.indexOf('Version')) != -1) {

        version = nAgt.substring(verOffset + 8);

      }

    }

    // Opera Next

    if ((verOffset = nAgt.indexOf('OPR')) != -1) {

      browser = 'Opera';

      version = nAgt.substring(verOffset + 4);

    }

    // Edge

    else if ((verOffset = nAgt.indexOf('Edge')) != -1) {

      browser = 'Microsoft Edge';

      version = nAgt.substring(verOffset + 5);

    }

    // MSIE

    else if ((verOffset = nAgt.indexOf('MSIE')) != -1) {

      browser = 'Microsoft Internet Explorer';

      version = nAgt.substring(verOffset + 5);

    }

    // Chrome

    else if ((verOffset = nAgt.indexOf('Chrome')) != -1) {

      browser = 'Chrome';

      version = nAgt.substring(verOffset + 7);

    }

    // Safari

    else if ((verOffset = nAgt.indexOf('Safari')) != -1) {

      browser = 'Safari';

      version = nAgt.substring(verOffset + 7);

      if ((verOffset = nAgt.indexOf('Version')) != -1) {

        version = nAgt.substring(verOffset + 8);

      }

    }

    // Firefox

    else if ((verOffset = nAgt.indexOf('Firefox')) != -1) {

      browser = 'Firefox';

      version = nAgt.substring(verOffset + 8);

    }

    // MSIE 11+

    else if (nAgt.indexOf('Trident/') != -1) {

      browser = 'Microsoft Internet Explorer';

      version = nAgt.substring(nAgt.indexOf('rv:') + 3);

    }

    // Other browsers

    else if ((nameOffset = nAgt.lastIndexOf(' ') + 1) < (verOffset = nAgt.lastIndexOf('/'))) {

      browser = nAgt.substring(nameOffset, verOffset);

      version = nAgt.substring(verOffset + 1);

      if (browser.toLowerCase() == browser.toUpperCase()) {

        browser = navigator.appName;

      }

    }

    // trim the version string

    if ((ix = version.indexOf(';')) != -1) version = version.substring(0, ix);

    if ((ix = version.indexOf(' ')) != -1) version = version.substring(0, ix);

    if ((ix = version.indexOf(')')) != -1) version = version.substring(0, ix);



    majorVersion = parseInt('' + version, 10);

    if (isNaN(majorVersion)) {

      version = '' + parseFloat(navigator.appVersion);

      majorVersion = parseInt(navigator.appVersion, 10);

    }



    // mobile version

    var mobile = /Mobile|mini|Fennec|Android|iP(ad|od|hone)/.test(nVer);



    // cookie

    var cookieEnabled = (navigator.cookieEnabled) ? true : false;



    if (typeof navigator.cookieEnabled == 'undefined' && !cookieEnabled) {

      document.cookie = 'testcookie';

      cookieEnabled = (document.cookie.indexOf('testcookie') != -1) ? true : false;

    }



    // system

    var os = unknown;

    var clientStrings = [

      {s: 'Windows 10', r: /(Windows 10.0|Windows NT 10.0)/},

      {s: 'Windows 8.1', r: /(Windows 8.1|Windows NT 6.3)/},

      {s: 'Windows 8', r: /(Windows 8|Windows NT 6.2)/},

      {s: 'Windows 7', r: /(Windows 7|Windows NT 6.1)/},

      {s: 'Windows Vista', r: /Windows NT 6.0/},

      {s: 'Windows Server 2003', r: /Windows NT 5.2/},

      {s: 'Windows XP', r: /(Windows NT 5.1|Windows XP)/},

      {s: 'Windows 2000', r: /(Windows NT 5.0|Windows 2000)/},

      {s: 'Windows ME', r: /(Win 9x 4.90|Windows ME)/},

      {s: 'Windows 98', r: /(Windows 98|Win98)/},

      {s: 'Windows 95', r: /(Windows 95|Win95|Windows_95)/},

      {s: 'Windows NT 4.0', r: /(Windows NT 4.0|WinNT4.0|WinNT|Windows NT)/},

      {s: 'Windows CE', r: /Windows CE/},

      {s: 'Windows 3.11', r: /Win16/},

      {s: 'Android', r: /Android/},

      {s: 'Open BSD', r: /OpenBSD/},

      {s: 'Sun OS', r: /SunOS/},

      {s: 'Chrome OS', r: /CrOS/},

      {s: 'Linux', r: /(Linux|X11(?!.*CrOS))/},

      {s: 'iOS', r: /(iPhone|iPad|iPod)/},

      {s: 'Mac OS X', r: /Mac OS X/},

      {s: 'Mac OS', r: /(MacPPC|MacIntel|Mac_PowerPC|Macintosh)/},

      {s: 'QNX', r: /QNX/},

      {s: 'UNIX', r: /UNIX/},

      {s: 'BeOS', r: /BeOS/},

      {s: 'OS/2', r: /OS\/2/},

      {s: 'Search Bot', r: /(nuhk|Googlebot|Yammybot|Openbot|Slurp|MSNBot|Ask Jeeves\/Teoma|ia_archiver)/}

    ];

    for (var id in clientStrings) {

      var cs = clientStrings[id];

      if (cs.r.test(nAgt)) {

        os = cs.s;

        break;

      }

    }



    var osVersion = unknown;



    if (/Windows/.test(os)) {

      osVersion = /Windows (.*)/.exec(os)[1];

      os = 'Windows';

    }



    switch (os) {

      case 'Mac OS X':

        osVersion = /Mac OS X (10[\.\_\d]+)/.exec(nAgt)[1];

        break;



      case 'Android':

        osVersion = /Android ([\.\_\d]+)/.exec(nAgt)[1];

        break;



      case 'iOS':

        osVersion = /OS (\d+)_(\d+)_?(\d+)?/.exec(nVer);

        osVersion = osVersion[1] + '.' + osVersion[2] + '.' + (osVersion[3] | 0);

        break;

    }



    // flash (you'll need to include swfobject)

    /* script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js" */

    var flashVersion = 'no check';

    if (typeof swfobject != 'undefined') {

      var fv = swfobject.getFlashPlayerVersion();

      if (fv.major > 0) {

        flashVersion = fv.major + '.' + fv.minor + ' r' + fv.release;

      } else {

        flashVersion = unknown;

      }

    }



    window.jscd = {

      screen: screenSize,

      browser: browser,

      browserVersion: version,

      browserMajorVersion: majorVersion,

      mobile: mobile,

      os: os,

      osVersion: osVersion,

      cookies: cookieEnabled,

      flashVersion: flashVersion

    };



    $(document).ready(function () {

      $('#os_info').val(jscd.os + ' ' + jscd.osVersion);

      $('#browser_info').val(jscd.browser + ' ' + jscd.browserMajorVersion);

    });

    $(document).keypress(

        function (event) {

          if (event.which == '13') {

            event.preventDefault();

          }

        });

    localStorage.setItem('popState', '');

  </script>

  <script type="text/javascript">



    $(document).keypress(

  function(event){

    if (event.which == '13') {

      event.preventDefault();

    }

});

    localStorage.setItem('popState','');

	

  </script>


  </body>

  </html>

<?php } else {

  header("location: user/profile.php");

} ?>