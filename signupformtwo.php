<?php

    session_start();
    if(!isset($_SESSION['basicInfo']) || empty($_SESSION['basicInfo']))
    {
        header("Location: signupformone.php");
    }


?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
        
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/customstyle.css">
        
        <link rel="stylesheet" href="css/custom.css">
        <link rel="stylesheet" href="jslib/spell/src/css/jquery.spellchecker.css">
        <script type="text/javascript" src="jslib/jquery-1.11.3.min.js"></script>
        <script src="jslib/bootstrap.min.js"></script>
        <script type="text/javascript" src="jslib/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/Country.js"></script>
        <script type="text/javascript" src="js/Religion.js"></script>
        <script type="text/javascript" src="js/Language.js"></script>
        <script type="text/javascript" src="jslib/spell/src/js/jquery.spellchecker.js"></script>
        <script type="text/javascript" src="js/verifierForm2.js"></script>
        
    </head>
    <body>
        
  
            <?php include 'header.php'; ?>
        
         <div id="error" class="alert-box error" style="display: none">
      <span>Error</span>
  </div>
        
        <div class=" customcontainer">
            
    <div class="form-group">
        <ul class="nav nav-tabs">
            <li ><a href="index.php">Sign In</a></li>
  <li class="active"><a  href="signupformone.php">Sign Up</a></li>
        </ul>
            
        <ul class="pagination">
  <li ><a href="#">Step 1</a></li>
  <li class="active"><a href="#">Step 2</a></li>
  <li><a href="#">Step 3</a></li>
  <li><a href="#">Step 4</a></li>
  <li><a href="#">Step 5</a></li>
</ul>
         <h3>Socio Religious Background</h3>
 
  <form role="form" >
    <div class="form-group">
      <label for="country">Country</label>
      <select id="country" class="form-control paddingdropdown">
    
</select>
    </div>
      
      <div class="form-group">
      <label for="state">State:</label>
      <select id="state" class="form-control paddingdropdown">
    
</select>
    </div>

      <div class="form-group">
          <label for="codes">Phone Number:</label>
          <div class="form-inline">
              <select id="codes" class="form-control" onfocus="loadCountryCodes()">
              </select>

              <input id="cell" type="tel" class="form-control"  placeholder="Enter Number" onchange = "verifyCell( $('#cell').val() )">
          </div>
      </div>

      <div class="form-group">
      <label for="religion">Religion:</label>
      <select id="religion" class="form-control paddingdropdown">
    
</select>
    </div>
      
      
      
      <div class="form-group">
      <label for="sect">Sect:</label>      
      <select id = "sect" class="form-control paddingdropdown" >
   
</select>
    </div>
      
      <label for="language">Language:</label>      
      <select id="language" class="form-control paddingdropdown">
    
</select>
      
      
     
      
     <div id ="text" class="form-group">
  <label for="about"></label>
  <textarea id="me" class="form-control" rows="5" placeholder="little about yourself"></textarea>
</div>
      
      <br>
      <input type="button" class="btn btn-danger" id="next" value="Next Step">
      
  </form>
       
        </div>      
        </div>
        
        <br><br><br>
      

        <?php include './footer.php'; ?>
        
        
        <script>

        $(document).ready(function(){

            loadCountriesName();
            getReligions();
            getLanguages();
            loadCountryCodes();
            $("#religion").change(function(){

                getSects(this.value);

            });

            $('#country').change(function(){
                   //'#country option:selected'
                console.log( 'value: ' + $(this).val());
                getStates(this.value);
            });

            $('#next').click(function(){

                verifyAll();
            });

        });

    </script>
        

    </body>
</html>


