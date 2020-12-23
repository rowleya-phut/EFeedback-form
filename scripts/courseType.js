$( document ).ready(function() {
    //get the room URL parameter
    var courseType = getUrlParameter('type');
    console.log("THE COURSE TYPE IS " + courseType);
    if(!courseType){
        alert("Enter a course type in the URL e.g. 'efeedback.html?type=trainer&room=VLE'");
    }

    function displayTypeQuestions(){
        if (courseType === "video"){
            $(".trainer").each(function(i, el){
                $(this).remove();
            })
        } else if (courseType === "trainer"){
            $(".video").each(function(i, el){
                $(this).remove();
            })
        }
    }

    displayTypeQuestions();


});