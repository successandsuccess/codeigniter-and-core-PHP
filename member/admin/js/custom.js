$(document).ready(function() {
    var refreshSn = function() {
        var time = 600000;
        setTimeout(function() {
            $.ajax({
                url: '../prevent_timeout.php',
                cache: false,
                complete: function() {
                    refreshSn();
                }
            });
        }, time);
    };
    refreshSn();
    $('.ctable').DataTable({
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        paging: false
    });
    $('.stable').DataTable({
        paging: false
    });
    /*=======>> groupTable setting..*/
    var table_eg = $('#emailGroupTbl').DataTable({
        'ajax': '../admin/classes/group_member.php',
        paging: true,
        lengthMenu: [10, 15, 20, 25],
        'columnDefs': [{
            'targets': 0,
            'checkboxes': {
                'selectRow': true
            }
        }],
        'select': [{
            'style': 'multi'
        }],
        'order': [
            [1, 'asc']
        ],
    });
    $('#emailGroupTbl_length').css('display', 'block');
    $('#emailGroupTbl_info').css('display', 'block');
    /*======>> search_groups_users_email_modal */
    var table_egu = $('#emailGroupUsersTbl').DataTable({
        ajax: '../admin/classes/group_member.php',
        paging: true,
        lengthMenu: [10, 15, 20, 25],
        columnDefs: [{
            targets: 4,
            createdCell: function(td, cellData, rowData, row, col) {
                $(td).css('text-align', 'center');
            }
        }],
    });
    $('#emailGroupUsersTbl_length').css('display', 'block');
    $('#emailGroupUsersTbl_info').css('display', 'block');
    /*==>> Group popup --> Group member popup transition event*/
    $('#emailGroupTbl tbody').on('click', 'a', function(e) {
        if ($(this).attr('title') == 'Group Edit') {
            // Set the h4 title
            $('div.modal-body>h4').text($(this).attr('gname'));
            // Get the group id
            $('input[name="groupID"]').val($($(this).parent().parent().children()[1]).text());
            //tbl load
            table_egu.ajax.url('../admin/classes/users_member.php?userdata=' + $(this).attr('userdata').trim()).load();
            $('#search_groups_email_modal').modal('hide');
            $('#search_groups_users_email_modal').modal('show');
        }
        /*==>> Remove Group event function define*/
        else if ($(this).attr('title') == 'Group Delete') {
            var confirmed = confirm("Are you sure remove this Group?");
            if (!confirmed) return;
            group_id = $(this).attr('gid');
            var gData = {
                'function': 'delgroup',
                'group_id': group_id
            };
            $.ajax({
                url: '../admin/classes/users_member.php',
                type: 'GET',
                dataType: 'json',
                data: gData,
                async: false,
                headers: {
                    "cache-control": "no-cache"
                },
                success: function(data) {
                    table_egu.ajax.url('../admin/classes/users_member.php?function=delgroup&group_id=' + group_id).load();
                    table_eg.ajax.url('../admin/classes/group_member.php').load();
                    jQuery.gritter.add({
                        title: 'Success!',
                        text: 'Group Remove Successfully!',
                        sticky: false,
                        class_name: 'bg-success',
                        time: '2000'
                    });
                    console.log(data);
                },
                error: function(e) {
                    console.log(e);
                }
            });
            $('#search_groups_email_modal').modal('show');
            $('#search_groups_users_email_modal').modal('hide');
        }
    });
    /*==>> Group Member popup event function*/
    $('#emailGroupUsersTbl tbody').on('click', 'a', function() {
        var confirmed = confirm("Are you sure remove this user in Group?");
        if (!confirmed) return;
        var group_id = $('input[name="groupID"]').val();
        table_egu.ajax.url('../admin/classes/users_member.php?function=delup&group_id=' + group_id + '&user_id=' + $(this).attr('userid').trim()).load();
        // group_member tbl reload
        table_eg.ajax.url('../admin/classes/group_member.php').load();
        $(this).attr('userdata');
        $('#search_groups_email_modal').modal('hide');
        $('#search_groups_users_email_modal').modal('show');
    });
    /*==>> emailGroupMemberTbl_Form form submit */
    $('#emailGroupMemberTbl_Form').on('submit', function(e) {
        var form = this;
        var rows_selected = table_eg.column(0).checkboxes.selected();
        var szRows = rows_selected.count();
        $('#g_szRows').text(szRows);
        var ids = [];
        names = [];
        var rows = table_eg.rows({
            selected: true
        }).data();
        // Iterate over all selected checkboxes
        $.each(rows_selected, function(index, rowId) {
            /* Get the seelcted datatbls id value. */
            var rowData_id = rows[rowId][1];
            var rowData_name = rows[rowId][2];
            ids.push(rowData_id);
            names.push(rowData_name);
        });
        $('#g_example-console-rows').text(names.join(","));
        $('input[name="g_selectedIds"]').val(ids);
        e.preventDefault();
    });
    $('button#group_ok').click(function(e) {
        var rows_selected = table_eg.column(0).checkboxes.selected();
        var szRows = rows_selected.count();
        $('#g_szRows').text(szRows);
        var ids = [];
        names = [];
        var rows = table_eg.rows({
            selected: true
        }).data();
        $.each(rows_selected, function(index, rowId) {
            var rowData_id = rows[rowId][1];
            var rowData_name = rows[rowId][2];
            ids.push(rowData_id);
            names.push(rowData_name);
        });
        $('#g_example-console-rows').text(names.join(","));
        $('#g_szRows').text('');
        $('#emailUids').val($('#g_example-console-rows').text());
        $('#emailUids').attr('title', $('#g_example-console-rows').text());
        $('#g_example-console-rows').text('');
        // update submit forms hidden tags.
        $('input[name="receiver_ids"]').val(ids);
        $('input[name="receiver_type"]').val("groups");
    });
    /*=======>> Add users to group popup datatbale definition*/
    var table_add_user = $('#addUsersGroupTbl').DataTable({
        ajax: '../admin/classes/users_member.php',
        paging: true,
        lengthMenu: [10, 15, 20, 25],
        'columnDefs': [{
            'targets': 0,
            'checkboxes': {
                'selectRow': true
            }
        }],
        'select': [{
            'style': 'multi'
        }],
        'order': [
            [1, 'asc']
        ]
    });
    $('#addUsersGroupTbl_length').css('display', 'block');
    $('#addUsersGroupTbl_info').css('display', 'block');
    $('#addUsersGroupTbl_Form').on('submit', function(e) {
        var form = this;
        var rows_selected = table_add_user.column(0).checkboxes.selected();
        var szRows = rows_selected.count();
        $('#add_user_szRows').text(szRows);
        var ids = [];
        names = [];
        var rows = table_add_user.rows({
            selected: true
        }).data();
        // Iterate over all selected checkboxes
        $.each(rows_selected, function(index, rowId) {
            /* Get the seelcted datatbls id value. */
            var rowData_id = rows[rowId][1];
            var rowData_name = rows[rowId][2];
            ids.push(rowData_id);
            names.push(rowData_name);
        });
        $('#add_user_example-console-rows').text(names.join(","));
        $('input[name="add_user_selectedIds"]').val(ids);
        e.preventDefault();
    });
    $('button#add_user_email_ok').click(function(e) {
        var rows_selected = table_add_user.column(0).checkboxes.selected();
        var szRows = rows_selected.count();
        $('#add_user_szRows').text(szRows);
        var ids = [];
        names = [];
        var rows = table_add_user.rows({
            selected: true
        }).data();
        // Iterate over all selected checkboxes
        $.each(rows_selected, function(index, rowId) {
            /* Get the seelcted datatbls id value. */
            var rowData_id = rows[rowId][1];
            var rowData_name = rows[rowId][2];
            ids.push(rowData_id);
            names.push(rowData_name);
        });
        var group_id = $('input[name="groupID"]').val();
        if (ids.length > 3000) {
            alert("Too Much Users... Please Retry with Smaller!");
            return;
        }
        if (ids.length == 0) {
            table_egu.ajax.url('../admin/classes/users_member.php?function=delup&group_id=' + group_id).load();
            table_eg.ajax.url('../admin/classes/group_member.php').load();
        } else {
            $('#add_user_szRows').text('');
            $('#add_user_example-console-rows').text('');
            /* Add members to specified group. and update*/
            table_egu.ajax.url('../admin/classes/users_member.php?function=addusers&users=' + ids + '&group_id=' + group_id).load();
            table_eg.ajax.url('../admin/classes/group_member.php').load();
        }
        $('#search_groups_add_users_modal').modal('hide');
        $('#search_groups_users_email_modal').modal('show');
    });
    /*=======>> emailTable setting..*/
    $('#viewAllEmailTbl').DataTable({
        paging: true,
        lengthMenu: [10, 50, 100, 150],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        'order': [
            [0, 'desc']
        ],
    });
    $('#viewAllEmailTbl_length').css('display', 'block');
    $('#viewAllEmailTbl_info').css('display', 'block');
    /*=========================================*/
    /*Users datatable.*/
    $.fn.DataTable.ext.pager.numbers_length = 3;
    var table = $('#emailMemberTbl').DataTable({
        'ajax': '../admin/classes/users_member.php',
        paging: true,
        lengthMenu: [10, 50, 100, 150],
        'columnDefs': [{
            'targets': 0,
            'checkboxes': {
                'selectRow': true
            }
        }],
        'select': [{
            'style': 'multi'
        }],
        'order': [
            [1, 'asc']
        ]
    });
    $('#emailMemberTbl_length').css('display', 'block');
    $('#emailMemberTbl_info').css('display', 'block');
    // Handle form submission event 
    $('#emailMemberTbl_Form').on('submit', function(e) {
        var form = this;
        $('#Details').html("<i class='fas fa-spinner'></i>");
        proc_email_popup();
        // Output form data to a console     
        $('#example-console-form').text($(form).serialize());
        e.preventDefault();
    });

    function proc_email_popup() {
        var rows_selected = table.column(0).checkboxes.selected();
        var szRows = rows_selected.count();
        $('#szRows').text(szRows);
        var ids = [];
        names = [];
        var rows = table.rows({
            selected: true
        }).data();
        // Iterate over all selected checkboxes
        $.each(rows_selected, function(index, rowId) {
            /* Get the seelcted datatbls id value. */
            var rowData_id = rows[rowId][1];
            var rowData_name = rows[rowId][3];
            ids.push(rowData_id);
            names.push(rowData_name);
        });
        $('#Details').html("Details");
        $('#example-console-rows').text(names.join(","));
        $('input[name="selectedIds"]').val(ids);
    }
    $('button#email_ok').click(function(e) {
        proc_email_popup();
        $('#szRows').text('');
        // $('#emailUids').val($('input[name="selectedIds"]').val());
        $('#emailUids').val($('#example-console-rows').text());
        $('#emailUids').attr('title', $('#example-console-rows').text());
        $('#example-console-rows').text('');
        // update submit forms hidden tags.
        $('input[name="receiver_ids"]').val($('input[name="selectedIds"]').val());
        $('input[name="receiver_type"]').val("members");
    });
    /*==> Add new group */
    var table_add_group = $('#addGroupGroupTbl').DataTable({
        'ajax': '../admin/classes/users_member.php',
        paging: true,
        lengthMenu: [10, 15, 20, 25],
        'columnDefs': [{
            'targets': 0,
            'checkboxes': {
                'selectRow': true
            }
        }],
        'select': [{
            'style': 'multi'
        }],
        'order': [
            [1, 'asc']
        ]
    });
    $('#addGroupGroupTbl_length').css('display', 'block');
    $('#addGroupGroupTbl_info').css('display', 'block');
    $('#addGroupGroupTbl_Form').on('submit', function(e) {
        var form = this;
        var rows_selected = table_add_group.column(0).checkboxes.selected();
        var szRows = rows_selected.count();
        $('#new_group_szRows').text(szRows);
        var ids = [];
        names = [];
        var rows = table_add_group.rows({
            selected: true
        }).data();
        // Iterate over all selected checkboxes
        $.each(rows_selected, function(index, rowId) {
            /* Get the seelcted datatbls id value. */
            var rowData_id = rows[rowId][1];
            var rowData_name = rows[rowId][2];
            ids.push(rowData_id);
            names.push(rowData_name);
        });
        $('#new_group_example-console-rows').text(names.join(","));
        $('input[name="new_group_selectedIds"]').val(ids);
        e.preventDefault();
    });
    $('button#new_group_email_ok').click(function(e) {
        var rows_selected = table_add_group.column(0).checkboxes.selected();
        var szRows = rows_selected.count();
        $('#new_group_szRows').text(szRows);
        var ids = [];
        names = [];
        var rows = table_add_group.rows({
            selected: true
        }).data();
        // Iterate over all selected checkboxes
        $.each(rows_selected, function(index, rowId) {
            /* Get the seelcted datatbls id value. */
            var rowData_id = rows[rowId][1];
            var rowData_name = rows[rowId][2];
            ids.push(rowData_id);
            names.push(rowData_name);
        });
        // var group_id = $('input[name="groupID"]').val();
        if (ids.length > 3000) {
            alert("Too Much Users... Please Retry with Smaller!");
            return;
        }
        if (ids.length == 0) {
            alert("Please select users");
        } else if ($("input[name='NewGroupID']").val() == "") {
            alert("Please Input Group name");
        } else {
            $('#add_user_szRows').text('');
            $('#add_user_example-console-rows').text('');
            var g_name = $("input[name='NewGroupID']").val();
            /* Add members to specified group. and update*/
            var gData = {
                'function': 'addgroup',
                'users': ids.join(','),
                "g_name": g_name
            };
            $.ajax({
                url: '../admin/classes/users_member.php',
                type: 'GET',
                dataType: 'json',
                data: gData,
                async: false,
                headers: {
                    "cache-control": "no-cache"
                },
                success: function(data) {
                    if (data['res'] == 1) {
                        jQuery.gritter.add({
                            title: 'Success!',
                            text: 'Group Add Successfully!',
                            sticky: false,
                            class_name: 'bg-success',
                            time: '2000'
                        });
                        table_eg.ajax.url('../admin/classes/group_member.php').load();
                    } else {
                        jQuery.gritter.add({
                            title: 'Failed!',
                            text: 'That Group Name is already exist. <br> Please retry with another name.',
                            sticky: false,
                            class_name: 'bg-error',
                            time: '3000'
                        });
                    }
                },
                error: function(data) {
                    console.log(data.responseText);
                }
            });
        }
        $('#add_new_group_modal').modal('hide');
        $('#search_groups_email_modal').modal('show');
    });
    /*==========>> Email send js script*/
    $('#emailAdminForm').on('submit', function(e) {
        var data = CKEDITOR.instances.summernote.getData();
        $('input[name="msg_contents"]').val(data.trim());
        var r_ids = $('input[name="receiver_ids"]').val();
        if (data.length <= 0) {
            var msg = 'Please type the message contents.';
        } else if (r_ids.length <= 0) {
            var msg = 'Please Select the Receiver. <br> Please retry with another name.';
        }
        if (data.length <= 0 || r_ids.length <= 0) {
            jQuery.gritter.add({
                title: 'Caution!',
                text: msg,
                sticky: false,
                class_name: 'bg-error',
                time: '3000'
            });
            e.preventDefault();
            return;
        }
    });
    /*<<= end of setting.*/
    /*>> banner img script*/
    function readURL(input) {
        if (input.files[0].size > 500000) {
            alert("Image Size should not be greater than 500Kb");
            return false;
        }
        if (input.files[0].type.indexOf("image") == -1) {
            alert("Please upload the Valid Img");
            return false;
        }
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp").change(function() {
        readURL(this);
    });
    /*<< end of banner */
    $(".paggingTable").DataTable({
        pageLength: 15
    });
    $('.otable').DataTable({
        paging: false,
        ordering: false
    });
    $('.ptable').DataTable({
        dom: 'Bfrtip',
        buttons: ['print'],
        paging: false
    });
    $('.ntable').DataTable({
        "scrollX": false,
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }],
        select: {
            style: 'os',
            selector: 'td:first-child'
        },
        paging: false
    });
});
//CME AUDIT start.
function cme_audit(id) {
    //admin_select cme_audit(Pass/Fail)
    var audit_result_id = $('#cme_audit_id' + id).val();
    var data = {
        'id': id,
        'audit_result_id': audit_result_id
    };
    $.ajax({
        url: "?content=content/audit&li_class=CME",
        method: "POST",
        data: data,
        async: true,
        dataType: 'json',
        error: function(data) {
            jQuery.gritter.add({
                title: 'Success!',
                text: 'Detail saved successfully.',
                //image: 'assets/images/user-profile-2.jpg',			
                sticky: false,
                class_name: 'bg-success',
                time: '1000'
            });
            id = null;
            audit_result_id = null;
            data = null;
        }
    });
}
//save cme audit data
function save_cme_audit() {
    var count_id = $('#id_count').val();
    var id = [];
    var issues = [];
    for (var i = 1; i <= count_id; i++) {
        id[i] = $("#" + i).val();
        issues[i] = $("#issues_text" + id[i]).val();
    }
    var data = {
        'id': id,
        'issues_text': issues
    };
    $.ajax({
        url: "?content=content/audit&li_class=CME",
        method: "POST",
        data: data,
        async: true,
        dataType: 'json',
        error: function(data) {
            jQuery.gritter.add({
                title: 'Success!',
                text: 'Detail saved successfully.',
                //image: 'assets/images/user-profile-2.jpg',			
                sticky: false,
                class_name: 'bg-success',
                time: '1000'
            });
            id = null;
            issues = null;
            data = null;
        }
    });
}
//CDQ show/no show
function show_allow(id) {
    //admin_select event(Pass/Fail)
    var show_id = $('#show_allow_id' + id).val();
    var data = {
        'id': id,
        'show_id': show_id
    };
    $.ajax({
        url: "?content=content/exam&li_class=Exams",
        method: "POST",
        data: data,
        async: true,
        dataType: 'json',
        error: function(data) {
            jQuery.gritter.add({
                title: 'Success!',
                text: 'Detail saved successfully.',
                //image: 'assets/images/user-profile-2.jpg',			
                sticky: false,
                class_name: 'bg-success',
                time: '1000'
            });
            id = null;
            show_id = null;
            data = null;
        }
    });
}
//CDQ pass/fail
function admin_select(id) {
    //admin_select event(Pass/Fail)
    var select_id = $('#admin_select_id' + id).val();
    var data = {
        'id': id,
        'select_id': select_id
    };
    $.ajax({
        url: "?content=content/exams&li_class=Exams",
        method: "POST",
        data: data,
        async: true,
        dataType: 'json',
        error: function(data) {
            jQuery.gritter.add({
                title: 'Success!',
                text: 'Detail saved successfully.',
                //image: 'assets/images/user-profile-2.jpg',			
                sticky: false,
                class_name: 'bg-success',
                time: '1000'
            });
            id = null;
            select_id = null;
            data = null;
        }
    });
}
//Certification show/no show
function show_certification(id) {
    //admin_select event(Pass/Fail)
    var show_id = $('#show_certification_id' + id).val();
    var data = {
        'student_id': id,
        'show_certification_id': show_id
    };
    $.ajax({
        url: "?content=content/certification&li_class=Exams",
        method: "POST",
        data: data,
        async: true,
        dataType: 'json',
        error: function(data) {
            jQuery.gritter.add({
                title: 'Success!',
                text: 'Detail saved successfully.',
                //image: 'assets/images/user-profile-2.jpg',			
                sticky: false,
                class_name: 'bg-success',
                time: '1000'
            });
            id = null;
            show_id = null;
            data = null;
        }
    });
}
//Certification pass/fail
function admin_certification(id) {
    //admin_select event(Pass/Fail)
    var select_id = $('#admin_certification_id' + id).val();
    var data = {
        'student_id': id,
        'admin_certification_id': select_id
    };
    $.ajax({
        url: "?content=content/certification&li_class=Exams",
        method: "POST",
        data: data,
        async: true,
        dataType: 'json',
        error: function(data) {
            jQuery.gritter.add({
                title: 'Success!',
                text: 'Detail saved successfully.',
                //image: 'assets/images/user-profile-2.jpg',			
                sticky: false,
                class_name: 'bg-success',
                time: '1000'
            });
            id = null;
            select_id = null;
            data = null;
        }
    });
}
$('#select_cme').click(function() {
    $('#select_cme').css("background", "rgb(36,96,139)");
    $('#select_cme').css("color", "white");
    $('#select_cdq').css("background", "");
    $('#select_cdq').css("color", "");
    $('#select_certification').css("background", "");
    $('#select_certification').css("color", "");
});
$('#select_cdq').click(function() {
    $('#select_cdq').css("background", "rgb(36,96,139)");
    $('#select_cdq').css("color", "white");
    $('#select_cme').css("background", "");
    $('#select_cme').css("color", "");
    $('#select_certification').css("background", "");
    $('#select_certification').css("color", "");
});
$('#select_certification').click(function() {
    $('#select_certification').css("background", "rgb(36,96,139)");
    $('#select_certification').css("color", "white");
    $('#select_cdq').css("background", "");
    $('#select_cdq').css("color", "");
    $('#select_cme').css("background", "");
    $('#select_cme').css("color", "");
});
//save_data
$('#save_data').click(function() {
    var txt;
    var r = confirm("Saved successfully!");
    if (r == true) {
        location.reload();
    } else {
        return false;
    }
});
$(".quesType").on("change", function() {
    var selectedvalue = $(this).children("option:selected").val();
    if (selectedvalue == 1) {
        $(".radioQuestion").slideUp();
        $(".textQuestion").slideDown();
    } else if (selectedvalue == 2) {
        $(".textQuestion").slideUp();
        $(".radioQuestion").slideDown();
    }
});
$(".replyBtn a").on("click", function() {
    $(".replyBtn").slideToggle("slow");
    $(".replyBlock").slideToggle("slow");
});
$(".replyClose").on("click", function() {
    $(".replyBtn").slideToggle("slow");
    $(".replyBlock").slideToggle("slow");
});
$(".top-heading").on("click", function() {
    $(this).children(".toggler").toggleClass("active");
    $(".admin-cards.card").slideToggle("slow");
    EqualHeightAdminCards();
});
$(".middle-heading2").on("click", function() {
    $(this).children(".toggler").toggleClass("active");
    $(".portal-cards.card").slideToggle("slow");
    if ($(".portal-cards").length > 0) {
        var maxHeight = -1;
        $('section.mainContent .portal-cards .card').each(function() {
            maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
        });
        $('section.mainContent .portal-cards .card').each(function() {
            $(this).height(maxHeight);
        });
    }
});
$(".middle-heading").on("click", function() {
    $(this).children(".toggler").toggleClass("active");
    $(".portal-member.card").slideToggle("slow");
});

function go_back() {
    window.history.back();
}

function EqualHeightAdminCards() {
    if ($(".admin-cards").length > 0) {
        var maxHeight = -1;
        $('section.mainContent .admin-cards .adminCard').each(function() {
            maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
        });
        $('section.mainContent .admin-cards .adminCard').each(function() {
            $(this).height(maxHeight);
        });
    }
}
if (CKEDITOR.env.ie && CKEDITOR.env.version < 9) CKEDITOR.tools.enableHtml5Elements(document);
CKEDITOR.addCss('figure[class*=easyimage-gradient]::before { content: ""; position: absolute; top: 0; bottom: 0; left: 0; right: 0; }' + 'figure[class*=easyimage-gradient] figcaption { position: relative; z-index: 2; }' + '.easyimage-gradient-1::before { background-image: linear-gradient( 135deg, rgba( 115, 110, 254, 0 ) 0%, rgba( 66, 174, 234, .72 ) 100% ); }' + '.easyimage-gradient-2::before { background-image: linear-gradient( 135deg, rgba( 115, 110, 254, 0 ) 0%, rgba( 228, 66, 234, .72 ) 100% ); }');
CKEDITOR.replace('editor', {
    extraPlugins: 'easyimage',
    removePlugins: 'image',
    removeDialogTabs: 'link:advanced',
    toolbar: [{
            name: 'document',
            groups: ['mode', 'document', 'doctools'],
            items: ['Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates']
        }, {
            name: 'clipboard',
            groups: ['clipboard', 'undo'],
            items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
        }, {
            name: 'editing',
            groups: ['find', 'selection', 'spellchecker'],
            items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
        }, {
            name: 'insert',
            items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']
        }, '/', {
            name: 'basicstyles',
            groups: ['basicstyles', 'cleanup'],
            items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat']
        }, {
            name: 'paragraph',
            groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language']
        }, {
            name: 'links',
            items: ['Link', 'Unlink', 'Anchor']
        }, '/', {
            name: 'styles',
            items: ['Styles', 'Format', 'Font', 'FontSize']
        }, {
            name: 'colors',
            items: ['TextColor', 'BGColor']
        }, {
            name: 'tools',
            items: ['Maximize', 'ShowBlocks']
        }, {
            name: 'others',
            items: ['-']
        },
        // { name: 'about', items: [ 'About' ] },
        {
            name: 'document',
            groups: ['mode', 'document', 'doctools']
        }, {
            name: 'forms',
            items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField']
        },
    ],
    height: 630,
    cloudServices_uploadUrl: 'https://33333.cke-cs.com/easyimage/upload/',
    // Note: this is a token endpoint to be used for CKEditor 4 samples only. Images uploaded using this token may be deleted automatically at any moment.
    // To create your own token URL please visit https://ckeditor.com/ckeditor-cloud-services/.
    cloudServices_tokenUrl: 'https://33333.cke-cs.com/token/dev/ijrDsqFix838Gh3wGO3F77FSW94BwcLXprJ4APSp3XQ26xsUHTi0jcb1hoBt',
    easyimage_styles: {
        gradient1: {
            group: 'easyimage-gradients',
            attributes: {
                'class': 'easyimage-gradient-1'
            },
            label: 'Blue Gradient',
            icon: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/gradient1.png',
            iconHiDpi: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/hidpi/gradient1.png'
        },
        gradient2: {
            group: 'easyimage-gradients',
            attributes: {
                'class': 'easyimage-gradient-2'
            },
            label: 'Pink Gradient',
            icon: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/gradient2.png',
            iconHiDpi: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/hidpi/gradient2.png'
        },
        noGradient: {
            group: 'easyimage-gradients',
            attributes: {
                'class': 'easyimage-no-gradient'
            },
            label: 'No Gradient',
            icon: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/nogradient.png',
            iconHiDpi: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/hidpi/nogradient.png'
        }
    },
    easyimage_toolbar: ['EasyImageFull', 'EasyImageSide', 'EasyImageGradient1', 'EasyImageGradient2', 'EasyImageNoGradient', 'EasyImageAlt']
});
CKEDITOR.config.height = 150;
CKEDITOR.config.width = 'auto';
var initSample = (function() {
    var wysiwygareaAvailable = isWysiwygareaAvailable(),
        isBBCodeBuiltIn = !!CKEDITOR.plugins.get('bbcode');
    return function() {
        var editorElement = CKEDITOR.document.getById('editor');
        // :(((
        if (isBBCodeBuiltIn) {
            editorElement.setHtml('Hello world!\n\n' + 'I\'m an instance of [url=https://ckeditor.com]CKEditor[/url].');
        }
        // Depending on the wysiwygarea plugin availability initialize classic or inline editor.
        if (wysiwygareaAvailable) {
            CKEDITOR.replace('editor');
        } else {
            editorElement.setAttribute('contenteditable', 'true');
            CKEDITOR.inline('editor');
        }
    };

    function isWysiwygareaAvailable() {
        if (CKEDITOR.revision == ('%RE' + 'V%')) {
            return true;
        }
        return !!CKEDITOR.plugins.get('wysiwygarea');
    }
})();
if ($("#editor").length > 0) {
    //    initSample();
}