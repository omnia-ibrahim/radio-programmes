$(function() {


  $(".episodes_list").hide();
  $(".show_episodes").click(function(){
        $(this).text("Hide available episodes");
        $(this).addClass('hide_episodes');
        $(this).removeClass('show_episodes');
        $(this).next().show();
        
       $(".hide_episodes").click(function(){
  
        $(this).text("Show available episodes");
        $(this).addClass('show_episodes');
        $(this).removeClass('hide_episodes');
        $(this).next().hide();
        return false;
       });

        return false;
    });
   
  });
