$(function() {

  // If search button is clicked
  $(".search_button").click(function() {
     
     return searchProgrammes(); 
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
  
  
   //setup before functions
   var typingTimer;                //timer identifier
   var doneTypingInterval = 5000;  //time in ms, 5 second for example
   var $input = $('#search_input');

   /*
    * User is "finished typing,or search button is clicked" search for the keyword
    */
   function searchProgrammes () {
      
     $('#search_input').blur();
     clearTimeout(typingTimer);
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
         $('.page_title').html('Search results for "' + $('#search_input').val() + '"');
         $('#returned_result').html(data);
       
      },
       complete: function(){

          $('#loading-image').hide();
      }
    });
    return false;

  }
  //on keyup, start the countdown
  $input.on('keyup', function () {
     clearTimeout(typingTimer);
     typingTimer = setTimeout(searchProgrammes, doneTypingInterval);  
   });

  //on keydown, clear the countdown 
  $input.on('keydown', function () {
    clearTimeout(typingTimer);
  });

});
