var hasChanges = false;var form_id = null;$( document ).ready(function() {
	var datepicker = jQuery( ".datepicker" ).datepicker({				autoclose: true,		
		dateFormat: "mm/dd/yy"
	});

	var slider = jQuery( ".slider" ).slider({
	});

	jQuery('[data-toggle="popover"]').popover()
	
	$("input").on( 'change', function(e) {				form_id = $(this).closest('form').attr('id');		
		hasChanges=true;
	});
	
	$("select").on( 'change', function(e) {				form_id = $(this).closest('form').attr('id');				hasChanges=true;
	});

	$(".other-checkbox").on( 'click', function(e) {

		var otherid = $(this).data("otherid");

		if ( $(this).prop("checked") ) $("#"+otherid).show();
		else $("#"+otherid).hide();
	});

	$(".clear-group").on( 'click', function(e) {

		var group = $(this).data("group");
		
		$('.check-group').filterByData('group', group).each( function () {
			$(this).prop("checked", false);
			$("#" + $(this).data("otherid")).hide();
		});
	});

	$(".check-group").on( 'click', function(e) {

		var group = $(this).data("group");
		
		$('.clear-group').filterByData('group', group).each( function () {
			$(this).prop("checked", false);
			$("#" + $(this).data("otherid")).hide();
		});
		
	});

	$(".left-shift").on( 'change', function(e) {

		var group = $(this).data("shiftgroup");
		var count = $('.left-shift').filterByData('shiftgroup', group).length;
		
		if ( count > 1) {
			for( k=0 ; k < count ; k++ ) {
				for( i=( count ) ; i > 0 ; i-- ) {
					if ( ( $("."+group+"-left-shift-" + (i).toString() ).val()!='') && ( $("."+group+"-left-shift-" + (i-1).toString() ).val()=='') )  {
						$("."+group+"-left-shift-" + (i-1).toString() ).val( $("."+group+"-left-shift-" + (i).toString() ).val() );
						$("."+group+"-left-shift-" + (i).toString() ).val('');
					}
				}
			}
		}
	});
	
	
	$("#other_than_english1").on( 'click', function(e) {

		$(".lang_communicate").show();
		$("#GeneralInfo_Form_sk").validate();
		$("#skills_field1").validate();
		//$("#skills_field1").data("validation","required");
		//$("#skills_field1").rules("add","required");

	});
		
	$("#other_than_english2").on( 'click', function(e) {

		$(".lang_communicate").hide();
		$("#GeneralInfo_Form_sk").validate();
		$("#skills_field1").validate();
		$("#skills_field1").data("validation","");
		//$("#skills_field1").rules("remove","required");
		
	});

	$("#belong_to_othermembership1").on( 'click', function(e) {

		$("#memberships-div").show();

	});
		
	$("#belong_to_othermembership2").on( 'click', function(e) {

		$("#memberships-div").hide();

	});

	$(".glyphicon-eye-open").on("click", function() {
		$(this).toggleClass("glyphicon-eye-close");
		var field = $(this).data('field');
	  var type = $("#"+field).attr("type");
		if (type == "text"){ 
		  $("#"+field).prop('type','password');
		} else { 
 			$("#"+field).prop('type','text'); 
 		}
	});
	
	$("#emp_work_schedule_1").on('change', function(e) {
		if ( $(this).prop('checked')) {
			$("#typical_weekly_other").hide();
		}
	});
	$("#emp_work_schedule_2").on('change', function(e) {
		if ( $(this).prop('checked')) {
			$("#typical_weekly_other").hide();
		}
	});
	$("#emp_work_schedule_3").on('change', function(e) {
		if ( $(this).prop('checked')) {
			$("#typical_weekly_other").hide();
		}
	});
	$("#emp_work_schedule_4").on('change', function(e) {
		if ( $(this).prop('checked')) {
			$("#typical_weekly_other").hide();
		}
	});

	$("#emp_work_schedule_5").on('change', function(e) {

		if ( $(this).prop('checked')) {
			$("#typical_weekly_other").show();
		} else {
			$("#typical_weekly_other").hide();
		}
				
	});


	$("#ethnicity_other").on('change', function(e) {
		if ( $(this).val!="" ) $("#ethnicity_id").val("Other");
	});
	
	$("#program_university_17").on('change', function(e) {		
		var datepicked=$(this).val();
		var fromDate = new Date(datepicked);
		var year = fromDate.getFullYear();
		$("#program_university_18").val( year );
	});

	$("#employment_information_1").on('change', function(e) {
		var datepicked=$(this).val();
		var fromDate = new Date(datepicked);
		var year = fromDate.getFullYear();
		$("#employment_information_2").val( year );
	});

	$("#retirement_field7").on('change', function(e) {
		var datepicked=$(this).val();
		var fromDate = new Date(datepicked);
		var year = fromDate.getFullYear();
		$("#retirement_field8").val( year );
	});


	changeDetection();

	$('owl-prev').click(function(){
		setTimeout( function() { changeDetection(); }, 1000 );
	});

	$('owl-next').click(function(){
		setTimeout( function() { changeDetection(); }, 1000 );
	});
	var specialties_requiredCheckboxes = $('.chk_boxes1');
	specialties_requiredCheckboxes.change(function(){
		var myChecked=false;
		specialties_requiredCheckboxes.each( function() {
						if ( $(this).is(':checked') ) {
						myChecked=true;
						}
		});

		if ( myChecked ) {
			specialties_requiredCheckboxes.last().attr("oninvalid", "this.setCustomValidity('')");
			specialties_requiredCheckboxes.last().attr("oninput", "this.setCustomValidity('')");
			specialties_requiredCheckboxes.last().attr('required', false);
			specialties_requiredCheckboxes.last().prop('required', false);
			specialties_requiredCheckboxes.last().removeAttr('required');
		} else {
			// specialties_requiredCheckboxes.last().attr('required', 'required');
			// specialties_requiredCheckboxes.last().prop('required', 'required');
			specialties_requiredCheckboxes.last().attr("oninput", "this.setCustomValidity('')");
			specialties_requiredCheckboxes.last().attr("oninvalid", "this.setCustomValidity('You must select at least 1 specialty')");
		}
	});
	specialties_requiredCheckboxes.last().change();

	var compensation_requiredCheckboxes = $('#full-compensation :radio');
	compensation_requiredCheckboxes.change(function(){
		var myChecked=false;
		compensation_requiredCheckboxes.each( function() {
						if ( $(this).is(':checked') ) {
						myChecked=true;
						}
		});

		if ( myChecked ) {
			compensation_requiredCheckboxes.last().attr("oninvalid", "this.setCustomValidity('')");
			compensation_requiredCheckboxes.last().attr("oninput", "this.setCustomValidity('')");
			compensation_requiredCheckboxes.last().attr('required', false);
			compensation_requiredCheckboxes.last().prop('required', false);
			compensation_requiredCheckboxes.last().removeAttr('required');
		} else {
			// compensation_requiredCheckboxes.last().attr('required', 'required');
			// compensation_requiredCheckboxes.last().prop('required', 'required');
			compensation_requiredCheckboxes.last().attr("oninput", "this.setCustomValidity('')");
			compensation_requiredCheckboxes.last().attr("oninvalid", "this.setCustomValidity('You must select at least 1y')");
		}
	});
	compensation_requiredCheckboxes.last().change();

	var overtime_requiredCheckboxes = $('#when-overtime :radio');
	overtime_requiredCheckboxes.change(function(){
		var myChecked=false;
		compensation_requiredCheckboxes.each( function() {
						if ( $(this).is(':checked') ) {
						myChecked=true;
						}
		});

		if ( myChecked ) {
			overtime_requiredCheckboxes.last().attr("oninvalid", "this.setCustomValidity('')");
			overtime_requiredCheckboxes.last().attr("oninput", "this.setCustomValidity('')");
			overtime_requiredCheckboxes.last().attr('required', false);
			overtime_requiredCheckboxes.last().prop('required', false);
			overtime_requiredCheckboxes.last().removeAttr('required');
		} else {
			// overtime_requiredCheckboxes.last().attr('required', 'required');
			// overtime_requiredCheckboxes.last().prop('required', 'required');
			overtime_requiredCheckboxes.last().attr("oninput", "this.setCustomValidity('')");
			overtime_requiredCheckboxes.last().attr("oninvalid", "this.setCustomValidity('You must select at least 1')");
		}
	});
	overtime_requiredCheckboxes.last().change();
    
	var schedule_requiredCheckboxes = $('#typical-schedule :radio');
	schedule_requiredCheckboxes.change(function(){
		var myChecked=false;
		schedule_requiredCheckboxes.each( function() {
						if ( $(this).is(':checked') ) {
						myChecked=true;
						}
		});

		if ( myChecked ) {
			schedule_requiredCheckboxes.last().attr("oninvalid", "this.setCustomValidity('')");
			schedule_requiredCheckboxes.last().attr("oninput", "this.setCustomValidity('')");
			schedule_requiredCheckboxes.last().attr('required', false);
			schedule_requiredCheckboxes.last().prop('required', false);
			schedule_requiredCheckboxes.last().removeAttr('required');
		} else {
			// schedule_requiredCheckboxes.last().attr('required', 'required');
			// schedule_requiredCheckboxes.last().prop('required', 'required');
			schedule_requiredCheckboxes.last().attr("oninput", "this.setCustomValidity('')");
			schedule_requiredCheckboxes.last().attr("oninvalid", "this.setCustomValidity('You must select at least 1')");
		}
	});
	schedule_requiredCheckboxes.last().change();


	var hours_requiredCheckboxes = $('#typical-hours :radio[required]');
	hours_requiredCheckboxes.change(function(){
		var myChecked=false;
		hours_requiredCheckboxes.each( function() {
						if ( $(this).is(':checked') ) {
						myChecked=true;
						}
		});

		if ( myChecked ) {
			hours_requiredCheckboxes.last().attr("oninvalid", "this.setCustomValidity('')");
			hours_requiredCheckboxes.last().attr("oninput", "this.setCustomValidity('')");
			hours_requiredCheckboxes.last().attr('required', false);
			hours_requiredCheckboxes.last().prop('required', false);
			hours_requiredCheckboxes.last().removeAttr('required');
		} else {
			// hours_requiredCheckboxes.last().attr('required', 'required');
			// hours_requiredCheckboxes.last().prop('required', 'required');
			hours_requiredCheckboxes.last().attr("oninput", "this.setCustomValidity('')");
			hours_requiredCheckboxes.last().attr("oninvalid", "this.setCustomValidity('You must select at least 1')");
		}
	});
	hours_requiredCheckboxes.last().change();
	
	setTimeout( function() { hasChanges=false; form_id = null;}, 300 );
	
	//if ( current_tab=="current4" ) comingSoon();

});


(function($) {

  $.fn.filterByData = function(prop, val) {
    var $self = this;
    if (typeof val === 'undefined') {
      return $self.filter(

        function() {
          return typeof $(this).data(prop) !== 'undefined';
        });
    }
    return $self.filter(

      function() {
        return $(this).data(prop) == val;
      });
  };

})(window.jQuery);

function changeDetection() {
	 $('ul.tabs li').unbind('click');
   $('ul.tabs li').click(function(){
    		if ( hasChanges ) {
				swal({
					title: "Warning!",
					text: "You have made changes to this page without saving.",					buttons: ["No! Continue to tab", "Yes! Save all changes"],										dangerMode: true,										showCancel: true,					
				}).then((willContinue) => {
					if (willContinue) {												hasChanges = false;												var current = null;												switch ($(this).attr('data-tab')) {						  						  case "tab-1":							current = "current1";							break;						  case "tab-2":							current = "current2";							break;						  case "tab-3":							current = "current3";							break;						  case "tab-4":							current = "current4";							break;						  case "tab-5":							current = "current5";							break;						  case "tab-6":							current = "current6";							break;						  case "tab-7":							current = "current7";							break;						  case "tab-8":							current = "current8";							break;						  case "tab-9":							current = "current9";							break;						  case "tab-10":							current = "current10";						  						}												$('#' + form_id).attr('action', "editProfile/tab1.php?tab=" + current).submit();												// if ( $(this).attr('data-tab')=="tab-4" ) {
							// comingSoon();
							// return( false );
						// }												form_id = null;												current = null;

					} else {											hasChanges = false;						var tab_id = $(this).attr('data-tab');						$('ul.tabs li').removeClass('current');						$('.tab-content').removeClass('current');						$(this).addClass('current');						$("#"+tab_id).addClass('current');
					}
				});
    		} else {
				var tab_id = $(this).attr('data-tab');
				$('ul.tabs li').removeClass('current');
				$('.tab-content').removeClass('current');
				$(this).addClass('current');
				$("#"+tab_id).addClass('current');
				// if ( tab_id=="tab-4") setTimeout( function() { comingSoon(); }, 100 );
		    }
    });
	
}

function comingSoon() {
					swal({
		  			title: "Coming Soon!",
					  text: "This page cannot be edited",
					  icon: "warning",
						buttons: false,
					  timer: 5000,
					  dangerMode: false,
					}).then(() => {
     	        $('ul.tabs li').removeClass('current');
			        $('.tab-content').removeClass('current');

			        if ( user_role=="Student" ) {
			        	$('.tab-link').filterByData('tab', 'tab-9').click();
		        		$('.tab-link').filterByData('tab', 'tab-9').addClass('current');
	        			$("#tab-9").addClass('current');
		        	} else {
				        $('.tab-link').filterByData('tab', 'tab-5').click();
		        		$('.tab-link').filterByData('tab', 'tab-5').addClass('current');
	        			$("#tab-5").addClass('current');
							}
					});
	
}