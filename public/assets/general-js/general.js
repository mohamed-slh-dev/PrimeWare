



// ========================= customers


// assign driver to special orders
$('.driver-assign-id').click(function() {
    
    // get customer id
    customer_id = $(this).val();
    
    $('#modal-assign-driver').val(customer_id);

});


// same for dubpliace thing (used in operation health)
$('.driver-assign-id-2').click(function() {
    
    // get customer id
    customer_id = $(this).val();
    
    $('#modal-assign-driver-2').val(customer_id);

});



$('.driver-assign-id-3').click(function() {
    
    // get customer id
    customer_id = $(this).val();
    
    $('#modal-assign-driver-3').val(customer_id);

});



$('.driver-assign-id-4').click(function() {
    
    // get customer id
    customer_id = $(this).val();
    
    $('#modal-assign-driver-4').val(customer_id);

});





// renew customer days modal
$('.customer-assign-id').click(function() {
    
    // get customer id
    customer_id = $(this).val();
    
    
    $('#modal-assign-customer').val(customer_id);

});




// renew customer days modal (in renew page)
$('.customer-assign-id-2').click(function() {
    
    // get customer id
    customer_id = $(this).val();
    
    request_id = $('#customer-assign-request').val();

    $('#modal-assign-customer').val(customer_id);
    $('#modal-assign-request').val(request_id);


});



// freeze customer days modal
$('.customer-assign-id-freeze').click(function() {
    
    // get customer id
    customer_id = $(this).val();
    
    
    $('#modal-assign-customer-freeze').val(customer_id);

});



// one order driver modal
$('.order-assign-id').click(function() {
    
    // get order id
    order_id = $(this).val();
    
    
    $('#modal-assign-order').val(order_id);

});


// one order driver modal
$('.order-assign-id-2').click(function() {
    
    // get order id
    order_id = $(this).val();
    
    
    $('#modal-assign-order-2').val(order_id);

});






// =================================

// 1- van option or bike option is checked then it affect numer of vans
$('#bikeoption, #vanoption').click(function() {


    // make required and appear
    if($('#vanoption').is(':checked')) {

        // make input appear
        $('#numberofvans').removeClass('d-none');
        $('#numberofvansinput').attr('required', true);

    } else {

        // make input disappear
        $('#numberofvans').removeClass('d-none');
        $('#numberofvans').addClass('d-none');

        $('#numberofvansinput').attr('required', false);

    }


});