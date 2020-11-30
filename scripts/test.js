$( document ).ready(function() {
    console.log( "ready!" );
    
 
    //record the time when page first loaded
    var timePageAccessed = Date.now();
    
    //Get the URL parameters
    //https://stackoverflow.com/questions/19491336/get-url-parameter-jquery-or-how-to-get-query-string-values-in-js
    var getUrlParameter = "E371";

    //get the room URL parameter
    var room = "E371";
    console.log("THE ROOM IS " + room);

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
        var form = $(this);
        e.preventDefault(); 

        if(true){
            console.log("SENT!!!!!!");
            var url = "php/testSend2.php";
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
                    //window.location='success.html'
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    console.log("Error" + errorThrown);
                });
        } else {
            alert("You have not answered all mandatory questions");
        }

        //clear the form so when back is pressed the data is not still there
        $("#feedbackForm")[0].reset();   
        
    });

});