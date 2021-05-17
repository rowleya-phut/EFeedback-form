$( document ).ready(function() {
    console.log( "ready!" );
    /////////////////staff group dropdown api call//////////////////////////
    $.getJSON("http://localhost/Efeedback-form/php/api/staffGroup/read.php", function(data){
      var string = "";
      $.each(data.records, function(index, value){
        string += "<option value='"+value['staffGroupId']+"'>" + value['staffGroupName'] + "</option>";
      })
      $(string).appendTo('#staffGroupDropDown');
    })

    ///////////////////////////////////////////////////////////


    /////////////////department dropdown api call//////////////////////////
    $.getJSON("http://localhost/Efeedback-form/php/api/department/read.php", function(data){
      var string = "";
      $.each(data.records, function(index, value){
        string += "<option value='"+value['departmentId']+"'>" + value['departmentName'] + "</option>";
      })
      $(string).appendTo('#departmentDropDown');
    })

    ///////////////////////////////////////////////////////////


    /////////////////courses dropdown api call//////////////////////////
    $.getJSON("http://localhost/Efeedback-form/php/api/course/read.php", function(data){
      var string = "";
      $.each(data.records, function(index, value){
        string += "<option value='"+value['courseId']+"'>" + value['courseTitle'] + "</option>";
      })
      $(string).appendTo('#courseDropDown');
    
    });

    ///////////////////////////////////////////////////////////

});