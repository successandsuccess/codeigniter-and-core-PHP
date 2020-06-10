var hasChanges = false;

$( document ).ready(function() {
 
	var datepicker = jQuery( ".datepicker" ).datepicker({
  	dateFormat: "mm/dd/yy"
	});

	var slider = jQuery( ".slider" ).slider({
	});

	jQuery('[data-toggle="popover"]').popover()
	
	$("input").on( 'change', function(e) {
		hasChanges=true;
	});
	
	$("select").on( 'change', function(e) {
		hasChanges=true;
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
		$("#skills_field1").data("validation","required");
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


   $('ul.tabs li').click(function(){
    		if ( hasChanges ) {

					swal({
		  			title: "Confirm Navigation",
					  text: "You have changes that are not saved.\r\ndo you wish to continue ?",
					  icon: "warning",
						buttons: true,
						showCancel: true,
					  dangerMode: true,
					}).then((willContinue) => {
					  if (willContinue) {
					  	hasChanges = false;
			        var tab_id = $(this).attr('data-tab');

			        $('ul.tabs li').removeClass('current');
			        $('.tab-content').removeClass('current');

			        $(this).addClass('current');
			        $("#"+tab_id).addClass('current');
						} else {
							return( false );
						}
					});
    		} else {
	        var tab_id = $(this).attr('data-tab');

	        $('ul.tabs li').removeClass('current');
	        $('.tab-content').removeClass('current');

	        $(this).addClass('current');
	        $("#"+tab_id).addClass('current');
				}
    });


