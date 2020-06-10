<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-159328273-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-159328273-1');
</script>
<?php
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off" || $_SERVER["HTTPS"] != "on") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title>NCCAA</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
<style>
  #errorsubmission-container{
    width: 800px;
  }

  #errorsubmission-container .form-input{
    float: right;
  }
  #errorsubmission-container .form-row label{
    float: none !important;
  }
  #errorsubmission-container textarea{
    min-width: 100%;
    min-height: 200px;
  }
</style>

  </head>
  <body>
  <div id="wrapper">
    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-2 col-sm-12">
              <div class="logo"><a href="/"><img src="images/logo.png" alt=""/></a></div>
          </div>
          <div class="col-md-8 col-sm-12">
              <h2 style="float: none;">National Commission for Certification of Anesthesiologist Assistants</h2>
          </div>
          <div class="col-md-2 col-sm-12">
              <div><a href="/logincaamember.php" style="float:right; margin-top:-50px;">Sign in</a></div>
          </div>
        </div>
        
        
        
      </div>
    </header><!--close header-->

    <div id="content">
      <div class="content-inner" id="errorsubmission-container">
        <h1 style="margin-bottom:0px;">Error Submission Form</h1>
        <?php if(isset($_GET['successCode']) && $_GET['successCode'] == 102) 
              {
                echo "<h5 id='submit-success-msg' style='color:#039429; padding:20px; border:2px solid; background-color:antiquewhite;'>Thank you for your submission. <br/>Please click Sign In upper right corner or click on the logo upper left corner to go to the Home Page.</h5>";
                echo "<script>setTimeout(function(){document.getElementById('submit-success-msg').style.display='none';}, 4000);</script>";
              }
              if(isset($_GET['errorCode']) && $_GET['errorCode'] == 104)
              {
                echo "<h5 id='submit-error-msg' style='color:red; padding:20px; border:2px solid; background-color:antiquewhite;'>NCCAA Support team already received your same submission.<br> Thank you for your submission.</h5>";
                echo "<script>setTimeout(function(){document.getElementById('submit-error-msg').style.display='none';}, 4000);</script>";
              } 
        ?>
        <form class="modal-content animate" action="member/user/errorsubmission_process.php" method="POST" enctype="multipart/form-data">
          <div class="form-sec">
            <div id="login-sec">
              <div class="form-row">
                <label>Your name</label>
                <input type="text" class="form-input" name="uname" placeholder="Your name" required>
                <?php if (isset($_GET['errorCode']) && $_GET['errorCode'] == 103) { ?>
                  <span class="error-msg">Please enter valid name</span>
                <?php } ?>
              </div>

              <div class="form-row">
                <label>Your Email</label>
                <input type="text" class="form-input" name="email" placeholder="Your email" required>
                <?php if (isset($_GET['errorCode']) && $_GET['errorCode'] == 103) { ?>
                  <span class="error-msg">Please enter valid email</span>
                <?php } ?>
              </div>

              <div class="form-row">
                <label>Date and Time</label>
                <input type="date" class="form-input" name="date" id="errorsub_datetime" required>
              </div>

              <div class="form-row">
                <label class="tooltip">
                    What specifically is the issue you are having?
                    <span class="tooltiptext">Please include the web page you are on, the URL if possible, and any specific identifiable error messages, if any, and snapshots if you are able, and anything that would help us to reproduce the issue. Thank You!</span>
                </label>
                <textarea class="text-area" placeholder="Enter issues here" name="issue" required></textarea>
              </div>

              <div class="form-row">
                <label>
                    Attachments
                </label>
                <input type="file" class="form-input" name="upload_file" id="upload_file" accept=".pdf, .gif, .jpg, .png, .jpeg, .bmp, .tif" >
                <?php if (isset($_GET['errorCode']) && $_GET['errorCode'] == 103) { ?>
                  <span class="error-msg">Please enter valid file</span>
                <?php } ?>
              </div>

              <div class="form-row">
                <label>What type of hardware are you using? Which specific model?</label>
                <select name="hardware" id="hardware" class="form-input" required>
                    <option value="" disabled selected>Choose hardware</option>
                    <option value="Desktop">Desktop</option>
                    <option value="Laptop">Laptop</option>
                    <option value="Apple iPhone">Apple iPhone</option>
                    <option value="Google Android">Google Android</option>
                    <option value="Windows Phone">Windows Phone</option>
                    <option value="Tablets">Tablets</option>
                </select>
              </div>

              <div class="form-row">
                <label>What browser are you using?</label>
                <select name="browser" id="browser" class="form-input" required>
                    <option value="" disabled selected>Choose browser</option>
                    <option value="Google Chrome">Google Chrome</option>
                    <option value="Microsoft Edge">Microsoft Edge</option>
                    <option value="Internet Explorer">Internet Explorer</option>
                    <option value="Firefox">Firefox</option>
                    <option value="Safari">Safari</option>
                    <option value="Opera">Opera</option>
                </select>
              </div>

              <div class="form-row">
                <label>What is your browser version?</label>
                <select name="browser_version" id="browser_version" class="form-input" required>
                    <option value="" disabled selected>Choose browser version</option>
                    <option value="Chrome 77/78/79/80">Chrome 77/78/79/80</option>
                    <option value="Edge 80">Edge 80</option>
                    <option value="Internet Explorer 11">Internet Explorer 11</option>
                    <option value="Firefox 73">Firefox 73</option>
                    <option value="Safari 12/13">Safari 12/13</option>
                    <option value="Opera 66">Opera 66</option>
                </select>
              </div>

              <div class="form-row">
                <label>Which platform are you using?</label>
                <select name="platform" id="platform" class="form-input" required>
                    <option value="" disabled selected>Choose platform</option>
                    <option value="Windows">Windows</option>
                    <option value="MAC OS">MAC OS</option>
                    <option value="Linux">Linux</option>
                    <option value="Android">Android</option>
                    <option value="iOS">iOS</option>
                </select>
              </div>

              <div class="form-row">
                <label>Connection type?</label>
                <select name="connection" id="connection" class="form-input" required>
                    <option value="" disabled selected>Choose connection</option>
                    <option value="WiFi">WiFi</option>
                    <option value="Ethernet">Ethernet</option>
                    <option value="Cellular data">Cellular data</option>
                    <option value="Speed of the connection">Speed of the connection</option>
                </select>
              </div>

              <div class="form-row">
                <label>Screen size (only if issue involves a design problem)</label>
                <input type="screen_size" class="form-input" name="screen_size" placeholder="Screen size">
              </div>
              <input type="hidden" class="form-input" id="os_info" name="os_info" value=""/>
              <input type="hidden" class="form-input" id="browser_info" name="browser_info" value=""/>
            </div>
            <div class="submit-row" id="signin_btn" style="text-align: center;">
              <input type="submit" class="form-submit" name="errorsubmission" value="SEND ERROR SUBMISSION" style="margin: auto; float:none;">
            </div>
          </div>
          
        </form>
        <div class="footer">
          <ul>
            <li><a href="#">Conditions of Use</a></li>
            <li><a href="#">Privacy Notice</a></li>
            <li><a href="#">Help</a></li>
          </ul>
        </div>
      </div>
    </div><!--close content-->
  </div><!--close wrapper-->
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
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
  </script>
  </body>
  </html>