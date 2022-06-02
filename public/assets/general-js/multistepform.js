var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");

  
  // check if one value is empty
  let emptyCheck = 0;
  let emptyCheckboxesCheck = 0;

  // check tab 1 items
  if (n == 1) {

    
    $('.tab-field-1').each(function() {

        if (!($(this).val())) {

          emptyCheck = 1;

        }

    });
    
  } //end tab 1 items







  // check tab 2 items
  if (n == 2) {

    
    $('.tab-field-2').each(function() {

        if ($(this).val() == 0) {

          emptyCheck = 1;

        }

    });
    
  } //end tab 2 items





  
  // check tab 3 items
  if (n == 3) {

    
    $('.tab-field-3').each(function() {

        if (!($(this).val())) {

          emptyCheck = 1;

        }

    });




    //get the products name
    productName = "";
    flavorItem = "";
    priceSum = 0;
    cityCharge = 0;

    // 1- products names
    $('.purchased-product').each(function() {


      for (let loop = 0; loop < productsArray.length; loop++) {

        if ($(this).val() == productsArray[loop]['id']) {

          productName = " | "+productsArray[loop]['name'];

          //insert
          $('#summary-products-wrapper').text($('#summary-products-wrapper').text()+productName);

        }

      }

    });
    



    // 2 flavors + quantity 
    $('.purchased-flavor').each(function() {


      for (let loop = 0; loop < flavorsArray.length; loop++) {

        
        if ($(this).val() == flavorsArray[loop]['id']) {


          // get id
          let id = $(this).attr('id');

          // get number of meal from id number
          let slicecounter = -1;
          let idclone = '';


          while(id.slice(slicecounter) >= '0') {

              idclone = id.slice(slicecounter);
              
              slicecounter--;
          }



          //get the order quantity then append it
          quantityCount = $("#purchased-quantity-"+idclone).val()

          flavorItem = '<span class="flavor-summary-span">'+flavorsArray[loop]['name']+'<span class="text-warning ml-1">('+quantityCount+')</span></span>';

          $('#summary-flavors-wrapper').append(flavorItem);



          //get the price also
          priceSum += parseFloat(flavorsArray[loop]['price']) * parseInt(quantityCount);

        }

      }

    });





    // 3 update price
    $('#summary-products-price').text(priceSum);
    

    // 4 update delivery charge
    for (let loop = 0; loop < chargesArray.length; loop++) {

        if ($('#cityselect').val() == chargesArray[loop]['city_id']) {

          cityCharge = parseFloat(chargesArray[loop]['fees']);

          $('#summary-delivery-price').text(cityCharge);
          break;

        }

      }





      // 5 get total price
      totalPriceSum = parseFloat(priceSum) + parseFloat(cityCharge);
      $('#summary-total-price').text(totalPriceSum+' (AED)');



  } //end tab 3 









  // first tab
  if (n == 0) {


    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = n;


    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";


    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
      $("#nextBtn").attr('type', 'button');

    }


     // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)

  } //end first tab




  // other tabs
  else if (emptyCheck == 0 && n < 5) {

    // Hide the current tab:
    if (n == 4) {
      $('form#myform').submit();
    }

    if (n < 4) {
      x[currentTab].style.display = "none";
    }

    // Increase or decrease the current tab by 1:
    currentTab = n;

   
    
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";
      // $("#nextBtn").attr('type', 'submit');
      

    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
      $("#nextBtn").attr('type', 'button');

    }


     // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)
     


  } //end else

 

  
}

function nextPrev(n) {

  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  // if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  // x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  // alert(n);

  // currentTab = currentTab + n;
  // if you have reached the end of the form... :
 
  // if (currentTab == (x.length - 1) && n == 1) {
  //   //...the form gets submitted:
  //   document.getElementById("regForm").submit();
  //   // return false;
  // }
  // Otherwise, display the correct tab:




  // check if all fields filled
  checkPass = 0;

  
  // make empty fields red border
  $('.tab-field-'+(currentTab + n)).each(function() {


      if (!($(this).val())) {

          $(this).addClass('border-danger');
          checkPass = 1;

      } else {

          $(this).removeClass('border-danger');

      }

  });





  // if there's no empty field
  if (checkPass == 0) {

    showTab(currentTab + n);

  }

        


}

function validateForm() {

  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  // x = document.getElementsByClassName("tab");
  // y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
//   for (i = 0; i < y.length; i++) {
//     // If a field is empty...
//     if (y[i].value == "") {
//       // add an "invalid" class to the field:
//       y[i].className += " invalid";
//       // and set the current valid status to false:
//       valid = false;
//     }
//   }
  // If the valid status is true, mark the step as finished and valid:
  // if (valid) {
  //   document.getElementsByClassName("step")[currentTab].className += " finish";
  // }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}