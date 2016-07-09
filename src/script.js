$(function() {



  $(".search_button").click(function(){
   

    if($('#search_input').val() == ''){
      alert('Search field can not be left blank');
      return;
    }
    $('#loading-image').show();
    $.ajax({
      type: "POST",
      async: true,
      data: ({search: $('#search_input').val()}),
      url: "code.php", //Relative or absolute path to response.php file
      success: function(data) {
        // alert(data)

       $('#returned_result').html(data);
       
       // alert("Form submitted successfully.\nReturned json: " + data["json"]);
      },
       complete: function(){
        $('#loading-image').hide();
      }
    });
    return false;
  });
   
  // Display loading image
    $('#loading-image').bind('ajaxStart', function(){
    $(this).show();
  }).bind('ajaxStop', function(){
    $(this).hide();
   });


  // Hide and show of episodes
   $(document).on("click", ".show_episodes", function(){

        $(this).text("Hide available episodes");
        $(this).addClass('hide_episodes');
        $(this).removeClass('show_episodes');
        $(this).next().show();
        
        $(document).on("click", ".hide_episodes", function(){      
 
  
        $(this).text("Show available episodes");
        $(this).addClass('show_episodes');
        $(this).removeClass('hide_episodes');
        $(this).next().hide();
        return false;
       });

        return false;
    });


});
