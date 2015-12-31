<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/30/2015
 * Time: 2:48 PM
 */
   if(!session_start())
   {
       session_start();
   }

   if(!isset($_SESSION['id']))
   {
       //header("Location: index.php");
   }

?>

<html>

<script type="text/javascript" src="jslib/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/RegistrationMail.js"></script>

<body>

<p>

    A mail with the registered link is sent to your account.
</p>

<p>  In case if the mail is not reached within 10 minutes kindly click is link below to send again</p>
     <form>

         <button id="resend" onclick="resendMail()">Resend Mail</button>

     </form>
   <script>

       $(document).ready(function(){

           resendMail();
       });

   </script>

</body>

</html>

