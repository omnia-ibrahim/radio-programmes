<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  

  <!-- Include Jquery library-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Include bootstrap CDN-->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384 fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

   <link rel="stylesheet" type="text/css" href="styles/style.css">
   <script src="script.js"></script> 
</head>
<body>

<header>
  <div class='container'>
     <img src='http://static.bbci.co.uk/frameworks/barlesque/3.20.0/orb/4/img/bbc-blocks-light.png' />
  </div>
</header>

  <div id='secondary_menu'>
     
     <div class='container'>
     <img src='http://www.hamilton.bham.sch.uk/images/pic%20links/iplayerradio.png' class='img-responsive'>
     </div>
   </div>
  <div class='container' id='main_content'>

     <h1> Search Results </h1>
     <div class='search'>
         <form action="code.php" method="post">
        <input id="search_input" class="search_input" type="search" placeholder="Search for a programme title" name="q">
       <button class="search_button" type="submit" name='submit' value='submit'>
        </form>
     </div>

        <?php include('code.php');?>
  </div>

 <footer>
    <div class='container'>
   Copyright © 2016 BBC.
     </div>
 </footer>

</body>
</html>
