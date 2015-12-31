<?php
session_start();
if(!isset($_SESSION['educational']) || empty($_SESSION['educational']))
{
    header("Location: signupformfour.php");
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
        <script type="text/javascript" src="jslib/jquery-1.11.3.min.js"></script>
        <link rel="stylesheet" href="css/custom.css">
        <script src="jslib/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/verifierform5.js"></script>
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
  <li><a href="#">Step 3</a></li>
  <li><a href="#">Step 4</a></li>
  <li class="active"><a href="#">Step 5</a></li>
</ul>
        
        <h3>Partner Preference</h3>
 
  <form role="form" >
    
      <div class="form-group">
  <label for="preference">What Qualities you want in your partner:</label>
  <textarea id="partner" class="form-control" rows="5" placeholder="Partner Preference not more than 100 words"></textarea>
</div>
      
      <br><br><br><br>
      
      <div class="form-group">
          <p>I agree with all the terms and conditions</p>
          <input id="agree" type="checkbox" class="form-control">
      </div>
      
      <br><br><br><br>
      
      <input id="next" type="button" class="btn btn-danger" value="Create Profile">
      
      
  </form>
        
        
        </div>
            
        </div>
        
        <br><br><br>
      

        <?php include './footer.php'; ?>
        
        <script>
           $("#next").click(function(){ verifyAll(); });
      </script>

    </body>
</html>


