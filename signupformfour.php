<?php
session_start();
if(!isset($_SESSION['physical']) || empty($_SESSION['physical']))
{
    header("Location: signupformthree.php");
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
        <script type="text/javascript" src="jslib/jquery-1.11.3.min.js"></script>
        <script src="jslib/bootstrap.min.js"></script>
        <script src="js/Education.js"></script>
        <script src="js/Field.js"></script>
        <script src="js/Currency.js"></script>
        <script src="js/verifierform4.js"></script>
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
  <li ><a href="#">Step 3</a></li>
  <li class="active"><a href="#">Step 4</a></li>
  <li><a href="#">Step 5</a></li>
</ul>
            <h3>Educational/Professional</h3>
 
  <form role="form" >
    
      <div class="form-group">
          <label for="education">Educational level:</label>
          <select id="education" class="form-control paddingdropdown">

      </select>
    </div>
      
      <div class="form-group">
          <label for="field">Field:</label>
          <select id="field" class="form-control paddingdropdown">
    <option value="one"></option>
    <option value="two"></option>
    <option value="three"></option>
    <option value="four"></option>
    <option value="five"></option>
      </select>
    </div>
      
      <div class="form-group">
          <label for="job">Working With:</label>
          <select id="working" class="form-control paddingdropdown">
      </select>
    </div>
      
       <div class="form-group">
          <label for="income">Monthly Income:</label>
          <div class="form-inline">
          <select id="currency" class="form-control paddingdropdown">
      </select>

              <input id="salary" type="number" class="form-control"  placeholder=" Salary"  min="100">
          
          </div>
    </div>
      
      
      
      <br>
      <input id="next" type="button" class="btn btn-danger" value="Next Step">
      
      
  </form>
        </div>
            
        </div>
        
        <br><br><br>
      

        <?php include './footer.php'; ?>
        
        
        <script>

          $(document).ready(function()
          {
              getEducationList();
              getAllField();
              getWorkingList();
              getCurrenyList();
              $("#next").click(function(){verifyAll();});
          });


      </script>
        

    </body>
</html>


