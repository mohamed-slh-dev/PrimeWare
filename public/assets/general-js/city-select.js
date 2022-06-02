

// only perform once in district select when adding not editing
// $('.districtselectforadding').val('');



// wheneve city is changed
$('#cityselect').change(function() {


    // hide all districts options first
    $('.all-districts').removeClass('d-none');
    $('.all-districts').addClass('d-none');

    // remove selected attribute
    $('#districtselect').val('');


    // get the id of the cityselect and show only the targeted districts
    let cityid = $(this).val();
    $('.city-'+cityid).removeClass('d-none');


});