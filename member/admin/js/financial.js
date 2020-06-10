var fieldData = {};
$(document).ready(function() {
    $('.datepicker').datepicker({
        autoclose: true,
    });
    $('#financialLedger').DataTable({
        "pageLength": 50,
        "deferRender": true,
        "orderClasses": false,
        searching: true,
        paging: true,
        lengthMenu: [10, 50, 100, 500],
    });
    $('#financialLedger_length').css('display', 'block');
    $('#financialLedger_info').css('display', 'block');
    // if($.fn.dataTable.isDataTable("#financialLedger")){
    // $("#financialLedger").css("display", "block");
    // }
    $('#add_cert').click(function(e) {
        $("#add_cert_modal").modal('show');
    });
    $('#add_cdq').click(function(e) {
        $("#add_cdq_modal").modal('show');
    });
    $('#add_cme').click(function(e) {
        $("#add_cme_modal").modal('show');
    });
    $('#add_admin').click(function(e) {
        $("#add_admin_modal").modal('show');
    });
    $("#cert_name").select2();
    $("#cdq_name").select2();
    $("#cme_name").select2();
});

function init_cert_fields() {
    $('#cert_name').val(0);
    $('#cert_date').val('');
    $('#cert_4cardnum').val('');
    $('#cert_month').val(0);
    $('#cert_year').val('');
    $('#cert_category').val(0);
    $('#cert_amount').val('');
}

function init_cdq_fields() {
    $('#cdq_name').val(0);
    $('#cdq_date').val('');
    $('#cdq_4cardnum').val('');
    $('#cdq_month').val(0);
    $('#cdq_year').val('');
    $('#cdq_category').val(0);
    $('#cdq_amount').val('');
}

function init_cme_fields() {
    $('#cme_name').val(0);
    $('#cme_date').val('');
    $('#cme_4cardnum').val('');
    $('#cme_year').val('');
    $('#cme_category').val(0);
    $('#cme_amount').val('');
}
/*function init_admin_fields(){


	


	$('#cme_name').val('');


	$('#cme_date').val('');


	$('#cme_4cardnum').val('');


	$('#cme_year').val('');


	$('#cme_category').val('');


	$('#cme_amount').val('');


	


}*/
function cert_category_change() {
    var cert = $('#cert_category').val();
    if (cert == 1) {
        $('#cert_amount').val(1327.5);
    } else if (cert == 2) {
        $('#cert_amount').val(1593);
    } else {
        $('#cert_amount').val(150);
    }
}

function cdq_category_change() {
    var cdq = $('#cdq_category').val();
    if (cdq == 1) {
        $('#cdq_amount').val(1000);
    } else if (cdq == 2) {
        $('#cdq_amount').val(1327.5);
    } else {
        $('#cdq_amount').val(150);
    }
}

function cme_category_change() {
    var cme = $('#cme_category').val();
    if (cme == 1) {
        $('#cme_amount').val(235);
    } else {
        $('#cme_amount').val(735);
    }
}
$('#add_cert_info').click(function() {
    if ($('#cert_name').val() == "" || $('#cert_name').val() == 0) {
        alert("Please select student");
        $('#cert_name').focus();
        return;
    } else if ($('#cert_date').val() == "") {
        $('#cert_date').focus();
        return;
    } else if ($('#cert_4cardnum').val() == "") {
        $('#cert_4cardnum').focus();
        return;
    } else if ($('#cert_month').val() == "" || $('#cert_month').val() == 0) {
        alert("Please select exam month.");
        $('#cert_month').focus();
        return;
    } else if ($('#cert_year').val() == "" || $('#cert_year').val() == 0) {
        $('#cert_year').focus();
        return;
    } else if ($('#cert_category').val() == "") {
        $('#cert_category').focus();
        return;
    }
    fieldData = {
        cert_name: $('#cert_name').val(),
        cert_date: $('#cert_date').val(),
        cert_4cardnum: $('#cert_4cardnum').val(),
        cert_month: $('#cert_month').val(),
        cert_year: $('#cert_year').val(),
        cert_category: $('#cert_category').val(),
        cert_amount: $('#cert_amount').val()
    };
    $.ajax({
        url: './content/financialAPI.php',
        type: 'POST',
        dataType: 'json',
        data: fieldData,
        success: function(data) {
            if (data['statusCode'] == 1) {
                init_cert_fields();
                jQuery.gritter.add({
                    title: 'Success!',
                    text: 'Saved successfully!',
                    sticky: false,
                    class_name: 'bg-success',
                    time: '1000'
                });
                $('#cert_name').focus();
            } else if (data['statusCode'] == 0) {
                jQuery.gritter.add({
                    title: 'Failed!',
                    text: 'Failed.',
                    sticky: false,
                    class_name: 'bg-error',
                    time: '1000'
                });
            }
        },
        error: function(data) {
            jQuery.gritter.add({
                title: 'Failed!',
                text: 'Failed.',
                sticky: false,
                class_name: 'bg-error',
                time: '1000'
            });
        }
    });
});
$('#add_cdq_info').click(function() {
    if ($('#cdq_name').val() == "" || $('#cdq_name').val() == 0) {
        alert("Please select CAA");
        $('#cdq_name').focus();
        return;
    } else if ($('#cdq_date').val() == "") {
        $('#cdq_date').focus();
        return;
    } else if ($('#cdq_4cardnum').val() == "") {
        $('#cdq_4cardnum').focus();
        return;
    } else if ($('#cdq_month').val() == "" || $('#cdq_month').val() == 0) {
        alert("Please select exam month.");
        $('#cdq_month').focus();
        return;
    } else if ($('#cdq_year').val() == "" || $('#cdq_year').val() == 0) {
        $('#cdq_year').focus();
        return;
    } else if ($('#cdq_category').val() == "") {
        $('#cdq_category').focus();
        return;
    }
    fieldData = {
        cdq_name: $('#cdq_name').val(),
        cdq_date: $('#cdq_date').val(),
        cdq_4cardnum: $('#cdq_4cardnum').val(),
        cdq_month: $('#cdq_month').val(),
        cdq_year: $('#cdq_year').val(),
        cdq_category: $('#cdq_category').val(),
        cdq_amount: $('#cdq_amount').val()
    };
    $.ajax({
        url: './content/financialAPI.php',
        type: 'POST',
        dataType: 'json',
        data: fieldData,
        success: function(data) {
            if (data['statusCode'] == 1) {
                init_cdq_fields();
                jQuery.gritter.add({
                    title: 'Success!',
                    text: 'Saved successfully!',
                    sticky: false,
                    class_name: 'bg-success',
                    time: '1000'
                });
                $('#cdq_name').focus();
            } else if (data['statusCode'] == 0) {
                jQuery.gritter.add({
                    title: 'Failed!',
                    text: 'Failed.',
                    sticky: false,
                    class_name: 'bg-error',
                    time: '1000'
                });
            }
        },
        error: function(data) {
            jQuery.gritter.add({
                title: 'Failed!',
                text: 'Failed.',
                sticky: false,
                class_name: 'bg-error',
                time: '1000'
            });
        }
    });
});
$('#add_cme_info').click(function() {
    if ($('#cme_name').val() == "" || $('#cme_name').val() == 0) {
        alert("Please select CAA");
        $('#cme_name').focus();
        return;
    } else if ($('#cme_date').val() == "") {
        $('#cme_date').focus();
        return;
    } else if ($('#cme_4cardnum').val() == "") {
        $('#cme_4cardnum').focus();
        return;
    } else if ($('#cme_year').val() == "" || $('#cme_year').val() == 0) {
        $('#cme_year').focus();
        return;
    } else if ($('#cme_category').val() == "") {
        $('#cme_category').focus();
        return;
    }
    fieldData = {
        cme_name: $('#cme_name').val(),
        cme_date: $('#cme_date').val(),
        cme_4cardnum: $('#cme_4cardnum').val(),
        cme_year: $('#cme_year').val(),
        cme_category: $('#cme_category').val(),
        cme_amount: $('#cme_amount').val()
    };
    $.ajax({
        url: './content/financialAPI.php',
        type: 'POST',
        dataType: 'json',
        data: fieldData,
        success: function(data) {
            if (data['statusCode'] == 1) {
                init_cme_fields();
                jQuery.gritter.add({
                    title: 'Success!',
                    text: 'Saved successfully!',
                    sticky: false,
                    class_name: 'bg-success',
                    time: '1000'
                });
                $('#cme_name').focus();
            } else if (data['statusCode'] == 0) {
                jQuery.gritter.add({
                    title: 'Failed!',
                    text: 'Failed.',
                    sticky: false,
                    class_name: 'bg-error',
                    time: '1000'
                });
            }
        },
        error: function(data) {
            jQuery.gritter.add({
                title: 'Failed!',
                text: 'Failed.',
                sticky: false,
                class_name: 'bg-error',
                time: '1000'
            });
        }
    });
});

function tr_baground(e) {
    if ($("#check_financial" + e).is(':checked')) {
        $("#financial_tr" + e).css('background-color', '#B0BED9');
    } else {
        $("#financial_tr" + e).css('background-color', '');
    }
}

function edit_financial_modal(e) {
    $('#edit_financial' + e).modal('show');
}

function update_financial(e) {
    var fieldData = {
        edit_id: e,
        edit_date: $('#edit_date' + e).val(),
        edit_description: $('#edit_description' + e).val(),
        edit_category: $('#edit_category' + e).val(),
        edit_amount: $('#edit_amount' + e).val(),
        add_amount: ''
    };
    $.ajax({
        url: '?content=content/financial&li_class=Financials&li_class=Financials',
        type: 'POST',
        dataType: 'json',
        data: fieldData,
        success: function(data) {
            location.href = '?content=content/financial&li_class=Financials';
        },
        error: function(data) {
            location.href = '?content=content/financial&li_class=Financials';
        }
    });
}

function delete_financial(e) {
    var fieldData = {
        delete_id: e,
        add_amount: ''
    };
    $.ajax({
        url: '?content=content/financial&li_class=Financials&li_class=Financials',
        type: 'POST',
        dataType: 'json',
        data: fieldData,
        success: function(data) {
            location.href = '?content=content/financial&li_class=Financials';
        },
        error: function(data) {
            location.href = '?content=content/financial&li_class=Financials';
        }
    });
}

function financial_filter_year() {
    var select_year = $('#select_year').val();
    var select_term = $('#select_term').val();
    var select_type = $('#select_type').val();
    if (select_year != 'null') {
        if (select_year == new Date().getFullYear() && select_term == 'Last_Year') {
            select_term = 'null';
        } else if ((select_year == (new Date().getFullYear() - 1)) && (select_term == 'Today' || select_term == 'Week' || select_term == 'Month' || select_term == 'Quarter' || select_term == 'Year')) {
            select_term = 'null';
        } else if ((select_year > new Date().getFullYear()) && (select_term == 'Today' || select_term == 'Week' || select_term == 'Month' || select_term == 'Quarter' || select_term == 'Year' || select_term == 'Last_Year')) {
            select_term = 'null';
        }
    }
    location.href = "?content=content/financial&li_class=Financials&s_year=" + select_year + "&s_term=" + select_term + "&s_type=" + select_type + "";
}

function financial_filter_term() {
    var select_year = $('#select_year').val();
    var select_term = $('#select_term').val();
    var select_type = $('#select_type').val();
    if (select_term == 'Today' || select_term == 'Week' || select_term == 'Month' || select_term == 'Quarter' || select_term == 'Year') {
        select_year = new Date().getFullYear();
    } else if (select_term == 'Last_Year') {
        select_year = (new Date().getFullYear() - 1);
    }
    location.href = "?content=content/financial&li_class=Financials&s_year=" + select_year + "&s_term=" + select_term + "&s_type=" + select_type + "";
}

function financial_filter_type() {
    var select_year = $('#select_year').val();
    var select_term = $('#select_term').val();
    var select_type = $('#select_type').val();;
    location.href = "?content=content/financial&li_class=Financials&s_year=" + select_year + "&s_term=" + select_term + "&s_type=" + select_type + "";
}
//newWin.document.write("<style> td:nth-child(2){display:none;} </style>");
function checked_tr_hide() {
    for (var i = 0; i < $("#count_tr").val(); i++) {
        if ($("#check_financial" + i).is(':checked')) {
            true;
        } else {
            $("#print_financial_tr" + i).css('display', 'none');
        }
    }
}

function print_admin_financial(elem) {
    // $(".close").hide();
    checked_tr_hide();
    $("#print_financialLedger").show();
    $("div").hide();
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
    location.href = "?content=content/financial&li_class=Financials";
}