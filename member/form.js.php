<script src="js/form.js"></script>

<script type="text/javascript">
	

function testUnsaved() {
	// this is called on nav tab click
	// ochange event tied to set fieldsChanged flag	
	// this will display a swal reminding of unsavd changes
}

function testRequired() {
	// this is called on any form submit
	// it should loop through all fields with data-validation="required"
	// if any of these have blank value. display swal and if choose cancel then abort the save
}

// for both of these, remove the current alert/confirms, should be able to remove the call to tab specific form validation top

$(document).ready(function(){
	
	var refreshSn = function ()
	{
		var time = 600000; 
		setTimeout(
			function ()
			{
			$.ajax({
			   url: 'prevent_timeout.php',
			   cache: false,
			   complete: function () {refreshSn();}
			});
			},
			time
		);
	};

	
	refreshSn();


	$('ul.tabs li').click(function(){


		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');


		$('.tab-content').removeClass('current');



		$(this).addClass('current');



		$("#"+tab_id).addClass('current');



	});

	
    $('.phone').inputmask({"mask": "(999) 999-9999"});
    
 
    $('.other6').click(function () {
       $('#benefit_field0').attr('data-validation', '');  
    });

    $('.other7').click(function () {
       $('#retirement_field0').attr('data-validation', '');  
    });



var allRadios = document.getElementsByName('teach_or_environment');
var booRadio;
var x = 0;
for(x = 0; x < allRadios.length; x++){
  allRadios[x].onclick = function() {
    if(booRadio == this){
      this.checked = false;
      booRadio = null;
    } else {
      booRadio = this;
    }
  };
}

var allRadios5 = document.getElementsByName('teach_healthcare_or');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}

var allRadios5 = document.getElementsByName('employer_offer_benefit[0]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}

var allRadios5 = document.getElementsByName('employer_offer_benefit[1]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}

var allRadios5 = document.getElementsByName('employer_offer_benefit[2]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}

var allRadios5 = document.getElementsByName('employer_offer_benefit[3]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}

var allRadios5 = document.getElementsByName('employer_offer_benefit[4]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}

var allRadios5 = document.getElementsByName('employer_offer_benefit[5]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}

var allRadios5 = document.getElementsByName('employer_offer_benefit[7]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}

var allRadios5 = document.getElementsByName('employer_offer_benefit[8]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}

var allRadios5 = document.getElementsByName('employer_offer_benefit[9]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}

var allRadios5 = document.getElementsByName('employer_offer_benefit[10]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}

var allRadios5 = document.getElementsByName('all_specialities_techniques');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}


var allRadios5 = document.getElementsByName('retirement_setup_plan[0]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}

var allRadios5 = document.getElementsByName('retirement_setup_plan[1]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}

var allRadios5 = document.getElementsByName('retirement_setup_plan[2]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}
 
 var allRadios5 = document.getElementsByName('retirement_setup_plan[3]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}

var allRadios5 = document.getElementsByName('retirement_setup_plan[4]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}


var allRadios5 = document.getElementsByName('retirement_setup_plan[5]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}

var allRadios5 = document.getElementsByName('retirement_setup_plan[6]');
var booRadio5;
var x5 = 0;
for(x5 = 0; x5 < allRadios5.length; x5++){
  allRadios5[x5].onclick = function() {
    if(booRadio5 == this){
      this.checked = false;
      booRadio5 = null;
    } else {
      booRadio5 = this;
    }
  };
}
 
});
</script>

<script>

jQuery('.category-slider').owlCarousel({
        stagePadding: 1,
        responsiveClass:true,
        center: false,
        loop:true,
        margin:25,
        nav:true,
        autoWidth:true,
        dots: false,
        mouseDrag: false,
        responsive:{
            0:{
                items:2
            },
            600:{
                items:3
            },
            1000:{
                items:6
            }
        }
    });
</script>
<?php if($current == 'current2') { ?>
<script type="text/javascript">
$(".category-slider").trigger("to.owl.carousel", [1, 0]);
</script>
<style type="text/css">
/*.tab-link {
    left: -96px;
}*/
</style>
<?php } else if($current == 'current3') { ?>
<script type="text/javascript">
$(".category-slider").trigger("to.owl.carousel", [2, 0]);
</script>   
<style type="text/css">
/*.tab-link {
    left: -194px;
}*/
</style>
<?php } else if($current == 'current4') { ?>
<script type="text/javascript">
$(".category-slider").trigger("to.owl.carousel", [3, 0]);
</script>   
<style type="text/css">
/*.tab-link {
    left: -310px;
}*/
</style>
<?php } else if($current == 'current5') { ?>
<script type="text/javascript">
$(".category-slider").trigger("to.owl.carousel", [4, 0]);
</script>
<style type="text/css"> 
/*.tab-link {

    left: -469px;

}*/
</style>
<?php } else if($current == 'current6') { ?>
<script type="text/javascript">
$(".category-slider").trigger("to.owl.carousel", [5, 0]);
</script>   
<style type="text/css"> 
/*.tab-link {

    left: -591px;

}*/
</style>
<?php } else if($current == 'current7') { ?>
<script type="text/javascript">
$(".category-slider").trigger("to.owl.carousel", [6, 0]);
</script>   
<style type="text/css"> 
/*.tab-link {

    left: -776px;

}*/
</style>
<?php } else if($current == 'current8') { ?>
<script type="text/javascript">
$(".category-slider").trigger("to.owl.carousel", [7, 0]);
</script>   
<style type="text/css"> 
/*.tab-link {

    left: -927px;

}*/
</style>
<?php } else if($current == 'current9') { ?>
<script type="text/javascript">
$(".category-slider").trigger("to.owl.carousel", [8, 0]);
</script>   
<style type="text/css"> 
/*.tab-link {

    left: -1144px;

}*/
</style>
<?php } else if($current == 'current10') { ?>
<script type="text/javascript">
$(".category-slider").trigger("to.owl.carousel", [9, 0]);
</script>   
<style type="text/css"> 
/*.tab-link {

    left: -1211px;

}*/
</style>
<?php } ?>
<script type="text/javascript">
function logout(){
    if(confirm("Are you sure you want to logout?")){
        window.location = "logout.php";
    }else{
        //do your stuff on if press cancel          
    }
}
 $.validate();
 $('.bg-input').prop('readonly',true);
    var sum = 0;
    $(".total").each(function(){
        sum += +$(this).val();
    });
    $(".total-value").text(sum);
$('.total').change(function () {
    var sum = 0;
    $(".total").each(function(){
        sum += +$(this).val();
    });
    $(".total-value").text(sum);
});
$('#hide_img').click(function () {
    if($('#file-2').data('status') == 0)
    {
    $('#file-2').data('status',1);
    $(this).css('background-color','#ccc');
    $('.img-responsive').css('display','none');
    $('#img_data').val('0');
    }
    else
    {
     $('#file-2').data('status',0);
     $(this).css('background-color','#fff');
     $('.img-responsive').css('display','block');
     $('#img_data').val('1');
    }
    
});
 $("#file-2-lable").click(function (){
       
     $('#hide_img').css('background-color','#fff');
     $('#img_data').val('1');
       
     });
function ethnicity_val(value) {
    if(value == "Other")
    {
        //$('#ethnicity_other').attr('data-validation', 'required');
    }
    else
    {
        $('#ethnicity_other').attr('data-validation', '');
    }
}


function other_data4(value) {
    if(value == "Other")
    {
        //$('#employment_information_1925').attr('data-validation', 'required');
    }
    else
    {
        $('#employment_information_1925').attr('data-validation', '');
    }
}
if('<?php echo $employment_info_type_setting_1; ?>'.indexOf('Other') != -1)
{
$('#other_data2').hide();    
}
// function other_data2(value) {
//     if(value == "Other")
//     {
//         $('#other_data2').show();
//     }
//     else
//     {
//         $('#other_data2').hide();
//     }
// }
function other_data2(value) {
// @@@ replaced this mechanism with cleaner jquery based
//    if(value == "Other")
//   {
//        $('#other_data2').show();
//    }
//    else
//    {
//        $('#other_data2').hide();
//    }



//    var ans15 = $('.empinfo').val();

    
   
//    if(ans15){

//        $("#Answer123").attr('checked', false); 
       
  
//    }else{
//        $("#Answer123").prop("checked", true);
        
//    }



}


if('<?php echo $employment_info_type_setting_2; ?>'.indexOf('Other') != -1)
{
$('#other_data3').hide();
}
function other_data3(value) {
    if(value == "Other")
    {
        $('#other_data3').show();
    }
    else
    {
        $('#other_data3').hide();
    }
}

function employer_status(value) {
    if(value == "Not currently employed as a CAA")
    {
        $('#employment_information_7').attr('data-validation', '');
        $('#employment_information_8').attr('data-validation', '');
        $('#employment_information_9000').attr('data-validation', '');
        $('#employment_information_10').attr('data-validation', '');
        $('#employment_information_11').attr('data-validation', '');
        $('#address_info_field99').attr('data-validation', '');
    }
    else
    {
        // $('#employment_information_7').attr('data-validation', 'required');
        // $('#employment_information_8').attr('data-validation', 'required');
        // $('#employment_information_9000').attr('data-validation', 'required');
        // $('#employment_information_10').attr('data-validation', 'required');
        // $('#employment_information_11').attr('data-validation', 'required');
        // $('#address_info_field99').attr('data-validation', 'required');
    }
}

function other_data5() {
	if ( $("#employment_information_24_switch").prop('checked') ) {
		$("#employment_information_24").val( $("#employment_information_24_switch").val() );
    $('.total').attr('data-validation', '');
    $('.total').val();
    $('.total').prop('readonly',true);
    $('.total-value').text('0');
  } else {
		$("#employment_information_24").val( "" );
    $('.total').attr('data-validation', 'required');
    $('.total').prop('readonly',false);
		$('.total').change();
  }

}
</script>
<?php if($employment_info->divided_8 == "emp_not_practicing")
{
    ?>
    <script type="text/javascript">
      $('.total').attr('data-validation', '');
    $('.total').val();
    $('.total').prop('readonly',true);
    $('.total-value').text('0');
    </script>
    <?php
}
?>
</body>
</html>
<!--tab-8 work-->
<script type="text/javascript">
    function change_sum()
    {
        var retirement_field1 = parseInt($('#retirement_field1').val());
        var retirement_field2 = parseInt($('#retirement_field2').val());
        var retirement_field3 = parseInt($('#retirement_field3').val());
        var retirement_field4 = parseInt($('#retirement_field4').val());
        var retirement_field5 = parseInt($('#retirement_field5').val());
        
        $('.all_sum').val(retirement_field1+retirement_field2+retirement_field3+retirement_field4+retirement_field5);

    }
    
</script>
<!--tab-8 work-->

<script type="text/javascript">
    
 function form1()
 {  
    var check = 0;

    // input first name
    var general_info_form_field1_p = '<?php echo $row_general_info->f_name; ?>';
    var general_info_form_field1_n = $('#general_info_form_field1').val();
    // Middle And last name
    var general_info_form_field2_p = '<?php echo $row_general_info->m_name; ?>';
    var general_info_form_field2_n = $('#general_info_form_field2').val();

    var general_info_form_field3_p = '<?php echo $row_general_infok->l_name; ?>';
    var general_info_form_field3_n = $('#general_info_form_field3').val();


    // user name
    var account_security_field1a_p = '<?php echo $user_information->name; ?>';
    var account_security_field1a_n = $('#account_security_field1a').val();        
    // user name
    var account_security_field1b_p = '<?php echo $user_information->email; ?>';
    var account_security_field1b_n = $('#account_security_field11').val();        
    //password
    var account_security_field2_p = '<?php echo $_SESSION['pass']; ?>';
    var account_security_field2_n = $('#account_security_field2').val();       
    //security
    var account_security_field4_p = '<?php echo $account_security_information->last4ssn; ?>';
    var account_security_field4_n = $('#account_security_field4').val(); 
    //mother name
    var account_security_field10_p = '<?php echo $account_security_information->mother_maiden_name; ?>';
    var account_security_field10_n = $('#account_security_field10').val(); 
    //Degree Date
    var program_university_17_p = '<?php echo $matric_dt_actual_graduation_date; ?>';
    var program_university_17_n = $('#program_university_17').val(); 
    // degree year selected
    var program_university_18_p = '<?php echo $matric_dt_actual_graduation_year ?>';
    var program_university_18_n = $('#program_university_18').find(":selected").text();
    //title selected
    var general_info_form_field0_p = '<?php echo $row_general_info->title ?>';
    var general_info_form_field0_n = $('#general_info_form_field0').find(":selected").text();
    //suffix
    var general_info_form_field4_p = '<?php echo $row_general_info->suffix ?>';
    var general_info_form_field4_n = $('#general_info_form_field4').find(":selected").text(); 
    //university
    var alma_university_p = '<?php echo $uname; ?>';
    var alma_university_n = $('#alma_university').find(":selected").text(); 


    if((general_info_form_field0_p!=general_info_form_field0_n) && ( general_info_form_field0_n!='Select Title'))
        check = 1 ;
    if(general_info_form_field1_p!=general_info_form_field1_n)
        check = 2 ;
 	 	if(general_info_form_field2_p!=general_info_form_field2_n)
        check = 3 ;    
    if(general_info_form_field3_p!=general_info_form_field3_n)
        check = 4 ;  
    if((general_info_form_field4_p!=general_info_form_field4_n) && ( general_info_form_field4_n!='Select Suffix'))
        check = 5 ; 

    if(account_security_field1a_p!=account_security_field1a_n)
        check = 6 ;  
    if(account_security_field1b_p!=account_security_field1b_n)
        check = 6 ;  
    if(account_security_field2_p!=account_security_field2_n)
        check = 7 ;   
    if(account_security_field4_p!=account_security_field4_n)
        check = 8 ;  
    if(account_security_field10_p!=account_security_field10_n)
        check = 9 ;         
    if(program_university_17_p!=program_university_17_n)
        check = 10 ;  
    if((program_university_18_p!=program_university_18_n)  && ( program_university_18_n!='Select Year'))
        check = 11 ;   

    if((alma_university_p!=alma_university_n) && ( alma_university_n!='Select University') )
        check = 12 ;      
                        

    if(check)
    {
 
 		//if ( ! confirmTabClick() ) return( false );
 		    
 //       if (confirm('you want to change this?')) 
 //       {
 //            
 //       }
    }

 }
 
</script>
<script type="text/javascript">
    
function form2()
{
  var check2=0;

    // input Birth date
    var account_security_field7_p = '<?php echo $account_security_date; ?>';
    var account_security_field7_n = $('#account_security_field7').val();
    if(account_security_field7_p!=account_security_field7_n)
        check2=1;
    
    // select gender
    var personal_form_info1_p = '<?php echo $personal_informationk->gender ?>';
    var personal_form_info1_n = $('#personal_form_info1').find(":selected").text(); 
    if((personal_form_info1_p!=personal_form_info1_n) && (personal_form_info1_n!='Select Gender') )
        check2=1;

    // select race
    var personal_form_info2_p = '<?php echo $personal_information->race ?>';
    var personal_form_info2_n = $('#personal_form_info2').find(":selected").text(); 
    if((personal_form_info2_p!=personal_form_info2_n) && (personal_form_info2_n!='Select Race'))
        check2=1;

    // select ethnicity
    var ethnicity_id_p = '<?php echo $personal_information->ethnicity ?>';
    var ethnicity_id_n = $('#ethnicity_id').find(":selected").text(); 
    if((ethnicity_id_p!=ethnicity_id_n) && (ethnicity_id_n!='Select Ethnicity'))
        check2=1;

    // input ethnicity_other
    var ethnicity_other_p = '<?php echo $personal_information->ethnicity_other; ?>';
    var ethnicity_other_n = $('#ethnicity_other').val();
    if(ethnicity_other_p!=ethnicity_other_n)
        check2=1;

    // select marrige
    var general_info_form_field5_p = '<?php echo $personal_information->marital_status ?>';
    var general_info_form_field5_n = $('#general_info_form_field5').find(":selected").text(); 
    if((general_info_form_field5_p!=general_info_form_field5_n) && (general_info_form_field5_n!='Select Marital Status'))
        check2=1;

    if(check2)
    {
        if (confirm('you want to change this?')) 
        {
              
            
        }
    }

}

</script>
<script type="text/javascript">

function form3()
{
     var check3=0;

    // input home address
    var address_info_field0_p = '<?php echo $address_contact_information->address_1; ?>';
    var address_info_field0_n = $('#address_info_field0').val();
    if(address_info_field0_p!=address_info_field0_n)
        check3=1;

    // input api/suite
    var address_info_field1_p = '<?php echo $address_contact_information->apt_suite; ?>';
    var address_info_field1_n = $('#address_info_field1').val();
    if(address_info_field1_p!=address_info_field1_n)
        check3=2;

    // input city
    var address_info_field2_p = '<?php echo $personal_informationk->city; ?>';
    var address_info_field2_n = $('#address_info_field2').val();
    if(address_info_field2_p!=address_info_field2_n)
        check3=3;

    // input zip
    var address_info_field4_p = '<?php echo $address_contact_information->zip_code; ?>';
    var address_info_field4_n = $('#address_info_field4').val();
    if(address_info_field4_p!=address_info_field4_n)
        check3=13;

    //select state
    var address_info_field3_p = '<?php echo $personal_informationk->state; ?>';
    var address_info_field3_n = $('#address_info_field3').find(":selected").text(); 
    if((address_info_field3_p!=address_info_field3_n) && (address_info_field3_n!='Select State'))
        check3=4;


    // select country
    var address_info_field5_p = '<?php echo $address_contact_information->country ?>';
    var address_info_field5_n = $('#address_info_field5').find(":selected").text(); 
    if(((address_info_field5_p!=address_info_field5_n) && (address_info_field5_n!='Select Country')) && ((address_info_field5_p=='') && (address_info_field5_n!='United States') ) )
        check3=5;

    // input cellphone
    var address_info_field6_p = '<?php echo $address_contact_information->cell_phone; ?>';
    var address_info_field6_n = $('#address_info_field6').val();
    if(address_info_field6_p!=address_info_field6_n)
        check3=6;

    // input bussiness phone
    var address_info_field7_p = '<?php echo $address_contact_information->business_phone; ?>';
    var address_info_field7_n = $('#address_info_field7').val();
    if(address_info_field7_p!=address_info_field7_n)
        check3=7;

     // input home phone
    var address_info_field8_p = '<?php echo $address_contact_information->home_phone; ?>';
    var address_info_field8_n = $('#address_info_field8').val();
    if(address_info_field8_p!=address_info_field8_n)
        check3=8;

    // input home phone
    var address_info_field9_p = '<?php echo $address_contact_information->other_phone; ?>';
    var address_info_field9_n = $('#address_info_field9').val();
    if(address_info_field9_p!=address_info_field9_n)
        check3=9;

    // input email
    var address_info_field10_p = '<?php echo $address_contact_information->email_default; ?>';
    var address_info_field10_n = $('#address_info_field10').val();
    if(address_info_field10_p!=address_info_field10_n)
        check3=10;

    // input home phone
    var address_info_field11_p = '<?php echo $address_contact_information->confirm_email; ?>';
    var address_info_field11_n = $('#address_info_field11').val();
    if(address_info_field11_p!=address_info_field11_n)
        check3=11;

    var address_info_field12_p = '<?php echo $address_contact_information->email_default2; ?>';
    var address_info_field12_n = $('#address_info_field12').val();
    if(address_info_field12_p!=address_info_field12_n)
        check3=12;

    var address_info_field13_p = '<?php echo $address_contact_information->confirm_email2; ?>';
    var address_info_field13_n = $('#address_info_field13').val();
    if(address_info_field13_p!=address_info_field13_n)
        check3=12;


    if(check3)
    {
        // alert(check3)
        if (confirm('you want to change this?'))
        {


        }
    }


}    
</script>
<div id="form5_work" style="display: none;"></div>
<div id="form8_work" style="display: none;"></div>
<script type="text/javascript">
    function form5()
    {
        var check5=0;

    // first_employment_date 
    var employment_information_1_p = '<?php echo $employment_info->first_employment_date; ?>';
    var employment_information_1_n = $('#employment_information_1').val();
    if(employment_information_1_p!=employment_information_1_n)
        check5=1;


    // Selected date
    var employment_information_2_p = '<?php echo $employment_info->first_employment_year ?>';
    var employment_information_2_n = $('#employment_information_2').find(":selected").text(); 
    if( (employment_information_2_p!=employment_information_2_n) &&  (employment_information_2_n!='Select Year') )
        check5=2;


    // first state
    var employement_practice_state1_p = '<?php echo $rowState3->states ?>';
    var employement_practice_state1_n = $('#employement_practice_state1').find(":selected").text(); 
    if( (employement_practice_state1_p!=employement_practice_state1_n) &&  (employement_practice_state1_n!='Select State') )
        check5=3;

    // Second state
    var employement_practice_state2_p = '<?php echo $rowState3->states ?>';
    var employement_practice_state2_n = $('#employement_practice_state2').find(":selected").text(); 
    if( (employement_practice_state2_p!=employement_practice_state2_n) &&  (employement_practice_state2_n!='Select State') )
        check5=4;

    // Third state
    var employement_practice_state3_p = '<?php echo $rowState3->states ?>';
    var employement_practice_state3_n = $('#employement_practice_state3').find(":selected").text(); 
    if( (employement_practice_state3_p!=employement_practice_state3_n) &&  (employement_practice_state3_n!='Select State') )
        check5=5;

    // Fourth state
    var employment_information_3_p = '<?php echo $employment_info->employment_status ?>';
    var employment_information_3_n = $('#employment_information_3').find(":selected").text(); 
    if( (employment_information_3_p!=employment_information_3_n) &&  (employment_information_3_n!='Select Employment Status') )
        check5=6;

    // employer_name 
    var employment_information_7_p = '<?php echo $employment_info->employer_name; ?>';
    var employment_information_7_n = $('#employment_information_7').val();
    if(employment_information_7_p!=employment_information_7_n)
        check5=7;

    // employer_address 
    var employment_information_8_p = '<?php echo $employment_info->employer_name; ?>';
    var employment_information_8_n= $('#employment_information_8').val();
    if(employment_information_8_p!=employment_information_8_n)
        check5=8;

    // employer_apt 
    var employment_information_9_p = '<?php echo $employment_info->employer_apt; ?>';
    var employment_information_9_n= $('#employment_information_9').val();
    if(employment_information_9_p!=employment_information_9_n)
        check5=9;

    // employer_city 
    var employment_information_9000_p = '<?php echo $employment_info->employer_city; ?>';
    var employment_information_9000_n= $('#employment_information_9000').val();
    if(employment_information_9000_p!=employment_information_9000_n)
        check5=10;

    // Select Employer State
    var employment_information_10_p = '<?php echo $rowState2->states?>';
    var employment_information_10_n= $('#employment_information_10').find(":selected").text(); 
    if( (employment_information_10_p!=employment_information_10_n) &&  (employment_information_10_n!='Select Employer State') )
        check5=11;

    // employer_zip 
    var employment_information_11_p = '<?php echo $employment_info->employer_zip; ?>';
    var employment_information_11_n= $('#employment_information_11').val();
    if(employment_information_11_p!=employment_information_11_n)
        check5=12;

    // Select Employer State
    var address_info_field99_p = '<?php echo $employment_info->employer_country ; ?>';
    var address_info_field99_n= $('#address_info_field99').find(":selected").text(); 
    if( ((address_info_field99_p!=address_info_field99_n) &&  (address_info_field99_n!='Select Country') ) &&  
          ((address_info_field99_p=='') && (address_info_field99_n!='United States') )   )
       check5=13;

    // employer_phone 
    var employment_information_12_p = '<?php echo $employment_info->employer_phone ?>';
    var employment_information_12_n= $('#employment_information_12').val();
    if(employment_information_12_p!=employment_information_12_n)
        check5=14;

    // confirm main email
    var employment_information_12_2_p = '<?php echo $employment_info->employer_email_conf ?>';
    var employment_information_12_2_n= $('#employment_information_12_2').val();
    if(employment_information_12_2_p!=employment_information_12_2_n)
        check5=141;

    // confirm main email
    var employment_information_12_hash_p = '<?php echo $employment_info->employer_email_conf ?>';
    var employment_information_12_hash_n= $('#employment_information_12_hash').val();
    if(employment_information_12_hash_p!=employment_information_12_hash_n)
        check5=142;

    // employer_email 
    var employment_information_12jj_p = '<?php echo $employment_info->employer_email; ?>';
    var employment_information_12jj_n= $('#employment_information_12jj').val();
    if(employment_information_12jj_p!=employment_information_12jj_n)
        check5=15;

    // Caaa
    var employment_information_13_p = '<?php echo $employment_info->providers_grp1; ?>';
    var employment_information_13_n= $('#employment_information_13').val();
    if(employment_information_13_p!=employment_information_13_n)
        check5=16;

    // Crna
    var employment_information_14_p = '<?php echo $employment_info->providers_grp1; ?>';
    var employment_information_14_n= $('#employment_information_14').val();
    if(employment_information_14_p!=employment_information_14_n)
        check5=17;

    // Md/Do
    var employment_information_15_p = '<?php echo $employment_info->providers_grp3; ?>';
    var employment_information_15_n= $('#employment_information_15').val();
    if(employment_information_15_p!=employment_information_15_n)
        check5=18;

    // other 1
    var Answer122_p = '<?php echo $employment_info->type_setting_1_other; ?>';
    var Answer122_n= $('#Answer122').val();
    if(Answer122_p!=Answer122_n)
        check5=19;

    // radio 2 other 1
    var employment_information_19_p = '<?php echo $employment_info->type_setting_2_other; ?>';
    var employment_information_19_n= $('#employment_information_19').val();
    if(employment_information_19_p!=employment_information_19_n)
        check5=22;

    // radio 2 other 2
    var employment_information_1925_p = '<?php echo $employment_info->employed_group_other; ?>';
    var employment_information_1925_n= $('#employment_information_1925').val();
    if(employment_information_1925_p!=employment_information_1925_n)
        check5=23;


    // first radio button
       <?php 
       if(!empty($employment_info->type_setting_1))
       {
          $employment_info_type_setting_1 = explode(',', $employment_info->type_setting_1);
          foreach ($employment_info_type_setting_1 as $key => $value) 
          {   ?>
              
                    $('input[name="type_setting_1[]"]:checked').each(function() {
                       var a = document.getElementById('form5_work').innerHTML=this.value;
                       if(  a == '<?php echo "$value" ?>')
                       {         
                          check5=0; 
                       }
                       else
                       {
                           check5=20;
                       }
                   });
              <?php          
          }
       }
       else
       {
          $employment_info_type_setting_1 = []; 
          ?>
                    $('input[name="type_setting_1[]"]:checked').each(function() {
                       var a = document.getElementById('form5_work').innerHTML=this.value;
                         if(a)
                          check5=20;
                    });
          <?php
       }
       ?>  


    // Second radio button
       <?php 
       if(!empty($employment_info->type_setting_2))
       {
          $employment_info_type_setting_2 = explode(',', $employment_info->type_setting_2);
          foreach ($employment_info_type_setting_2 as $key => $values) 
          {   ?>
              
                    $('input[name="type_setting_2[]"]:checked').each(function() {
                       var a = document.getElementById('form5_work').innerHTML=this.value;
                       if(  a == '<?php echo "$values" ?>')
                       {         
                          check5=0; 
                       }
                       else
                       {
                           check5=21;
                       }
                   });
              <?php          
          }
       }
       else
       {
          $employment_info_type_setting_2 = []; 
          ?>
                    $('input[name="type_setting_2[]"]:checked').each(function() {
                       var a = document.getElementById('form5_work').innerHTML=this.value;
                         if(a)
                          check5=21;
                    });
          <?php
       }
       ?>  








    if(check5)
    {   
        // alert(check5)
        if (confirm('you want to change this?'))
        {


        }
    }


    }
</script>



<script type="text/javascript">


function show1(){
  document.getElementById('div1').style.display ='block';
}
function show2(){
  //document.getElementById('div1').style.display = 'none';
}


</script>

<!-- <script type="text/javascript">
$(function() {
    $('.chk_boxes').click(function() {
        $('.chk_boxes1').prop('checked', this.checked);
    });
});
</script> -->



<script type="text/javascript">
    function form6()
    {
        var check6=0;

        // first field
        var full_compension_p = '<?php echo $employer_compensation->full_compension; ?>';
        var full_compension_n = getCheckedValue(document.forms['GeneralInfo_Form_ec'].elements['full_compension'])
        if(full_compension_p!=full_compension_n)
            check6=1;
        
        // Second radio field
        var employer_overtime_compensation_p = '<?php echo $employer_compensation->employer_overtime_compensation; ?>';
        var employer_overtime_compensation_n = getCheckedValue(document.forms['GeneralInfo_Form_ec'].elements['employer_overtime_compensation'])
        if(employer_overtime_compensation_p!=employer_overtime_compensation_n)
            check6=2;

        // Third radio field  
        var employer_overtime_pay_p = '<?php echo $employer_compensation->employer_overtime_pay ?>';
        var employer_overtime_pay_n = getCheckedValue(document.forms['GeneralInfo_Form_ec'].elements['employer_overtime_pay'])
        if(employer_overtime_pay_p!=employer_overtime_pay_n)
            check6=3;          
 

        if(check6)
        {   
            // alert(check6) 
            if (confirm('you want to change this?'))
            {

            }
        }
    } 

    function form7()
    {
       var check7=0;


        // other
        var employment_information_16_p = '<?php echo $employment_info->typical_weekly_other; ?>';
        var employment_information_16_n= $('#employment_information_16').val();
        if(employment_information_16_p!=employment_information_16_n)
            check7=11;

        // $('input[name="typical_weekly1[]"]:checked').each(function() {
        //    // console.log(this.value); 
        //    check7=1;
        // });

        var typical_weekly_hour_pp = '<?php echo $employment_info->typical_weekly1 ?>';
        var typical_weekly_hour_nn = getCheckedValue(document.forms['GeneralInfo_Form_es'].elements['typical_weekly1']);


        if(typical_weekly_hour_pp!=typical_weekly_hour_nn)
            check7=1;


        // Second radio work per day
        var typical_weekly_hour_p = '<?php echo $employment_info->typical_weekly_hour ?>';
        var typical_weekly_hour_n = getCheckedValue(document.forms['GeneralInfo_Form_es'].elements['typical_weekly_hour'])
        if(typical_weekly_hour_p!=typical_weekly_hour_n)
            check7=2;

        // Direct patient
        var employment_information_17_p = '<?php echo $employment_info->divided_1; ?>';
        var employment_information_17_n= $('#employment_information_17').val();
        if(employment_information_17_p!=employment_information_17_n)
            check7=3;

        // InDirect patient
        var employment_information_18_p = '<?php echo $employment_info->divided_2; ?>';
        var employment_information_18_n= $('#employment_information_18').val();
        if(employment_information_18_p!=employment_information_18_n)
            check7=4;

        // Administration
        var employment_information_19_p = '<?php echo $employment_info->divided_3; ?>';
        var employment_information_19_n= $('#employment_information_19_ak').val();
        if(employment_information_19_p!=employment_information_19_n)
            check7=5;

        // Nonclinical training
        var employment_information_20_p = '<?php echo $employment_info->divided_4; ?>';
        var employment_information_20_n= $('#employment_information_20').val();
        if(employment_information_20_p!=employment_information_20_n)
            check7=6;

        // Research
        var employment_information_21_p = '<?php echo $employment_info->divided_5; ?>';
        var employment_information_21_n= $('#employment_information_21').val();
        if(employment_information_21_p!=employment_information_21_n)
            check7=7;

        // Activities related to 
        var employment_information_22_p = '<?php echo $employment_info->divided_6; ?>';
        var employment_information_22_n= $('#employment_information_22').val();
        if(employment_information_22_p!=employment_information_22_n)
            check7=8;

        // Other
        var employment_information_23_p = '<?php echo $employment_info->divided_7; ?>';
        var employment_information_23_n= $('#employment_information_23').val();
        if(employment_information_23_p!=employment_information_23_n)
            check7=9;

        // Na radio work 
        var employment_information_24_p = '<?php echo $employment_info->divided_8 ?>';
        var employment_information_24_n = getCheckedValue(document.forms['GeneralInfo_Form_es'].elements['employment_information_24'])
        if(employment_information_24_p!=employment_information_24_n)
            check7=10;



        if(check7)
        {   
            // alert(check7) 
            if (confirm('you want to change this?'))
            {

            }
        }  


    }

    function form8()
    {
       var check8=0;
         
        // date
        var retirement_field7_p = '<?php echo $employer_retirement->anticipated_month_retirement; ?>';
        var retirement_field7_n= $('#retirement_field7').val();
        if(retirement_field7_p!=retirement_field7_n)
            check8=3;

        // Other emp
        var benefit_field0_p = '<?php echo $employer_benefits->other_benefits; ?>';
        var benefit_field0_n= $('#benefit_field0').val();
        if(benefit_field0_p!=benefit_field0_n)
            check8=2;




        // Other
        var retirement_field0_p = '<?php echo $employer_retirement->retirement_setup_plan_other; ?>';
        var retirement_field0_n= $('#retirement_field0').val();
        if(retirement_field0_p!=retirement_field0_n)
            check8=5;

        // Profit Sharing
        var retirement_field1_p = '<?php echo $employer_retirement->profit_sharing; ?>';
        var retirement_field1_n= $('#retirement_field1').val();
        if(retirement_field1_p!=retirement_field1_n)
            check8=6;

        // employer_matching
        var retirement_field2_p = '<?php echo $employer_retirement->employer_matching; ?>';
        var retirement_field2_n= $('#retirement_field2').val();
        if(retirement_field2_p!=retirement_field2_n)
            check8=7;

        // employer_offer_lumpsum
        var retirement_field3_p = '<?php echo $employer_retirement->employer_offer_lumpsum; ?>';
        var retirement_field3_n= $('#retirement_field3').val();
        if(retirement_field3_p!=retirement_field3_n)
            check8=8;

        // Pension
        var retirement_field4_p = '<?php echo $employer_retirement->pension_of; ?>';
        var retirement_field4_n= $('#retirement_field4').val();
        if(retirement_field4_p!=retirement_field4_n)
            check8=9;

        // Pension of years
        var retirement_field5_p = '<?php echo $employer_retirement->after_service_years; ?>';
        var retirement_field5_n= $('#retirement_field5').val();
        if(retirement_field5_p!=retirement_field5_n)
            check8=10;

        // service_offer_other
        var retirement_field6_p = '<?php echo $employer_retirement->service_offer_other; ?>';
        var retirement_field6_n= $('#retirement_field6').val();
        if(retirement_field6_p!=retirement_field6_n)
            check8=11;


        var benefit_field0_p = '<?php echo $employer_benefits->other_benefits; ?>';
        var benefit_field0_n= $('#benefit_field0').val();
        if(benefit_field0_p!=benefit_field0_n)
        check8=15;

         
       <?php 
       if(!empty($employer_benefits->employer_offer_benefit))
       {
          $employment_info_type_setting_1 = explode(',', $employer_benefits->employer_offer_benefit);
          $Count1 = count($employment_info_type_setting_1);
          $p = 0;
          foreach ($employment_info_type_setting_1 as $key => $value) 
          {   ?>
              
                    $('input[name="employer_offer_benefit[]"]:checked').each(function() {
                       var a = document.getElementById('form5_work').innerHTML=this.value;
                       var jscount = document.querySelectorAll('input[name="employer_offer_benefit[]"]:checked').length;
                       var b = '<?php echo $value ?>';
                       var phpcount = '<?php echo $Count1 ?>';
                       console.log(this.value)
                       // alert(b); 
                        if(jscount>phpcount){
                        check8 = 12;
                       }else if(a==b)
                       {  
                        // check8=0; 
                       }
                       else{
                        $check8 = 12;
                       }


                   });
              <?php          
          }
       }
       else
       {
          $employment_info_type_setting_1 = []; 
          ?>
                    $('input[name="employer_offer_benefit[]"]:checked').each(function() {
                       var a = document.getElementById('form5_work').innerHTML=this.value;
                         if(a)
                          check8=12;
                    });
          <?php
       }
       ?> 

       <?php 
       if(!empty($employer_retirement->retirement_setup_plan))
       {
          $employment_info_type_setting_1 = explode(',', $employer_retirement->retirement_setup_plan);
          $Count1 = count($employment_info_type_setting_1);
          $p = 0;
          foreach ($employment_info_type_setting_1 as $key => $value) 
          {   ?>
              
                    $('input[name="retirement_setup_plan[]"]:checked').each(function() {
                       var a = document.getElementById('form5_work').innerHTML=this.value;
                       var jscount = document.querySelectorAll('input[name="retirement_setup_plan[]"]:checked').length;
                       var b = '<?php echo $value ?>';
                       var phpcount = '<?php echo $Count1 ?>';
                       console.log(this.value)
                       // alert(b); 
                        if(jscount>phpcount){
                        check8 = 13;
                       }else if(a==b)
                       {  
                        // check8=0; 
                       }
                       else{
                        $check8 = 13;
                       }


                   });
              <?php          
          }
       }
       else
       {
          $employment_info_type_setting_1 = []; 
          ?>
                    $('input[name="retirement_setup_plan[]"]:checked').each(function() {
                       var a = document.getElementById('form5_work').innerHTML=this.value;
                         if(a)
                          check8=13;
                    });
          <?php
       }
       ?>

       // alert(check8);

        if(check8)
        {   
            if (confirm('you want to change this?'))
            {

            }
        } 

    }
    
    function form9()
    {
       var check9=0;

    var skills_field0_p = '<?php echo $employee_skills->languages_speak ; ?>';
    var skills_field0_n= $('#skills_field0').find(":selected").text(); 
    if( (skills_field0_p!=skills_field0_n) &&  (skills_field0_n!='Select Language') )
       check9=1;

    // Na radio work 
    var other_than_english_p = '<?php echo $employee_skills->other_than_english ?>';
    var other_than_english_n = getCheckedValue(document.forms['GeneralInfo_Form_sk'].elements['other_than_english'])
    if(other_than_english_p!=other_than_english_n)
        check9=2;


    // language 1 
    var skills_field1_p = '<?php echo $employee_skills->which_languages ; ?>';
    var skills_field1_n= $('#skills_field1').find(":selected").text(); 
    if( (skills_field1_p!=skills_field1_n) &&  (skills_field1_n!='Select One') )
       check9=3;

    // language 2
    var skills_field2_p = '<?php echo $employee_skills->skills_languages2 ; ?>';
    var skills_field2_n= $('#skills_field2').find(":selected").text(); 
    if( (skills_field2_p!=skills_field2_n) &&  (skills_field2_n!='Select One') )
       check9=4;

    // language 3
    var skills_field3_p = '<?php echo $employee_skills->skills_languages3 ; ?>';
    var skills_field3_n= $('#skills_field3').find(":selected").text(); 
    if( (skills_field3_p!=skills_field3_n) &&  (skills_field3_n!='Select One') )
       check9=5;

    // language 4
    var skills_field4_p = '<?php echo $employee_skills->skills_languages4 ; ?>';
    var skills_field4_n= $('#skills_field4').find(":selected").text(); 
    if( (skills_field4_p!=skills_field4_n) &&  (skills_field4_n!='Select One') )
       check9=6;      

    // Other
    var other_techniques1_p = '<?php echo $employee_skills->all_specialities_techniques_other; ?>';
    var other_techniques1_n= $('#other_techniques1').val();
    if(other_techniques1_p!=other_techniques1_n)
        check9=9;


    var teach_or_environment_p = '<?php echo $employee_skills->teach_or_environment; ?>';
    var checked = $("#environment1").prop("checked");
    if(checked){
      teach_or_environment_n = 'Yes';
    }else{
      teach_or_environment_n = '';
    }
    if(teach_or_environment_p!=teach_or_environment_n)
        check9=11;
	
    var teach_healthcare_or_p = '<?php echo $employee_skills->teach_healthcare_or; ?>';
    var checked = $("#healthcare1").prop("checked");
    if(checked){
      teach_healthcare_or_n = 'Yes';
    }else{
      teach_healthcare_or_n = '';
    }
    if(teach_healthcare_or_p!=teach_healthcare_or_n)
        check9=12;

       <?php 
       if(!empty($employee_skills->all_specialities_techniques))
       {
          $employment_info_type_setting_1 = explode(" , ",$employee_skills->all_specialities_techniques);
          // $Count1 = count($employment_info_type_setting_1);
          $Count1 = $my_count;
          $p = 0;
          foreach ($employment_info_type_setting_1 as $key => $value) 
          {   ?>
              
                    $('input[name="all_specialities_techniques[]"]:checked').each(function() {
                       var a = document.getElementById('form5_work').innerHTML=this.value;
                       var jscount = document.querySelectorAll('input[name="all_specialities_techniques[]"]:checked').length;
                       var b = '<?php echo $value ?>';
                       var phpcount = '<?php echo $Count1 ?>';
                       console.log(this.value)
   // alert(jscount);
   // alert(phpcount);
                        if(jscount>phpcount){
                        check9 = 10;
                       }else if(a==b)
                       {  
                        // check8=0; 
                       }
                       else{
                        $check9 = 10;
                       }


                   });
              <?php          
          }
       }
       else
       {
          $employment_info_type_setting_1 = []; 
          ?>
                    $('input[name="all_specialities_techniques[]"]:checked').each(function() {
                       var a = document.getElementById('form5_work').innerHTML=this.value;
    
                         if(a)
                          check9=10;
                    });
          <?php
       }
       ?>



      if(check9)
        {   
            // alert(check9) 
            if (confirm('you want to change this?'))
            {

            }
        } 


    }

    function form10()
    {
        var check10=0;

        // anesthesiology-related groups
        // var belong_to_othermembership_p = '<?php echo $other_memberships->belong_to_othermembership ?>';
        // var belong_to_othermembership_n = getCheckedValue(document.forms['GeneralInfo_Form_mem'].elements['belong_to_othermembership'])

        // if(belong_to_othermembership_p!=belong_to_othermembership_n)
        // {   
        //     check10=1;
        //     if(belong_to_othermembership_n=='Yes')
        //     {

                // first 1 national
                var national_p = '<?php echo $other_memberships->national ; ?>';
                var national_n= $('#national').val();
                if( (national_p!=national_n) &&  (national_n!='Select National') )
                   check10=2;

                // Second 2 national
                var StateLevel_Assistants_p = '<?php echo $other_memberships->StateLevel_Assistants ; ?>';
                var StateLevel_Assistants_n= $('#StateLevel_Assistants').find(":selected").text(); 
                if( (StateLevel_Assistants_p!=StateLevel_Assistants_n) &&  (StateLevel_Assistants_n!='Select State Level') )
                   check10=3;

                // Third 3 national
                var national1_p = '<?php echo $other_memberships->national1 ; ?>';
                var national1_n= $('#national1').val(); 
                if( (national1_p!=national1_n) &&  (national1_n!='Select National') )
                   check10=4;
                                
                // Four 4 national
                var StateLevel_Anesthesiologists_p = '<?php echo $other_memberships->StateLevel_Anesthesiologists ; ?>';
                var StateLevel_Anesthesiologists_n= $('#StateLevel_Anesthesiologists').find(":selected").text(); 
                if( (StateLevel_Anesthesiologists_p!=StateLevel_Anesthesiologists_n) &&  (StateLevel_Anesthesiologists_n!='Select State Level') )
                   check10=5;
        //     }
        // } 

       if(check10)
        {   
            // alert(check10) 
            if (confirm('you want to change this?'))
            {

            }
        } 



    }




function getCheckedValue(radioObj) {
  if(!radioObj)
    return "";
  var radioLength = radioObj.length;
  if(radioLength == undefined)
    if(radioObj.checked)
      return radioObj.value;
    else
      return "";
  for(var i = 0; i < radioLength; i++) {
    if(radioObj[i].checked) {
      return radioObj[i].value;
    }
  }
  return "";
}
   
</script>

<?php 

if(empty($other_memberships->belong_to_othermembership)){ ?> 
    <script>


$(function() {
    show2();

    var $radios = $('input:radio[name=belong_to_othermembership]');
    if($radios.is(':checked') === false) {
        $radios.filter('[value=No]').prop('checked', true);
    }
});


 </script> <?php } ?>




<?php 

if($other_memberships->belong_to_othermembership == "No"){ ?> 
    <script>
$(function(){


 show2();

 });

 </script> <?php } ?>



<script type="text/javascript">
function checkValidation(){
    //alert('fdgdg');
    var program_university_17 = $('#program_university_17').val();
    var program_university_18 = $('#program_university_18').val();
    //alert(program_university_17);
    //alert(program_university_18);
    if(program_university_17 == '' && program_university_18 == ''){
       // alert('fdsfds');
        $('#msg_div').html('Please choose any one.');
        return false;
    }else{
      $('#msg_div').html('');
      return true;
    }

}
 


 </script> 

