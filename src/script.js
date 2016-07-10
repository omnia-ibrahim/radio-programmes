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
     var keyword = $('#search_input').val();
     var trimmed = '';

     $('#search_input').blur();
     clearTimeout(typingTimer);

    // Check if string is empty
    if(keyword == ''){
        alert('Search field can not be left blank');
       return;
     }
   
     // Replace every special character and keep only alphanumeric characters and trim them as well
     trimmed = keyword.replace(/[^a-z0-9\s]/gi, '').trim();

     $('#loading-image').show();

    $.ajax({
      type: "POST",
      async: true,
      data: ({search: trimmed}),
      url: "code.php", //Relative or absolute path to response.php file
      success: function(data) {
         $('.page_title').html('Search results for "' + trimmed + '"');
         $('#returned_result').html(data);
       
      },
       complete: function(){
          // Hide loading image
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
