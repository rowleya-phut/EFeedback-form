$( document ).ready(function() {
    console.log( "star ready!" );

    $('label').mouseover(function() {
        var l = $(this);

        //if not previously clicked or left of clicked sibling do this
        if(!l.hasClass('locked')){
            // console.log("not locked");
            l.css("color", "gold");
            l.prevUntil('legend').not('.locked').css("color", "gold"); 
        }
     });

     $('label').mouseout(function() {
        var l = $(this);
        if(!l.hasClass('locked')){ //not working yet
            l.css("color", "#ddd");
            l.prevUntil('legend').not('.locked').css("color", "#ddd"); 
        }
     });

    $("label").on('click', function(){
        var l = $(this);
        l.css("color", "orange").addClass('locked');
        l.prevUntil('legend').css("color", "orange").addClass('locked');
        l.nextAll().css("color", "#ddd").removeClass('locked');   
    });


});