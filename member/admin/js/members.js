var gTotalRow = 0;
var maxinumPageButton = 7;
var sideButtonNumber = 3;
var orderBy = {
    column: "id",
    desc: true,
};

$(document).ready(function () {
    /* Serhii Code Start */
    var pageNumber = 1;

    pullTableResult();

    $("#search-input").keyup(function (event) {
        if (event.keyCode == "13") {
            pageNumber = 1;
            pullTableResult();
        }
    });

    $("#search-button").click(function () {
        pageNumber = 1;
        pullTableResult();
    });

    $("#entry-select").change(function () {
        pageNumber = 1;
        pullTableResult();
    });

    $("#header-line th").click(function () {
        var icon = ($(this).children().first());
        if (icon.attr("name") !== "print_check_input") {
            if (icon.attr("name") == orderBy.column) {
                icon.toggleClass("arrow-top");
                orderBy.desc = !orderBy.desc;
            } else {
                $(".arrow-top").removeClass("arrow-top");
                orderBy.column = icon.attr("name");
                orderBy.desc = true;
            }

            pageNumber = 1;
            pullTableResult();
        }
    });

    function pullTableResult() {
        var entry_length = $("#entry-select").val();
        var keyword = $("#search-input").val();
        var sort = orderBy;

        $.ajax({
            url: "content/loadMemberTableData.php",
            type: "post",
            data: {
                s_entry: entry_length,
                s_page: pageNumber - 1,
                s_keyword: keyword,
                s_sort: sort
            },
            success: function(result, status) {
                if (status == "success") {
                    var ret = JSON.parse(result);
                    var totalRow = ret.total_row[0].total_count;
                    gTotalRow = totalRow;
                    var tableData = ret.data;
                    showPagination(totalRow);
                    showTable(tableData);
                } else {
                    /**
                     * TODO error
                     */
                }
            }
        });
    }

    function showInformText(totalRow) {
        var entry = $("#entry-select").val();
        var text = "Showing " + (parseInt(entry * (pageNumber - 1)) + 1) +
            " to " + (entry * pageNumber > totalRow ? totalRow : entry * pageNumber) + " of " + totalRow + " entries";
        $("#inform_text").text(text);
    }

    function startPage() {
        if (!$("#start_button").hasClass("disabled")) {
            pageNumber = 1;
            pullTableResult();
        }
    }

    function endPage(num) {
        if (!$("#end_button").hasClass("disabled")) {
            pageNumber = num;
            pullTableResult();
        }
    }

    function previousPage() {
        if (!$("#previous_button").hasClass("disabled")) {
            pageNumber = parseInt(pageNumber) - 1;
            pullTableResult();
        }
    }

    function nextPage() {
        if (!$("#next_button").hasClass("disabled")) {
            pageNumber = parseInt(pageNumber) + 1;
            pullTableResult();
        }
    }

    function navigatePage(num) {
        pageNumber = parseInt(num);
        pullTableResult();
    }

    function showPagination(totalRow) {
        if (totalRow == 0) {
            $("#footer-row").css("display", "none");
        } else {
            $("#footer-row").css("display", "block");
            showInformText(totalRow);

            var startButton = $("#start_button");
            var endButton = $("#end_button");
            var previousButton = $("#previous_button");
            var nextButton = $("#next_button");
            var pageButton = $("#normal_button");
            var pageRow = $("#entry-select").val();

            var numberOfButtons;
            if (Math.floor(totalRow / pageRow) < totalRow / pageRow) {
                numberOfButtons = Math.floor(totalRow / pageRow) + 1;
            } else {
                numberOfButtons = Math.floor(totalRow / pageRow);
            }

            $("#pagination_buttons").html("");

            if (startButton.hasClass("disabled")) {
                startButton.removeClass("disabled");
            }

            if (endButton.hasClass("disabled")) {
                endButton.removeClass("disabled");
            }

            if (previousButton.hasClass("disabled")) {
                previousButton.removeClass("disabled");
            }

            if (nextButton.hasClass("disabled")) {
                nextButton.removeClass("disabled");
            }

            if (pageNumber == 1) {
                startButton.addClass("disabled");
                previousButton.addClass("disabled");
            } else {
                startButton.click(function () {
                    startPage();
                });

                previousButton.click(function () {
                    previousPage();
                });
            }

            if (pageNumber == numberOfButtons) {
                endButton.addClass("disabled");
                nextButton.addClass("disabled");
            } else {
                endButton.click(function () {
                    endPage(numberOfButtons);
                });
                nextButton.click(function () {
                    nextPage();
                });
            }

            $("#pagination_buttons").append(startButton, previousButton);

            var start = 0;
            var end = 0;
            if (numberOfButtons <= maxinumPageButton) {
                start = 1;
                end = numberOfButtons;
            } else {
                if (pageNumber <= sideButtonNumber) {
                    start = 1;
                    end = maxinumPageButton;
                } else if (pageNumber > (numberOfButtons - sideButtonNumber)) {
                    start = numberOfButtons - (maxinumPageButton - 1);
                    end = numberOfButtons;
                } else {
                    start = pageNumber - sideButtonNumber;
                    end = pageNumber + sideButtonNumber;
                }
            }

            for (var i = start; i <= end; i++) {
                if (pageButton.hasClass("active")) {
                    pageButton.removeClass("active");
                }

                var temp = pageButton.clone();

                if (i == pageNumber) {
                    temp.addClass("active");
                }

                temp.children()[0].text = i;
                temp.attr("page", i);
                temp.click(function () {
                    navigatePage($(this).attr("page"));
                });

                $("#pagination_buttons").append(temp);
            }

            $("#pagination_buttons").append(nextButton, endButton);
        }
    }

    function showTable(info) {
        var rows = "";
        var row = "";
        if (info.length == 0) {
            row = "<tr style='cursor:pointer;'>" +
                "<td colspan='6' align='center'>No registered data</td>" +
                "</tr>";
            rows += row;
        } else {
            for (var i = 0; i < info.length; i++) {
                row = "<tr><td>" + info[i][0] + "</td><td>" + info[i][1] + "</td><td>" + info[i][2] +
                    "</td><td>" + info[i][3] + "</td><td>" + info[i][4] + "</td><td>" + info[i][5] + "</td></tr>";
                rows += row;
            }
        }

        $("#member_table_main").html(rows);

    }

    /* Serhii Code End */

    /*var table_member = $('#viewAllMembersTbl').DataTable({




        "processing": true,

        // "serverSide": true,



        "deferRender": true,





        "pageLength": 20,







        paging: true,







        lengthMenu: [10, 20, 50, 100],







        bAutoWidth: false,







        aoColumns : [



            { sWidth: '5%' },



            { sWidth: '16%' },



            { sWidth: '16%' },



            { sWidth: '32%' },



            { sWidth: '17%' },



            { sWidth: '14%' }



        ],







        'order': [[0, 'asc']],



    });*/



    // $('#viewAllMembersTbl').show();

    // table_member.columns.adjust().draw();







    $('#viewAllMembersTbl_length').css('display', 'block');







    $('#viewAllMembersTbl_info').css('display', 'block');







    function edit_role(id){







        var role_val = $('#role_member_id'+id).val();







        var data = {'id':id, 'member_role':role_val };







        $.ajax({



            url : "classes/edit_role.php",



            method : "POST",



            data : data,



            async : true,



            dataType : 'json',







            success: function(data){







                if(data['statusCode'] == 1){







                    jQuery.gritter.add({



                        title: 'Success!',



                        text: 'Role is changed to ' + role_val + '.',



                        //image: 'assets/images/user-profile-2.jpg',



                        sticky: false,



                        class_name: 'bg-success',



                        time: '1000'



                    });







                }else if(data['statusCode'] == 2){







                    $('#role_member_id'+id).val(data['data']);







                    jQuery.gritter.add({



                        title: 'Failed!',



                        text: 'You can not change the role to Admin or Program Director.',



                        sticky: false,



                        class_name: 'bg-error',



                        time: '3000'



                    });







                }else{







                    jQuery.gritter.add({



                        title: 'Failed!',



                        text: 'There is one issue in Database.',



                        sticky: false,



                        class_name: 'bg-error',



                        time: '3000'



                    });







                }







                $(".gritter-item-wrapper").css("width", "350px");







                $(".gritter-item-wrapper").css("text-align", "center");







                $("#gritter-notice-wrapper").css("position","fixed");







                $("#gritter-notice-wrapper").css("top", "45%");







                $("#gritter-notice-wrapper").css("left", "45%");







                id = null;







                role_val = null;







                data = null;







            },







            error: function(data){







                jQuery.gritter.add({







                    title: 'Failed!',







                    text: 'You can not change the role to Admin or PD.',







                    sticky: false,







                    class_name: 'bg-error',







                    time: '3000'







                });







                $(".gritter-item-wrapper").css("width", "350px");







                $(".gritter-item-wrapper").css("text-align", "center");







                $("#gritter-notice-wrapper").css("position","fixed");







                $("#gritter-notice-wrapper").css("top", "40%");







                $("#gritter-notice-wrapper").css("left", "50%");















                id = null;







                role_val = null;







                data = null;







            }







        });



    }
});