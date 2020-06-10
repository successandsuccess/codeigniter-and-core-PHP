function cmemodal_css(id){
	
	$("#" + id).css("overflow-x", "hidden");
	
	$("#" + id).css("overflow-y", "auto");
	
}

$(function(){
	/////////cme module start/////////
    $('#cme_first_pay').click(function(){
        $('#paymentContentModal_cme').modal({
			show: true,
			backdrop: 'static',
			keyboard: false
		}); 
		cmemodal_css('paymentContentModal_cme');
	});

	$('#cme_first_pay_1').click(function(){
        $('#paymentContentModal_cme').modal({
			show: true,
			backdrop: 'static',
			keyboard: false
		}); 
		cmemodal_css('paymentContentModal_cme');
	});

	$("#receiptContentModal_cme").on("hidden.bs.modal", function () {
         location.href = "?content=content/cmehistory";
    });
});




function cme_privacy_fun(){
	
	$('#paymentContentModal_cme').modal('hide');
	
	$('#privacy_modal').modal({
		show: true,
		backdrop: 'static',
		keyboard: false
	});
	
	cmemodal_css('privacy_modal');
	
	$("#cdq_privacy_back").hide();
	
	$("#cme_privacy_back").show();
	
	$("#certification_privacy_back").hide();
	
}

function cme_privacy_back(){
	
	$('#paymentContentModal_cme').modal({
		show: true,
		backdrop: 'static',
		keyboard: false
	}); 
	
	cmemodal_css('paymentContentModal_cme');
	
	$('#privacy_modal').modal('hide');
	
}

function cme_terms_fun(){
	
	$('#paymentContentModal_cme').modal('hide');
	
	$('#terms_modal').modal({
		show: true,
		backdrop: 'static',
		keyboard: false
	}); 
	
	cmemodal_css('terms_modal');
	
	$("#cdq_terms_back").hide();
	
	$("#cme_terms_back").show();
	
	$("#certification_terms_back").hide();
	
}

function cme_terms_back(){
	
	$('#paymentContentModal_cme').modal({
		show: true,
		backdrop: 'static',
		keyboard: false
	}); 
	
	cmemodal_css('paymentContentModal_cme');
	
	$('#terms_modal').modal('hide');
	
}

function receipt_print_cme(elem) {
	
	$(".close").hide();
	
	$(".receipt_bottom").hide();
	
    var domClone = elem.cloneNode(true);
    
    var $printSection = document.getElementById("printSection");
    
    if (!$printSection) {
		
        var $printSection = document.createElement("div");
		
        $printSection.id = "printSection";
		
        document.body.appendChild($printSection);
		
    }
    
    $printSection.innerHTML = "";
	
    $printSection.appendChild(domClone);
	
    window.print();
	
	window.history.replaceState({}, '', '?content=content/cmehistory');
	
}

new Cleave('#card-expiry-element-cme', {

    date: true,

    datePattern: ['m', 'y']

});



$( "#frmStripePaymentCME" ).validate({

    rules: {

        field: {

            required: true,

            number: true

        }

    }

});

$("#card-number-cme").rules("add", {

    required: true,

    number: true

});



$("#card-expiry-element-cme").rules("add", {

    required: true,

});



$("#code-cme").rules("add", {

    required: true,

});



$("#name-cme").rules("add", {

    required: true,

});



$("#address-cme").rules("add", {

    required: true,

});



$("#city-cme").rules("add", {

    required: true,

});



$("#state-cme").rules("add", {

    required: true,

});



$("#zip-cme").rules("add", {

    required: true,

});

