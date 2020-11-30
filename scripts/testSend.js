//code to respond to click event which runs a php/testSend2.php

$( document ).ready(function() {
    console.log( "ready!" );
    



    function submitTestForm(e) {

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
    });

});