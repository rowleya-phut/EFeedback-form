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
    
    //Get the URL parameters
    //https://stackoverflow.com/questions/19491336/get-url-parameter-jquery-or-how-to-get-query-string-values-in-js
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&');
    
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
    
            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };

    //get the room URL parameter
    var room = getUrlParameter('room');
    //console.log("THE ROOM IS " + room);

    //append the room data as a field in the form
    var roomElement = $("<input>")
    .attr("type", "hidden")
    .attr("name", "room").val(room);
    $('#feedbackForm').append(roomElement);


    //append the time data as a field in the form
    var timeAccessedData = $("<input>")
    .attr("type", "hidden")
    .attr("name", "timeAccessed").val(timePageAccessed);
    $('#feedbackForm').append(timeAccessedData);


    $("#feedbackForm").submit(function(e) {
        //validate form
        var form = $(this);
        //section 0 (details)
        var detailsCompleted = true;
        $('.details').each(function(){
            var isDefaultValue = ($(this).children("option:selected").val()).includes("Choose");
            if(isDefaultValue){
                $(this).css('border-color', '#C80000');
                detailsCompleted = false;
            } else {
                $(this).css('border-color', '#BDC7BC');
            }
        });
        console.log("details comepleted: " + detailsCompleted);
        //section 1 (content)
        var contentCompleted = true;
        $('.content').each(function(){
            //console.log($(this).children("input:checked").length);
            if ($(this).children("input:checked").length == 0){
                contentCompleted = false;
                var id = $(this).attr('id');
                //find the equivalent text question and make red
                var qId = id.replace("B", "A");
                console.log(qId);
                console.log($('#'+qId+''));
                $('#'+qId+'').css('color', 'red'); 

            } else{
                var id = $(this).attr('id');
                //find the equivalent text question and make black
                var qId = id.replace("B", "A");
                console.log(qId);
                console.log($('#'+qId+''));
                $('#'+qId+'').css('color', 'black'); 
            }
        });
        console.log("Content completed: " + contentCompleted);
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
        //section 2 (learningb)
        var learningbCompleted = true;
        $('.learningb').each(function(){
            //console.log($(this).children("input:checked").length);
            if ($(this).children("input:checked").length == 0){
                learningbCompleted = false;
                var id = $(this).attr('id');
                //find the equivalent text question and make red
                var qId = id.replace("B", "A");
                $('#'+qId+'').css('color', 'red'); 
                // $([document.documentElement, document.body]).animate({
                //     scrollTop: $('#'+qId+'').offset().top + (-200)
                // }, 1000);
            } else{
                var id = $(this).attr('id');
                //find the equivalent text question and make black
                var qId = id.replace("B", "A");
                $('#'+qId+'').css('color', 'black'); 
            }
        });
        console.log("learningb completed: " + learningbCompleted);
        //section 3 (qualitya)
        var qualityaCompleted = true;
        if($('.qualitya').children("input:checked").length == 0){
            qualityaCompleted = false;
            $('.qualitya').parent().css("color","red");
        } else {
            $('.qualitya').parent().css("color","black");
        }
        //section 3 (qualityb)
        var qualitybCompleted = true;
        $('.qualityb').each(function(){
            //console.log($(this).children("input:checked").length);
            if ($(this).children("input:checked").length == 0){
                qualitybCompleted = false;
                var id = $(this).attr('id');
                //find the equivalent text question and make red
                var qId = id.replace("B", "A");
                $('#'+qId+'').css('color', 'red'); 
                // $([document.documentElement, document.body]).animate({
                //     scrollTop: $('#'+qId+'').offset().top + (-200)
                // }, 1000);
            } else{
                var id = $(this).attr('id');
                //find the equivalent text question and make black
                var qId = id.replace("B", "A");
                $('#'+qId+'').css('color', 'black'); 
            }
        });  
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
                
                //redirect to success page
                //window.location='index.html'
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                console.log("Error" + errorThrown);
            });
            
    });
});