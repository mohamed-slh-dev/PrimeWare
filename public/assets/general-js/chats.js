


// drivers name button
$('.chats-button').click(function() {

    //get the id number of button
    let k = $(this).attr('id');

    // slicer and y
    let slicecounter = -1;
    let y = '';

    while(k.slice(slicecounter) >= '0') {

        y = k.slice(slicecounter);
        
        slicecounter--;
    }

    
    // add to the button a class to be active adn remove from others
    $('.chats-button').removeClass('new-message');
    $('#'+k).addClass('new-message');
    

    // hide all other chats-wrapper then add again
    $('.chats-wrapper').removeClass('d-none');
    $('.chats-wrapper').addClass('d-none');

    // remove class from the targeted chat
    $('#chat-'+y).removeClass('d-none');


});