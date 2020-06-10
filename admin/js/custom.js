$(document).ready(function() {
    $('.ctable').DataTable( {
        // "scrollX": true,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        // order: [[ 1, 'asc' ]],
        paging: false
    });
    $('.stable').DataTable( {
        // "scrollX": true,
        paging: false
    });
    $('.ptable').DataTable( {
        "scrollX": true,

        dom: 'Bfrtip',
        buttons: [
            'print'
        ],
        paging: false
    });
    $('.ntable').DataTable( {
        "scrollX": false,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        // order: [[ 1, 'asc' ]],
        paging: false
    });
});

$(".quesType").on("change", function(){
    var selectedvalue = $(this).children("option:selected").val();
    if(selectedvalue == 1){
        $(".radioQuestion").slideUp();
        $(".textQuestion").slideDown();
    }
    else if( selectedvalue == 2){
        $(".textQuestion").slideUp();
        $(".radioQuestion").slideDown();
    }
});

$(".top-heading").on("click", function(){
    $(this).children(".toggler").toggleClass("active");
    $(".admin-cards.card").slideToggle("slow");
    if($(".admin-cards").length > 0) {
        var maxHeight = -1;
        $('section.mainContent .admin-cards .adminCard').each(function() {
            maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
        });

        $('section.mainContent .admin-cards .adminCard').each(function() {
            $(this).height(maxHeight);
        });
    }
});
$(".middle-heading2").on("click", function(){
    $(this).children(".toggler").toggleClass("active");
    $(".portal-cards.card").slideToggle("slow");
    if($(".portal-cards").length > 0) {
        var maxHeight = -1;
        $('section.mainContent .portal-cards .card').each(function() {
            maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
        });

        $('section.mainContent .portal-cards .card').each(function() {
            $(this).height(maxHeight);
        });
    }

});
$(".middle-heading").on("click", function(){
    $(this).children(".toggler").toggleClass("active");
    $(".portal-member.card").slideToggle("slow");

});