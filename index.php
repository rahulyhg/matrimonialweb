<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>ShaadiPlan.com</title>
        
        <link rel="stylesheet" href="css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="css/customstyle.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
        <script type="text/javascript" src="jslib/jquery-1.11.3.min.js"></script>
        <script src="jslib/bootstrap.min.js"></script>
        <script src="js/featureMembers.js"></script>
        <script type="text/javascript" src="js/Login.js"></script>
    </head>
    <body>
            <?php include 'header.php'; ?>
        
        
        <div id="feature" class=" row customcontainer">

        </div>
  
        <div class=" customcontainer container center-block">
        
        
        <form role="form" method="post">
    <div class="form-group">
        <ul class="nav nav-tabs">
            <li class="active"><a href="index.php">Sign In</a></li>
  <li><a href="signupformone.php">Sign Up</a></li>
        </ul>

        <div id="error" class="alert-box error" style="display: none">
            </div>
        <br>
      <label for="username">Username:</label>
      <input id="username" type="text" class="form-control" placeholder="Enter username">

    </div>
      
      <div class="form-group">
      <label for="password">Password:</label>
      <input  id="password" type="password" class="form-control"  placeholder="Enter password">
    </div>

            <input id="login" class=" btn btn-danger" name="login" value="register" type="button">
        </form>
        <br>
        <p><a href="#">Forget Password</a></p>
        <br><br>
    </div>
       
        <br><br><br>
       
        <?php include 'footer.php'; ?>


            <script>

                $(document).ready(function()
                {
                    fetchFeatureMembers();
                    $('#login').click(function(){
                        Login();
                    });
                });
            </script>
        

    </body>
</html>
