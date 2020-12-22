$( document ).ready(function() {
    console.log( "ready!" );
    let hiddenClassName =  $("#personalName");
    let hiddenClassJobTitle = $('#jobTitle');
    $('#personalCheck').change(
        function(){
            if (this.checked) {
                hiddenClassName.removeClass("hidden");
                hiddenClassJobTitle.removeClass("hidden");
                // console.log("Showing hidden name field");
            } else if(!this.checked) {
                hiddenClassName.addClass("hidden");
                hiddenClassJobTitle.addClass("hidden");

            }
        });

});