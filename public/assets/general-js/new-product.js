// flavor counter for all products like total chosen
var flavors = 1;
var actualFlavors = 1;
var confirmation = 1;


// ---------------------- 1 -------------------
$('#new-flavor-button').click(function() {

    // get id
    let id = $(this).attr('id');

    // get number of meal from id number
    let slicecounter = -1;
    let idclone = '';


    while(id.slice(slicecounter) >= '0') {

        idclone = id.slice(slicecounter);
        
        slicecounter--;
    }



    // add new flavor
    flavors++; //just counter
    actualFlavors++; //real quantity

    
    // add flavors new
    let item = '<div class="col-12 mt-3" id="new-flavor-'+flavors+'"><div class="row align-items-end"><div class="col-4"><label>Flavor</label><input type="text" placeholder="" name="flavor_name[]" id="" class="form-control"></div><div class="col-3"><label>Price</label><input type="text" min="1" name="flavor_price[]" id="" class="form-control"></div><div class="col-3"><label>Quantity</label><input type="number" min="1" name="flavor_quantity[]" id="" class="form-control"></div><div class="col-2 text-left"><button id="deletenew-flavor-'+flavors+'"class="btn btn-danger deletenew-flavor"><i class="fa fa-trash"></i></button></div><div class="col-3 mt-3"><label>Cals</label><input type="text" placeholder="" name="flavor_cals[]" id="" class="form-control"></div><div class="col-3 mt-3"><label>Protein</label><input type="text" placeholder="" name="flavor_proteins[]" id="" class="form-control"></div><div class="col-3 mt-3"><label>Carbs</label><input type="text" placeholder="" name="flavor_carbs[]" id="" class="form-control"></div><div class="col-3 mt-3"><label>Fats</label><input type="text" placeholder="" name="flavor_fats[]" id="" class="form-control"></div><div class="col-12"><hr style="width:50%; border-color:rgb(65, 65, 65) !important;"></div></div></div>';


    
    // append component html line
    $('.new-flavors-row').append(item);


});











// -------------------------------------- 2 -------------------------------------
// delete flavor button
$('div.new-flavors-row').on("click", "button.deletenew-flavor", function(){


    // get id then remove 'Delete' Out
    let id = $(this).attr('id');

    id = id.replace('delete', '');


    // remove the row with this id
    actualFlavors--;



    // use clone to remove the component
    $('#'+id).remove();
    

});













// ------------------------------- dispatch ---------------------


// flavor counter for all products like total chosen
var dispatchflavors = 1;
var dispatchactualFlavors = 1;
var dispatchconfirmation = 0;


// ---------------------- 1 -------------------
$('#dispatch-flavor-button').click(function() {

    // get id
    let id = $(this).attr('id');

    // get number of meal from id number
    let slicecounter = -1;
    let idclone = '';


    while(id.slice(slicecounter) >= '0') {

        idclone = id.slice(slicecounter);
        
        slicecounter--;
    }



    // add new flavor
    dispatchflavors++; //just counter
    dispatchactualFlavors++; //real quantity

    
    // add flavors new
    let item = '<div class="col-12 mt-3" id="dispatch-flavor-'+dispatchflavors+'"><div class="row align-items-end"><div class="col-4"><label>Flavor</label><select name="dispatch-flavor-name" class="form-control custom-select dispatch-flavor-select"><option value="">Chocolate</option><option value="">Vanilla</option><option value="">Caramel</option><option value="">Cookies</option></select></div><div class="col-3"><label>Quantity</label><input type="number" min="1" name="dispatch-flavor-quantity" id="" class="form-control"></div><div class="col-2 text-left"><button id="deletedispatch-flavor-'+dispatchflavors+'" class="btn btn-danger deletedispatch-flavor"><i class="fa fa-trash"></i></button></div><div class="col-12"><hr style="width:50%; border-color:rgb(65, 65, 65) !important;"></div></div></div>';


    
    // append component html line
    $('.dispatch-flavors-row').append(item);


});











// -------------------------------------- 2 -------------------------------------
// delete flavor button
$('div.dispatch-flavors-row').on("click", "button.deletedispatch-flavor", function(){


    // get id then remove 'Delete' Out
    let id = $(this).attr('id');

    id = id.replace('delete', '');


    // remove the row with this id
    dispatchactualFlavors--;



    // use clone to remove the component
    $('#'+id).remove();
    

});









// ----------------------------------- dispatch product -----------------------------


$('#dispatch-product-select').change(function() {

    // get val 
    product = $(this).val();


    // hide all flavors row + show targeted one
    $('.dispatch-flavors-row').addClass('d-none');
    $('#dispatch-flavors-'+product).removeClass('d-none');

});