    function getCourseType(){
        var courseType = getUrlParameter('type');
        console.log("THE COURSE TYPE IS " + courseType);
        if(!courseType){
            alert("Enter a course type in the URL e.g. 'efeedback.html?type=trainer&room=VLE'");
        }
        return courseType;
    }

    function displayTypeQuestions(courseType){
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
    // var courseType = getCourseType();
    // displayTypeQuestions();
