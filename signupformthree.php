<?php
session_start();
if(!isset($_SESSION['socialInfo']) || empty($_SESSION['socialInfo']))
{
    header("Location: signupformtwo.php");
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
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/custom.css">
        <script type="text/javascript" src="jslib/jquery-1.11.3.min.js"></script>
        <script src="jslib/bootstrap.min.js"></script>
        <script src="js/MartialStatus.js"></script>
        <script src="js/Family.js"></script>
        <script src="js/Disabilities.js"></script>
        <script src="js/height.js"></script>
        <script src="js/verifierform3.js"></script>
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
  <li ><a href="#">Step 2</a></li>
  <li class="active"><a href="#">Step 3</a></li>
  <li><a href="#">Step 4</a></li>
  <li><a href="#">Step 5</a></li>
</ul>
         <h3>Physical / Family Information</h3>
 
  <form role="form" >
    <div class="form-group">
      <label for="height">Height:</label>
      <select id="height" class="form-control paddingdropdown">
            </select>
    </div>
      
      <div class="form-group">
      <label for="weight">Weight:</label>
      <select id="weight" class="form-control paddingdropdown">
          </select>
    </div>
    
      <div class="form-group form-inline">
          <label for="disablilities">Any Disabilities:</label><p>(Please Mention)</p>
          <div class="radio">
              <label><input  id="yes" type="radio" value="1">Any disability ?</label>
               </div>
          <select id="disability" class="form-control paddingdropdown">
      </select>
    </div>
      
      <div class="form-group">
          <label for="martial">Martial Status:</label>
          <select id="martial" class="form-control paddingdropdown">

      </select>
    </div>
      
      <div class="form-group">
          <label for="family_type">Family Type:</label>
          <select id="type" class="form-control paddingdropdown">

      </select>
    </div>
      
      <div class="form-group">
          <label for="family_status">Family Status:</label>
          <select id="class" class="form-control paddingdropdown">
      </select>
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
                   loadAll();
                   getsAllFamilyTypes();
                   getAllFamilyClasses();

                   $('#yes').click(function(){
                       getAllDisability();
                   });

                   var feets = getFeets();
                   var height = getHeights();
                   var weight = getWeight();
                   for(var i=0; i< feets.length; i++)
                   {
                       $("#height").append($("<option />").val(height[i]).text(feets[i]));
                   }

                  for(var i=0; i<weight.length; i++)
                  {
                      $("#weight").append($("<option />").val(weight[i]).text(weight[i]));
                  }

                  $('#next').click(function(){

                      verfiyAll();
                  });
            });

        </script>

    </body>
</html>


