$( document ).ready(function() {
    console.log( "ready!" );
    
    //logic to disable other options when 'none of these apply' is selected
    var trainerFlag = false;    
    
    $('.none').click(function(){
        //console.log("CLICKED!!!");
        if(!trainerFlag){
            trainerFlag = true;
            $('.other').attr('disabled', '');
            $('.other').prop("checked", false);
        } else{
            trainerFlag = false;
            $('.other').removeAttr('disabled');
        }
    });
    //logic to disable other options when 'none of these apply' is selected
    var impactFlag = false;    
        $('.noneImpact').click(function(){
            //console.log("CLICKED!!!");
            if(!impactFlag){
                impactFlag = true;
                $('.otherImpact').attr('disabled', '');
                $('.otherImpact').prop("checked", false);
            } else{
                impactFlag = false;
                $('.otherImpact').removeAttr('disabled');
            }
        });

    //record the time when page first loaded
    var timePageAccessed = Date.now();
    var timePageAccessed = Math.floor(timePageAccessed /1000);
    console.log("TIME PAGE ACCESSED IS " + timePageAccessed);

    //get the room URL parameter
    var room = getUrlParameter('room');
    console.log("THE ROOM IS " + room);

    if(!room){
        alert("Enter a room type in the URL e.g. 'efeedback.html?type=trainer&room=VLE'");
    }

    //append the room data as a field in the form
    var roomElement = $("<input>")
    .attr("type", "hidden")
    .attr("name", "room").val(room);
    $('#feedbackForm').append(roomElement);

    //append the coursetype data as a field in the form (from courseType.js - a dependency)
    var typeElement = $("<input>")
    .attr("type", "hidden")
    .attr("name", "type").val(courseType);
    $('#feedbackForm').append(typeElement );

    //append the time data as a field in the form
    var timeAccessedData = $("<input>")
    .attr("type", "hidden")
    .attr("name", "timeAccessed").val(timePageAccessed);
    $('#feedbackForm').append(timeAccessedData);


    $("#feedbackForm").submit(function(e) {

        //validate form
        var form = $(this);
        //section 0 (details) - dropdown box validation
        var detailsCompleted = true;
        $('.details').each(function(){
            //includes() not compatible with IE11
            //so using IE11 polyfill
            //https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/includes#Polyfill
            if (!String.prototype.includes) {
                String.prototype.includes = function(search, start) {
                  'use strict';
              
                  if (search instanceof RegExp) {
                    throw TypeError('first argument must not be a RegExp');
                  } 
                  if (start === undefined) { start = 0; }
                  return this.indexOf(search, start) !== -1;
                };
              }
            var isDefaultValue = ($(this).children("option:selected").val()).includes("Choose");

            var optionValue = $(this).children("option:selected").val();
            // optionValue

            if(isDefaultValue){
                $(this).css('border-color', '#C80000');
                detailsCompleted = false;
            } else {
                $(this).css('border-color', '#BDC7BC');
            }
        });
        console.log("details completed: " + detailsCompleted);

        //star ratings validation
        var starRatingCompleted = true;
        $('.starRating').each(function(){
            //console.log($(this).children("input:checked").length);
            if ($(this).children("input:checked").length == 0){
                starRatingCompleted = false;
                var id = $(this).attr('id');
                //find the equivalent text question and make red
                var qId = id.replace("B", "A");
                // console.log(qId);
                // console.log($('#'+qId+''));
                $('#'+qId+'').css('color', 'red'); 

            } else{
                var id = $(this).attr('id');
                //find the equivalent text question and make black
                var qId = id.replace("B", "A");
                // console.log(qId);
                // console.log($('#'+qId+''));
                $('#'+qId+'').css('color', 'black'); 
            }
        });
        
        //radio and checkbox validation
        //section0 (attend in own time)
        var attendInOwnTimeCompleted = true;
        if($('.attendInOwnTime').children("input:checked").length == 0){
            attendInOwnTimeCompleted = false;
            $('.attendInOwnTime').parent().css("color","red");
            
        } else {
            $('.attendInOwnTime').parent().css("color","black");
        }

        //section1b (contentb)
        var contentbCompleted = true;
        if($('.contentb').children("input:checked").length == 0){
            contentbCompleted = false;
            $('.contentb').parent().css("color","red");
        } else {
            $('.contentb').parent().css("color","black");
        }
        //section 2 (learninga)
        var learningaCompleted = true;
        if($('.learninga').children("input:checked").length == 0){
            learningaCompleted = false;
            $('.learninga').parent().css("color","red");
        } else {
            $('.learninga').parent().css("color","black");
        }

        //section 3 (qualitya)
        var qualityaCompleted = true;
        if($('.qualitya').children("input:checked").length == 0){
            qualityaCompleted = false;
            $('.qualitya').parent().css("color","red");
        } else {
            $('.qualitya').parent().css("color","black");
        }
  
        // section 3 (qualityc)      
        var qualitycCompleted = true;
        if($('.qualityc').children("input:checked").length == 0){
            qualitycCompleted = false;
            $('.qualityc').parent().css("color","red");
        } else {
            $('.qualityc').parent().css("color","black");
        }

        // $([document.documentElement, document.body]).animate({
        //     scrollTop: $('#'+qId+'').offset().top + (-200)
        // }, 1000);

        // to execute the actual submit of the form.

        e.preventDefault(); 

        if(starRatingCompleted && contentbCompleted && learningaCompleted && qualityaCompleted && qualitycCompleted){

            
            console.log("SENT!!!!!!");
            var url = "php/submitFeedback.php";
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                datatype: 'json',
                })
                .done(function (data) { 
                    console.log('Submission successful');
                    console.log(data);
                //clear the form so when back is pressed the data is not still there
                // $("#feedbackForm")[0].reset(); 
                    
                    //redirect to success page
                    // window.location='success.html'
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    console.log("Error" + errorThrown);
                });
        } else {
            alert("You have not answered all mandatory questions");
        }

  
        
    });

});