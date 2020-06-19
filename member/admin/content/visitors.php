<?php


$visitor_list = $visitors->readAllVisitors();


?>
<style>
.tr-enlarge:hover{
	background-color: #e9e9e9 !important;
}
.td-enlarge:hover {
    -webkit-transform:scale(1.5);
    -moz-transform:scale(1.5);
    -ms-transform:scale(1.5);
    -o-transform:scale(1.5);
    transform:scale(1.5); 
    background-color: #E2E2E2;
	-moz-box-shadow: 1px 2px 4px rgba(0, 0, 0,0.5);
	-webkit-box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
	box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);
	
}
.td-enlarge {
    text-decoration: none;
    border-top: 2px solid #F1F1F1;
    border-right: 2px solid #969696;
    border-bottom: 2px solid #969696;
    border-left: 2px solid #F1F1F1;
}

</style>




<div class="member-card card">


  <h4>View All Visitors</h4>





  <table id="visitor-table" class="table table-striped table-bordered" style="width:100%">


    <thead>


    <tr>


      <th>Id</th>


      <th>Full Name</th>


      <th>Role</th>


      <th>Email</th>


      <th>Date</th>


      <th>Browser</th>


      <th>IP</th>


      <th>OS</th>


    </tr>


    </thead>


    <tbody>


    <?php


      foreach ($visitor_list as $item) { ?>


        <tr class="tr-enlarge">


          <td style="font-size: 10px;"><?=$item[0]?></td>


          <td class="td-enlarge" style="font-size: 10px; width:15%;"><?=$item[1]?></td>


          <td class="td-enlarge" style="font-size: 10px; width: 8%;"><?=$item[2]?></td>


          <td class="td-enlarge" style="font-size: 10px;"><?=$item[3]?></td>


          <td class="td-enlarge" style="font-size: 10px; width:13%"><?=$item[4]?></td>


          <td class="td-enlarge" style="font-size: 10px; width: 13%;"><?=$item[5]?></td>


          <td class="td-enlarge" style="font-size: 10px; width:12%"><?=$item[6]?></td>


          <td class="td-enlarge" style="font-size: 10px; width: 12%;"><?=$item[7]?></td>


        </tr>


     <?php }


    ?>


    </tbody>


  </table>


</div>





<script type="text/javascript">


  $(document).ready(function() {


    $('#visitor-table').DataTable({


      "aLengthMenu": [[50, 100, 250, 500, 1000], [50, 100, 250, 500, 1000]],


      "iDisplayLength": 50,


      "order": []


    });


  });
  
function open_browser(){
	  // Opera 8.0+
	var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

	// Firefox 1.0+
	var isFirefox = typeof InstallTrigger !== 'undefined';

	// Safari 3.0+ "[object HTMLElementConstructor]" 
	var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));

	// Internet Explorer 6-11
	var isIE = /*@cc_on!@*/false || !!document.documentMode;

	// Edge 20+
	var isEdge = !isIE && !!window.StyleMedia;

	// Chrome 1 - 71
	var isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);

	// Blink engine detection
	var isBlink = (isChrome || isOpera) && !!window.CSS;


	var output = 'Detecting browsers by ducktyping:<hr>';
	output += 'isFirefox: ' + isFirefox + '<br>';
	output += 'isChrome: ' + isChrome + '<br>';
	output += 'isSafari: ' + isSafari + '<br>';
	output += 'isOpera: ' + isOpera + '<br>';
	output += 'isIE: ' + isIE + '<br>';
	output += 'isEdge: ' + isEdge + '<br>';
	output += 'isBlink: ' + isBlink + '<br>';
	document.body.innerHTML = output;
}

</script>