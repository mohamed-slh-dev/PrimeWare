


// home-orders page tabs
$('.orders-buttons').click(function() {


    let id = $(this).attr('id');
    

    // remove the active class from all then add it again to target
    $('.orders-buttons').removeClass('active');
    $('#'+id).addClass('active');
    

    // remove and add all the d-none from cols
    $('.orders-cols').addClass('d-none');

    // then remove class from target
    if (id == "all-orders-button")
        $('.all-orders-col').removeClass('d-none');
    else if (id == "received-orders-button")
        $('.received-orders-col').removeClass('d-none');
    else if (id == "delivered-orders-button")
        $('.delivered-orders-col').removeClass('d-none');


});









// --------------- map button


$('.uppermapbutton').click(function() {

    
    $('.uppermapcol').toggleClass('active');

    if ($('.uppermapcol').hasClass('active')) {

        $('.toggleicon').removeClass('fa-chevron-down');
        $('.toggleicon').addClass('fa-chevron-up');
    } else {

        $('.toggleicon').removeClass('fa-chevron-up');
        $('.toggleicon').addClass('fa-chevron-down');
    }   



    // toggle other cols
    $('.lowermapcol').toggleClass('d-none');
    $('.maincontentcol').toggleClass('d-none');


});