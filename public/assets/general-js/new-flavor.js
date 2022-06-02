


// flavor counter for all products like total chosen
var flavors = 0;
var actualFlavors = 0;
var confirmation = 0;


// ---------------------- 1 -------------------
$('.add-flavor-button').click(function() {

    // get id
    let id = $(this).attr('id');

    // get number of meal from id number
    let slicecounter = -1;
    let idclone = '';


    while(id.slice(slicecounter) >= '0') {

        idclone = id.slice(slicecounter);
        
        slicecounter--;
    }



    // get selected flavor value + quantity
    let productValue = $('#add-flavor-product-'+idclone).val();
    let flavorText = $('#add-flavor-select-'+idclone+' option:selected').text();
    let flavorValue = $('#add-flavor-select-'+idclone).val();

    let quantityValue = $('#add-flavor-quantity-'+idclone).val();



    // check if there's enought quantity
    let availableQuantity = $('#product-available-quantity-'+idclone+'-'+flavorValue).val();


    // then add it
    if (parseInt(quantityValue) <= parseInt(availableQuantity) && parseInt(quantityValue) != 0) {


        // remove input red if exists
        $('#add-flavor-quantity-'+idclone).removeClass('border-danger');


        //update the actual value of quantity
        let leftQuantity = parseInt(availableQuantity) - parseInt(quantityValue);
        $('#product-available-quantity-'+idclone+'-'+flavorValue).val(leftQuantity);

        //limit max quantity + reset
        $('#add-flavor-quantity-'+idclone).attr('max', leftQuantity);
        $('#add-flavor-quantity-'+idclone).val('');

        // add flavor
        flavors++; //just counter
        actualFlavors++; //real quantity


        // check if actualFlavors > 0 (form multistep form)
        if (actualFlavors > 0) {

            $('.tab-field-2').val('1');

        } else {

            $('.tab-field-2').val('0');

        }




        

        // flavors should be changed to array of flavors (when adding new items)
        let item = '<div id="flavors-'+idclone+'-'+flavors+'" class="row mb-2 no-gutters align-items-center">\
            <div class="col-9">\
                <p class="mb-0 py-2" style="background-color: #1e2835; text-align:left; padding-left: 15px;">'+flavorText+':<span class="ml-2">'+quantityValue+'</span></p>\
            </div>\
            \
            <input type="hidden" id="purchased-product-'+flavors+'" class="purchased-product" name="product[]" value="'+productValue+'">\
            <input type="hidden" id="purchased-flavor-'+flavors+'" class="purchased-flavor" name="flavor[]" value="'+flavorValue+'">\
            <input type="hidden" id="purchased-quantity-'+flavors+'" class="purchased-quantity" name="quantity[]" value="'+quantityValue+'">\
            \
            \
            <div class="col-3">\
                <button id="Deleteflavors-'+idclone+'-'+flavors+'" class="btn btn-danger w-100 delete-flavor-button" style="box-shadow: none !important;"><i class="fa fa-trash"></i></button>\
            </div>\
        </div>';


        
        // append component html line
        $('#flavor-wrapper-'+idclone).append(item);

    }

    else {

        // make input red
        $('#add-flavor-quantity-'+idclone).addClass('border-danger');

    }


});















// -------------------------------------- 2 -------------------------------------
// delete flavor button
$('div.flavor-wrapper').on("click", "button.delete-flavor-button", function(){


    // get id then remove 'Delete' Out
    let id = $(this).attr('id');
    id = id.replace('Delete', '');


    // remove the row with this id
    actualFlavors--;


    // check if actualFlavors > 0 (form multistep form)
    if (actualFlavors > 0) {

        $('.tab-field-2').val('1');

    } else {

        $('.tab-field-2').val('0');

    }


    // use clone to remove the component
    $('#'+id).remove();


    

});



// --------------------------------------- 3 --------------------------------------


// location confirmation once
$('#confirmPosition').click(function() {

    // update value to make next and previous buttons active
    // $('#confirmPositionInput').val('1');

    // nextBtn and previous disabled
    // $('#nextBtn').attr('disabled', false);

});
