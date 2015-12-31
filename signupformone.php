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
        <script type="text/javascript" src="jslib/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/Country.js"></script>
        <script type="text/javascript" src="js/Verifier.js"></script>


    </head>
    <body>
        
  
            <?php include 'header.php'; ?>
        
        

        
        <div class=" customcontainer">
            
    <div class="form-group">
        <ul class="nav nav-tabs">
            <li ><a href="index.php">Sign In</a></li>
  <li class="active"><a  href="signupformone.php">Sign Up</a></li>
        </ul>
            
        <ul class="pagination">
  <li class="active"><a href="#">Step 1</a></li>
  <li ><a href="#">Step 2</a></li>
  <li><a href="#">Step 3</a></li>
  <li><a href="#">Step 4</a></li>
  <li><a href="#">Step 5</a></li>
</ul>
         <h3>Basic Information</h3>

        <div id="error" class="alert-box error" style="display: none">
            <span>Error</span>
        </div>
         <form role="form" >
             
       <div id="form">
             <div class="form-group">
      <label for="username">Username:</label>
      <input id="name" type="text" class="form-control" placeholder="Enter username" onchange="verifyUsername($('#name').val())">
    </div>
      
      <div class="form-group">
      <label for="email">Email:</label>
      <input  id="email" type="email" class="form-control"  placeholder="Enter email" onchange="verifyEmail( $('#email').val() )">
    </div>
    
      <div class="form-group">
      <label for="pwd">Password:</label>
      <input id="password" type="password" class="form-control"  placeholder="Enter password">
    </div>
      
      <div class="form-group">
      <label for="again_pwd">Confirm Password:</label>
      <input id="conform" type="password" class="form-control"  placeholder="Enter password again"onchange="validatePasswords()">
    </div>
      

      <div class="form-group">
      <label for="gender">Gender:</label>
      
        <div class="radio">
            <label><input id="male" type="radio"  name="optmale" value="1">Male</label>
            <label><input id="female" type="radio" name="optfemale" value="2">Female</label>
        </div>
        </div>
      
      <div class="form-group">
      <label for="dob">Date of Birth:</label>
      <input id="dob" type="date" class="form-control">
    </div>
      
      <br>
      <input type="button" class="btn btn-danger" id="next" value="Next Step">
      
      
             
        </form>
       
        </div>
            
        </div>
            </div>
        <br><br><br>
        
            <?php include './footer.php'; ?>
        
        
        <script>

                  loadCountryCodes();
                  $(document).ready(function()
                  {
                      var id = "#form";
                      $(id).hide();
                      $(id).slideDown(2000,function(){
                           $(id).show();
                           window.scrollTo(0,document.body.scrollHeight);
                      });

                      loadCountryCodes();

                      $("#next").click(function(){

                          verifyAll();
                      });

                  });
              </script>

    </body>
</html>
