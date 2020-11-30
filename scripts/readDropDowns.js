$( document ).ready(function() {
    console.log( "ready!" );
    /////////////////staff group dropdown ajax call//////////////////////////
    $.ajax({method: "POST", url: "php/readStaffGroup.php"})
    .done(function(returnedData){
      var result = $.parseJSON(returnedData);
        var string = "";
        $.each(result, function(index, value){
            //build an option element string for each object in the returned JSON
            string += "<option value='"+value['StaffGroupId']+"'>" + value['StaffGroupName'] + "</option>";
        });
        //attach the built string to the element on the html      
        $(string).appendTo('#staffGroupDropDown');
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      console.log("Read Error: " + errorThrown);
    });

    ///////////////////////////////////////////////////////////


    /////////////////department dropdown ajax call//////////////////////////
    $.ajax({method: "POST", url: "php/readDepartment.php"})
    .done(function(returnedData){
      var result = $.parseJSON(returnedData);
        var string = "";
        $.each(result, function(index, value){
            //build an option element string for each object in the returned JSON
            string += "<option value='"+value['DepartmentId']+"'>" + value['DepartmentName'] + "</option>";
        });
        //attach the built string to the element on the html      
        $(string).appendTo('#departmentDropDown');
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      console.log("Read Error: " + errorThrown);
    });

    ///////////////////////////////////////////////////////////


	
    /////////////////courses dropdown ajax call//////////////////////////
    $.ajax({method: "POST", url: "php/readCourses.php"})
    .done(function(returnedData){
      var result = $.parseJSON(returnedData);
        var string = "";
        $.each(result, function(index, value){
            //build an option element string for each object in the returned JSON
            string += "<option value='"+value['CourseId']+"'>" + value['CourseTitle'] + "</option>";
        });
        //attach the built string to the element on the html      
        $(string).appendTo('#courseDropDown');
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      console.log("Read Error: " + errorThrown);
    });

    ///////////////////////////////////////////////////////////

});